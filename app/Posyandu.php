<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Posyandu extends Model
{
    use Notifiable;

    protected $table = 'tb_posyandu';

    protected $fillable = [
        'id_desa',
        'id_admin',
        'nama_posyandu',
        'alamat',
        'nomor_telepon',
        'banjar',
        'latitude',
        'longitude',
    ];

    // public function desa()
    // {
    //     return $this->belongsTo('App\desa');
    // }




}
