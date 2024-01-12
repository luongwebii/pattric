<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Option;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    

    public function addToCartGroup(Request $request)//, $id
    {
        
        
        $input = $request->all();

        $productIds = $input['productIds'];
        $qtys = $input['qtys'];
        foreach($productIds as $key => $productId){
            if(!empty($productId)) {
                if(isset($qtys[$key])) {
                    $qty = $qtys[$key];

                    if(!empty($qty)) {
                        $product = Product::findOrFail($productId);
                        Cart::add([
                            'id' => $productId,
                            'name' => $product->product_name_en,
                            'qty' => $qty,
                            'price' => $product->price,
                            'weight' => 1,
                            'options' => [
                                'image' => $product->image,
                                'freight_only' => $product->freight_only
                                ]
                        ]);
            
                    }

                }

            }
        }
       
        return response()->json(['success' => 'Successfully added on your cart'],200);

       
       
    }
    
    public function saveShipping(Request $request)//, $id
    {
        $this->validate($request, [
           
            'shipping_street'   => 'required',
          //  'shipping_suite'   => 'required',
            'shipping_city'   => 'required',
            'shipping_state'   => 'required',
          //  'shipping_zip'   => 'required',
            'shipping_package'   => 'required',
            'shipping_country'   => 'required',

        ]);

        $state = $request->shipping_state;
        $country = $request->shipping_country;
        if($state == 'TX' && $country == 'US'){
            $option = Option::first();
            Cart::setGlobalTax($option->value);
        } else {
            Cart::setGlobalTax(0);
        }

        $sub_total = Cart::subtotal();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();
        $tax = Cart::tax();
        return response()->json([
            'success' => 'Successfully added on your cart', 
            'tax' => $tax,
            'shipping_package' => $request->shipping_package,
            'sub_total' => $sub_total,
            'cart_qty' => $cart_qty,
            'cart_total' => $cart_total,],200);
    }

    public function addToCart(Request $request)//, $id
    {
        $input = $request->all();
        if(empty($input['productId'])) {
            return response()->json(['error' => 'Product not found'],200);
        }

        if(empty($input['qty'])) {
            return response()->json(['error' => 'Qty is empty'],200);
        }

        $product = Product::findOrFail($input['productId']);
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $price = $product->price;
        if(!empty($product->sale_price)){
            $price = $product->sale_price;
        }
      
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $input['productId'],
                'name' => $product->product_name_en,
                'qty' => $request->qty,
                'price' => $price,
                'weight' => 1,
                'options' => [
                    'image' => $product->image,
                    'freight_only' => $product->freight_only
                    ]
            ]);

            return response()->json(['success' => 'Successfully added on your cart'],200);
        }else{
            Cart::add([
                'id' => $input['productId'],
                'name' => $product->product_name_en,
                'qty' => $request->qty,
                'price' => $product->price,
                'weight' => 1,
                'options' => [
                    'image' => $product->image,
                    'freight_only' => $product->freight_only
                    ]
            ]);
           
            return response()->json(['success' => 'Successfully added on your cart'],200);
        }
    }

    public function getMiniCart()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        $freight_only = 0;
        foreach($carts as $cart){//print_r( $cart);
            $freight_only = $cart->options->freight_only;
            if($freight_only) {
                break;
            }
        }

        return response()->json([
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => $cart_total,
            'freight_only' => $freight_only,
        ], 200);
    }
    
    public function removeRowCartPage(Request $request)
    {
        $input = $request->all();
        if(empty($input['rowId'])) {
            return response()->json(['error' => 'Product not found'],200);
        }

        Cart::remove($input['rowId']);

        $cart_qty = Cart::count();
        $cart_total = Cart::total();
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();

        $data = [ 'cart_qty' => $cart_qty,
            'cart_total' => $cart_total,
            'subtotal' => $subtotal,
            'tax' => $tax
        ];

        return response()->json(['success' => 'Product Remove from Cart', 'data' =>  $data],200);
    }

    public function removeMiniCart(Request $request)
    {
        $input = $request->all();
        if(empty($input['rowId'])) {
            return response()->json(['error' => 'Product not found'],200);
        }

        Cart::remove($input['rowId']);
        return response()->json(['success' => 'Product Remove from Cart'],200);
    }

    public function updateMiniCart(Request $request)
    {
        $input = $request->all();
        if(empty($input['rowId'])) {
            return response()->json(['error' => 'Product not found'],200);
        }

        if(empty($input['qty'])) {
            return response()->json(['error' => 'Qty not found'],200);
        }

        Cart::update($input['rowId'], $input['qty']);
        return response()->json(['success' => 'Product update Successfully'],200);
    }

}
