<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('admin.comments',compact('comments'));
    }

    public function destroy($id){
    	Comment::findOrFail($id)->delete();
    	return redirect()->back()->with('successMsg','Comment Successfully Removed From List');
    }
}

