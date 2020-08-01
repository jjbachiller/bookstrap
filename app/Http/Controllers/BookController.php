<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
      $books = auth()->user()->books()->orderBy('id', 'desc')->paginate(config('bookstrap-constants.NUM_BOOKS_PAGINATION'));
      return view('dashboard.index', compact('books'));
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
        $images = [];
        $sectionFolder = Storage::path($section->getContentFolder());
        $filenames = glob($sectionFolder.'*');
        natsort($filenames);
        foreach ($filenames as $imgFile) {
          // $data = ['procesing' => true, 'accepted' => true, 'status' => 'success'];
          $data = [];
          $fileinfo = new \SplFileInfo($imgFile);
          if (!$fileinfo->isFile() || !in_array($fileinfo->getExtension(), config('bookstrap-constants.allowedExtensions'), true)) continue;
          $data['name'] = $fileinfo->getFilename();
          $data['size'] = $fileinfo->getSize();
          $data['type'] = $fileinfo->getType();
          // Virtual url to the resource
          $fileVirtualPath = $virtualPath . $section->folder . '/preview/' . $fileinfo->getFilename();
          $images[] = ['data' => $data, 'url' => url($fileVirtualPath)];
        }
        $book->sections[$key]->{"images"} = $images;
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
