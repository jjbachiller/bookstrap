<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TestController extends Controller
{
    public function s3(Request $request)
    {
      // $sudokuConfig = config('sudokus');
      // $directory = $sudokuConfig['sudokus_folder'] . 'levelone' . $sudokuConfig['puzzle_folder'];
      // $imgName = randomGen(0, $sudokuConfig['max_number'], 1);
      // $path = $directory . $imgName[0] . $sudokuConfig['ext'];
      // return Storage::disk('s3')->download($path);
      // // return Storage::disk('s3')->download($path);
      //
      // // if (!is_file($file)) {
      // //   abort(404);
      // // }
      // // return response()->file($file);

      // $directory = 'test';
      // $files = Storage::disk('s3')->files($directory);
      $files = Storage::disk('s3')->directories('/japanese/');
      echo "<h1>Total de archivos del nivel 1: " . count($files) . "</h1>";
      // for ($i=0; $i<count($files); $i++) {
      //   print_r($files[$i]. "      |         ");
      //
      // }
      exit;
    }

    public function fopen(Request $request)
    {
      $file = 'http://bookstrap.local/content/1';
      $f = fopen($file,'rb');
      if(!$f)
        $this->Error('Can\'t open image file: '.$file);
      echo "Todo Guay";
      // $info = $this->_parsepngstream($f,$file);
      fclose($f);
    }

    function curl()
    {
        // Initializing
        $ch = curl_init();

        $uri = 'http://bookstrap.local/content/1';
        $time_out = 10;
        $headers = 0;

        // Set URI
        curl_setopt($ch, CURLOPT_URL, trim($uri));

        curl_setopt($ch, CURLOPT_HEADER, $headers);

        // 1 - if output is not needed on the browser
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Time-out in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);

        // Executing
        $result = curl_exec($ch);

        // Closing the channel
        curl_close($ch);

        return $result;
    }

    function referer()
    {
      $referer = request()->headers->get('referer');
      echo "Referer: " . $referer;
      echo "Server Host: " . $_SERVER['SERVER_NAME'];
      print_r(request()->headers);
    }

    function internalReferer()
    {
      $file = 'http://bookstrap.local/referer';
      $f = fopen($file,'rb');
      $contents = stream_get_contents($f);
      print_r($contents);
      fclose($f);
    }
}
