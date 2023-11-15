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
       $categories = Category::orderBy('category_name_en', 'ASC')->get();
   
       return view('home.index',compact('categories'));
    }
}
