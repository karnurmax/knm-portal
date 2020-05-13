<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DevController extends Controller
{
    public function index(){
    
        $devs = User::devs()
                        ->withCount('posts')
                        ->withCount('comments')
                        ->get();
    
        return view('admin.devs',compact('devs'));
    

    }


    public function destroy($id){
        $dev = User::findOrFail($id)->delete();
        return redirect()->back()->with('successMsg', 'Your dev deleted successfully');

    }
}
