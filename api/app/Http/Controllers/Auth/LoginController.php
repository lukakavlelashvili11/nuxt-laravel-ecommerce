<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninValidation;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(SigninValidation $request){
        if(!Auth::attempt($request->only('email','password'),$request->remember)){
            throw new AuthenticationException();
        }
    }
}
