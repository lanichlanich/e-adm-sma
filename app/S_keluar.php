<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S_keluar extends Model
{
    protected $table = 's_keluars';
    protected $fillable = [
        'no_surat', 'judul', 'tujuan', 'tgl_surat', 'keterangan', 'softfile'
    ];
}
