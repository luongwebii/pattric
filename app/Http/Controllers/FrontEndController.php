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
                    ->paginate(1);

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
        if (Auth::check()) {

            $carts = Cart::content();
            $cart_qty = Cart::count();
            $cart_total = Cart::total();
            $subtotal = Cart::subtotal();
            $tax = Cart::tax();
            $user_id = Auth::user()->id;
            $userProfile = UserProfile::where('user_id', '=', $user_id)->first();
         
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
        } else {
            $notification = [
                'message' => 'You need to Login First for Checkout',
                'alert-type' => 'error'
            ];
            return redirect()->route('user.login')->with($notification);
        }
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
      
      
        $pages = Page::where('is_home', '!=', 1)->orderBy('title', 'ASC')->get();
        
        return view('front.search', [
            'pages'=> $pages,
        ]);
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
