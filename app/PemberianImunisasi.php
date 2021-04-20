<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Imunisasi;
use App\Posyandu;
use App\User;
use App\Pegawai;

class PemberianImunisasi extends Model
{
    protected $table = 'tb_pemberian_imunisasi';

    protected $fillable = [
        'id_jenis_imunisasi',
        'id_user',
        'id_posyandu',
        'id_pegawai',
        'nama_posyandu',
        'nama_pemeriksa',
        'usia',
        'tanggal_imunisasi',
        'tanggal_kembali',
        'keterangan',
        'lokasi',
    ];

    public function imunisasi()
    {
        return $this->belongsTo(Imunisasi::class,'id_jenis_imunisasi','id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class,'id_posyandu','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'id_pegawai','id');
    }
}
