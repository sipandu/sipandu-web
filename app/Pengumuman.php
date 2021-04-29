<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'tb_pengumuman';

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }

    public function getUrlImage() {
        return url('/admin/pengumuman/get-img/'.$this->id);
    }
}
