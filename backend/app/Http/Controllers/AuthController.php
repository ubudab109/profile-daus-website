<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::check()) {
            return redirect()->intended();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'pin' => 'required',
        ]);
        $pin = DB::table('users')->first();
        if (Hash::check($request->pin, $pin->pin)) {
            Auth::loginUsingId($pin->id);
            return redirect()->intended();
        }
        return redirect()->route('login')->withErrors('Pin Incorrect');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
