<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plugin;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PluginController extends Controller
{

   public function index(){
   	$plugins = Plugin::latest()->approved()->paginate(9);
   	return view('plugins',compact('plugins'));
   }

   public function download_file($slug){
      $plugin = Plugin::where('slug',$slug)->first();
      return Storage::download($plugin->download_link);
   }


    public function details($slug){
     
     $plugin = Plugin::where('slug',$slug)->approved()->first();

     $blogPluginKey = 'blog_' . $plugin->id;
     if (!Session::has($blogPluginKey)) {
     	$plugin->increment('view_count');
     	Session::put($blogPluginKey,1);
     }

     $randomplugins = Plugin::approved()->take(3)->inRandomOrder()->get();
     return view('plugin',compact('plugin','randomplugins'));

    }

    public function pluginByCategory($slug){
 $category = Category::where('slug',$slug)->first();
 $plugins = $category->plugins()->approved()->get();
 $posts = $category->posts()->approved()->published()->get();
 return view('category',compact('category','plugins','posts'));


  }

   public function pluginByTag($slug){
 $tag = Tag::where('slug',$slug)->first();
 $plugins = $tag->plugins()->approved()->get();
 $posts = $tag->posts()->approved()->published()->get();
 return view('tag',compact('tag','plugins','posts'));


  }




}