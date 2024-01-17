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
use App\Models\ProductGroupItem;
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
        $jum_menus =  Menu::where('title', 'like', '%jum%')->orderBy('icon', 'ASC')->get();
      
        $heardTxt = '
        <div class="product-category-search-box">
        <span>Jump to </span>
        
        <div class="form-group product-category-section">
             
             <div class="select-dropdown">
             <select class="form-select" aria-label="Default select example" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                   <option value="">Select Option</option>';
        foreach($jum_menus as  $menuDataValueLeft){
            $jum_childs =  Menu::where('parent_id', '=', $menuDataValueLeft->id)->orderBy('icon', 'ASC')->get();
           

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

        
        $outofstock = '<span>qty: </span>
        <div class="form-group qty-input">
            <input type="hidden" name="productId" id="productId" value="'.$id.'"/>
            <input type="number" id="qty" name="qty" value="1" class="form-control">
        </div>
        <a href="javascript:void(0);"  onclick="addToCart(this)" class="primary-btn ccc group-pro">Add to cart</a>';
        if($product->product_qty <= 0) {
            $outofstock = '
            <span>out of stock</span>
            ';
        }
    
        $url = $product->image ? url($product->image) : '';
        $img = '';
        if(!empty($url)){
            $img .= '<div class="product-img-box"><img src="'.$url.'" alt="swivelWheels-img" class="img-fluid"></div>';
        }

        $price = '';
        if(!empty($product->sale_price)){
        
            $price .= '<div  style="padding:5px;"><div class="text-deco">$' . Helper::format_numbers($product->price) . '</div>';
            $price .= '<div>$' . Helper::format_numbers($product->sale_price). '</div></div>';
        } else {
            $price .= '<div>$' . Helper::format_numbers($product->price) . '</div>';
        }

       


        $contentget = '
        <form class="form-inline">
         
          <div class="form-check form-check-inline product-qty-box">
            '.$img.'
            <label id="product-name" style="padding-left:5px;">&nbsp;'.$product->product_name_en.'&nbsp;</label>
            &nbsp; <span>Price:</span> '.$price.'&nbsp;&nbsp;'.$outofstock.'
           
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
        $img = '';
        $url = $group->image ? url($group->image) : '';
        if(!empty($url)){
          //  $img .= '<div class="product-img-box"><img src="'.$url.'" alt="swivelWheels-img" class="img-fluid"></div>';
        }
        $sizeFlag = true;
        $drawingFlag = true;
        $orientFlag = true;
        $areaFlag = true;
        $bottomFlag = true;
        $rackingFlag = true;
     

        $contentget = ' <form>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <h2  id="product-name">'.$group->product_group_name.'</h2>
                <div class="product-deatils-box"> '.$img. '<div class="product-text-box">'.$group->description.'</div></div>
            </div>
        </div>
        <section id="examples" class="order-form-product-list-table ">
            <!-- content -->
            <div id="content-8" class="content">

                <table class="table  table-responsive">
                    <thead class="thead-dark">
                        <tr>';
            if($group->image_flag) {
                $contentget .= ' <th scope="col"></th>';
            }
            $contentget .= '<th scope="col">Model</th>
                <th scope="col">Price</th>
                <th scope="col">buy qty.</th>';

            if($group->size_flag) {
                $contentget .= ' <th scope="col">Size</th>';
            }
            if($group->capacity_flag) {
                $contentget .= ' <th scope="col">Capacity'.$group->capacity_flag.'</th>';
            }
            if($group->drawing_flag) {
                $contentget .= ' <th scope="col">drawing</th>';
            }
           
            if($group->orient_flag) {
                $contentget .= ' <th scope="col">orient</th>';
            }
            if($group->area_sm_flag) {
                $contentget .= ' <th scope="col">AreaSM</th>';
            }
            if($group->bottom_flag) {
                $contentget .= ' <th scope="col">bottom butter.</th>';
            }
            if($group->racking_flag) {
                $contentget .= ' <th scope="col">racking butter.</th>';
            }
            if($group->man_way_flag) {
                $contentget .= ' <th scope="col">Man Way</th>';
            }
           
        
            $contentget .= '
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
                $size = $score->product->size === null ? "" : $score->product->size;
                $man_way = $score->product->man_way === null ? "" : $score->product->man_way;
                $capacity = $score->product->capacity === null ? "" : $score->product->capacity;
                $url = $score->product->image ? url($score->product->image) : '';
                $image = '';
                if(!empty($url)){
                    $image = '<div class="product-img-box"><img src="'.$url.'" alt="swivelWheels-img" class="img-fluid"></div>';
                }
               

                $outofstock = 'name="qtys[]" value="0"';
                if($score->product->product_qty <=0) {
                    $outofstock = 'name="qtys[]" value="0" disabled ';
                }
                $optionHtml .= "<tr>";

                $price = '';
                if(!empty($score->product->sale_price)){
                
                    $price .= '<div class="text-deco">$' . Helper::format_numbers($score->product->price) . '</div>';
                    $price .= '<div>$' . Helper::format_numbers($score->product->sale_price). '</div>';
                } else {
                    $price .= '<div>$' . Helper::format_numbers($score->product->price) . '</div>';
                }

                if($group->image_flag) {
                    $optionHtml .= ' <td >'.$image.'</td>';
                }

                $optionHtml .= '
                    <td>'.$score->product->model.'</td>
                    <td>'. $price.'</td>
                    <td>
                        <div class="form-group qty-input">
                        <input type="hidden" name="productIds[]" value="'.$score->product->id.'" id="productId"/>
                            <input type="number" class="form-control	" '.$outofstock.' placeholder="0" id="qty">
                        </div>
                    </td>';

                    if($group->size_flag) {
                        $optionHtml .= ' <td >'.$size.'</td>';
                    }
                    if($group->capacity_flag) {
                        $optionHtml .= '<td>'.$capacity.'</td>';
                    }

                    if($group->drawing_flag) {
                        $optionHtml .= ' <td>'.$drawing.'</td>';
                    }
                    if($group->orient_flag) {
                        $optionHtml .= '<td>'.$orient.'</td>';
                    }
                    if($group->bottom_flag) {
                        $optionHtml .= ' <td>'.$area_sm.'</td>';
                    }
                    if($group->racking_flag) {
                        $optionHtml .= '<td>'.$bottom_butter.'</td>';
                    }
                    if($group->racking_flag) {
                        $optionHtml .= '<td>'.$racking_butter.'</td>';
                    }
                    if($group->man_way_flag) {
                        $optionHtml .= '<td>'.$man_way.'</td>';
                    }
                   
                    
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

            $freight_only = 0;
            foreach($carts as $cart){//print_r( $cart);
                $freight_only = $cart->options->freight_only;
                if($freight_only) {
                    break;
                }
            }

            if(empty($freight_only)) {
                $freight_only = 0;
            }

            $states = CountryState::getStates('US');
            //print_r($states);
            $txt = '';
            foreach($states as $key => $state){
                $txt .= '<option value="'.$key.'">'.$state.'</option>';
            }

           // echo $freight_only; die();
            return view('front.shopping_cart_page', [
                'carts' => $carts,
                'cart_qty' => $cart_qty,
                'cart_total' => $cart_total,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'txt' => $txt,
                'userProfile' => $userProfile,
                'freight_only' => $freight_only,
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
        $products = Product::where(function ($query) use ($keyword) {
            $query->where('product_name_en', 'LIKE', "%$keyword%")
                  ->orWhere('model', 'LIKE', "%$keyword%");
                    })
                    ->where('status', '=', 1)
                    ->get();
        $productIdArray = [];
        foreach($products as $product ){
            $productIdArray[] = $product->id;
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

        $groups = ProductGroup::select('product_group_name', 'id')
        ->where(function ($query) use ($keyword) {
            $query->where('product_group_name', 'LIKE', "%$keyword%")
                  ->orWhere('description', 'LIKE', "%$keyword%");
                    })
        ->where('status', '=', 1)
        ->get();

        $resultGroups = [];

        foreach( $groups as  $group){
            $resultGroups[] = $group->id;
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
      //  print_r($productIdArray);
        $productGroupObj = ProductGroupItem::whereIn('product_id', $productIdArray)->get();
        foreach($productGroupObj as $productGroupValue){
            $resultGroups[] = $productGroupValue->product_group_id; 
        }

        $resultGroups = array_unique($resultGroups); 
      
        $pages = Page::where('is_home', '!=', 1)
        ->where('status', '=', 1)
        ->where(function ($query) use ($keyword, $resultGroups, $productIdArray) {
            $query->where('title', 'LIKE', "%$keyword%");
            $query->orWhere('body', 'LIKE', "%$keyword%");
            $query->orWhere(function ($q) use ($resultGroups) {
                collect($resultGroups)->each(function ($keyword) use ($q) {
                  $q->orWhere('body', 'like', '%[GROUP ID='. $keyword .']%');
                });
            });
            $query->orWhere(function ($q) use ($productIdArray) {
                collect($productIdArray)->each(function ($productId) use ($q) {
                  $q->orWhere('body', 'like', '%[PRODUCT ID='. $productId .']%');
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
