<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Section extends Model
{

    use \Bkwld\Cloner\Cloneable;

    protected $cloneable_relations = ['content'];

    // Book which contains the section
    public function book()
    {
      return $this->belongsTo('App\Book');
    }

    // Images of the book
    public function content()
    {
      // return $this->hasMany('App\Image')->orderBy('order');
      return $this->hasMany('App\Image')->orderBy('id');
    }

    public function images()
    {
      return $this->hasMany('App\Image')->where('solution', 0)->orderBy('id');
    }

    public function solutions()
    {
      return $this->hasMany('App\Image')->where('solution', 1)->orderBy('id');
    }

    public function updatedPagesAndSize()
    {
      $numImages = $this->images->count();
      $pagesImages = ceil($numImages / $this->images_per_page);
      $numSolutions = $this->solutions->count();
      $pagesSolutions = ceil($numSolutions / $this->solutions_per_page);
      $totalPages = $pagesImages + $pagesSolutions;
      if ($this->title) $totalPages+= 1;
      if ($this->solutions_title) $totalPages+= 1;
      if ($this->book->add_blank_pages) {
        $totalPages*= 2;
      }

      $this->size = $this->content->sum('size');
      $this->pages_count = $totalPages;
      $this->save();
    }

    public function getContentFolder()
    {
      $user_uid = Auth::check() ? Auth::user()->uid : session('user_uid');
      $sectionFolder = config('bookstrap-constants.uploads_path');
      $sectionFolder .= $user_uid . '/';
      $sectionFolder .= $this->book->uid  . '/';
      $sectionFolder .= $this->id . '/';

      return $sectionFolder;
    }

    public function getSolutionsFolder()
    {
      $solutionsFolder = $this->getContentFolder() . config('bookstrap-constants.SOLUTIONS_FOLDER');
      return $solutionsFolder;
    }

    public function deleteWithImages()
    {
      $this->content()->delete();
      $this->delete();
    }
}
