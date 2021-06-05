<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// <<<<<<< loginRegis
use Illuminate\Notifications\Notifiable;

class Kecamatan extends Model
{
    use Notifiable;

    protected $table = 'tb_kecamatan';

    protected $fillable = [
        'id_kabupaten',
        'nama_kecamatan',
    ];

    public function desa()
    {
        return $this->hasMany('App\Desa','id_kecamatan','id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id');
    }

    public function superAdmin()
    {
        return $this->hasMany(SuperAdmin::class,'id_posyandu','id');
    }
}
