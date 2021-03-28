<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anak extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_anak';

    protected $fillable = [
        'id_posyandu',
        'id_user',
        'nama_anak',
        'nama_ayah',
        'nama_ibu',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'anak_ke',
        'alamat',
        'nomor_telepon',
        'NIK',
    ];

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function posyandu(){
        return $this->belongsTo('App\Posyandu','id_posyandu');
    }



}
