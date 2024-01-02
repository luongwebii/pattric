<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Category;
use App\Models\UserProfile;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\Page;
use Cart;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showPage($id)
    {
        //
        $page = Page::find($id);
        $pages = Page::where('is_home', '!=', 1)->orderBy('title', 'ASC')->get();
        
        return view('front.page', [
            'page' => $page,
            'pages'=> $pages
        ]);
    }

    public function listProductCategory($id)
    {
        //
        $pages = Page::where('is_home', '!=', 1)->orderBy('title', 'ASC')->get();
        $categories = Category::find($id);

        $products = Product::where('category_id', '=', $id)
                    ->where('status', '=', 1)
                    ->paginate(25);

        return view('front.list_pro', [
            'categories' => $categories,
            'products' => $products,
            'pages' => $pages
        ]);
    }

    public function loadMoreAjax($id, Request $request)
    {
        //
        $offset = $request->input('offset'); 
        $limit = $request->input('limit'); 
 
        
        
        $categories = Category::find($id);

        $products = Product::where('category_id', '=', $id)
                    ->where('status', '=', 1)
                    ->skip($offset)->take($limit)->get(); 

        return response()->json($products); 
    }




    public function shoppingCartPage()
    {
      //  if (Auth::check()) {

            $carts = Cart::content();
            $cart_qty = Cart::count();
            $cart_total = Cart::total();
            $subtotal = Cart::subtotal();
            $tax = Cart::tax();
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $userProfile = UserProfile::where('user_id', '=', $user_id)->first();
            }
            if (empty($userProfile)) {
                $userProfile = new UserProfile;
            }


            return view('front.shopping_cart_page', [
                'carts' => $carts,
                'cart_qty' => $cart_qty,
                'cart_total' => $cart_total,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'userProfile' => $userProfile,
            ]);
       /* } else {
           $notification = [
                'message' => 'You need to Login First for Checkout',
                'alert-type' => 'error'
            ];
            return redirect()->route('user.login')->with($notification);
        }
        */
    }

    public function showAllCategory()
    {
        //
        $pages = Page::where('is_home', '!=', 1)->orderBy('title', 'ASC')->get();
        $categories = Category::get();
        return view('front.list_all_pro', [
            'categories' => $categories,
            'pages' => $pages
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        //
        $keyword = $request->input('name');
       // echo $keyword;
        $categoryArray = [];
        $flag = true;
        $products = Product::where('product_name_en', 'LIKE', "%$keyword%")->get();
        foreach($products as $product ){
            if(!empty($product->category_id)){
                $categoryArray[$product->category->category_name_en][] = $product;
                $flag = false;
            }
          
        }

        $groups = Product::select('product_name_en', 'id')->where('product_name_en', 'LIKE', "%$keyword%")->get();

       

        $groups = ProductGroup::select('product_group_name', 'id')->
        where('product_group_name', 'LIKE', "%$keyword%")->
        get();

        $resultGroups = [];
        foreach( $groups as  $product){
            $data = [];
            $data['id'] = $product['id']; 
            $data['value'] = $product['product_group_name']; 
            $flag = false;
            $products = [];
            foreach($product->groupItems as $item){
                $products[] = $item->product;
            }

            $data['products'] = $products; 
            array_push($resultGroups, $data); 
        }

        $pages = Page::where('is_home', '!=', 1)
        ->where(function ($query) use ($keyword) {
            $query->where('title', 'LIKE', "%$keyword%");
            $query->orWhere('body', 'LIKE', "%$keyword%");

        })
        ->orderBy('title', 'ASC')->get();

        if($pages->count() > 0) {
            $flag = false;
        }

        
        return view('front.search', [
            'pages'=> $pages,
            'categoryArray'=> $categoryArray,
            'resultGroups'=> $resultGroups,
            'pages'=> $pages,
            'flag'=> $flag,
        ]);
    }


    public function searchAutocomplete(Request $request)
    {
        $keyword = $request->input('term');
        $products = Product::select('product_name_en', 'id')->where('product_name_en', 'LIKE', "%$keyword%")->get();
        $result = [];
        foreach( $products as  $product){
            $data = [];
            $data['id'] = $product['id']; 
            $data['value'] = $product['product_name_en']; 
            $data['value'] = $product['product_name_en']; 
            array_push($result, $data); 
        }
        return response()->json($result);

    }



    public function register()
    {
       $user = User::create([
            'first_name' => "Test",
            'last_name' => "Test",
            'role' => "admin",
            'email' => 'luong@webii.net',
            'password' => bcrypt('123456'),
        ]);
      
       die();
    }
}
