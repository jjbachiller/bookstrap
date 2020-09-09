<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Section extends Model
{
    // Book which contains the section
    public function book()
    {
      return $this->belongsTo('App\Book');
    }

    // Images of the book
    public function images()
    {
      return $this->hasMany('App\Image')->orderBy('order');;
    }

    public function getContentFolder()
    {
      $user_uid = Auth::check() ? Auth::user()->uid : session('user_uid');
      $sectionFolder = config('bookstrap-constants.uploads_path');
      $sectionFolder .= $user_uid . '/';
      $sectionFolder .= $this->book->uid  . '/';
      $sectionFolder .= $this->folder . '/';

      return $sectionFolder;
    }

    public function getSolutionsFolder()
    {
      $solutionsFolder = $this->getContentFolder() . config('bookstrap-constants.SOLUTIONS_FOLDER');
      return $solutionsFolder;
    }
}
