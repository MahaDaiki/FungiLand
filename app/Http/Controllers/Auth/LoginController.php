<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

 
        public function login(login $request)
        {
            $credentials = $request->only('email', 'password');
        
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
        
                return redirect()->intended('/');
            }
        
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

