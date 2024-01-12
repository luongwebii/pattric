<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\gwapi;
use App\Http\Requests\CheckoutStoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Cart;
use Helper;
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

        $input = $request->all();
        $shipping_package = $request->shipping_package;
        if($shipping_package != 'Large Freight Shipping') {
            $validate = [
                'first_name'             => 'required',
                'last_name'           => 'required',
              //  'phone'              => 'required',
                'email'  => 'required',
                'shipping_company_name'   => 'nullable',
                'shipping_department'   => 'nullable',
                'shipping_street'   => 'required',
              //  'shipping_suite'   => 'required',
                'shipping_city'   => 'required',
                'shipping_state'   => 'required',
              //  'shipping_zip'   => 'required',
                'shipping_package'   => 'required',
                'shipping_country'   => 'required',
                'shipping_instructions'             => 'nullable',
                'billing_address'   => 'required',
                'payment_method'   => 'required',
               
                   
                'billing_suite'   => 'nullable',
                'billing_city'   => 'required',
                'billing_state'   => 'required',
             //   'billing_zip'   => 'required',
                'card_name'   => 'required',
                'card_number'   => 'required',
                'card_month'   => 'required',
                'card_year'   => 'required',
            //    'card_expired'   => 'required',
                'card_code'   => 'required',
    
            ];
        } else {
            $validate = [
                'first_name'             => 'required',
                'last_name'           => 'required',
              //  'phone'              => 'required',
                'email'  => 'required',
                'shipping_company_name'   => 'nullable',
                'shipping_department'   => 'nullable',
                'shipping_street'   => 'required',
              //  'shipping_suite'   => 'required',
                'shipping_city'   => 'required',
                'shipping_state'   => 'required',
              //  'shipping_zip'   => 'required',
              'shipping_package'   => 'required',
                'shipping_country'   => 'required',
                'shipping_instructions'             => 'nullable',
                'billing_address'   => 'required',
               
                'payment_method'   => 'required',
                'billing_suite'   => 'nullable',
                'billing_city'   => 'required',
                'billing_state'   => 'required',
    
    
            ];
        }
      
        $this->validate($request, $validate,
        ['card_month.required' => 'Field is required.', 'card_year.required' => 'Field is required.']);

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = Cart::total();
        }
        $total_amount = Helper::format_number_db($total_amount);


        $create_account = $request->create_account;
        if(!empty($create_account)) {
            $hasExpenseSavedForUser = User::query()
                ->where('email', $request->email)
                ->exists();

            if ($hasExpenseSavedForUser) {
                return response()->json(array(
                    'success' => false,
                    'errors' => [
                        'email' => 'The email has already been taken'
                    ]
            
                ), 422);
            }
        }
        // update cart
      
        $invoiceNumber = 'AAF'.mt_rand(10000000,99999999);
        $transaction_id = uniqid();
      
        if($shipping_package != 'Large Freight Shipping') {

            $gw = new gwapi;
            $gw->setLogin("83RhcjNm98CG8pV5A3tRbpJDv7sdTVFS");
            $gw->setBilling($request->first_name, $request->last_name,"na", $request->billing_address, $request->billing_suite, $request->billing_city,
                $request->billing_state,"na", $request->billing_country, $request->phone,"na",$request->email,
                    "na");
            $gw->setShipping($request->first_name,$request->last_name,"na",$request->shipping_street,$request->shipping_suite, $request->shipping_city,
                $request->shipping_state,"na",$request->shipping_country,"na");
            $ip = $request->ip();
            $gw->setOrder($invoiceNumber,"Order", 0, 0, "", $ip);
            ob_start();
            $r  = $gw->doSale($total_amount, $request->card_number, $request->card_month. $request->card_year,  $request->card_code);
            $result = ob_get_contents();
            ob_end_clean();
    //   print_r($result);
            
        // echo $result;

            list($_response, $_responsetext, $_authcode, $_transactionid, $_avsresponse, $_cvvresponse, $_orderid, $_type, $_response_code ) = explode('&', $result);
            $responsetext = explode('=', $_responsetext);
            $trans_response = explode('=', $_response);
            $trans_code = explode('=', $_response_code);
            $transactionid = explode('=', $_transactionid);
            $transaction_id = $transactionid[1];
        
            $approved = 1;
            $declined = 2;
            $error = 3;
            if($trans_response[1] != $approved) {
                $errors = [];
                $new_str = preg_replace('/REFID\z/i', '', $responsetext[1]);
                $part = 'REFID';
                $string = implode( $part, array_slice( explode( $part,  $responsetext[1] ), 0, -1 ) );
                if($trans_code[1] == 300 || $trans_code[1] == 203) {
                    $pos = strpos($string, 'Credit Card Number');
                    $pos1 = strpos($string, 'Card expiration');
                    if ($pos !== false) {
                        $errors['card_name'] = $string;
                    } else if ($pos1 !== false) {
                        $errors['card_month1'] = $string;
                    } else {
                        if(empty($string)){
                            $string = $responsetext[1];
                        }
                        $errors['other'] = $string;
                    }
                }
                return response()->json(array(
                    'success' => false,
                    'errors' => $errors
            
                ), 422);
            }
        }
       // die();
        $qty =  $input['qty'];
        $notes =  $input['notes'];
        foreach( $qty as $rowId => $value){
            Cart::update($rowId, ['qty' => $value,  'options' => ['notes' =>  $notes[$rowId]] ]);
        }

        $data = [];
        $user_id = 0;
      
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            if(!empty($create_account)) {
                $user_id = User::insertGetId([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'role' => 'user',
                    'password' => bcrypt(Str::random(8)),
                ]);
            }
        }

       
       
      //  $data['shipping_company_name'] = $request->shipping_company_name;
      //  $data['shipping_department'] = $request->shipping_department;
        $data['user_id'] =  $user_id ;
        $data['billing_first_name'] = $request->first_name;
        $data['billing_last_name'] = $request->last_name;
        $data['billing_email'] = $request->email;
        $data['billing_phone'] = $request->phone;

        $data['billing_address'] = $request->billing_address;
        $data['billing_suite'] = $request->billing_suite;
        $data['billing_city'] = $request->billing_city;
        $data['billing_state'] = $request->billing_state;
        //$data['billing_zip'] = $request->billing_zip;
        $data['billing_country'] = $request->billing_country;

     
        $data['shipping_quote'] = $request->shipping_quote;
        $data['shipping_package'] = $request->shipping_package;
        $data['shipping_street'] = $request->shipping_street;
        $data['shipping_suite'] = $request->shipping_suite;
        $data['shipping_state'] = $request->shipping_state;
        $data['shipping_city'] = $request->shipping_city;
    //    $data['shipping_zip'] = $request->shipping_zip;
        $data['shipping_country'] = $request->shipping_country;
     //   $data['shipping_instructions'] = $request->shipping_instructions;
       
        if(!empty($user_id)) {
            $userProfile = UserProfile::where('user_id','=', $user_id)->first();

            if(empty($userProfile)) {
                UserProfile::create($data);
            } else {
                $userProfile->update($data);
            }
        }

       
        $qty = 0;
        foreach(Cart::content() as $row) {
            $qty += $row->qty;
        }
      
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $sub_total = Helper::format_number_db($subtotal); //
        $tax = Helper::format_number_db($tax);//Cart::tax();
        // Order Service Area
        $order_id = Order::insertGetId([
            'user_id' => $user_id,
            'first_name'             => $request->first_name,
            'last_name'           => $request->last_name,
            'phone'              => $request->phone,
            'email'  => $request->email,

            'billing_address'   => $request->billing_address,
            'billing_suite'   => $request->billing_suite,
            'billing_city'   => $request->billing_city,
            'billing_state'   => $request->billing_state,
            'billing_zip'   => $request->billing_zip,
            'billing_country'=> $request->billing_country,

          //  'shipping_company_name'   => $request->shipping_company_name,
          //  'shipping_department'   => $request->shipping_department, 
            'shipping_quote'   => $request->shipping_quote,
            'shipping_package'   => $request->shipping_package,
            'shipping_street'   => $request->shipping_street,
            'shipping_suite'   => $request->shipping_suite,
            'shipping_city'   => $request->shipping_city,
            'shipping_state'   => $request->shipping_state,
            'shipping_zip'   => $request->shipping_zip,
            'shipping_country'   => $request->shipping_country,
          //  'shipping_instructions'             => $request->shipping_instructions,
           
            'card_name'   => $request->card_name,
            'card_number'   => $request->card_number,
            'card_month'   => $request->card_month,
            'card_year'   => $request->card_year,
            'card_code'   => $request->card_code,
            'payment_method'   => $request->payment_method,
            'transaction_id' =>  $transaction_id,
            'amount' => $total_amount,
            'sub_total' => $sub_total,
            'tax' => $tax,
            'qty' => $qty,
            'order_number' => '',
            'invoice_number' => $invoiceNumber,
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
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
                'unit_price' => $cart->price,
                'drawing' => $product->drawing,
                'orient' => $product->orient,
                'area_sm' => $product->area_sm,
                'bottom_butter' => $product->bottom_butter,
                'racking_butter' => $product->racking_butter,
                'man_way' => $product->man_way,
                'capacity' => $product->capacity,
                'notes' => $cart->options->notes,
            ]);
        }
        Cart::destroy();
        $notification = array(
			'success' => 'Your Order Place Successfully',
			'alert-type' => 'success'
		);
        return response()->json(['success' => 'Your Order Place Successfully'],200);

		//return redirect()->route('home')->with($notification);
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
