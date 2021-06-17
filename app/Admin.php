<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_admin';

    protected $guard = 'admin';

    protected $fillable = [
        'email',
        'password',
        'profile_image',
        'is_verified',
        'otp_token',
        'role',
        'created_at'
    ];

    protected $hidden = [
        'password'
    ];

    public function pegawai(){
        return $this->hasOne('App\Pegawai','id_admin','id');
    }

    public function informasi_penting()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function superAdmin()
    {
        return $this->hasOne(SuperAdmin::class,'id_admin','id');
    }

    public function nakes()
    {
        return $this->hasOne(Nakes::class,'id_admin','id');
    }

    public function adminPermission()
    {
        return $this->hasMany(Admin::class,'id_admin','id');
    }
}
