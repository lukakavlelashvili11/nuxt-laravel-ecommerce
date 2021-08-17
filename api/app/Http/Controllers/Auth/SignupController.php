<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupValidation;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function signup(SignupValidation $request,UserRepository $user){
        $user->store([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
    }
}
