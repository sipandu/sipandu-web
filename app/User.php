<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table = 'tb_user';

    protected $fillable = [
        'id_kk',
        'id_chat_tele',
        'email',
        'password',
        'profile_image',
        'is_verified',
        'otp_token',
    ];


    protected $hidden = [
        'password',
    ];

    public function anak(){
        return $this->hasMany('App\Anak','id_user','id');
    }

    public function ibu(){
        return $this->hasMany('App\Ibu','id_user','id');
    }

    public function lansia(){
        return $this->hasMany('App\Lansia','id_user','id');
    }

    public function kk(){
        return $this->belongsTo('App\KK','id_kk');
    }



}
