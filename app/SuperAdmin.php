<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    protected $table = 'tb_super_admin';

    protected $fillable = [
        'id_kabupaten',
        'id_kecamatan',
        'id_desa',
        'id_admin',
        'nama_super_admin',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_telepon',
        'username_telegram',
        'nik',
        'file_ktp',
        'area_tugas',
    ];

    public function posyandu(){
        return $this->belongsTo(Posyandu::class,'id_posyandu','id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'id_admin','id');
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class,'id_kecamatan','id');
    }

    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class,'id_kabupaten','id');
    }
}
