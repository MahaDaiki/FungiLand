<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'profilepic' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        // $profilePicPath = null;
        // if ($request->hasFile('profilepic')) {
        //     $profilePicPath = $request->file('profilepic')->store('profilepic', 'public');
        // }
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'profilepic' => $profilePicPath, 
        ]);
    
        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }
}
