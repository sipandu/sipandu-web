<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Kegiatan extends Model
{
    use SoftDeletes;
    protected $table = 'tb_kegiatan';
    protected $dates = ['deleted_at'];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }

    public function broadcastKegiatanBaru()
    {
        $msg = '[ KEGIATAN BARU ]'.PHP_EOL.

        'Salam sehat, salam semangat!'.PHP_EOL.
        'Smart Posyandu kembali hadir menemani dengan membawa agenda baru.'.PHP_EOL.
        'Kegiatan             : '. $this->nama_kegiatan.PHP_EOL.
        'Tempat               : '.$this->tempat.PHP_EOL.
        'Tanggal              : '.date('D, d F Y', strtotime($this->start_at)) . ' s/d ' . date('D, d F Y', strtotime($this->end_at)).PHP_EOL.PHP_EOL.

        strip_tags($this->deskripsi.PHP_EOL.PHP_EOL).

        'Salam Sehat,'.PHP_EOL.
        'Smart Posyandu';

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
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

        foreach($lansia as $item)
        {
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

        foreach($ibu_hamil as $item)
        {
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

    }

    public function broadcastKegiatanUpdate()
    {
        $msg = '[ RALAT KEGIATAN ]'.PHP_EOL.

        'Salam sehat, salam semangat!'.PHP_EOL.
        'Smart Posyandu kembali hadir menemani dengan membawa agenda baru.'.PHP_EOL.
        'Kegiatan             : '. $this->nama_kegiatan.PHP_EOL.
        'Tempat               : '.$this->tempat.PHP_EOL.
        'Tanggal              : '.date('D, d F Y', strtotime($this->start_at)) . ' s/d ' . date('D, d F Y', strtotime($this->end_at)).PHP_EOL.PHP_EOL.

        strip_tags($this->deskripsi.PHP_EOL.PHP_EOL).

        'Salam Sehat,'.PHP_EOL.
        'Smart Posyandu';

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
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

        foreach($lansia as $item)
        {
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

        foreach($ibu_hamil as $item)
        {
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

    }

    public function broadcastKegiatanCancel($alasan)
    {
        $msg = '[ PEMBATALAN KEGIATAN ]'.PHP_EOL.

        'Salam sehat, salam semangat!'.PHP_EOL.
        'Smart Posyandu kembali hadir menemani dengan membawa agenda baru.'.PHP_EOL.
        'Kegiatan             : '. $this->nama_kegiatan.PHP_EOL.
        'Tempat               : '.$this->tempat.PHP_EOL.
        'Tanggal              : '.date('D, d F Y', strtotime($this->start_at)) . ' s/d ' . date('D, d F Y', strtotime($this->end_at)).PHP_EOL.PHP_EOL.

        $alasan.

        'Salam Sehat,'.PHP_EOL.
        'Smart Posyandu';

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
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

        foreach($lansia as $item)
        {
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

        foreach($ibu_hamil as $item)
        {
            $this->sendMessage($item->id_chat_tele, $msg);
            sleep(2);
        }

    }

    public function sendMessage($id_chat, $text)
    {
        $token = '1137522342:AAEj3X4Obbi-uV8QGzkvcvpzjo6HKENKfX4';
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
        $response = Http::post($url, [
            'chat_id' => $id_chat,
            'text' => $text,
        ]);

    }
}
