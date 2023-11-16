@extends('layouts/contentNavbarLayout')
@section('title')
All categories
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
        <li class="breadcrumb-item active" aria-current="page">Categories</li>
      </ol>
    </nav>
  </div>
</div>
<div class="card border-lg-top-info radius-15">
  <div class="card-header border-bottom-0 mb-4">
    <div class="d-flex align-items-center">
      <div>
        <h5>Product Groups</h5>
      </div>
      <div class="ml-auto">
    
        <a class="btn btn-primary px-3" href="{{ route('admin.groupProduct.create') }}" data-toggle="tooltip" title="Add new Product Group &#9989"><i class="bx bx-plus mr-1"></i>Add</a>
   
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered text-center table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
       
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($groupProducts as $key => $groupProduct)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td class="text-center">
              <div class="product-img bg-transparent ">
                <img @if (file_exists($groupProduct->image)) src="/{{ $groupProduct->image }}"
                @else
                src="/images/no_image.jpg" @endif
                alt="{{ $groupProduct->product_group_name }}"
                width="45">
              </div>
            </td>
            <td>{{ $groupProduct->product_group_name }}</td>
         
            <td>
              @if ($groupProduct->status)
              <span class="badge badge-info rounded " data-toggle="tooltip" title="Category status is true &#128077">Active</span>
              @else
              <span class="badge badge-danger" data-toggle="tooltip" title="Category status is false &#128078">Inactive</span>
              @endif
            </td>
            <td>
          
              <a class="btn btn-sm btn-success" href="{{ route('admin.groupProduct.edit', $groupProduct->id) }}" data-toggle="tooltip" title="Edit &#128221"><i class="fadeIn animated bx bx-edit"></i>
              </a>
           
              <form action="{{ route('admin.groupProduct.update', $groupProduct->id) }}" style="display: inline-block" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger delete-confirm" type="submit" data-toggle="tooltip" title="Delete &#128683">
                  <i class="fadeIn animated bx bx-trash"></i>
                </button>
              </form>
            
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
@push('js')
<!--Data Tables js-->
<!-- DataTables  & Plugins -->

<script>
  $(function() {

  });

</script>
@endpush
