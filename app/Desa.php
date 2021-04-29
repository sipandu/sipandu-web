<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Desa extends Model
{
    use Notifiable;

    protected $table = 'tb_desa';

    protected $fillable = [
        'id_kecamatan',
        'nama_desa',
    ];

    public function posyandu()
    {
        return $this->hasMany(Posyandu::class,'id_desa');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\kecamatan');
    }

    public function pjLansia()
    {
        return $this->hasMany(PjLansia::class,'id_desa','id');
    }
}
