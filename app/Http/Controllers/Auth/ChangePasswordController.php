<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function changePassword()
    {
       return view('auth.passwords.change');
    }

    public function updatePassword(Request $request)
    {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);


            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }


            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with("status", "Password changed successfully!");
    }
}
