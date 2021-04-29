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
        'is_verified',
        'otp_token',
        'keterangan',
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

    public function getUrlImage() {

        $informasi = InformasiPenting::find($id);

        if(File::exists(storage_path($informasi->image))) {
            return response()->file(
                storage_path($informasi->image)
            );
        } else {
            return response()->file(
                public_path('images/default-img.jpg')
            );
        }

        return url('/admin/pengumuman/get-img/'.$this->id);
    }
}
