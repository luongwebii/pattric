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

    <script type="text/javascript">

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  
  // var data = $("form").serializeArray();
   //console.log(data);
   var table = $('.dataTable').DataTable({
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
