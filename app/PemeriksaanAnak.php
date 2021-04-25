<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanAnak extends Model
{
    protected $table = 'tb_rekam_kesehatan_anak';

    protected $fillable = [
        'id_posyandu',
        'id_anak',
        'id_pegawai',
        'nama_posyandu',
        'nama_pemeriksa',
        'nama_anak',
        'lingkar_kepala',
        'berat_badan',
        'tinggi_badan',
        'usia_anak',
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

    public function anak()
    {
        return $this->belongsTo(Anak::class,'id_ibu_hamil','id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'id_pegawai','id');
    }
}
