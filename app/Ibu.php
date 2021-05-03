<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ibu extends Model
{
    use Notifiable;

    protected $table = 'tb_ibu_hamil';

    protected $fillable = [
        'id_user',
        'id_posyandu',
        'NIK',
        'nama_ibu_hamil',
        'nama_suami',
        'tempat_lahir',
        'tanggal_lahir',
        'kehamilan_ke',
        'jarak_anak_sebelumnya',
        'pekerjaan_ibu',
        'pekerjaan_suami',
        'pendidikan_ibu',
        'pendidikan_suami',
        'nomor_telepon',
        'alamat',
    ];

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function posyandu(){
        return $this->belongsTo('App\Posyandu','id_posyandu');
    }

    public function pemeriksaanIbu()
    {
        return $this->hasMany(PemeriksaanIbu::class,'id_ibu_hamil','id');
    }

    public function persalinan()
    {
        return $this->hasMany(Persalinan::class,'id_ibu_hamil','id');
    }
}
