<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanLansia extends Model
{
    protected $table = 'tb_rekam_kesehatan_lansia';

    protected $fillable = [
        'id_posyandu',
        'id_nakes',
        'id_lansia',
        'nama_posyandu',
        'nama_pemeriksa',
        'nama_lansia',
        'berat_badan',
        'usia_lansia',
        'tinggi_lutut',
        'tinggi_badan',
        'tekanan_darah',
        'suhu_tubuh',
        'denyut_nadi',
        'IMT',
        'diagnosa',
        'pengobatan',
        'keterangan',
        'tempat_pemeriksaan',
        'jenis_pemeriksaan',
        'tanggal_pemeriksaan',
        'tanggal_kembali',
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class,'id_posyandu','id');
    }

    public function lansia()
    {
        return $this->belongsTo(Lansia::class,'id_lansia','id');
    }

    public function nakes()
    {
        return $this->belongsTo(Nakes::class,'id_nakes','id');
    }
}
