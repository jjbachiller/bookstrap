<?php

namespace App\Book;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentFile {

  private $workFolder;
  private $bookFolder;
  private $downloadVirtualFolder;
  private $filename;
  private $filetype;

  public function __construct($book, $filename = null, $filetype = null) {
    $userUid = Auth::check() ? Auth::user()->uid : session('user_uid');

    $workFolder = config('constants.uploads_path') . $userUid . '/' . $book . '/';
    $this->workFolder = Storage::path($workFolder);
    $this->setDownloadFolders($book);
    $this->filetype = empty($filetype) ? config('constants.PDF') : $filetype;
    $this->filename = empty($filename) ? config('constants.DEFAULT_FILENAME') : $filename;
    $this->filename .= ($this->filetype == config('constants.PPT')) ? config('constants.PPT_EXTENSION') : config('constants.PDF_EXTENSION');
  }

  private function setDownloadFolders($book) {
    $userUid = Auth::check() ? Auth::user()->uid : session('user_uid');

    $currentDate = date('m-d-Y_hia');

    $bookPath = config('constants.downloads_path') . $userUid . '/' . $book . '/';
    $bookPath.= $currentDate . '/';
    Storage::makeDirectory($bookPath);
    $this->bookFolder = Storage::path($bookPath);

    $downloadVirtualPath = config('constants.book_virtual_path') . $userUid . '/' . $book . '/';
    $downloadVirtualPath.= $currentDate . '/';
    Storage::makeDirectory($downloadVirtualPath);
    $this->downloadVirtualFolder = $downloadVirtualPath;

  }

  public function getFiletype() {
    return $this->filetype;
  }

  public function getWorkFolder() {
    return $this->workFolder;
  }

  public function getBookFilePath() {
    return $this->bookFolder . $this->filename;
  }

  public function getDownloadVirtualPath() {
    return $this->downloadVirtualFolder . $this->filename;
  }
}
