<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// <<<<<<< loginRegis
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
        return $this->hasMany('App\Posyandu','id_desa','id');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\kecamatan');
    }
// =======

// class Desa extends Model
// {
//     protected $table = 'tb_desa';
// >>>>>>> main
}
