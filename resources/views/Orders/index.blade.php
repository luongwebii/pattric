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
                    <form method="POST" action="" id="configform">
                    @csrf
                    <section class="main-section">
                        <div class="container">
                            <div class="outer-container1">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                
                                        <div class="heading-box">
                                            <h4>Search</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col1-large">
                                        <div class="form-group">
                                            <label for="exampleinputcourse">First Name</label>
                                            <input value="{{ old('first_name', request()->input('first_name'))}}" type="text"
                                                        class="form-control" name="first_name" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col col1-large">
                                        <div class="form-group">
                                            <label for="exampleinputcourse">Last Name</label>
                                            <input value="{{ old('last_name', request()->input('last_name'))}}" type="text"
                                                        class="form-control" name="last_name" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col col1-large">
                                        <div class="form-group">
                                            <label for="exampleinputcourse">Invoice</label>
                                            <input value="{{ old('order_id', request()->input('order_id'))}}" type="text"
                                                        class="form-control" name="order_id" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col col1-large">
                                        <div class="form-group">
                                            <label for="exampleinputcourse">From Date</label>
                                            <input value="{{ old('from_date', request()->input('from_date'))}}"
                                                        type="datetime-local" class="form-control  flatpickr-input" name="from_date" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col col1-large">
                                        <div class="form-group">
                                            <label for="exampleinputcourse">To Date</label>
                                            <input value="{{ old('to_date', request()->input('to_date'))}}"
                                                        type="datetime-local" class="form-control  flatpickr-input" name="to_date" placeholder="">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <div class="search-btn-group-student pt-4">
                                            <ul style="justify-content: flex-end;">
                                                <li> <button class="dt-button add-new btn btn-primary search" tabindex="0" type="button"><span><span
                                                                class="d-none d-sm-inline-block">Search</span></span></button></li>
                                                <li style="margin-right: 0;">  <button class="btn btn-label-secondary clear-search" tabindex="0"
                                                        type="submit"><span><span class="d-none d-sm-inline-block">Clear
                                                                Search</span></span></button> </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>




                    </section>
                    </form>
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
                                                    <th>Payment Method</th>
                                                    <th>Amount</th>
                                                    <th>Qty</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
   
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]", {altInput: true, dateFormat: "Y-m-d", altFormat: "Y-m-d"});
</script>
    <script type="text/javascript">
 var table;
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  
  // var data = $("form").serializeArray();
   //console.log(data);
    table = $('.dataTable').DataTable({
      "order": [],
      bFilter: false, bInfo: false,
      processing: true,
      "lengthChange": false,
            "pageLength": 50,
    "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
            $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
        }
    },
      type: "POST",
      serverSide: true,
      responsive: true,
    //  pageLength:1,
      language: {
        'paginate': {
        'previous': '<span class="prev-icon page-link"><</span>',
        'next': '<span class="next-icon page-link">></span>'
        }
      },
      ajax: {

        url: "{{ route('admin.orders.post') }}",
        dataType: 'json',
        type: 'POST',
        data:   function (d) {
                  
                    d.first_name = $('input[name=first_name]').val();
                    d.last_name = $('input[name=last_name]').val();
                    d.order_id = $('input[name=order_id]').val();
                    d.from_date = $('input[name=from_date]').val();
                    d.to_date = $('input[name=to_date]').val(); //$('input[name=YOUT_NAME]').val(); doesn't work with Radio Button/Select/Checbox.

                },
      },

      columns: [
        { "data": 'DT_RowIndex'}, // row index
        {data: 'date_format'},
   
   
        {data: 'invoice_number'},
        {data: 'name'},
        {data: 'payment_method'},
        {data: 'amount_format'},
         
        {data: 'qty'},
        {data: 'status_format'},
        {data: 'action'},
      ]

  });

 
  $(".search").click(function(e){
    e.preventDefault();
    table.draw();

    });
    $(".clear-search").click(function(e){
    e.preventDefault();
    $('#configform')[0].reset();
    table.draw();

    });


  $(".btn-group > button.btn").on("click", function(){
      
        //alert("Value is " + $(this).is(':focus'));
        table.draw();
    });

   

  $(".clear-search").click(function(e){
      e.preventDefault();
      $('#configform')[0].reset();
    

  });


});

function deleteProduct(productId) {
        
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {

            window.location.href = "{{ route('admin.product.delete') }}?product_id=" + productId;
           
        }
    });
    return false;
}
    
</script>


@endsection
