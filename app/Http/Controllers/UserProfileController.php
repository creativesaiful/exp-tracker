<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
   public function ProfileView(){
        
        $user = User::where('id', auth()->user()->id)->first();
      
        
        return view('pages.profile', compact('user'));
    }


    public function ProfileUpdate(Request $request){

      
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required || min:11 || max:11',
            'default_currency'=>'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

        
        $name = $request->name;
        $phone = $request->phone;
        $default_currency= $request->default_currency;
        $user = User::where('id', auth()->user()->id)->first();

        //profile image procesing
        if ($request->file('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/uploads'), $imageName); 

            unlink('storage/uploads/'.$user->profile_photo_path);
        }else{
            $imageName = $user->profile_photo_path;
        }

      try{
        $user = User::where('id', auth()->user()->id)->first();
        $user->name = $name;
        $user->phone = $phone;
        $user->default_currency = $default_currency;
        $user->profile_photo_path = $imageName; 
        $user->save();

        $success = [
            'type' => 'success',
            'message'=>'Profile Updated Successfully',
        ];

        return redirect()->route('profile')->with($success);
      }catch(\Exception $e){
        $error = [
            'type' => 'error',
            'message'=>$e->getMessage(),
        ];

        return redirect()->route('profile')->with($error);


       
    }
    }

}
