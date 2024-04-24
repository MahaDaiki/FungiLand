<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Saved;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
            $user = Auth::user();
            $userPosts = Post::withCount('likes', 'comments', 'saves')
                             ->where('user_id', $user->id)
                             ->get();
            $totalLikes = $userPosts->sum('likes_count');
            $totalComments = $userPosts->sum('comments_count');
            $totalSaved = $userPosts->sum('saves_count');
            $totalPosts = $userPosts->count();
            
            return view('profile', compact('user', 'totalLikes', 'totalComments', 'totalSaved', 'totalPosts'));
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
             'email'=> 'Check your email'
             ])->onlyInput('email');
     }else{
         return back()->withErrors([
             'email'=> 'Email not found'
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
             return redirect()->back()->with('error', 'password error');
         }
     }else{
         abort(404);
     }
 } 
}
