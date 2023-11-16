<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
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

        if($product->discount_price == NULL){
            Cart::add([
                'id' => $input['productId'],
                'name' => $product->product_name_en,
                'qty' => $request->qty,
                'price' => $product->price,
                'weight' => 1,
                'options' => [
                    'image' => $product->image
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
                    'image' => $product->image
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

        return response()->json([
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => round($cart_total),
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
            'cart_total' => round($cart_total),
            'subtotal' => round($subtotal),
            'tax' => round($tax)
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
