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
        //php artisan storage:link
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
        $products = Product::select('product_name_en', 'id')
            ->where('status', '=', 1)
            ->where('product_name_en', 'LIKE', "%$keyword%")->get();
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
            where('status', '=', 1)->
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
                $pro['model'] = $item->product->model;
                $pro['price'] = $item->product->price;
                $pro['drawing'] = $item->product->drawing;
                $pro['orient'] = $item->product->orient;
                $pro['area_sm'] = $item->product->area_sm;
                $pro['bottom_butter'] = $item->product->bottom_butter;
                $pro['racking_butter'] = $item->product->racking_butter;

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
            'excerpt'           => 'nullable',
            'body'              => 'nullable',
            'meta_description'  => 'nullable',
            'meta_keywords.*'   => 'nullable',
            'image'             => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);
        $page   = Page::create([
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'excerpt'           => $request->excerpt,
            'body'              => $request->body,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
            'status'            => $request->status,
            'is_home'            => $request->filled('is_home'),
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
            'excerpt'           => 'nullable',
            'body'              => 'nullable',
            'meta_description'  => 'nullable',
            'meta_keywords.*'   => 'nullable',
            'image'             => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);
        $page->update([
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'excerpt'           => $request->excerpt,
            'body'              => $request->body,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
            'status'            => $request->status,
            'is_home'            => $request->filled('is_home'),
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

    public function deletePage(Request $request)
    {

        $data = $request->all();
        $id = $data['id'];

        $model = Page::find($id);
        
        $model->delete();

        // toastr()->success('Product deleted successfully');
        return redirect()->back()->withSuccess(__('Page deleted successfully.'));
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
