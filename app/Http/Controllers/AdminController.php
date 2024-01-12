<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

use PDF;
class AdminController extends Controller
{
    //
    public function settings()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('welcome');
    }

    public function index()
    {

        $orders = Order::all();

        $orderItems = OrderItem::all();
        $totalPrice = 0;
        $totalQty = 0;
        $category = [];

        $lastOrders = Order::latest('id')->take(10)->get();

        foreach($orders as $order){//print_r($order); die();
            $totalPrice += $order->amount;
            
        }

        foreach($orderItems as $item){//print_r($order); die();
            
            $totalQty += $item->qty;
         //   var_dump( $item->product->category->category_name_en);
            if(isset($item->product->category)) {
                if(isset($category[$item->product->category->category_name_en])){
                    $category[$item->product->category->category_name_en] += $item->unit_price * $item->qty;
                } else {
                    $category[$item->product->category->category_name_en] = $item->unit_price * $item->qty;
                }
            }
           // $category[$item->product->category->category_name_en] += $item->unit_price;
              
        }

      // echo implode("', '", array_values($category));die();
        return view('admin.dashboard', [
            'totalPrice' => $totalPrice,
            'totalQty' => $orders->count(),
            'category' => $category,
            'lastOrders' => $lastOrders,
            

        ]);
    }

}
