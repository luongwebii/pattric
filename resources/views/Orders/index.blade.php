@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Orders
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            All Orders List
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                            role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Invoice</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Qty</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        {{ $loop->index+1 }}
                                                    </td>
                                                    <td class="sorting_1">{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }} </td>
                                                    <td class="soring_1">{{ $order->invoice_number }}</td>
                                                    <td class="soring_1">{{ $order->first_name }} {{ $order->last_name }}</td>
                                                    <td class="sorting_1">${{ Helper::format_numbers($order->amount) }}</td>
                                                    <td class="soring_1">{{ $order->qty ? $order->qty : '' }}</td>
                                                    <td class="sorting_1">
                                                        @if ($order->status == 'pending')
                                                        <span class="badge badge-primary">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'confirmed')
                                                        <span class="badge badge-secondary">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'processing')
                                                        <span class="badge badge-info">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'picked')
                                                        <span class="badge badge-warning">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'shipped')
                                                        <span class="badge badge-light">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'delivered')
                                                        <span class="badge badge-success">{{ $order->status }}</span>
                                                        @else
                                                        <span class="badge badge-danger">{{ $order->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-success" title="View"><i class="fa fa-eye"></i>
                                                            </a>
                                                            @if ($order->status =='pending')

                                                            @else
                                                            <a href="{{ route('admin-invoice-download', $order->id) }}" class="btn btn-danger" title="Download"><i class="fa fa-download"></i>
                                                            </a>
                                                            @endif
                                                           
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
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
