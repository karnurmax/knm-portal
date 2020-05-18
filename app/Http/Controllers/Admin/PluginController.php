<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;
use App\Subscriber;
use App\Http\Controllers\Controller;
use App\Plugin;
use App\Category;
use App\Tag; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class PluginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plugins = Plugin::latest()->get();
        return view('admin.plugin.index',compact('plugins'));
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
        return view('admin.plugin.create',compact('categories','tags'));
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
            'plugin_file' => 'required',
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
  
              if (!Storage::disk('public')->exists('plugins_images')) {
                 Storage::disk('public')->makeDirectory('plugins_images');
              }
  
  
              // Resize Image for category and upload
              $pluginImage = Image::make($image)->resize(1600,1066)->stream();
              Storage::disk('public')->put('plugins_images/'.$imageName,$pluginImage);
  
     }else{
      $imageName = "default_plugin.png";
     }


          // Get Form Plugin_file
          $plugin_file = $request->file('plugin_file');
          if (isset($plugin_file)) {
             
             // Make Unique Name for plugin
    $currentDate = Carbon::now()->toDateString();
    $plugin_fileName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$plugin_file->getClientOriginalExtension();
  
  
          // Check Category Dir is exists
  
              if (!Storage::disk('public')->exists('plugins')) {
                 Storage::disk('public')->makeDirectory('plugins');
              }
  
  
              //  upload
              Storage::disk('public')->put('plugins/'.$plugin_fileName,$plugin_file);
  
     }else{
      $plugin_fileName = "default_plugin.zip";
     }

     $download_link = asset('plugins/'.$plugin_fileName,$plugin_file);

  
     $plugin = new Plugin();
     $plugin->user_id = Auth::id();
     $plugin->title = $request->title;
     $plugin->slug = $slug;
     $plugin->image = $imageName;
     $plugin->body = $request->body;
     $plugin->plugin_file = $plugin_fileName;
     $plugin->download_link = $download_link;
     $plugin->is_approved = true;
     $plugin->save();
   
     $plugin->categories()->attach($request->categories);
     $plugin->tags()->attach($request->tags);
      
      $subscribers = Subscriber::all();
      foreach ($subscribers as $subscriber) {
        Notification::route('mail',$subscriber->email)
        ->notify(new NewPostNotify($plugin));
     }
  
  
    return redirect(route('admin.plugin.index'))->with('successMsg', 'Plugin Inserted Successfully');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plugin  $plugin
     * @return \Illuminate\Http\Response
     */
    public function show(Plugin $plugin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plugin  $plugin
     * @return \Illuminate\Http\Response
     */
    public function edit(Plugin $plugin)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.plugin.edit',compact('plugin','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plugin  $plugin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plugin $plugin)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'plugin_file' => 'file',
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
  
              if (!Storage::disk('public')->exists('plugins_images')) {
                 Storage::disk('public')->makeDirectory('plugins_images');
              }


                       // Delete old post image
        if(Storage::disk('public')->exists('plugins_images/'.$plugin->image)){
            Storage::disk('public')->delete('plugins_images/'.$plugin->image);
  
          }
  
  
              // Resize Image for category and upload
              $pluginImage = Image::make($image)->resize(1600,1066)->stream();
              Storage::disk('public')->put('plugins_images/'.$imageName,$pluginImage);
  
     }else{
      $imageName = $plugin->image;
     }


          // Get Form Plugin_file
          $plugin_file = $request->file('plugin_file');
          if (isset($plugin_file)) {
             
             // Make Unique Name for Plugin
    $currentDate = Carbon::now()->toDateString();
    $plugin_fileName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$plugin_file->getClientOriginalExtension();
  
  
          // Check Category Dir is exists
  
              if (!Storage::disk('public')->exists('plugins')) {
                 Storage::disk('public')->makeDirectory('plugins');
              }

        
                       // Delete old plugin
                       if(Storage::disk('public')->exists('plugins/'.$plugin->plugin_file)){
                        Storage::disk('public')->delete('plugins/'.$plugin->plugin_file);
              
                      }
  
  
              //  upload
              Storage::disk('public')->put('plugins/'.$plugin_fileName,$plugin_file);
  
     }else{
        $plugin_fileName = $plugin->plugin_file;
     }

     $download_link = asset('plugins/'.$plugin_fileName,$plugin_file);


     $plugin->user_id = Auth::id();
     $plugin->title = $request->title;
     $plugin->slug = $slug;
     $plugin->image = $imageName;
     $plugin->body = $request->body;
     $plugin->plugin_file = $plugin_fileName;
     $plugin->download_link = $download_link;
     $plugin->is_approved = true;
     $plugin->save();
   
     $plugin->categories()->sync($request->categories);
     $plugin->tags()->sync($request->tags);
      
  
  
    return redirect(route('admin.plugin.index'))->with('successMsg', 'Plugin Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plugin  $plugin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plugin $plugin)
    {
        //
    }
}