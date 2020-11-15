<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{

  protected $appends = [
      'url',
      'preview_url',
    ];

  // Section which contains the image
  public function section()
  {
    return $this->belongsTo('App\Section');
  }

  public function getUrlAttribute()
  {
    return $this->url('original');
  }

  public function getPreviewUrlAttribute()
  {
    return $this->url();
  }

  public function isLocal() {
    return is_null($this->s3_disk);
  }

  // public static function boot() {
  //   parent::boot();
  //
  //   self::created(function($image){
  //     $image->section->book->updatedPagesAndSize();
  //   });
  //
  //   self::deleted(function($image){
  //     $image->section->book->updatedPagesAndSize();
  //   });
  //
  // }


  // public function data() {
  //   $data = ['name' => $this->show_name, 'size' => $this->size, 'type' => $this->type];
  //
  //   return $data;
  // }

  public function url($size = 'preview') {

    $url = config('bookstrap-constants.uploads_virtual_path');

    $miniatures = config('bookstrap-constants.miniatures');

    return url($url  . $miniatures[$size]['folder'] . $this->id);

  }

  public function fullPath() {

    $fullPath = $this->path('original') . $this->file_name;

    return Storage::path($fullPath);

  }

  public function path($size = 'preview') {
    if ($this->isLocal())
      return $this->getLocalPath($size);
    return $this->getLocalS3Path();
  }

  private function getLocalPath($size = 'preview') {
    $localPath = config('bookstrap-constants.uploads_path');
    $localPath.= $this->section->book->user->uid . '/';
    $localPath.= $this->section->book->uid . '/';
    $localPath.= $this->section->id . '/';

    if ($this->solution) {
      $localPath.= config('bookstrap-constants.SOLUTIONS_FOLDER');
    }

    $miniatures = config('bookstrap-constants.miniatures');
    $localPath.= $miniatures[$size]['folder'];

    return $localPath;
  }

  private function getLocalS3Path() {
    $localS3Path = config('bookstrap-constants.uploads_path');
    $localS3Path.= $this->s3_disk;
    $localS3Path.= $this->s3_directory . '/';

    if ($this->solution) {
      $localS3Path.= config('bookstrap-constants.SOLUTIONS_FOLDER');
    }

    return $localS3Path;
  }

  public function s3Path($config) {
    if ($this->isLocal()) return false;

    $s3ImagePath = $this->s3_disk . $this->s3_directory;
    $s3ImagePath .= ($this->solution) ? $config['solutions_folder'] : $config['puzzles_folder'];

    return $s3ImagePath;
  }

}
