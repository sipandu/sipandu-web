@component('mail::message')

<p>Kode Konfirmasi Password</p>
<h1>Halo, {{$user->email}}</h1>
<h2>Kode OTP Anda "{{$user->otp_token}}"</h2>
<h2>PERHATIAN! Jangan Berikan kode OTP tersebut kepada orang lain</h2>
<p>Code hanya berlaku dalam 15 menit</p>

@endcomponent
