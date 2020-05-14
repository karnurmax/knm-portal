<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return view('dev.settings');
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email'
        ]);
        
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->back()->with('successMsg', 'User profile updated Successfully');


    }


    public function updatePassword(Request $request){
   
        $this->validate($request, [
        'old_password' => 'required',
        'password' => 'required|confirmed',
      
        ]);
       
       $hashedPassword = Auth::user()->password;
       if (Hash::check($request->old_password,$hashedPassword)) {
      if (!Hash::check($request->password,$hashedPassword)) {
          $user = User::find(Auth::id());
          $user->password = Hash::make($request->password);
          $user->save();
          Auth::logout();
          return redirect()->back();
      
      }else{
          return redirect()->back()->with('loginerrorMsg', 'New password Can not be same as old password');
      }
     
       }else{
           return redirect()->back()->with('loginerrorMsg', 'Current Password is not match');
       }
     
       }
     
}
