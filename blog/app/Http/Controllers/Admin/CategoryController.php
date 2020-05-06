<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,png,jpg'
           ]);
   
            // Get Form Image
           $image = $request->file('image');
           $slug = str_slug($request->name);
           if (isset($image)) {
              
              // Make Unique Name for Image 
             $currentDate = Carbon::now()->toDateString();
     $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
   
   
           // Check Category Dir is exists
   
               if (!Storage::disk('public')->exists('category')) {
                  Storage::disk('public')->makeDirectory('category');
               }
   
   
               // Resize Image for category and upload
               $category = Image::make($image)->resize(1600,479)->stream();
               Storage::disk('public')->put('category/'.$imagename,$category);
   
   
              // Check Category Slider Dir is exists
   
               if (!Storage::disk('public')->exists('category/slider')) {
                  Storage::disk('public')->makeDirectory('category/slider');
               }
   
   
               // Resize Image for category slider and upload
               $slider = Image::make($image)->resize(500,333)->stream();
               Storage::disk('public')->put('category/slider/'.$imagename,$slider);
    
            }else{
               $imagename = 'default.png';
            } 
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
         return redirect(route('admin.category.index'))->with('successMsg', 'Category Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg'
           ]);
   
            // Get Form Image
           $image = $request->file('image');
           $slug = str_slug($request->name);
           $category = Category::find($id);
           if (isset($image)) {
              
              // Make Unique Name for Image 
             $currentDate = Carbon::now()->toDateString();
     $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
   
   
           // Check Category Dir is exists
   
               if (!Storage::disk('public')->exists('category')) {
                  Storage::disk('public')->makeDirectory('category');
               }
   
                // Delete Old Image 
             if (Storage::disk('public')->exists('category/'.$category->image)) {
                Storage::disk('public')->delete('category/'.$category->image);
               }  
   
   
               // Resize Image for category and upload
               $categoryimage = Image::make($image)->resize(1600,479)->stream();
               Storage::disk('public')->put('category/'.$imagename,$categoryimage);
   
   
              // Check Category Slider Dir is exists
   
               if (!Storage::disk('public')->exists('category/slider')) {
                  Storage::disk('public')->makeDirectory('category/slider');
               }
   
   
               // Delete Old Image Slider 
             if (Storage::disk('public')->exists('category/slider/'.$category->image)) {
                Storage::disk('public')->delete('category/slider/'.$category->image);
               }  
   
   
               // Resize Image for category slider and upload
               $slider = Image::make($image)->resize(500,333)->stream();
               Storage::disk('public')->put('category/slider/'.$imagename,$slider);
    
            }else{
               $imagename = $category->image;
            } 
        
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
         return redirect(route('admin.category.index'))->with('successMsg', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

                        // Delete Old Image 
                        if (Storage::disk('public')->exists('category/'.$category->image)) {
                            Storage::disk('public')->delete('category/'.$category->image);
                           }  

                           
                        // Delete Old Image Slider 
                         if (Storage::disk('public')->exists('category/slider/'.$category->image)) {
                            Storage::disk('public')->delete('category/slider/'.$category->image);
                            }  

                            $category->delete();
                            return redirect(route('admin.category.index'))->with('successMsg', 'Category Deleted Successfully');
    }
}
