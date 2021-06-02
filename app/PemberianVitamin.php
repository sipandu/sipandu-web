<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Imunisasi;
use App\Posyandu;
use App\User;
use App\Pegawai;

class PemberianVitamin extends Model
{
    protected $table = 'tb_pemberian_vitamin';

    protected $fillable = [
        'id_jenis_vitamin',
        'id_user',
        'id_posyandu',
        'id_nakes',
        'nama_posyandu',
        'nama_pemeriksa',
        'usia',
        'tanggal_pemberian',
        'tanggal_kembali',
        'keterangan',
        'lokasi',
    ];

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class,'id_jenis_vitamin','id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class,'id_posyandu','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function nakes()
    {
        return $this->belongsTo(Nakes::class,'id_nakes','id');
    }
}
