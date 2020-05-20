<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Plugin;
use App\User;
use App\Category;
use App\Tag;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
       

	   $posts = Post::all();
	   $plugins = Plugin::all();
       $popular_posts = Post::withCount('comments')
       						->orderBy('view_count','desc')
       						->orderBy('comments_count','desc')
							->take(10)->get();
							   
		$popular_plugins = Plugin::withCount('plugin_comments')
       						->orderBy('view_count','desc')
							->orderBy('plugin_comments_count','desc')
							->orderBy('download_count','desc')
       						->take(10)->get();

	   $total_pending_posts = Post::where('is_approved',false)->count();
	   $total_pending_plugins = Plugin::where('is_approved',false)->count();
	   $all_views = Post::sum('view_count');
	   $all_views_plugins = Plugin::sum('view_count');

	   //missing all downloads
	   $author_count = User::where('role_id',2)->count();
	   $dev_count = User::where('role_id',3)->count();
       $new_authors_today = User::where('role_id',2)
							   ->whereDate('created_at',Carbon::today())->count();
	   $new_devs_today = User::where('role_id',3)
       						   ->whereDate('created_at',Carbon::today())->count();

       $active_authors = User::where('role_id',2,3)
       						->withCount('posts')
							->withCount('comments')	
							->withCount('plugin_comments')	
       						->orderBy('posts_count','desc')
							->orderBy('comments_count','desc')
							->orderBy('plugin_comments_count','desc')
							->take(10)->get();
							   
		$active_devs = User::where('role_id',3)
							   ->withCount('plugins')
							   ->orderBy('plugins_count','desc')
       						->take(10)->get();

       	$category_count = Category::all()->count();
       	$tag_count = Tag::all()->count();


		return view('admin.dashboard',compact('posts','popular_posts','total_pending_posts','all_views','author_count',
		'dev_count','new_authors_today','new_devs_today','active_authors','active_devs','category_count','tag_count',
		'plugins','popular_plugins','total_pending_plugins','all_views_plugins'));
    }
}
