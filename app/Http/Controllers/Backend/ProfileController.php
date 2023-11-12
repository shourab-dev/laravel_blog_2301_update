<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function showProfile()
    {
        return view('backend.profile');
    }

    function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            "profile_img" => "nullable|mimes:jpg,png"

        ], [
            'name.required' => "Enter your user name"
        ]);



        //* DATA UPDATE

        if ($request->hasFile('profile_img')) {
            $ext = $request->profile_img->extension();
            $imgName = auth()->user()->name . '-' . Carbon::now()->format('d-m-y-h-m-s') . '.' . $ext;
            $request->profile_img->storeAs('users', $imgName, 'public');
        }


        //*  user data update db
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_img')) {
            $user->profile_img = $imgName;
        }

        $user->save();
        return back();
    }

    function updatePassword(Request $request)
    {

        $request->validate([
            'old' => "required|current_password",
            'password' => "required|confirmed|different:old",
            'password_confirmation' => "required",
        ]);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back();
    }
}
