<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;

class PageController extends Controller
{

    public function index()
    {

        $pages   = Page::latest('id')->get();
        return view('pages.index', compact('pages'));
    }

    public function show(Page $page)
    {
        return $page;
    }

    public function auto(Request $request)
    {
        $keyword = $request->input('term');
        $products = Product::select('product_name_en', 'id')->where('product_name_en', 'LIKE', "%$keyword%")->get();
        $result = [];
        foreach( $products as  $product){
            $data = [];
            $data['id'] = $product['id']; 
            $data['value'] = $product['product_name_en']; 
            array_push($result, $data); 
        }
        return response()->json($result);
    }

    public function autoGroup(Request $request)
    {
        $keyword = $request->input('term');
        $products = ProductGroup::select('product_group_name', 'id')->
            where('product_group_name', 'LIKE', "%$keyword%")->
            get();

        
        $result = [];
        foreach( $products as  $product){
            $data = [];
            $data['id'] = $product['id']; 
            $data['value'] = $product['product_group_name']; 
            $products = [];
            foreach($product->groupItems as $item){
                $pro = [];
                $pro['name'] = $item->product->product_name_en;
                $pro['category'] = $item->product->category->category_name_en;
                $pro['id'] = $item->product_id;
                $products[] = $pro;
            }

            $data['products'] = $products; 
            array_push($result, $data); 
        }
        return response()->json($result);
    }



    public function create()
    {

        return view('pages.form');
    }
    
    public function autocomplete()
    {

        return view('pages.autocomplete');
    }

    public function autocompleteGroups()
    {

        return view('pages.autocomplete_group');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'title'             => 'required|string|unique:pages',
            'excerpt'           => 'required',
            'body'              => 'required',
            'meta_description'  => 'string',
            'meta_keywords.*'   => 'string',
            'image'             => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);
        $page   = Page::create([
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'excerpt'           => $request->excerpt,
            'body'              => $request->body,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
            'status'            => $request->filled('status'),
        ]);
        $file = $request->hasFile('image');
        if ($file) {
            $page->image        = $this->uploadeImage($request);
            $page->save();
        }
        return redirect()->route('admin.pages')->withSuccess(__('Page Successfully Added.'));
    }


    public function edit(Page $page)
    {

        return view('pages.form', compact('page'));
    }


    public function update(Request $request, Page $page)
    {
      //  print_r( $request ); die();
        $this->validate($request, [
            'title'             => 'required|string|unique:pages,title,' . $page->id,
            'excerpt'           => 'required',
            'body'              => 'required',
            'meta_description'  => 'string',
            'meta_keywords.*'   => 'string',
            'image'             => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);
        $page->update([
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'excerpt'           => $request->excerpt,
            'body'              => $request->body,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
            'status'            => $request->filled('status'),
        ]);
        // upload images
        $file                   = $request->hasFile('image');
     
        if ($file) {
            if (file_exists($page->image)) {
                unlink($page->image);
            }
            $page->image        = $this->uploadeImage($request);
            $page->save();
        }
       // toastr()->success('Page Successfully Update.', 'Updated');
        return redirect()->route('admin.pages')->withSuccess(__('Page Successfully Update.'));
    }


    public function destroy(Page $page)
    {
        $page->delete();
        //toastr()->success('Page Successfully Deleted.', 'Deleted');
        return back();
    }
    //Image intervetion
    protected function uploadeImage($request)
    {
        $file           = $request->file("image");
        $get_imageName  =  date('mdYHis') . uniqid() . $file->getClientOriginalName();
        $directory      = 'images/pages/';
        $imageUrl       = $directory . $get_imageName;
        Image::make($file)->resize(700, 400)->save($imageUrl);
        return $imageUrl;
    }
}
