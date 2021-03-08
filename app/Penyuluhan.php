<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Penyuluhan extends Model
{
    protected $table = 'tb_penyuluhan';

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }

    public function sendMessage()
    {
        $msg =  '[PENYULUHAN]'.PHP_EOL.
                'Nama Penyuluhan : '.$this->nama_penyuluhan.PHP_EOL.
                'Lokasi : '.$this->lokasi.PHP_EOL.
                'Tanggal : '.$this->tanggal.PHP_EOL.
                'Topik : '.$this->topik_penyuluhan.PHP_EOL.
                'Deskripsi Kegiatan : '.PHP_EOL.PHP_EOL.
                $this->deskripsi;
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
        $chat_id = $this->posyandu->id_chat_grup_tele;
        $response = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $msg,
        ]);
    }

    public function sendMessageRalat()
    {
        $msg =  '[RALAT PENYULUHAN]'.PHP_EOL.
                'Nama Penyuluhan : '.$this->nama_penyuluhan.PHP_EOL.
                'Lokasi : '.$this->lokasi.PHP_EOL.
                'Tanggal : '.$this->tanggal.PHP_EOL.
                'Topik : '.$this->topik_penyuluhan.PHP_EOL.
                'Deskripsi Kegiatan : '.PHP_EOL.PHP_EOL.
                $this->deskripsi;
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
        $chat_id = $this->posyandu->id_chat_grup_tele;
        $response = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $msg,
        ]);
    }
}
