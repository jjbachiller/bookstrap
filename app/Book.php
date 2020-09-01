<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
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

    public function scopeWithContent($query)
    {
      return $query->has('sections');
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

    public function deleteBook()
    {

      DB::table('sections')->where('book_id', $this->id)->where('user_id', Auth::user()->id)->delete();
      DB::table('books')->where('id', $this->id)->delete();
    }

    public static function getBooksWithContent()
    {
      //
    }
}
