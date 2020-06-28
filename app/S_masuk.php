<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S_masuk extends Model
{
    protected $table = 's_masuks';
    protected $fillable = [
        'no_surat', 'judul', 'dari', 'tgl_surat', 'keterangan', 'softfile'
    ];
}
