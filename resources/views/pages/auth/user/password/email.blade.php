@component('mail::message')

{{-- <div class="card-header bg-white text-center">
    <img class="rounded mx-auto d-block" src="{{  }}" alt="sipandu logo" width="100" height="100">
    <a href="" class="text-decoration-none h4 fw-bold">Smart POSYANDU</a>
</div> --}}
{{-- <img src="{{embed(asset('images/sipandu-logo.png'))}}"> --}}
{{-- [logo]: {{asset('/images/sipandu-logo.png')}} "Logo" --}}

Please Your Konfirmasi Password Code

<h1>Hello, {{$user->email}}</h1>

<h1>Your Code OTP, {{$user->otp_token}}</h1>


<h2>Perhatian!!,Jangan Berikan Code OTP tersebut kepada orang lain</h2>
<h2>Code hanya berlaku dalam 15 menit</h2>

Thanks,<br>


@endcomponent
