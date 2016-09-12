<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
  protected $fillable = [
    'judul',
    'author',
    'jurnal',
    'citedby',
    'year',
    'id_dosen',
    'link'
  ];
}
