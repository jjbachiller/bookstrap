<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Bookstrap\StatisticsCalculator;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'active.user']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // See if the user has a book created as guess.
      $book = Book::getCreatedAsGuessBook();
      if ($book) {
        $book->created_as_guess = false;
        $book->save();
        // Return view for created as guess book.
        return view('dashboard.guest-book', compact('book'));
      }

      $statistics = StatisticsCalculator::dashBoardStatistics();

      $books = auth()->user()->books()->withContent()->orderBy('id', 'desc')->paginate(config('bookstrap-constants.NUM_BOOKS_PAGINATION'));

      return view('dashboard.index', compact('books', 'statistics'));
    }

    public function download($bookUid, $date, $book)
    {

      if (Gate::denies('active-subscription')) {
        request()->session()->flash('deny', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.code'));
        request()->session()->flash('message', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.message'));
        return redirect()->route('books.index');
      }

      $userUid =  Auth::user()->uid;
      $bookPath = config('bookstrap-constants.downloads_path') . $userUid . '/' . $bookUid . '/' . $date  . '/' . $book;
      $file = Storage::path($bookPath);
      if (!is_file($file)) {
        abort(404);
      }
      //return response()->file($file);
      $fileInfo = pathinfo($file);
      $contentType = ('.'.$fileInfo['extension'] == config('bookstrap-constants.PDF_EXTENSION')) ? config('bookstrap-constants.PDF_CONTENT_TYPE'):config('bookstrap-constants.PPT_CONTENT_TYPE');
      $headers = array('Content-Type' => $contentType);
      $response = response()->download($file,$fileInfo['basename'],$headers);
      ob_end_clean();
      // Save the download in the downloads table.
      return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId)
    {
      $book = \App\Book::with(['sections.images', 'sections.solutions'])->findOrFail($bookId);
      if (auth()->user()->id != $book->user_id) {
        return abort(401);
      }
      session(['idBook' => $book->id]);

      return view('wizard.content', compact('book'));
    }

    public function update(Request $request) {
      if (Gate::allows('active-subscription')) {
        $book = \App\Book::findOrFail(session('idBook'));
        if (auth()->user()->id != $book->user_id) {
          return abort(401);
        }

        $bookData = json_decode($request->getContent(), true);
        $book->name = $bookData['filename'];
        $bookTypes = config('book-types');
        $book->book_type = array_key_exists($bookData['type'], $bookTypes) ? $bookData['type'] : array_shift($bookTypes);
        $bookSizes = config('book-sizes');
        $book->dimensions = array_key_exists($bookData['size'], $bookSizes) ? $bookData['size'] : reset($bookSizes);
        $book->img_position = $bookData['imagePosition'];
        $book->img_scale = $bookData['imageSize'];
        $book->footer_details = $bookData['footer']['addFooter'] ? $bookData['footer']['text'] : '';
        $book->page_number_position = $bookData['pageNumber']['addPageNumber'] ? $bookData['pageNumber']['position'] : 0;
        $book->add_blank_pages = $bookData['addBlankPages'];
        $book->full_bleed = $bookData['fullBleed'];
        $book->total_pages = $bookData['totalPages'];
        $book->save();

        $book->updatedPagesAndSize();

        return $book;
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
      $user = auth()->user();
      if ($user->id != $book->user_id) {
        return abort(401);
      }

      if (Gate::denies('active-subscription')) {
        request()->session()->flash('deny', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.code'));
        request()->session()->flash('message', config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.message'));
        return redirect()->route('books.index');
      }

      // Delete uploads path content for the book
      $bookUploads = config('bookstrap-constants.uploads_path') . $user->uid . '/' . $book->uid;
      Storage::deleteDirectory($bookUploads);
      // Delete download content for the book
      $bookDownloads = config('bookstrap-constants.downloads_path') . $user->uid . '/' . $book->uid;
      Storage::deleteDirectory($bookDownloads);
      // Delete book data in DB
      $book->deleteWithSections();
      // Redirect to home
      return redirect('home');
    }
}
