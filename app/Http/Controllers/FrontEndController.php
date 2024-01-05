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
use App\Models\Menu;
use Cart;
use Helper;
use CountryState;

class FrontEndController extends Controller
{
    public $jumTo = '';
    public function __construct()
    {  
        $jum_menus =  Menu::where('title', 'like', '%jum%')->orderBy('title' ,'asc')->get();
      
        $heardTxt = '
        <div class="product-category-search-box">
        <span>Jump to </span>
        
        <div class="form-group product-category-section">
             
             <div class="select-dropdown">
             <select class="form-select" aria-label="Default select example" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                   <option value="">Select Option</option>';
        foreach($jum_menus as  $menuDataValueLeft){
            $jum_childs =  Menu::where('parent_id', '=', $menuDataValueLeft->id)->orderBy('title' ,'asc')->get();
           

            foreach ($jum_childs as $menuDataValue){
                $heardTxt .= " <option value='{$menuDataValue->url}'>{$menuDataValue->title} </option>";
                if(isset($menuDataValue->childs)){
                    $heardTxt .= $this->menuQ($menuDataValue->childs);
                }
            }
           
        }
        $heardTxt .= '</select>
		</div>
        </div>
	 </div>';
    //var_dump($heardTxt) ;die();
     $this->jumTo =$heardTxt;
       
    }

    public function menuQ($menuDataValueLeft){//echo '<pre>';
        $heardTxt = '';
       
        foreach($menuDataValueLeft as $child){
            $heardTxt .= " <option value='{$child->url}'>{$child->title}</option>";
            if(isset($child->childs)){
                $this->menuQ($child->childs);
            }
        }
       
        return $heardTxt;

    }
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

        $body = str_replace("[JUMP_TO]", $this->jumTo, $page->body);
        $body = $this->display_product($body);
        $body = $this->display_group($body);

