@extends('layouts/contentNavbarLayout_print')
@section('title')
SPoT – Orders
@endsection
@section('content')
<style>
    @media print {
   .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
        float: left;
   }
   .col-sm-12 {
        width: 100%;
   }
   .col-sm-11 {
        width: 91.66666667%;
   }
   .col-sm-10 {
        width: 83.33333333%;
   }
   .col-sm-9 {
        width: 75%;
   }
   .col-sm-8 {
        width: 66.66666667%;
   }
   .col-sm-7 {
        width: 58.33333333%;
   }
   .col-sm-6 {
        width: 50%;
   }
   .col-sm-5 {
        width: 41.66666667%;
   }
   .col-sm-4 {
        width: 33.33333333%;
   }
   .col-sm-3 {
        width: 25%;
   }
   .col-sm-2 {
        width: 16.66666667%;
   }
   .col-sm-1 {
        width: 8.33333333%;
   }
   .delivery-menu {
  width: 49%;
}
.delivery-menu {
  width: 50%;
  float: right;
}
}
</style>
    <section class="content">

        <div class="row">
            <div class="col-md-5 col-lg-5 delivery-menu">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shipping Details</h3>
                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th> First Name: </th>
                                <th> {{ $order->first_name }} </th>
                            </tr>
                            <tr>
                                <th> Last Name: </th>
                                <th> {{ $order->last_name }} </th>
                            </tr>
                            <tr>
                                <th> Phone : </th>
                                <th> {{ $order->phone }} </th>
                            </tr>
                            <tr>
                                <th> Email : </th>
                                <th> {{ $order->email }} </th>
                            </tr>
                            <tr>
                                <th> Shipping Package : </th>
                                <th> {{ $order->shipping_package }} </th>
                            </tr>
                          
                            <tr>
                                <th> Shipping Type : </th>
                                <th> {{ $order->shipping_quote == 1 ? "Custom Shipping Quote" : "Local Pickup" }} </th>
                            </tr>
                            <tr>
                                <th> Street : </th>
                                <th> {{ $order->shipping_street }} </th>
                            </tr>
                            <tr>
                                <th> Apt/Suite : </th>
                                <th> {{ $order->shipping_suite }} </th>
                            </tr>
                            <tr>
                                <th> City : </th>
                                <th> {{ $order->shipping_city }} </th>
                            </tr>
                           
                            <tr>
                                <th> State/Province : </th>
                                <th> {{ $order->shipping_state }} </th>
                            </tr>
                            <tr>
                                <th> ZIP/Postal Code : </th>
                                <th> {{ $order->shipping_zip }} </th>
                            </tr>
                            <tr>
                                <th> Country : </th>
                                <th> {{ $order->shipping_country }} </th>
                            </tr>
                           
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-5 col-lg-5 delivery-menu">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Details</h3>
                     
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                           
                            <tr>
                                <th> Payment Type : </th>
                                <th> {{ $order->payment_method }} </th>
                            </tr>
                            <tr>
                                <th> Tranx ID : </th>
                                <th> {{ $order->transaction_id }} </th>
                            </tr>
                            <tr>
                                <th> Invoice : </th>
                                <th class="text-danger"> {{ $order->invoice_number }} </th>
                            </tr>
                            <tr>
                                <th> Sub Total : </th>
                                <th>$ {{ Helper::format_numbers($order->sub_total) }} </th>
                            </tr>
                            <tr>
                                <th> Tax : </th>
                                <th>$ {{ Helper::format_numbers($order->tax) }} </th>
                            </tr>
                            <tr>
                                <th> Order Total : </th>
                                <th>$ {{ Helper::format_numbers($order->amount) }} </th>
                            </tr>
                            <tr>
                                <th> Status : </th>
                                <th>
                                    <span class="badge badge-success">{{ $order->status }}
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th>Return Reason: <p>{{ $order->return_reason }}</p></th>
                                
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-12 col-lg-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Products</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr style="background: #e3e3e3;">
                                        <td class="text-dark">
                                            <label for=""> Image</label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Product Name </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Model</label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Qty </label>
                                        </td>
                            
                                        <td class="text-dark">
                                            <label for=""> Price </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Sub Total </label>
                                        </td>
                                        
                                    </tr>
                                    @foreach ($orderItems as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                <label for=""><img src="{{ asset( $item->product->image ) }}"
                                                        height="50px;" width="50px;"> </label>
                                            </td>
                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->product_name_en }}</label>
                                            </td>
                                            <td class="col-md-3">
                                                <label for=""> {{ $item->model }}</label>
                                            </td>
                                 
                                           
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->qty }}</label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> ${{ Helper::format_numbers($item->unit_price) }}  </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> ${{ Helper::format_numbers($item->unit_price * $item->qty )}}  </label>
                                            </td>
                                           
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


@endsection
