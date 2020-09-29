<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CloneController extends Controller
{
    public function cloneBook(Request $request)
    {
      $clonedBookId = $request->input('id');
      $newBookName = $request->input('name');
      // Copy book in DB
      $clonedBook = \App\Book::findOrFail($clonedBookId);
      $newBook = $clonedBook->duplicate();
      $newBook->name = $newBookName;
      $newBook->save();

      // Copy the files with the structure under the new book uid (for the local images).
      $userPath = config('bookstrap-constants.uploads_path');
      $userPath.= Auth::user()->uid . '/';
      $clonedPath = $userPath . $clonedBook->uid;
      $entro = false;
      if(Storage::exists($clonedPath)) {
        $entro = true;
        $newPath = $userPath . $newBook->uid;
        File::copyDirectory(Storage::path($clonedPath), Storage::path($newPath));
        //Movida, no se puede hacer así, las secciones se guardan por el id y este cambia al clonar
        // Quizás ordenando por id en el book clonado y en el nuevo y creando directorios y clonando
        // El contenido... habrá que probarlo.
      }

      $editUrl = route('books.edit', $newBook->id);
      return response()->json(['editUrl' => $editUrl]);
    }
}
