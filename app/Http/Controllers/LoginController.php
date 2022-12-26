<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
//        dd($credential);
        if (Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return response("login gagal");
    }
}
