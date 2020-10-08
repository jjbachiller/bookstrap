<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
  // Owner of the book
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  
}
