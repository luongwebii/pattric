@extends('layouts/contentNavbarLayout')
@section('title')
Order Details
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-lg-6">
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
                                <th> Company Name: </th>
                                <th> {{ $order->shipping_company_name }} </th>
                            </tr>
                            <tr>
                                <th> Department : </th>
                                <th> {{ $order->shipping_department }} </th>
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
                                <th> {{ $order->shipping_department }} </th>
                            </tr>
                            <tr>
                                <th> Department : </th>
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
                            <tr>
                                <th> Instructions : </th>
                                <th> {{ $order->shipping_instructions }} </th>
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
                        <h3 class="box-title">Order Details</h3>
                        <span class="text-danger"> Invoice : {{ $order->invoice_number }}</span>
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
                                <th> Order Total : </th>
                                <th>$ {{ $order->amount }} </th>
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
                                <th>
                                    @if ($order->status == 'pending')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'confirmed'
                                    ]) }}" class="btn btn-block btn-success">Confirm Order</a>
                                    @elseif ($order->status == 'confirmed')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'processing'
                                    ]) }}" class="btn btn-block btn-success">Process Order</a>
                                    @elseif ($order->status == 'processing')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'picked'
                                    ]) }}" class="btn btn-block btn-success">Pick Order</a>
                                    @elseif ($order->status == 'picked')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'shipped'
                                    ]) }}" class="btn btn-block btn-success">Ship Order</a>
                                    @elseif ($order->status == 'shipped')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'delivered'
                                    ]) }}" class="btn btn-block btn-success">Deliverd Order</a>
                                    @elseif ($order->status == 'cancel')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'return'
                                    ]) }}" class="btn btn-block btn-danger">Return Order</a>
                                    @endif
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
                        <h3 class="box-title">Order View</h3>
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
                                            <label for=""> Drawing </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Orient </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Area Sm </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Orient </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Bottom Butter </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Racking Butter </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Man Way</label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Capacity</label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Price </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Download </label>
                                        </td>
                                    </tr>
                                    @foreach ($orderItems as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                <label for=""><img src="{{ asset( $item->product->product_thumbnail ) }}"
                                                        height="50px;" width="50px;"> </label>
                                            </td>
                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->product_name_en }}</label>
                                            </td>
                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->model }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->drawing }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->orient }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->area_sm }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->bottom_butter }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->racking_butter }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->man_way }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->capacity }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for=""> {{ $item->qty }}</label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> ${{ $item->unit_price }}  </label>
                                            </td>
                                            @php
                                                $file = App\Models\Product::where('id', $item->product_id)->first();
                                            @endphp

                                            <td class="col-md-1">
                                                @if ($order->status == 'pending')
                                                    <strong>
                                                        <span class="badge badge-pill badge-success" style="background: #418DB9;"> No
                                                            File</span> </strong>

                                                @elseif($order->status == 'confirm')

                                                    <a target="_blank" href="{{ asset('upload/pdf/' . $file->digital_file) }}">
                                                        <strong>
                                                            <span class="badge badge-pill badge-success" style="background: #FF0000;">
                                                                Download Ready</span> </strong> </a>
                                                @endif
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
