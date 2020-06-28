<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S_penting extends Model
{
    protected $table = 's_pentings';
    protected $fillable = [
        'no_surat', 'judul', 'jenis', 'tgl_surat', 'keterangan', 'softfile'
    ];
}
