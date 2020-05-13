<?php

namespace App\Http\Controllers\Dev;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag; 
use App\User;
use App\Notifications\NewAuthorPost;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
       return view('dev.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('dev.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
          'title' => 'required',
          'image' => 'required',
          'categories' => 'required',
          'tags' => 'required',
          'body' => 'required',

         ]);

   // Get Form Image
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
           
           // Make Unique Name for Image 
          $currentDate = Carbon::now()->toDateString();
  $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();


        // Check Category Dir is exists

            if (!Storage::disk('public')->exists('post')) {
               Storage::disk('public')->makeDirectory('post');
            }


            // Resize Image for category and upload
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);

   }else{
    $imageName = "default.png";
   }

  $post = new Post();
  $post->user_id = Auth::id();
  $post->title = $request->title;
  $post->slug = $slug;
  $post->image = $imageName;
  $post->body = $request->body;
  if (isset($request->status)) {
    $post->status = true;
  }else{
    $post->status = false;
  }
  $post->is_approved = false;
  $post->save();

  $post->categories()->attach($request->categories);
  $post->tags()->attach($request->tags);
 
  $users = User::where('role_id', '1')->get();
  Notification::send($users, new NewAuthorPost($post));

  return redirect(route('dev.post.index'))->with('successMsg', 'Developer Post Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      if ($post->user_id != Auth::id()) {
       return redirect()->back();
      }
        return view('dev.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      if ($post->user_id != Auth::id()) {
       return redirect()->back();
      }
        $categories = Category::all();
        $tags = Tag::all();
        return view('dev.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      if ($post->user_id != Auth::id()) {
       return redirect()->back();
      }
         $this->validate($request,[
          'title' => 'required',
          'image' => 'image',
          'categories' => 'required',
          'tags' => 'required',
          'body' => 'required',

         ]);

   // Get Form Image
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
           
           // Make Unique Name for Image 
          $currentDate = Carbon::now()->toDateString();
  $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();


        // Check Category Dir is exists

            if (!Storage::disk('public')->exists('post')) {
               Storage::disk('public')->makeDirectory('post');
            }

         // Delete old post image
        if(Storage::disk('public')->exists('post/'.$post->image)){
          Storage::disk('public')->delete('post/'.$post->image);

        }

            // Resize Image for category and upload
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);

   }else{
    $imageName = $post->image;
   }

  
  $post->user_id = Auth::id();
  $post->title = $request->title;
  $post->slug = $slug;
  $post->image = $imageName;
  $post->body = $request->body;
  if (isset($request->status)) {
    $post->status = true;
  }else{
    $post->status = false;
  }
  $post->is_approved = false;
  $post->save();

  $post->categories()->sync($request->categories);
  $post->tags()->sync($request->tags);
  return redirect(route('dev.post.index'))->with('successMsg', 'Developer Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      if ($post->user_id != Auth::id()) {
       return redirect()->back();
      }
        if (Storage::disk('public')->exists('post/'.$post->image)) {
           Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        return redirect(route('dev.post.index'))->with('successMsg', 'Developer Post Deleted Successfully');
    }
}
