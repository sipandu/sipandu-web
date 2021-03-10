<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'tb_admin';

    protected $fillable = [
        'email', 'password', 'profile_image', 'is_verified'
    ];

    protected $hidden = [
        'password'
    ];

    public function posyandu()
    {
        return $this->hasMany(Posyandu::class, 'id_admin');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_admin');
    }
}
