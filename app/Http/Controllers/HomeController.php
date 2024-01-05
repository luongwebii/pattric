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
       
        $body = $this->display_product($page->body);
        $categories =  Category::whereHas('products', function($query) {
            $query->where('featured', 1);
         })->get();

         $products = Product::where('featured', 1)->get();
     
       return view('home.index', [
        'products'=> $products, 
        'page'=> $page, 
        'body'=> $body, 
       ]);
    }

    public function get_product($id) {
        $product = Product::find($id);
        $contentget = '
        <form class="form-inline">
         
          <div class="form-check form-check-inline product-qty-box">
            <label id="product-name">'.$product->product_name_en.':&nbsp;</label>
            <span>qty.</span>
            <div class="form-group qty-input">
                <input type="hidden" name="productId" id="productId" value="'.$id.'"/>
                <input type="text" id="qty" name="qty" value="1" class="form-control">
            </div>
            <a href="javascript:void(0);"  onclick="addToCart(this)" class="primary-btn ccc">Add to cart</a>
           
          </div>
        </form>';
      
        return  $contentget;
    }
    
    public function display_product($text) {
        $feature = '';
        $products = Product::where('featured', 1)->get();

        foreach ($products as $product){ 
            $url = route('category.front.list', $product->category_id);
            $image =  url($product->image ? $product->image : 'assets/img/no-image.jpg');
            $feature .= '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">';
            $feature .= '<div class="page-featured-product-box">';
            $feature .= '    <a href="'.$url.'"></a>';
            $feature .= '    <div class="page-featured-product-img">';
            $feature .= '        <img src="'.$image.'" alt="sub-category-1"';
            $feature .= '            class="img-fluid">';
            $feature .= '    </div>';
            $feature .= '    <h5>'.$product->product_name_en.'</h5>';
            $feature .= ' </div>';
            $feature .= '</div>';

    }

        $body = str_replace("[Featured Products]", $feature, $text);
       return $body;
    }
}
