<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function index(){
    
        $authors = User::authors()
                        ->withCount('posts')
                        ->withCount('comments')
                        ->get();
    
        return view('admin.authors',compact('authors'));
    

    }


    public function destroy($id){
        $author = User::findOrFail($id)->delete();
        return redirect()->back()->with('successMsg', 'Your author deleted successfully');

    }
}
