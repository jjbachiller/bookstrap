<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TestController extends Controller
{
    public function s3(Request $request)
    {
      $sudokuConfig = config('sudokus');
      $directory = $sudokuConfig['sudokus_folder'] . 'levelone' . $sudokuConfig['puzzle_folder'];
      $imgName = randomGen(0, $sudokuConfig['max_number'], 1);
      $path = $directory . $imgName[0] . $sudokuConfig['ext'];
      return Storage::disk('s3')->download($path);
      // return Storage::disk('s3')->download($path);

      // if (!is_file($file)) {
      //   abort(404);
      // }
      // return response()->file($file);

      // $directory = 'test';
      // $files = Storage::disk('s3')->files($directory);
      // echo "<h1>Total de archivos del nivel 1: " . count($files) . "</h1>";
      // for ($i=0; $i<10; $i++) {
      //   print_r($files[$i]);
      // }
      // exit;
    }
}
