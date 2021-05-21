<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

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
                strip_tags($this->deskripsi);
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';

        $anak = DB::table('tb_user')->join('tb_anak', 'tb_anak.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_anak.id_posyandu', $this->id_posyandu)
            ->get();
        $ibu_hamil = DB::table('tb_user')->join('tb_ibu_hamil', 'tb_ibu_hamil.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_ibu_hamil.id_posyandu', $this->id_posyandu)
            ->get();
        $lansia = DB::table('tb_user')->join('tb_lansia', 'tb_lansia.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_lansia.id_posyandu', $this->id_posyandu)
            ->get();

        foreach($anak as $item)
        {
            $response = Http::post($url, [
                'chat_id' => $item->id_chat_tele,
                'text' => $msg,
            ]);
            sleep(2);
        }

        foreach($lansia as $item)
        {
            $response = Http::post($url, [
                'chat_id' => $item->id_chat_tele,
                'text' => $msg,
            ]);
            sleep(2);
        }

        foreach($ibu_hamil as $item)
        {
            $response = Http::post($url, [
                'chat_id' => $item->id_chat_tele,
                'text' => $msg,
            ]);
            sleep(2);
        }
        // $chat_id = $this->posyandu->id_chat_grup_tele;
    }

    public function sendMessageRalat()
    {
        $msg =  '[RALAT PENYULUHAN]'.PHP_EOL.
                'Nama Penyuluhan : '.$this->nama_penyuluhan.PHP_EOL.
                'Lokasi : '.$this->lokasi.PHP_EOL.
                'Tanggal : '.$this->tanggal.PHP_EOL.
                'Topik : '.$this->topik_penyuluhan.PHP_EOL.
                'Deskripsi Kegiatan : '.PHP_EOL.PHP_EOL.
                strip_tags($this->deskripsi);
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
        // $chat_id = $this->posyandu->id_chat_grup_tele;

        $anak = DB::table('tb_user')->join('tb_anak', 'tb_anak.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_anak.id_posyandu', $this->id_posyandu)
            ->get();
        $ibu_hamil = DB::table('tb_user')->join('tb_ibu_hamil', 'tb_ibu_hamil.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_ibu_hamil.id_posyandu', $this->id_posyandu)
            ->get();
        $lansia = DB::table('tb_user')->join('tb_lansia', 'tb_lansia.id_user', 'tb_user.id')
            ->select('tb_user.id_chat_tele')
            ->where('tb_user.id_chat_tele', '!=', NULL)
            ->where('tb_lansia.id_posyandu', $this->id_posyandu)
            ->get();

        foreach($anak as $item)
        {
            $response = Http::post($url, [
                'chat_id' => $item->id_chat_tele,
                'text' => $msg,
            ]);
            sleep(2);
        }

        foreach($lansia as $item)
        {
            $response = Http::post($url, [
                'chat_id' => $item->id_chat_tele,
                'text' => $msg,
            ]);
            sleep(2);
        }

        foreach($ibu_hamil as $item)
        {
            $response = Http::post($url, [
                'chat_id' => $item->id_chat_tele,
                'text' => $msg,
            ]);
            sleep(2);
        }
    }
}
