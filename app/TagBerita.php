<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagBerita extends Model
{
    protected $table = 'tb_tag_berita';

    protected $fillable = [
        'id_informasi',
        'id_tag',
    ];

    public function tag(){
        return $this->belongsTo(Tag::class,'id_tag','id');
    }

    public function informasi(){
        return $this->belongsTo(InformasiPenting::class,'id_informasi','id');
    }
}
