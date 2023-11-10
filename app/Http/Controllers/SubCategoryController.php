<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function index()
    {
    
        $subcategories = SubCategory::oldest('id')->get();
        return view('subcategories.index', compact('subcategories'));
    }


    public function create()
    {
        
        $categories = Category::latest('id')->get();
        return view('subcategories.form', compact('categories'));
    }


    public function store(Request $request)
    {
        // return $request;
       
        $this->validate($request, [
            'subcategory_name_en'    => 'required|string|unique:sub_categories,subcategory_name_en',
            'image'                  => 'nullable|image|mimes:jpg,png,jpeg,svg',
            'description'   => 'nullable',
            'category_id'            => 'required',
        ]);
        $subCategory = SubCategory::create([
            'category_id'            => $request->category_id,
            'subcategory_name_en'    => $request->subcategory_name_en,
            'description'      => $request->description,
            'subcategory_slug_en'    => ($request->subcategory_name_en),
            'status'                 => $request->filled('status'),
        ]);
        $file                   = $request->hasFile('image');
        if ($file) {
            if (file_exists($subCategory->image)) {
                unlink($subCategory->image);
            }
            $subCategory->image = $this->uploadeImage($request);
        }
        $subCategory->save();

        return redirect()->route('admin.subcategory')->withSuccess(__('SubCategory added Successfully.'));
    }

     //Image intervetion
     protected function uploadeImage($request)
     {
         $file           = $request->file("image");
         $get_imageName  =  date('mdYHis') . uniqid() . $file->getClientOriginalName();
         $directory      = 'images/sub-categories/';
         $imageUrl       = $directory . $get_imageName;
         Image::make($file)->resize(600, 400)->save($imageUrl);
         return $imageUrl;
     }


    public function edit(SubCategory $subcategory)
    {
        
        $categories = Category::all();
        return view('subcategories.form', compact('subcategory', 'categories'));
    }



    public function update(Request $request, SubCategory $subcategory)
    {
        
        $this->validate($request, [
            'subcategory_name_en'    => 'required|string|unique:sub_categories,subcategory_name_en,' . $subcategory->id,
            'image'                  => 'nullable|image|mimes:jpg,png,jpeg,svg',
            'description'   => 'nullable',
            'category_id'            => 'required',
        ]);
        $subcategory->update([
            'category_id'             => $request->category_id,
            'subcategory_name_en'     => $request->subcategory_name_en,
            'subcategory_slug_en'     => ($request->subcategory_name_en),
            'description'      => $request->description,
            'status'                  => $request->filled('status'),
        ]);
        $file                   = $request->hasFile('image');
        if ($file) {
            if (file_exists($subcategory->image)) {
                unlink($subcategory->image);
            }
            $subcategory->image = $this->uploadeImage($request);
        }
        $subcategory->save();

        return redirect()->route('admin.subcategory')->withSuccess(__('SubCategory Updated Successfully.'));
    }


    public function destroy(SubCategory $subcategory)
    {
       
        $subcategory->delete();

        return redirect()->route('admin.subcategory')->withSuccess(__('SubCategory deleted Successfully.'));
    }
    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}
