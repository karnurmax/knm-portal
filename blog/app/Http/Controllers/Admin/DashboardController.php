<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
       

       $posts = Post::all();
       $popular_posts = Post::withCount('comments')
       						->orderBy('view_count','desc')
       						->orderBy('comments_count','desc')
       						->take(10)->get();

       $total_pending_posts = Post::where('is_approved',false)->count();
       $all_views = Post::sum('view_count');
       $author_count = User::where('role_id',2)->count();
       $new_authors_today = User::where('role_id',2)
       						->whereDate('created_at',Carbon::today())->count();

       $active_authors = User::where('role_id',2)
       						->withCount('posts')
       						->withCount('comments')	
       						->orderBy('posts_count','desc')
       						->orderBy('comments_count','desc')
       						->take(10)->get();

       	$category_count = Category::all()->count();
       	$tag_count = Tag::all()->count();


    	return view('admin.dashboard',compact('posts','popular_posts','total_pending_posts','all_views','author_count','new_authors_today','active_authors','category_count','tag_count'));
    }
}
