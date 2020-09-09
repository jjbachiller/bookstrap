<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  // Section which contains the image
  public function section()
  {
    return $this->belongsTo('App\Section');
  }
}
