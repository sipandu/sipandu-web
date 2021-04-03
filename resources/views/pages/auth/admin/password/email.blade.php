@component('mail::message')

{{-- <div class="card-header bg-white text-center">
    <img class="rounded mx-auto d-block" src="{{  }}" alt="sipandu logo" width="100" height="100">
    <a href="" class="text-decoration-none h4 fw-bold">Smart POSYANDU</a>
</div> --}}
{{-- <img src="{{embed(asset('images/sipandu-logo.png'))}}"> --}}
{{-- [logo]: {{asset('/images/sipandu-logo.png')}} "Logo" --}}

<p>Kode Konfirmasi Password</p>
<h1>Halo, {{$admin->email}}</h1>
<h5>Kode OTP Anda "{{$admin->otp_token}}"</h5>
<h2>PERHATIAN! Jangan Berikan kode OTP tersebut kepada orang lain</h2>
<p>Code hanya berlaku dalam 15 menit</p>

Thanks,<br>


@endcomponent
