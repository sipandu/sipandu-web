<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanIbu extends Model
{
    protected $table = 'tb_rekam_kesehatan_ibu_hamil';

    protected $fillable = [
        'id_posyandu',
        'id_ibu_hamil',
        'id_pegawai',
        'nama_posyandu',
        'nama_pemeriksa',
        'nama_ibu_hamil',
        'lingkar_lengan',
        'berat_badan',
        'usia_kandungan',
        'tekanan_darah',
        'denyut_nadi_ibu',
        'detak_jantung_bayi',
        'tinggi_rahim',
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

    public function ibu()
    {
        return $this->belongsTo(Ibu::class,'id_ibu_hamil','id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'id_pegawai','id');
    }
}
