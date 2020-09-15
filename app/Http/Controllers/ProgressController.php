<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    // Return the number of images of the current section
    public function getSectionNumImages(Request $request)
    {
      $book = \App\Book::findOrFail(session('idBook'));

      $requestData = json_decode($request->getContent(), true);
      $sectionId = $requestData['id'];

      $section = $book->sections->find($sectionId);

      $numImages = $section->content->count();

      return json_encode(['num_images' => $numImages]);
    }

}
