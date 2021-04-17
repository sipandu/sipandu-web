<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PemberianImunisasi;

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

    public function pemberianImunisasi()
    {
        return $this->hasMany('PemberianImunisasi','id_jenis_imunisasi','id');
    }
}
