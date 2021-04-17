<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    protected $table = 'tb_jenis_vitamin';

    protected $fillable = [
        'nama_vitamin',
        'usia_pemberian',
        'perulangan',
        'deskripsi',
        'status',
        'penerima',
    ];
}
