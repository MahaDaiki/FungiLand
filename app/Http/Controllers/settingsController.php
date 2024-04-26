<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\settingsRequests;
use App\Models\User; // Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class settingsController extends Controller
{
    // public function updateProfile(settingsRequests $request)
    // {
    //     $user = Auth::user();

    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->description = $request->input('description');
    //     if ($request->hasFile('image')) {
    //         if ($user->profilepic) {
    //             Storage::delete($user->profilepic);
    //         }
    //         $path = $request->file('image')->store('profile_pictures', 'public');
    //         $user->profilepic = $path;
    //     }

    //     $user->save();

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }
    public function edit(User $user)
    {
        return view('Auth.settings', compact('user'));
    }

    public function update(SettingsRequests $request, User $user)
{
    $validatedData = $request->validated(); 

    if ($request->hasFile('image')) {
        if ($user->profilepic) {
            Storage::delete($user->profilepic);
        }
        $path = $request->file('image')->store('assets/images', 'public');
        $validatedData['profilepic'] = $path; 
    }

    $user->update($validatedData);

    return back()->with('success', 'User updated successfully.');
}
public function updatePassword(ChangePasswordRequest $request, User $user)
{
    $validatedData = $request->validated();

    if (!Hash::check($validatedData['current_password'], $user->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    $user->update([
        'password' => Hash::make($validatedData['new_password'])
    ]);

    return back()->with('success', 'Password changed successfully.');
}

}
