<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\bookstrap\StatisticsCalculator;

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
      $userUid =  Auth::user()->uid;
      $bookPath = config('bookstrap-constants.downloads_path') . $userUid . '/' . $bookUid . '/' . $date  . '/' . $book;
      $file = Storage::path($bookPath);
      if (!is_file($file)) {
        abort(404);
      }
      return response()->file($file);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId)
    {
      $book = \App\Book::findOrFail($bookId);
      if (auth()->user()->id != $book->user_id) {
        return abort(401);
      }
      session(['idBook' => $book->id]);

      // Generate image data for dropZone (FIXME: Take it out of here!
      $virtualPath = config('bookstrap-constants.uploads_virtual_path') . $book->uid . '/';
      foreach ($book->sections as $key => $section)
      {
        // Section images.
        $sectionFolder = Storage::path($section->getContentFolder());
        $virtualFolder = $virtualPath . $section->folder . '/';
        $book->sections[$key]->{"images"} = getImageExtendedDataFromFolder($sectionFolder, $virtualFolder);
        // Solutions images.
        $solutionsFolder = $sectionFolder . config('bookstrap-constants.SOLUTIONS_FOLDER');
        $virtualSolutionsFolder = $virtualFolder . config('bookstrap-constants.SOLUTIONS_FOLDER');
        $book->sections[$key]->{"solutions"} = getImageExtendedDataFromFolder($solutionsFolder, $virtualSolutionsFolder);
      }

      return view('wizard.content', compact('book'));
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
      // Delete uploads path content for the book
      $bookUploads = config('bookstrap-constants.uploads_path') . $user->uid . '/' . $book->uid;
      Storage::deleteDirectory($bookUploads);
      // Delete download content for the book
      $bookDownloads = config('bookstrap-constants.downloads_path') . $user->uid . '/' . $book->uid;
      Storage::deleteDirectory($bookDownloads);
      // Delete book data in DB
      $book->deleteBook();
      // Redirect to home
      return redirect('home');
    }
}
