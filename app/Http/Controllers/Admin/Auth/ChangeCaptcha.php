<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeCaptcha extends Controller
{
    function refreshCaptcha()
    {
        return captcha_img("flat");
    }
}