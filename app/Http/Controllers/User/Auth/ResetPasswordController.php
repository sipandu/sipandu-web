<?php

namespace App\Http\Controllers\User\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{

    public function showForm(Request $request)
    {
        return view('pages.auth.user.password.verify-otp');
    }

    public function cekOTP(Request $request)
    {
        $user = User::whereOtp_token($request->otp)->first();

        if($user ==null){
            return redirect()->back()->with('error','Code OTP yang anda masukan salah');
        }else{
            Carbon::setLocale('id');
            $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
            $session = $user->updated_at;
            $now = Carbon::parse($today);
            $updated = Carbon::parse($session);
            $perbedaan_waktu = $updated->diff($now);

            $tahun = ($perbedaan_waktu->y)*525600;
            $bulan = ($perbedaan_waktu->m)*43200;
            $day = ($perbedaan_waktu->d)*1440;
            $jam = ($perbedaan_waktu->h)*60;
            $minutes = ($perbedaan_waktu->i);

            $total_menit = $tahun + $bulan + $day + $jam + $minutes;

            if($minutes > 15){
                return redirect()->back()->with('error','Code OTP is Expired,Request Kembali Code OTP anda');
            }else{
                $user->update([
                    'otp_token' => rand(100000,999999),
                 ]);

                 return redirect()->route('user.password.reset',[$user->otp_token])->with('succes','Silakan masukan password baru anda');
            }

        }
    }

    public function showResetForm(Request $request, $token = null)
    {
        $user = User::whereOtp_token($token)->first();
        return view('pages.auth.user.password.reset-password')->with(
            ['token' => $token, 'email' => $user->email]
        );
    }


    public function passwordUpdate(Request $request)
    {
        $this->validate($request,[
            'email' => "required|email|exists:tb_user",
            'password' => 'required|min:8|max:50|confirmed',
        ],
        [
            'email.required' => "Email wajib diisi",
            'email.email' => "Masukan email yang valid",
            'email.exists' => "Email yang anda masukan tidak terdaftar",
            'password.required' => "Password Baru wajib diisi",
            'password.min' => "Password minimal 8 karakter",
            'password.max' => "Password maksimal 50 karakter",
            'password.confirmed' => "Konfirmasi password tidak sesuai",
        ]);

        $user = User::whereOtp_token($request->token)->first();

        $user->update([
            'password' => Hash::make($request->password),
            'otp_token' => null,
        ]);

        return redirect()->route('form.user.login')->with('success','Anda Berhasil mengganti password silakan untuk login');

    }

}
