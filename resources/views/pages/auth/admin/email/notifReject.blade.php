
@component('mail::message')

<p>Hallo Pengguna Smart Posyandu</p>

<h1>Hello,{{$nama}}</h1>

<h2>Kami Telah Meninjau pendaftaran akun kamu pada Layanan Smart Posyandu ya, Mohon maaf kami menolak dengan alasan {{$keterangan}}</h2>

<p>Terimakasi</p>

@endcomponent
