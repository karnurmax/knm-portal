<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PluginComment;

class PluginCommentController extends Controller
{
    public function index(){
        $posts = Auth::user()->posts;
        return view('author.plugin_comments',compact('plugins'));
    }

    public function destroy($id){
    	PluginComment::findOrFail($id)->delete();
    	return redirect()->back()->with('successMsg','PluginComment Successfully Removed From List');
    }
}
