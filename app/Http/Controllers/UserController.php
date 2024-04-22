<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
 public function index(){
    return view('profile');
 }
 public function forgot_show()
 {
     return view('Auth.forgotpassword');
 }
 public function reset($token)
 {
     $user = User::where('remember_token', $token)->first();
 
     if (!empty($user)) {
         $data['user'] = $user;
         $data['token'] = $token; 
         return view('Auth.resetpassword', $data);
     } else {
         abort(404);
     }
 }
 public function forgot_password(Request $request)
 {
     $request->validate([
         'email' => 'required|email',
     ]);

     $email = $request->input('email');
     $user = User::where('email', $email)->first();
     if(!empty($user))
     {
         $user->remember_token = Str::random(40);
         $user->save();

         Mail::to($user->email)->send(new ForgotPasswordMail($user));
         
         return back()->withErrors([
             'email'=> 'Check ton email'
             ])->onlyInput('email');
     }else{
         return back()->withErrors([
             'email'=> 'Email non trouvé.'
             ])->onlyInput('email');
     }
 }
 public function post_reset($token, Request $request)
 {
     $user = User::where('remember_token','=',$token)->first();
     if(!empty($user))
     {
         if($request->password == $request->confirm_password)
         {
             $user->password = Hash::make($request->password);
             $user->remember_token = Str::random(40);
             $user->save();

             return redirect()->route('Auth.login'); 

         }else{
             return redirect()->back()->with('error', 'Mots de passe non identiques');
         }
     }else{
         abort(404);
     }
 } 
}
