<?php

namespace App;

// <<<<<<< loginRegis
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


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
  
    protected $hidden = [
        'password'
    ];

//     public function pegawai(){
//         return $this->hasOne('App\Pegawai','id_admin','id');
//     }

//     public function posyandu(){
//         return $this->hasOne('App\Posyandu','id_admin','id');
//     }



=======


// class Admin extends Model
// {
//     protected $table = 'tb_admin';

//     protected $fillable = [
//         'email', 'password', 'profile_image', 'is_verified'
//     ];

//     protected $hidden = [
//         'password'
//     ];

    public function posyandu()
    {
        return $this->hasMany(Posyandu::class, 'id_admin');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_admin');
    }
// >>>>>>> main
}
