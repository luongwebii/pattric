@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Orders
@endsection
@section('content')
<form method="post" action="{{ route('admin.orders.update', $order) }}" id="form">
@csrf
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Shipping Details</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th> First Name: </th>
                                <th> <input value=" {{ $order->first_name }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="first_name" 
                                    placeholder="" > </th>
                            </tr>
                            <tr>
                                <th> Last Name: </th>
                                <th><input value=" {{ $order->last_name }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="last_name" 
                                    placeholder="" >  </th>
                            </tr>
                            <tr>
                                <th> Phone : </th>
                                <th> <input value=" {{ $order->phone }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="phone" 
                                    placeholder="" > </th>
                            </tr>
                            <tr>
                                <th> Email : </th>
                                <th> <input value=" {{ $order->email }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="email" 
                                    placeholder="" ></th>
                            </tr>
                            <tr>
                                <th> Shipping Package : </th>
                                <th> {{ $order->shipping_package }} </th>
                            </tr>
                          
                          
                            <tr>
                                <th> Street : </th>
                                <th><input value=" {{ $order->shipping_street }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="shipping_street" 
                                    placeholder="" >  </th>
                            </tr>
                            <tr>
                                <th> Apt/Suite : </th>
                                <th> <input value=" {{ $order->shipping_suite }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="shipping_suite" 
                                    placeholder="" >  </th>
                            </tr>
                            <tr>
                                <th> City : </th>
                                <th><input value=" {{ $order->shipping_city }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="shipping_city" 
                                    placeholder="" > </th>
                            </tr>
                           
                            <tr>
                                <th> State/Province : </th>
                                <th>
                                <select class="form-select" id="shipping_state"
                                aria-label="Default select example"
                                name="shipping_state">
                                <option value="">Select State</option>
                                @foreach($states  as $key => $state)
                                <option value="{{$key}}" {{ $order->shipping_state == $key ? 'selected' : '' }}>{{$state}}</option>
                                @endforeach
                            </select>
                                </th>
                            </tr>
                            <tr>
                                <th> ZIP/Postal Code : </th>
                                <th><input value=" {{ $order->shipping_zip }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="shipping_zip" 
                                    placeholder="" >   </th>
                            </tr>
                            <tr>
                                <th> Country : </th>
                                <th> <select class="form-select" id="shipping_country"
                                        aria-label="Default select example"
                                        name="shipping_country">
                                        <option value="">Select Country</option>
                                        <option value="US" {{ $order->shipping_country == 'US' ? 'selected' : '' }}>United States</option>
                                        <option value="CA" {{ $order->shipping_country == 'CA' ? 'selected' : '' }}>Canada</option>
                                        <option value="MX" {{ $order->shipping_country == 'MX' ? 'selected' : '' }}>Mexico</option>
                                    </select>
                                                                  </th>
                            </tr>
                           
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-lg-6">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Order Details</h4>
                     
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                           
                            <tr>
                                <th> Payment Type : </th>
                                <th><select class="form-select" id="payment_method"
                                        aria-label="Default select example"
                                        name="payment_method">
                                        <option value="">Select Payment Method</option>
                                        <option value="Credit Card" {{ $order->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="Check / ACH Payment" {{ $order->payment_method == 'Check / ACH Payment' ? 'selected' : '' }}>Check / ACH Payment</option>
                                    </select>
                                    
                                 </th>
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
                                <th>
                                <div class="input-group" ><span class="input-group-text">$</span> <input value=" {{ $order->sub_total }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="sub_total" 
                                    placeholder="" >
                                </div>
                           </th>
                            </tr>
                            <tr>
                                <th> Tax : </th>
                                <th><div class="input-group" ><span class="input-group-text">$</span> <input value=" {{ $order->tax }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="tax" 
                                    placeholder="" >
                                </div> </th>
                            </tr>
                            <tr>
                                <th> Order Total : </th>
                                <th><div class="input-group" ><span class="input-group-text">$</span> <input value=" {{ $order->amount }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="amount" 
                                    placeholder="" >
                                </div> </th>
                            </tr>
                            <tr>
                                <th> Status : </th>
                                <th>
                                <select class="form-select" id="status"
                                    aria-label="Default select example"
                                    name="status">
                                    <option value="">Select Status</option>
                                    @foreach($statuses  as $key => $status)
                                    <option value="{{$status}}" {{ $order->status == $status ? 'selected' : '' }}>{{ucfirst($status)}}</option>
                                    @endforeach
                                </select>

                                   
                                    </span>
                                </th>
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
                        <h4 class="box-title">Products</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr style="background: #e3e3e3;">
                                       
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
                                </thead>
                                <tbody>
                                @foreach($order->order_items as $item)
                                <tr>
                                <td> <input type="hidden" name="item_id[]" value="{{ $item->id }}" />
                                {{ $item->product->product_name_en }}
                                
                                </td>
                                <td>{{ $item->model }}</td>
                                <td> <input value=" {{ $item->product_qty }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="qtyy[]" 
                                    placeholder="" ></td>

                            
                                <td><input value=" {{ $item->price }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="price[]" 
                                    placeholder="" ></td>
                                <td><input value=" {{ $item->price * $item->product_qty }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="total_item[]" 
                                    placeholder="" ></td>

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
        <div class="container mt-2">
    <button type="button" class="btn btn-primary mt-2 updateShipping">Update</button>
    </div>
    </section>
</form>


<script type="text/javascript">

$(document).ready(function() {
    var questionIndex = 1;

    $('.updateShipping').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure that you want to save these changes to this order? ",

            showCancelButton: true,
            confirmButtonText: "Save",

            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
          
               document.getElementById("form").submit();
            } 
        });
        return;

    });
});    
</script>
@endsection
