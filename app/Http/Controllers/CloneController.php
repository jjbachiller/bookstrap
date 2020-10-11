<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class CloneController extends Controller
{
    public function cloneBook(Request $request)
    {
      if (Gate::denies('active-subscription')) {
        $error = [
          'deny' => config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.code'),
          'message' => config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.message')
        ];

        return response()->json($error);
      }

      $clonedBookId = $request->input('id');
      $newBookName = $request->input('name');
      // Copy book in DB
      $clonedBook = \App\Book::findOrFail($clonedBookId);

      if (Gate::denies('space-available', $clonedBook->total_size)) {
        $error = [
          'deny' => config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.code'),
          'message' => config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.message')
        ];

        return response()->json($error);
      }


      $newBook = $clonedBook->duplicate();
      $newBook->name = $newBookName;
      $newBook->save();

      // Copy the files with the structure under the new book uid (for the local images).
      $userPath = config('bookstrap-constants.uploads_path');
      $userPath.= Auth::user()->uid . '/';
      $clonedPath = $userPath . $clonedBook->uid;
      if(Storage::exists($clonedPath)) {
        $newPath = $userPath . $newBook->uid;
        // Cloned sections content (ordered by order, sections has same order in both books)
        $clonedSections = $clonedBook->sections;
        $newSections = $newBook->sections;
        foreach ($clonedSections as $id => $clonedSection) {
          $newSection = $newSections[$id];
          $clonedSectionPath = $clonedPath . '/' . $clonedSection->id . '/';
          // If folder exists, section has local images uploaded
          if (Storage::exists($clonedSectionPath)) {
            $newSectionPath = $newPath . '/' . $newSection->id . '/';
            File::copyDirectory(Storage::path($clonedSectionPath), Storage::path($newSectionPath));
          }
        }
      }

      $editUrl = route('books.edit', $newBook->id);
      return response()->json(['editUrl' => $editUrl]);
    }
}
