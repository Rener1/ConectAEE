<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
  public function album(){
     return $this->belongsTo(Album::class);
  }
}
