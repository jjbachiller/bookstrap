<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

      $response = ['num_images' => $numImages, 'images' => $section->images, 'solutions' => $section->solutions];

      if (Gate::denies('space-available', 0)) {
        $response['deny'] = config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.code');
        $response['message'] = config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.message');
      }

      return json_encode($response);
    }

}
