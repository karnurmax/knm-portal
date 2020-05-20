<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PluginComment;

class PluginCommentController extends Controller
{
    public function index(){
        $plugin_comments = PluginComment::latest()->get();
        return view('admin.plugin_comments',compact('plugin_comments'));
    }

    public function destroy($id){
    	PluginComment::findOrFail($id)->delete();
    	return redirect()->back()->with('successMsg','Comment Successfully Removed From List');
    }
}

