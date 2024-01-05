<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGroupItem;
use App\Models\ProductGroup;
use Intervention\Image\Facades\Image;

class ProductGroupController extends Controller
{
    public function index()
    {

        $groupProducts = ProductGroup::latest('id')->get();
        return view('groupproduct.index', compact('groupProducts'));
    }


    public function create()
    {

        return view('groupproduct.form');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'product_group_name'      => 'required',
            'description'   => 'nullable',
            'image'                 => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);
        $groupProductData = $request->post(); // DI
       // print_r($groupProductData); die();
        $groupProduct = ProductGroup::create([
            'product_group_name'      => $request->product_group_name,
            'description'      => $request->description,
            'status'                => $request->status,
        ]);
        $product_group_id =  $groupProduct->id;
      
        $file                   = $request->hasFile('image');
        if ($file) {
            if (file_exists($groupProduct->image)) {
                unlink($groupProduct->image);
            }
            $groupProduct->image = $this->uploadeImage($request);
        }
        $groupProduct->save();

        $this->updateProductGroup($groupProductData, $product_group_id);


        return redirect()->route('admin.groupProduct')->withSuccess(__('Category added successfully.'));
    }

    public function updateProductGroup($groupProductData, $product_group_id)
    {
        //print_r($groupProductData); die();
        if(isset($groupProductData['productIds'])) {
            $productIds =  $groupProductData['productIds'];
            $productIdArray = [];
            foreach ($productIds as  $key => $productId) {
                //  print_r($question); die();
                // Create a new question
                if (!empty($productId)) {
                    $productIdArray[] = $productId;
                    $id = $groupProductData['productGroupIds'][$key];

                    if (!empty($id)) {
                        $item = ProductGroupItem::find($id);
                        $item->product_group_id = $product_group_id;
                        $item->product_id = $productId;
                        $item->save();
                    } else {
                        ProductGroupItem::create([
                            'product_group_id'      => $product_group_id,
                            'product_id'           => $productId
                        ]);

                    
                    }
                }
            }

            // delete remove question
            if (!empty($productIdArray)) {
                ProductGroupItem::where('product_group_id', '=', $product_group_id)->whereNotIn('product_id', $productIdArray)->delete();
            }
        }
    }



    public function edit(ProductGroup $groupProduct)
    {
       // print_r($groupProduct->groupItems);

        return view('groupproduct.form', compact('groupProduct'));
    }



    public function update(Request $request, ProductGroup $groupProduct)
    {
        $this->validate($request, [
            'product_group_name'      => 'required',
            'description'   => 'nullable',
            'image'                 => 'nullable|image|mimes:jpg,png,jpeg,svg',
        ]);

        $groupProduct->update([
            'product_group_name'      => $request->product_group_name,
            'description'      => $request->description,
            'status'             => $request->status,
        ]);
        $file                    = $request->hasFile('image');
        if ($file) {
            if (file_exists($groupProduct->image)) {
                unlink($groupProduct->image);
            }
            $groupProduct->image = $this->uploadeImage($request);
        }
        $groupProduct->save();
        $groupProductData = $request->post(); // DI
        $this->updateProductGroup($groupProductData, $groupProduct->id);

        return redirect()->route('admin.groupProduct')->withSuccess(__('Category update successfully.'));
    }


    public function destroy(ProductGroup $groupProduct)
    {

        if (file_exists($groupProduct->image)) {
            unlink($groupProduct->image);
        }
        $groupProduct->delete();

        return redirect()->route('admin.groupProduct')->withSuccess(__('Category deleted successfully.'));
    }

    public function deleteGroupProduct(Request $request)
    {

        $data = $request->all();
        $id = $data['id'];

        $model = ProductGroup::find($id);
        
        $model->delete();

        // toastr()->success('Product deleted successfully');
        return redirect()->back()->withSuccess(__('Product Group deleted successfully.'));
    }

    //Image intervetion
    protected function uploadeImage($request)
    {
        $file           = $request->file("image");
        $get_imageName  =  date('mdYHis') . uniqid() . $file->getClientOriginalName();
        $directory      = 'images/groupproduct/';
        $imageUrl       = $directory . $get_imageName;
        Image::make($file)->resize(600, 400)->save($imageUrl);
        return $imageUrl;
    }

    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}
