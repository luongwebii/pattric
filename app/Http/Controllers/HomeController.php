<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use Cart;
class HomeController extends Controller
{
    //
    public function index()
    {
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
       // $t = Cart::content();print_r($t );
    //   $categories = Category::orderBy('category_name_en', 'ASC')->get();
/*
       $data = Category::whereHas('products', fn($q) => $q->where('featured', 1))
    ->with(['child' => fn($q) => $q->where('column', 1)])
    ->get();
*/ 
        $page = Page::where('is_home', 1)->first();
        if($page == null){
            $page = new Page();
        }
       
       
        $categories =  Category::whereHas('products', function($query) {
            $query->where('featured', 1);
         })->get();

         $products = Product::where('featured', 1)->get();
     
       return view('home.index', [
        'products'=> $products, 
        'page'=> $page, 
       ]);
    }
}
