<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;


    protected $table = 'tb_user';

    protected $fillable = [
        'id_kk',
        'role',
        'id_chat_tele',
        'username_tele',
        'email',
        'password',
        'profile_image',
        'golongan_darah',
        'agama',
        'tanggungan',
        'no_jkn',
        'masa_berlaku',
        'faskes_rujukan',
        'is_verified',
        'status',
        'keterangan',
        'otp_token',
    ];


    protected $hidden = [
        'password',
    ];

    public function anak(){
        return $this->hasOne('App\Anak','id_user','id');
    }

    public function ibu(){
        return $this->hasOne('App\Ibu','id_user','id');
    }

    public function lansia(){
        return $this->hasOne('App\Lansia','id_user','id');
    }

    public function kk(){
        return $this->belongsTo('App\KK','id_kk');
    }

    public function pemberianImunisasi()
    {
        return $this->hasMany(PemberianImunisasi::class,'id_user','id');
    }

    public function pemberianVitamin()
    {
        return $this->hasMany(PemberianVitamin::class,'id_user','id');
    }

    public function alergi()
    {
        return $this->hasMany(Alergi::class,'id_user','id');
    }

    public function penyakitBawaan()
    {
        return $this->hasMany(PenyakitBawaan::class,'id_user','id');
    }

    public function riwayatPenyakit()
    {
        return $this->hasMany(RiwayatPenyakit::class,'id_user','id');
    }

    public function pjLansia()
    {
        return $this->hasMany(PjLansia::class,'id_user','id');
    }

    public function getUrlImage() {
        return url('/api/mobileuser/get-user-img/'.$this->id);
    }

    public function getIdPosyandu()
    {
        $id_posyandu = 0;
        if($this->role == '0') {
            $user = Anak::query()->select('id_posyandu')->where('id_user', $this->id)->first();
        } elseif($this->role == '1') {
            $user = Ibu::query()->select('id_posyandu')->where('id_user', $this->id)->first();
        } elseif($this->role == '2') {
            $user = Lansia::query()->select('id_posyandu')->where('id_user', $this->id)->first();
        }

        if($user->id_posyandu != null) {
            $id_posyandu = $user->id_posyandu;
        }

        return $id_posyandu;
    }

    public function getNamaPasien()
    {
        $nama = '';
        if($this->role == '0') {
            $user = Anak::query()->select('nama_anak')->where('id_user', $this->id)->first();
            $nama = $user->nama_anak;
        } elseif($this->role == '1') {
            $user = Ibu::query()->select('nama_ibu_hamil')->where('id_user', $this->id)->first();
            $nama = $user->nama_ibu_hamil;
        } elseif($this->role == '2') {
            $user = Lansia::query()->select('nama_lansia')->where('id_user', $this->id)->first();
            $nama = $user->nama_lansia;
        }

        return $nama;
    }

    public function getPasienInfo()
    {
        if($this->role == '0') {
            $user = Anak::query()
                ->join('tb_posyandu', 'tb_posyandu.id', 'tb_anak.id_posyandu')
                ->select('nama_anak AS nama', 'jenis_kelamin', 'tanggal_lahir', 'tb_posyandu.nama_posyandu')
                ->where('id_user', $this->id)
                ->first();
            $nama = $user;
        } elseif($this->role == '1') {
            $user = Ibu::query()
                ->join('tb_posyandu', 'tb_posyandu.id', 'tb_ibu_hamil.id_posyandu')
                ->select('nama_ibu_hamil AS nama', 'tanggal_lahir', 'tb_posyandu.nama_posyandu')
                ->where('id_user', $this->id)->first();
            $nama = $user;
        } elseif($this->role == '2') {
            $user = Lansia::query()
                ->join('tb_posyandu', 'tb_posyandu.id', 'tb_lansia.id_posyandu')
                ->select('nama_lansia AS nama', 'jenis_kelamin', 'tanggal_lahir', 'tb_posyandu.nama_posyandu')
                ->where('id_user', $this->id)->first();
            $nama = $user;
        }

        return $nama;
    }
  
    public function notifUser()
    {
        return $this->hasMany(Notifikasiuser::class,'id_user','id');
    }
}
