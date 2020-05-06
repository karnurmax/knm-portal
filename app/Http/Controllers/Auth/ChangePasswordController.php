<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    } 


    public function index(){
        return view('auth.passwords.change  '); // path folder
    }

    

    public function changepassword(Request $request){

        $this->validate($request,[  

            'oldpassword' => 'required', 
            'password' => 'required | confirmed',  


        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword )) {   //it is saying: if the entered old password mathces existing in DB password

            $user = User::find(Auth::id()); // as I understand: it means take id of the authorised user
            $user->password = Hash::make($request->password);     // do hashing of the entered password and enter to database
            $user->save();

            Auth::logout();

            return redirect()->route('login')->with('sucessfulMsg', "Password is changed successfully");


        }else{

            return redirect()->back()->with('errorMsg', "Password can not be changed");

        }

    }


}
