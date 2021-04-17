<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    protected $table = 'tb_jenis_imunisasi';

    protected $fillable = [
        'nama_imunisasi',
        'usia_pemberian',
        'perulangan',
        'deskripsi',
        'status',
        'penerima',
    ];
}
