<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;


    protected $table = 'tb_user';

    protected $fillable = [
        'id_kk',
        'role',
        'id_chat_tele',
        'username_tele',
        'email',
        'password',
        'profile_image',
        'golongan_darah',
        'agama',
        'tanggungan',
        'no_jkn',
        'masa_berlaku',
        'faskes_rujukan',
        'is_verified',
        'keterangan',
        'otp_token',
    ];


    protected $hidden = [
        'password',
    ];

    public function anak(){
        return $this->hasOne('App\Anak','id_user','id');
    }

    public function ibu(){
        return $this->hasOne('App\Ibu','id_user','id');
    }

    public function lansia(){
        return $this->hasOne('App\Lansia','id_user','id');
    }

    public function kk(){
        return $this->belongsTo('App\KK','id_kk');
    }

    public function pemberianImunisasi()
    {
        return $this->hasMany(PemberianImunisasi::class,'id_user','id');
    }

    public function pemberianVitamin()
    {
        return $this->hasMany(PemberianVitamin::class,'id_user','id');
    }

    public function alergi()
    {
        return $this->hasMany(Alergi::class,'id_user','id');
    }

    public function penyakitBawaan()
    {
        return $this->hasMany(PenyakitBawaan::class,'id_user','id');
    }

    public function riwayatPenyakit()
    {
        return $this->hasMany(RiwayatPenyakit::class,'id_user','id');
    }

    public function pjLansia()
    {
        return $this->hasMany(PjLansia::class,'id_user','id');
    }

    public function getUrlImage() {
        return url('/api/mobileuser/get-user-img/'.$this->id);
    }
}
