<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    public function author(){
      return $this->belongsTo('App\Author');
    }
}