        return view('front.page', [
            'page' => $page,
            'pages'=> $pages,
            'body'=> $body
        ]);
    }

    public function get_product($id) {
        $product = Product::find($id);

        $outofstock = '<span>qty.</span>
        <div class="form-group qty-input">
            <input type="hidden" name="productId" id="productId" value="'.$id.'"/>
            <input type="text" id="qty" name="qty" value="1" class="form-control">
        </div>
        <a href="javascript:void(0);"  onclick="addToCart(this)" class="primary-btn ccc">Add to cart</a>';
        if($product->product_qty <= 0) {
            $outofstock = '
            <span>out of stock</span>
            ';
        }
        $contentget = '
        <form class="form-inline">
         
          <div class="form-check form-check-inline product-qty-box">
            <label id="product-name">'.$product->product_name_en.':&nbsp;</label>
            '.$outofstock.'
           
          </div>
        </form>';
      
        return  $contentget;
    }
    
    public function display_product($text) {
       return preg_replace_callback(
                  '/\[PRODUCT ID=(\d+)]/',
                  function($m) {
                      return $this->get_product($m[1]);
                  },
                  $text
              );
    }

    public function get_group($id) {
        $group = ProductGroup::find($id);


        $contentget = ' <form>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <h2  id="product-name">'.$group->product_group_name.'</h2>
            </div>
        </div>
        <section id="examples" class="order-form-product-list-table ">
            <!-- content -->
            <div id="content-8" class="content">

                <table class="table  table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Model</th>
                            <th scope="col">Price</th>
                            <th scope="col">buy qty.</th>
                            <th scope="col">drawing</th>
                            <th scope="col">orient.</th>
                            <th scope="col">area SM</th>
                            <th scope="col">bottom butter.</th>
                            <th scope="col">racking butter.</th>


                        </tr>
                    </thead>
                    <tbody class="group-content">';
            $optionHtml ='';
            foreach($group->groupItems as $score){ //print_r($score);
                $drawing = $score->product->drawing === null ? "" : $score->product->drawing;
                $orient = $score->product->orient === null ? "" : $score->product->orient;
                $area_sm = $score->product->area_sm === null ? "" : $score->product->area_sm;
                $bottom_butter = $score->product->bottom_butter === null ? "" : $score->product->bottom_butter;
                $racking_butter = $score->product->racking_butter === null ? "" : $score->product->racking_butter;

                $outofstock = 'name="qtys[]" value="1"';
                if($score->product->product_qty <=0) {
                    $outofstock = 'name="qtys[]" value="0" disabled ';
                }
                $optionHtml .= "<tr>";
                $optionHtml .= '
                    <td>'.$score->product->model.'</td>
                    <td>$'. Helper::format_numbers_2($score->product->price).'</td>
                    <td>
                        <div class="form-group qty-input">
                        <input type="hidden" name="productIds[]" value="'.$score->product->id.'" id="productId"/>
                            <input type="text" class="form-control	" '.$outofstock.' placeholder="0" id="qty">
                        </div>
                    </td>
                    <td class="dra-link">'.$drawing.'</td>
                    <td>'.$orient.'</td>
                    <td>'.$area_sm.'</td>
                    <td>'.$bottom_butter.'</td>
                    <td>'.$racking_butter.'</td>

                      ';
                    $optionHtml .= "</tr>";

            }
        $contentget .= $optionHtml;
        $contentget .='
                    </tbody>
                </table>
            </div>
        </section>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="add-cart-box">
                    <a href="javascript:void(0);" onclick="addToCartGroup(this)" class="primary-btn">Add to cart</a>
                </div>
            </div>
        </div>
    </form>';
      
        return  $contentget;
    }
    
    public function display_group($text) {
       return preg_replace_callback(
                  '/\[GROUP ID=(\d+)]/',
                  function($m) {
                      return $this->get_group($m[1]);
                  },
                  $text
              );
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
    public function getState(Request $request)
    {
        //
        $country = $request->input('country');

        $states = CountryState::getStates($country);
        //print_r($states);
        $txt = '';
        foreach($states as $key => $state){
            $txt .= '<option value="'.$key.'">'.$state.'</option>';
        }

        return response()->json(['result' => 'OK', 'txt' => $txt],200);
    }
    public function search(Request $request)
    {
        //
        $keyword = $request->input('name');
       // echo $keyword;
        $categoryArray = [];
        $flag = true;
        $products = Product::where('product_name_en', 'LIKE', "%$keyword%")
                    ->where('status', '=', 1)
                    ->get();
        foreach($products as $product ){
            if(!empty($product->category_id)){
                $categoryArray[$product->category_id] = $product->category->category_name_en;
                $flag = false;
            }
          
        }

        $catas = Category::where('category_name_en', 'LIKE', "%$keyword%")
                    ->where('status', '=', 1)
                    ->get();

        foreach($catas as $cata ){
            $categoryArray[$cata->id] = $cata->category_name_en;
        }

        $groups = ProductGroup::select('product_group_name', 'id')->
        where('product_group_name', 'LIKE', "%$keyword%")->
        get();

        $resultGroups = [];

        foreach( $groups as  $product){
            $resultGroups[] = $product->id;
            $data = [];
            /*
            $data['id'] = $product['id']; 
            $data['value'] = $product['product_group_name']; 
            $flag = false;
            $products = [];
            foreach($product->groupItems as $item){
                $products[] = $item->product;
            }

            $data['products'] = $products; 
            array_push($resultGroups, $data); 
            */
        }

        $pages = Page::where('is_home', '!=', 1)
        ->where('status', '=', 1)
        ->where(function ($query) use ($keyword, $resultGroups) {
            $query->where('title', 'LIKE', "%$keyword%");
            $query->orWhere('body', 'LIKE', "%$keyword%");
            $query->orWhere(function ($q) use ($resultGroups) {
                collect($resultGroups)->each(function ($keyword) use ($q) {
                  $q->orWhere('body', 'like', '%[GROUP ID='. $keyword .']%');
                });
            });

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
