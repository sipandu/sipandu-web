<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class Kegiatan extends Model
{
    protected $table = 'tb_kegiatan';

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }

    public function sendMessage()
    {
        // $posyandu = Posyandu::find(4);
        $msg = '[ KEGIATAN ]'.PHP_EOL.

        'Salam sehat, salam semangat!'.PHP_EOL.
        'Smart Posyandu kembali hadir menemani dengan membawa agenda baru.'.PHP_EOL.
        'Kegiatan             : '. $this->nama_kegiatan.PHP_EOL.
        'Tempat               : '.$this->tempat.PHP_EOL.
        'Tanggal              : '.date('D, d F Y', strtotime($this->start_at)) . ' s/d ' . date('D, d F Y', strtotime($this->end_at)).PHP_EOL.PHP_EOL.

        $this->deskripsi.PHP_EOL.PHP_EOL.

        'Salam Sehat,'.PHP_EOL.
        'Smart Posyandu';

        $token = '1519375290:AAEt7FLKWTlaEPJgamcqKv8pVTtboTbA9iY';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';

        $response = Http::post($url, [
            'chat_id' => '-518331855',
            'text' => $msg,
        ]);

        if($response->successful()){
            return true;
        }
    }

    public function sendMessageRalat()
    {
        $msg = '[ RALAT KEGIATAN ]'.PHP_EOL.

        'Salam sehat, salam semangat!'.PHP_EOL.
        'Smart Posyandu kembali hadir menemani dengan membawa agenda baru.'.PHP_EOL.
        'Kegiatan             : '. $this->nama_kegiatan.PHP_EOL.
        'Tempat               : '.$this->tempat.PHP_EOL.
        'Tanggal              : '.date('D, d F Y', strtotime($this->start_at)) . ' s/d ' . date('D, d F Y', strtotime($this->end_at)).PHP_EOL.PHP_EOL.

        $this->deskripsi.PHP_EOL.PHP_EOL.

        'Salam Sehat,'.PHP_EOL.
        'Smart Posyandu';
        $token = '1519375290:AAEt7FLKWTlaEPJgamcqKv8pVTtboTbA9iY';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';

        $response = Http::post($url, [
            'chat_id' => '-518331855',
            'text' => $msg,
        ]);

        if($response->successful()){
            return true;
        }
    }

    public function sendMessageCancel($alasan)
    {
        // $posyandu = Posyandu::all();
        $msg =  '[PEMBATALAN KEGIATAN]'.PHP_EOL.PHP_EOL.
                'Nama Kegiatan    : '.$this->nama_kegiatan.PHP_EOL.
                'Tempat           : '.$this->tempat.PHP_EOL.
                'Tanggal Mulai    : '.$this->start_at.PHP_EOL.
                'Tanggal Berakhir : '.$this->end_at.PHP_EOL.
                'Alasan        : '.PHP_EOL.PHP_EOL.
                $alasan;
        $token = '1519375290:AAEt7FLKWTlaEPJgamcqKv8pVTtboTbA9iY';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';

        $response = Http::post($url, [
            'chat_id' => '-518331855',
            'text' => $msg,
        ]);

        if($response->successful()){
            return true;
        }
    }

    public function determineKegiatanStatus()
    {
        /*
            0 -> belum berjalan
            1 -> sedang berjalan
            2 -> sudah berjalan
        */
        Carbon::setLocale('id');
        $today = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $kegiatan = Kegiatan::where('id', $this->id)->get()->first();

        if ($kegiatan->end_at > $today) {
            if($kegiatan->start_at > $today) {
                return 0;
            }
            else {
                return 1;
            }
        }
        else {
            return 2;
        }
    }
}
