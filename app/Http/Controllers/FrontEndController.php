<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
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

    public function listProductCategory($id)
    {
        //
        $categories = Category::find($id);
        return view('front.list_pro', [
            'categories' => $categories
        ]);
    }

    public function shoppingCartPage()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();

        return view('front.shopping_cart_page', [
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => round($cart_total),
            'subtotal' => round($subtotal),
            'tax' => round($tax),
        ]);
    }

    public function showAllCategory()
    {
        //
        $categories = Category::get();
        return view('front.list_all_pro', [
            'categories' => $categories
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
}
