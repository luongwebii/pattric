@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Products
@endsection
@push('css')
<!-- DataTables -->

@endpush
@section('content')

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
  <div class="breadcrumb-title pr-3">Dashboard</div>
  <div class="pl-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
      </ol>
    </nav>
  </div>
</div>
<div class="card border-lg-top-info radius-15">
  <div class="card-header border-bottom-0 mb-4">
    <div class="d-flex align-items-center">
      <div>
        <h5>Control Products</h5>
      </div>
      <div class="ml-auto">
       
        <a class="btn btn-primary px-3" href="{{ route('admin.product.create') }}" data-toggle="tooltip" title="Add new Category &#9989"><i class="bx bx-plus mr-1"></i>Add</a>
     
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered text-center table-hover data-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Action</th>
            <th>Status</th>
            <th>Name </th>
       
            <th>Price</th>
            <th>Sale Price</th>
            <th>Quantity</th>
        
            <th style="width:15%;">Category</th>
          </tr>
        </thead>
        <tbody>
        
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- DataTables  & Plugins -->

<script type="text/javascript">

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  
  // var data = $("form").serializeArray();
   //console.log(data);
   var table = $('.data-table').DataTable({
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

        url: "{{ route('admin.product.post') }}",
        dataType: 'json',
        type: 'POST',
        data:   function (d) {
                  
                    d.first_name = $('input[name=first_name]').val();
                    d.last_name = $('input[name=last_name]').val();
         
                },
      },

      columns: [
        { "data": 'DT_RowIndex'}, // row index
        {data: 'action'},
   
   
        {data: 'status_format'},
        {data: 'image_format'},
        {data: 'price_format'},
        {data: 'sale_price_format'},
         
        {data: 'product_qty'},
        {data: 'category_name_en'},
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

