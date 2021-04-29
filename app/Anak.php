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
        'NIK',
        'nama_ayah',
        'nama_ibu',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'anak_ke',
        'pendidikan_ibu',
        'pendidikan_ayah',
        'pekerjaan_ibu',
        'pekerjaan_ayah',
        'nomor_telepon',
        'alamat',
    ];

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function posyandu(){
        return $this->belongsTo('App\Posyandu','id_posyandu');
    }

    public function pemeriksaanAnak()
    {
        return $this->hasMany(PemeriksaanAnak::class,'id_anak','id');
    }

    public function persalinan()
    {
        return $this->hasMany(Persalinan::class,'id_anak','id');
    }
}
