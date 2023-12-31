<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::latest('id')->get();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::latest('id')->get();
        return view('categories.form');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'category_name_en'      => 'required|string|unique:categories,category_name_en',
            'meta_description_en'           => 'nullable',
            'parent_id'           => 'nullable',
            'image'                 => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);

       
        $data = [
            'icon'                  => $request->icon,
            'category_name_en'      => $request->category_name_en,
            'category_slug_en'      =>  Str::slug($request->category_name_en),
            'meta_description_en'      => $request->meta_description_en,
            'parent_id'      => $request->parent_id,
            'status'                => $request->filled('status'),
        ];
      
        $category = Category::create($data);
        $file                   = $request->hasFile('image');
        if ($file) {
            if (file_exists($category->image)) {
                unlink($category->image);
            }
            $category->image = $this->uploadeImage($request);
        }
        $category->save();

        return redirect()->route('admin.category')->withSuccess(__('Category added successfully.'));
    }


    public function edit(Category $category)
    {

        return view('categories.form', compact('category'));
    }



    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_name_en'      => 'required|string|unique:categories,category_name_en,'.$category->id,
            'meta_description_en'   => 'nullable',
            'parent_id'           => 'nullable',
            'image'                 => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);

        $category->update([
            'icon'                  => $request->icon,
            'category_name_en'      => $request->category_name_en,
            'category_slug_en'      => Str::slug($request->category_name_en),
            'parent_id'      => $request->parent_id,
            'meta_description_en'      => $request->meta_description_en,
            'status'             => $request->filled('status'),
        ]);
        $file                    = $request->hasFile('image');
        if ($file) {
            if (file_exists($category->image)) {
                unlink($category->image);
            }
            $category->image = $this->uploadeImage($request);
        }
        $category->save();

        return redirect()->route('admin.category')->withSuccess(__('Category update successfully.'));
    }


    public function destroy(Category $category)
    {

        if (file_exists($category->image)) {
            unlink($category->image);
        }
        $category->delete();

        return redirect()->route('admin.categories')->withSuccess(__('Category deleted successfully.'));
    }
    //Image intervetion
    protected function uploadeImage($request)
    {
        $file           = $request->file("image");
        $get_imageName  =  date('mdYHis') . uniqid() . $file->getClientOriginalName();
        $directory      = 'images/categories/';
        $imageUrl       = $directory . $get_imageName;
		
        Image::make($file)->resize(600, 400)->save($imageUrl);
        return $imageUrl;
    }

    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}
