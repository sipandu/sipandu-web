<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_admin';

    protected $fillable = [
        'email',
        'password',
        'profile_image',
        'is_verified',
        'otp_token',
        'created_at'
    ];

    public function pegawai(){
        return $this->hasOne('App\Pegawai','id_admin','id');
    }

    public function posyandu(){
        return $this->hasOne('App\Posyandu','id_admin','id');
    }



}
