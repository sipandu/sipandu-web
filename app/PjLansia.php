<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PjLansia extends Model
{
    protected $table = 'tb_pj_lansia';

    protected $fillable = [
        'id_lansia',
        'nama',
        'hubungan_keluarga',
        'nomor_telepon',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class,'id_desa','id');
    }
}
