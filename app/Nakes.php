<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nakes extends Model
{
    protected $table = 'tb_nakes';

    protected $fillable = [
        'id_admin',
        'nama_nakes',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_telepon',
        'username_telegram',
        'nik',
        'file_ktp',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class,'id_admin','id');
    }

    public function nakesPosyandu()
    {
        return $this->hasMany(NakesPosyandu::class,'id_nakes','id');
    }

    public function pemeriksaanIbu()
    {
        return $this->hasMany(PemeriksaanIbu::class,'id_nakes','id');
    }

    public function pemeriksaanAnak()
    {
        return $this->hasMany(PemeriksaanAnak::class,'id_nakes','id');
    }

    public function pemeriksaanLansia()
    {
        return $this->hasMany(PemeriksaanLansia::class,'id_nakes','id');
    }

    public function pemberianImunisasi()
    {
        return $this->hasMany(PemberianImunisasi::class,'id_nakes','id');
    }
    
    public function pemberianVitamin()
    {
        return $this->hasMany(PemberianVitamin::class,'id_nakes','id');
    }
}
