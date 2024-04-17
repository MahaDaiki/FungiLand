<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('Auth.register');
    }

    public function register(Register $request)
    {
        $profilePicPath = null;
        if ($request->hasFile('profilepic')) {
            $profilePicPath = $request->file('profilepic')->store('assets/images', 'public');
        }
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profilepic' => $profilePicPath, 
        ]);
    
        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }
}
