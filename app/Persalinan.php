<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persalinan extends Model
{
    protected $table = 'tb_riwayat_persalinan';

    protected $fillable = [
        'id_ibu_hamil',
        'id_anak',
        'berat_lahir',
        'persalinan',
        'penolong_persalinan',
        'komplikasi',
        'kategori',
    ];

    public function anak()
    {
        return $this->belongsTo(User::class,'id_anak','id');
    }
}
