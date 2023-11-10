<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use Cart;
class HomeController extends Controller
{
    //
    public function index()
    {
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
       // $t = Cart::content();print_r($t );
       $categories = Category::with(['subcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
       foreach( $categories as  $category){
       // echo '<pre>';
      //      print_r($category->products);
       }
     //  die();
       return view('home.index',compact('categories'));
    }
}
