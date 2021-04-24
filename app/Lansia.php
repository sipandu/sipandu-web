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
        'NIK',
        'nama_lansia',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'status_perkawinan',
        'pendidikan_terakhir',
        'sumber_biaya_hidup',
        'status',
        'jumlah_anak',
        'jumlah_cucu',
        'jumlah_cicit',
        'jumlah_keluarga_serumah',
        'nomor_telepon',
        'tempat_tinggal',
        'alamat',
    ];


    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function posyandu(){
        return $this->belongsTo('App\Posyandu','id_posyandu');
    }

    public function pemeriksaanLansia()
    {
        return $this->hasMany(PemeriksaanLansia::class,'id_lansia','id');
    }
}
