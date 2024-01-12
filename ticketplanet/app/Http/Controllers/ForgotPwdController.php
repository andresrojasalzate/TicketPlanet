<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ForgotPwdController extends Controller
{

    public function showResetPwd()
    {
        return view('auth.forgotPwd');
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgotPwd');
    }


}
