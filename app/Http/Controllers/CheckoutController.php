<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutStoreRequest;


use Illuminate\Http\Request;
use Carbon\Carbon;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use App\Models\UserProfile;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;


class CheckoutController extends Controller
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

    public function checkoutStore(Request $request)
    {

        $this->validate($request, [
            'first_name'             => 'required',
            'last_name'           => 'required',
            'phone'              => 'required',
            'email'  => 'required|email',
            'shipping_company_name'   => 'nullable',
            'shipping_department'   => 'nullable',
            'shipping_street'   => 'required',
            'shipping_suite'   => 'required',
            'shipping_city'   => 'required',
            'shipping_state'   => 'required',
            'shipping_zip'   => 'required',
            'shipping_country'   => 'required',
            'shipping_instructions'             => 'nullable',
            'billing_address'   => 'required',
            'billing_suite'   => 'required',
            'billing_city'   => 'required',
            'billing_state'   => 'required',
            'billing_zip'   => 'required',
            'card_name'   => 'required',
            'card_number'   => 'required',
            'card_expired'   => 'required',
            'card_code'   => 'required',

        ]);

        $data = [];
        $data['shipping_company_name'] = $request->shipping_company_name;
        $data['shipping_department'] = $request->shipping_department;
        $data['shipping_street'] = $request->shipping_street;
        $data['shipping_suite'] = $request->shipping_suite;
        $data['shipping_state'] = $request->shipping_state;
        $data['shipping_zip'] = $request->shipping_zip;
        $data['shipping_country'] = $request->shipping_country;
        $data['shipping_instructions'] = $request->shipping_instructions;
        $data['billing_address'] = $request->billing_address;
        $data['billing_suite'] = $request->billing_suite;
        $data['billing_city'] = $request->billing_city;
        $data['billing_state'] = $request->billing_state;
        $data['billing_zip'] = $request->billing_zip;
        $user_id = Auth::user()->id;

        $userProfile = UserProfile::where('user_id','=', $user_id)->first();

        if(empty($userProfile)) {
            UserProfile::create($data);
        } else {
            $userProfile->update($data);
        }

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total());
        }

        // Order Service Area
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'first_name'             => $request->first_name,
            'last_name'           => $request->last_name,
            'phone'              => $request->phone,
            'email'  => $request->email,
            'shipping_company_name'   => $request->shipping_company_name,
            'shipping_department'   => $request->shipping_department,
            'shipping_street'   => $request->shipping_street,
            'shipping_suite'   => $request->shipping_suite,
            'shipping_city'   => $request->shipping_city,
            'shipping_state'   => $request->shipping_state,
            'shipping_zip'   => $request->shipping_zip,
            'shipping_country'   => $request->shipping_country,
            'shipping_instructions'             => $request->shipping_instructions,
            'billing_address'   => $request->billing_address,
            'billing_suite'   => $request->billing_suite,
            'billing_city'   => $request->billing_city,
            'billing_state'   => $request->billing_state,
            'billing_zip'   => $request->billing_zip,
            'card_name'   => $request->card_name,
            'card_number'   => $request->card_number,
            'card_expired'   => $request->card_expired,
            'card_code'   => $request->card_code,
            'transaction_id' =>  uniqid(),
            'amount' => $total_amount,
            'order_number' => '',
            'invoice_number' => 'AAF'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
        ]);


        $carts = Cart::content();
        foreach ($carts as $key => $cart) {

            $product = Product::findOrFail($cart->id);
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'product_qty' => $cart->qty,
                'qty' => $cart->qty,
                'model' => $product->model,
                'price' => $product->price,
                'unit_price' => $product->price,
                'drawing' => $product->drawing,
                'orient' => $product->orient,
                'area_sm' => $product->area_sm,
                'bottom_butter' => $product->bottom_butter,
                'racking_butter' => $product->racking_butter,
                'man_way' => $product->man_way,
                'capacity' => $product->capacity,
            ]);
        }
        Cart::destroy();
        $notification = array(
			'message' => 'Your Order Place Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('home')->with($notification);
/*
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

*/
    }

    

    public function checkoutPage()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cart_qty = Cart::count();
                $cart_total = Cart::total();

                $userProfile = UserProfile::where('user_id','=', $user_id)->first();

                if(empty($userProfile)) {
                    $userProfile = new UserProfile;
                }
              
                //return $divisions;
                return view('checkout_page.checkout_page', compact(
                    'carts',
                    'cart_qty',
                    'cart_total',
                    'userProfile'
                ));
            }else{
                $notification = [
                    'message' => 'Your shopping cart is empty!!',
                    'alert-type' => 'error'
                ];
                return redirect()->route('home')->with($notification);
            }
        }else{
            $notification = [
                'message' => 'You need to Login First for Checkout',
                'alert-type' => 'error'
            ];
            return redirect()->route('user.login')->with($notification);
        }
    }
}
