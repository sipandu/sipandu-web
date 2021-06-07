<?php

namespace App\Http\Controllers;

use App\Konsultasi;
use App\Mover;
use App\Nakes;
use App\NakesPosyandu;
use App\Pegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PDF;

class KonsultasiBotController extends Controller
{
    public function index()
    {
        $nakes_posyandu = NakesPosyandu::where('id_nakes', auth()->guard('admin')->user()->nakes->id)->get();
        $data_konsultasi = [];
        foreach($nakes_posyandu as $item) {
            $data_konsultasi[] = Konsultasi::where('id_posyandu', $item->id_posyandu)->orderby('tanggal', 'desc')->get();
        }
        return view('pages.admin.kesehatan-keluarga.konsultasi-bot.home', compact('data_konsultasi'));
    }

    public function show($id)
    {
        $konsultasi = Konsultasi::find($id);
        $user = User::find($konsultasi->id_user);
        $pasien = $user->getPasienInfo();
        $data = json_decode($konsultasi->value);
        return view('pages.admin.kesehatan-keluarga.konsultasi-bot.show', compact('konsultasi', 'user', 'pasien', 'data'));
    }

    public function updateDiagnosa(Request $request)
    {
        $pegawai = Nakes::find(auth()->guard('admin')->user()->nakes->id);

        $konsultasi = Konsultasi::where('kode_konsultasi', $request->kode)->first();
        $konsultasi->id_pegawai = auth()->guard('admin')->user()->nakes->id;
        $konsultasi->nama_pemeriksa = $pegawai->nama_nakes;
        $konsultasi->is_confirm = '1';
        $konsultasi->diagnosa = $request->diagnosa;
        $konsultasi->resep = $request->resep;
        $konsultasi->is_sent = '0';
        $konsultasi->keterangan = $request->keterangan;
        $konsultasi->save();

        return redirect()->back()->with(['success' => 'Data Konsultasi berhasil diupdate']);
    }

    public function downloadKonsultasi($id)
    {
        $konsultasi = Konsultasi::where('kode_konsultasi', $id)->first();
        $user = User::find($konsultasi->id_user);
        $pasien = $user->getPasienInfo();
        $data = json_decode($konsultasi->value);
        $pdf = PDF::loadView('pages.admin.kesehatan-keluarga.konsultasi-bot.file-download', [
            'pasien' => $pasien,
            'user' => $user,
            'konsultasi' => $konsultasi,
            'data' => $data
        ]);
        return $pdf->download('konsultasi.pdf');
        // return view('pages.admin.kesehatan-keluarga.konsultasi-bot.file-download');
    }

    public function sendHasilToUser($id)
    {
        $url_bot = 'http://127.0.0.1:5002/updated-chat-in';
        $konsultasi = Konsultasi::find($id);
        $konsultasi->is_sent = '1';
        $konsultasi->save();
        $url_download = route('konsultasi-bot.download', $konsultasi->kode_konsultasi);
        $chat = '[HASIL PEMERIKSAAN]'. PHP_EOL .
                'Halo, hasil konsultasi kamu pada ' . date('d F Y', strtotime($konsultasi->tanggal)) . 'telah keluar, berikut link untuk mendownload hasil konsultasi anda.'
                . PHP_EOL . $url_download;
        $response = Http::get($url_bot, [
            'chat_id' => $konsultasi->chat_id,
            'chat' => $chat,
            'command' => '/kirim_hasil',
        ]);

        return redirect()->back()->with(['success' => 'Hasil Konsultasi berhasil dikirimkan ke user']);
    }

    public function getResep($id)
    {
        $konsultasi = Konsultasi::find($id);
        return response()->file(
            storage_path($konsultasi->resep)
        );
    }
}
