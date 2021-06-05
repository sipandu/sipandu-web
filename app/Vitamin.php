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
        'deleted_at',
    ];

    public function pemberianVitamin()
    {
        return $this->hasMany(PemberianVitamin::class,'id_jenis_vitamin','id');
    }
}
