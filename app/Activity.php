<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  protected $fillable = [
    'id_activities',
    'nama_kegiatan',
    'cakupan',
    'category',
    'tgl_mulai',
    'tgl_selesai',
    'sumber_dana',
    'pencapaian',
    'deskripsi',
    'id_people',
    'group'
  ];
}
