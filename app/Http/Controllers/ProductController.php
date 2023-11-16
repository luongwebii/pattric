<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\ProductMultiImage;
use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest('id')->with('category')->get();
        return view('product.index', compact('products'));
    }


    public function create()
    {

        $data['categories'] = Category::latest()->get();
      

        return view('product.create', $data);
    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'category_id1'                  => 'required|integer',
            'product_name_en'               => 'required|string',
            'product_qty'                   => 'required',
            'price'                         => 'required',
            'discount'                      => 'nullable',
            'model'                         => 'nullable',
            'drawing'                       => 'nullable',
            'orient'                        => 'nullable',
            'area_sm'                       => 'nullable',
            'bottom_butter'                         => 'nullable',
            'racking_butter'                         => 'nullable',
            'man_way'                         => 'nullable',
            'capacity'               => 'nullable',
            'long_description_en'           => 'required|min:3',
            'size'                          => 'nullable|string',
            'product_color'                 => 'nullable|string',
            'image'                         => 'required|image|mimes:jpg,png,jpeg,svg',
            'multiImage.*'                  => 'nullable|image|mimes:jpg,png,jpeg,svg',
            'meta_keywords_en'              => 'nullable|string',
            'meta_description_en'           => 'nullable|string',

        ]);

        $product   = Product::create([
            'category_id'                   => $request->category_id1,
            'product_name_en'               => $request->product_name_en,
            'product_slug_en'               => Str::slug($request->product_name_en),
            'product_qty'                   => $request->product_qty,
            'price'                         => $request->price,
            'drawing'                       => $request->drawing,
            'model'                         => $request->model,
            'orient'                        => $request->orient,
            'area_sm'                        => $request->area_sm,
            'bottom_butter'                        => $request->bottom_butter,
            'racking_butter'                        => $request->racking_butter,
            'capacity'                        => $request->capacity,
            'long_description_en'           => $request->long_description_en,
            'long_description_en'           => $request->long_description_en,
            'size'                          => $request->size,
            'product_color'                 => $request->product_color,
            'meta_keywords_en'              => $request->meta_keywords_en,
            'meta_description_en'           => $request->meta_description_en,
            'featured'                      => $request->filled('featured'),
            'status'                        => $request->filled('status'),
        ]);
       // $product->product_code = $this->generateProductCode($product->id);
        $file                               = $request->hasFile('image');
        if ($file) {
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            $product->image                 = $this->uploadeImage($request);
        }
        $product->save();

        $images = $request->file('multi_img');
        if ($images) {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(700, 600)->save('images/products/multi-image/' . $make_name);
                $uploadPath = 'images/products/multi-image/' . $make_name;
                ProductMultiImage::insert([
                    'product_id' => $product->id,
                    'image_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('admin.product')->withSuccess(__('Product added Successfully.'));
    }


    public function show(Product $product)
    {

       return view('product.deatails',compact('product'));
    }

    public function edit(Product $product)
    {
        $data['categories'] = Category::latest('id')->get();
        $data['product']   = $product;
        return view('product.edit', $data);
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'category_id1'                  => 'required|integer',
            'product_name_en'               => 'required|string',
            'product_qty'                   => 'required',
            'price'                         => 'required',
            'discount'                      => 'nullable',
            'model'                         => 'nullable',
            'drawing'                       => 'nullable',
            'orient'                        => 'nullable',
            'area_sm'                       => 'nullable',
            'bottom_butter'                         => 'nullable',
            'racking_butter'                         => 'nullable',
            'man_way'                         => 'nullable',
            'capacity'               => 'nullable',
            'long_description_en'           => 'nullable',
            'size'                          => 'nullable|string',
            'product_color'                 => 'nullable|string',
          //  'image'                         => 'required|image|mimes:jpg,png,jpeg,svg',
            'multiImage.*'                  => 'nullable|image|mimes:jpg,png,jpeg,svg',
            'meta_keywords_en'              => 'nullable|string',
            'meta_description_en'           => 'nullable|string',
        ]);
        $product->update([
            'category_id'                   => $request->category_id1,
            'product_name_en'               => $request->product_name_en,
            'product_slug_en'               => Str::slug($request->product_name_en),
            'product_qty'                   => $request->product_qty,
            'price'                         => $request->price,
            'drawing'                       => $request->drawing,
            'model'                         => $request->model,
            'orient'                        => $request->orient,
            'area_sm'                        => $request->area_sm,
            'man_way'                        => $request->man_way,
            'bottom_butter'                        => $request->bottom_butter,
            'racking_butter'                        => $request->racking_butter,
            'capacity'                        => $request->capacity,
            'long_description_en'           => $request->long_description_en,
            'long_description_en'           => $request->long_description_en,
            'size'                          => $request->size,
            'product_color'                 => $request->product_color,
            'meta_keywords_en'              => $request->meta_keywords_en,
            'meta_description_en'           => $request->meta_description_en,
            'featured'                      => $request->filled('featured'),
            'status'                        => $request->filled('status'),
        ]);

        $file                               = $request->hasFile('image');
        if ($file) {
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            $product->image                 = $this->uploadeImage($request);
        }
        $product->save();

      //  toastr()->success('Product Updated successfully');
        return redirect()->route('admin.product')->withSuccess(__('Product Updated Successfully.'));
    }


    public function destroy(Product $product)
    {

        if (file_exists($product->image)) {
            unlink($product->image);
        }

        $images = ProductMultiImage::where('product_id', $product->id)->get();
        foreach ($images as $img) {
            if (file_exists($img->image_name)) {
                unlink($img->image_name);
            }

            ProductMultiImage::where('product_id', $product->id)->delete();
        }
        $product->delete();

       // toastr()->success('Product deleted successfully');
        return redirect()->back()->withSuccess(__('Product deleted Successfully.'));
    }



    // Multi Image
    public function updateMultiImage($id)
    {
        $multiImages = ProductMultiImage::where('product_id', $id)->get();
        return view('product.editMultiImage', compact('multiImages', 'id'));
    }
    public function updateMultiImageUpdate(Request $request)
    {

        $imgs = $request->multi_img;
        if ($imgs) {
            foreach ($imgs as $id => $img) {
                $imgDel = ProductMultiImage::findOrFail($id);
                if (file_exists($imgDel->image_name)) {
                    unlink($imgDel->image_name);
                }

                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(700, 600)->save('images/products/multi-image/' . $make_name);
                $uploadPath = 'images/products/multi-image/' . $make_name;

                ProductMultiImage::where('id', $id)->update([
                    'image_name' => $uploadPath,
                    'updated_at' => Carbon::now(),

                ]);
            }
           // toastr()->success('Product Multi image updated successfully');
           return redirect()->back()->withSuccess(__('Product Multi image Updated Successfully.'));
        } else {
            //toastr()->error('Select image first');
            return redirect()->back()->withErrors(__('Select image first.'));
        }
       
    }
    public function updateMultiImageDelete($id)
    {
        $oldimg = ProductMultiImage::findOrFail($id);
        if (file_exists($oldimg->image_name)) {
            unlink($oldimg->image_name);
        }
        $oldimg->delete();
       // toastr()->success('Image deleted successfully');
        return redirect()->back()->withSuccess(__('Image deleted Successfully.'));
    }

    public function updateMultiImageStore(Request $request)
    {
        $images = $request->file('multi_img');
        if ($images) {
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(700, 600)->save('images/products/multi-image/' . $make_name);
                $uploadPath = 'images/products/multi-image/' . $make_name;
                ProductMultiImage::insert([
                    'product_id' => $request->id,
                    'image_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
      //  toastr()->success('Product added successfully');
        return redirect()->back()->withSuccess(__('Product added Successfully.'));
    }
    // End Multi Image


    //Stock
    public function updateStock($id)
    {
        $product = Product::findOrFail($id);
        return view('product.stock', compact('product'));
    }
    public function updateStockUpdate(Request $request)
    {

        $product = Product::findOrFail($request->id);
        $product->update([
            'product_qty'                => $request->product_qty,
        ]);
      //  toastr()->success('Product stock updated successfully');
        return redirect()->back()->withSuccess(__('Product stock updated successfully.'));
    }



    // Get Data By ajax
    public function category(Request $request)
    {
        if ($request->ajax()) {
            $categorywithSubcategory = Category::where('id', $request->category_id1)->with(['subcategories'])->first();
            return view('product.subcategory', compact('categorywithSubcategory'));
        }
    }
    public function subcategory(Request $request)
    {
        if ($request->ajax()) {
            $categorywithSubSubcategory = SubCategory::where('id', $request->subcategory_id)->with(['subsubcategories'])->first();
            return view('product.subsubcategory', compact('categorywithSubSubcategory'));
        }
    }

    //Update status
    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = false;
            } else {
                $status = true;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }


    // Code Generator
    protected function generateProductCode($id)
    {
        return 'ABC-' . str_pad($id, 5, "0", STR_PAD_LEFT);
    }

    //Image intervetion
    protected function uploadeImage($request)
    {
        $file           = $request->file("image");
		var_dump( $file  );
        $get_imageName  =  date('mdYHis') . uniqid() . $file->getClientOriginalName();
        $directory      = 'images/products/thambnails/';
        $imageUrl       = $directory . $get_imageName;
		
        Image::make($file)->resize(700, 600)->save($imageUrl);
	
        return $imageUrl;
    }

    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}
