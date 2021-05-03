<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPenyakit extends Model
{
    protected $table = 'tb_riwayat_penyakit_lansia';

    protected $fillable = [
        'id_lansia',
        'nama_penyakit',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
