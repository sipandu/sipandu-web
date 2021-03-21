@component('mail::message')

{{-- <div class="card-header bg-white text-center">
    <img class="rounded mx-auto d-block" src="{{  }}" alt="sipandu logo" width="100" height="100">
    <a href="" class="text-decoration-none h4 fw-bold">Smart POSYANDU</a>
</div> --}}
{{-- <img src="{{embed(asset('images/sipandu-logo.png'))}}"> --}}
{{-- [logo]: {{asset('/images/sipandu-logo.png')}} "Logo" --}}

Please Your Konfirmasi Password Code

<h1>Hello, {{$admin->pegawai->nama_pegawai}}</h1>

<h1>Your Code OTP, {{$admin->otp_token}}</h1>


<h2>Perhatian!!,Jangan Berikan Code OTP tersebut kepada orang lain</h2>

Thanks,<br>


@endcomponent
