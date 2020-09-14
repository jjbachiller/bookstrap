<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    // Return the number of images of the current section
    public function getSectionNumImages(Request $request)
    {
      $sectionId = $request->input('id');
      // if the section id is empty (not created yet when we call here), we get the last created section from the user.
      if (empty($sectionId)) {
        $section = \App\Section::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
      } else {
        $section = \App\Section::findOrFail($sectionId);
        if ($section->user_id != Auth::user()->id) {
          abort(404);
        }
      }

      $numImages = $section->content->count();

      return json_encode(['num_images' => $numImages]);
    }

}
