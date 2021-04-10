<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lansia extends Model
{
    use Notifiable;

    protected $table = 'tb_lansia';

    protected $fillable = [
        'id_posyandu',
        'id_user',
        'nama_lansia',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'NIK',
        'status',
        'jenis_kelamin',
    ];


    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function posyandu(){
        return $this->belongsTo('App\Posyandu','id_posyandu');
    }
}
