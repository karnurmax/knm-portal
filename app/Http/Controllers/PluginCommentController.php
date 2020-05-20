<?php

namespace App\Http\Controllers;
use App\PluginComment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PluginCommentController extends Controller
{
    public function store(Request $request,$plugin){

        $this->validate($request,[
        'plugin_comment' => 'required'
        ]);
   
      $plugin_comment = new PluginComment();
      $plugin_comment->plugin_id = $plugin;
      $plugin_comment->user_id = Auth::id();
      $plugin_comment->plugin_comment = $request->plugin_comment;
      $plugin_comment->save();
      return redirect()->back()->with('successMsg','Plugin Comment Successfully Published');
   
       }
}
