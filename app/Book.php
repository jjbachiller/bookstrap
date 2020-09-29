<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use \Bkwld\Cloner\Cloneable;

    protected $cloneable_relations = ['sections'];
    protected $clone_exempt_attributes = ['uid', 'name'];

    // Owner of the book
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    // Sections of the book
    public function sections()
    {
      return $this->hasMany('App\Section')->orderBy('order');;
    }


    public function onCloning($src, $child = null) {
        $this->uid = uniqid();
    }

    public function scopeWithContent($query)
    {
      return $query->has('sections');
    }

    public function updatedPagesAndSize()
    {
      foreach ($this->sections as $section) {
        $section->updatedPagesAndSize();
      }

      $bookSize = $this->sections->sum('size');
      // Add the size of the pdf or ppt if it exists
      $bookSize+= getBookFileSizeFromUrl($this->pdf);
      $bookSize+= getBookFileSizeFromUrl($this->ppt);
      $this->total_size = $bookSize;
      $this->total_pages = $this->sections()->sum('pages_count');
      $this->save();
    }

    public function resetContent() {
      $this->sections()->delete();
    }

    public function updateBookOwner($user)
    {
      if (is_null($this->user_id)) {
        // Book created_as_guess = true;
        $this->user_id = $user->id;
        $this->save();
        // update the user id in all the sections of the book
        foreach ($this->sections as $section)
        {
          $section->user_id = $user->id;
          $section->save();
        }
      }
    }

    public static function getCreatedAsGuessBook()
    {
      $user = Auth::user();
      $book = $user->books->where('created_as_guess', 1)->first();
      return $book;
    }

    public function lastCreatedSection()
    {
      return $this->sections()->orderBy('id', 'desc')->first();
    }

    public function deleteWithSections()
    {
      $this->sections->each->deleteWithImages();
      $this->sections()->delete();
      $this->delete();
    }
}
