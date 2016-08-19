<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
      'img',
      'id_lecture',
      'id_student'
    ];
}
