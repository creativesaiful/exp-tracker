<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    function ProfileView(){
        
        $user = User::where('id', auth()->user()->id)->first();
      
        
        return view('pages.profile', compact('user'));
    }


    function ProfileUpdate(Request $request){

        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required || min:11 || max:11',
            'default_currency'=>'required',
        ]);
        
        $name = $request->name;
        $phone = $request->phone;
        $default_currency= $request->default_currency;

        //profile image procesing
        $imagepath = $request->file('profile_image');
        $imgName = hexdec(uniqid()).'.'.$imagepath->getClientOriginalExtension();

        $request->profile_image->move(public_path('images'), $imgName);



        $user = User::where('id', auth()->user()->id)->first();
        $user->name = $name;
        $user->phone = $phone;
        $user->default_currency = $default_currency;
        $user->profile_photo_path = $imgName;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile Updated');


       
    }
}
