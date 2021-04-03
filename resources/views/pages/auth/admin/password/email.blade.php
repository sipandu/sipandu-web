@component('mail::message')

<p>Kode Konfirmasi Password</p>
<h1>Halo, {{$admin->email}}</h1>
<h5>Kode OTP Anda "{{$admin->otp_token}}"</h5>
<h2>PERHATIAN! Jangan Berikan kode OTP tersebut kepada orang lain</h2>
<p>Code hanya berlaku dalam 15 menit</p>

@endcomponent
