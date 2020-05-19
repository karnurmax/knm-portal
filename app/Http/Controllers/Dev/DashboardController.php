<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();
        $posts = $user->posts;
        $plugins = $user->plugins;
        $popular_posts = $user->posts()
                        ->withCount('comments')
                        ->orderBy('view_count','desc')
                        ->orderBy('comments_count','desc')
                        ->take(3)->get();

        $popular_plugins = $user->plugins()
        ->withCount('comments')
        ->orderBy('view_count','desc')
        ->orderBy('comments_count','desc')
        ->orderBy('downloads_count','desc')
        ->take(3)->get();
    
        $total_pending_posts = $posts->where('is_approved',false)->count();
        $total_pending_plugins = $plugins->where('is_approved',false)->count();
        $all_views = $posts->sum('view_count');
        $all_views_plugins = $plugins->sum('view_count');
    
            return view('dev.dashboard', compact('posts','popular_posts', 'total_pending_posts','all_views',
                                                 'plugins','popular_plugins', 'total_pending_plugins','all_views_plugins'
                                                                                                         ));
        }
}
