@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Categories
@endsection
@push('css')
<!-- DataTables -->

@endpush
@section('content')
<style>
    .text-left{text-align:left;}
</style>
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
        <h5>Control Categories</h5>
      </div>
      <div class="ml-auto">
    
        <a class="btn btn-primary px-3" href="{{ route('admin.category.create') }}" data-toggle="tooltip" title="Add new Category &#9989"><i class="bx bx-plus mr-1"></i>Add</a>
   
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered text-center table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Parent Category</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $key => $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td class="text-center">
              <div class="product-img bg-transparent ">
                <img @if (file_exists($category->image)) src="/{{ $category->image }}"
                @else
                src="/images/no_image.jpg" @endif
                alt="{{ $category->category_name_en }}"
                width="45">
              </div>
            </td>
            <td class="text-left">{{ $category->category_name_en }}</td>
            <td>{{ $categoryDataArray[$category->parent_id] ?? '' }}</td>
            <td>
              @if ($category->status)
              <span class="badge badge-info rounded " data-toggle="tooltip" title="Category status is true &#128077">Active</span>
              @else
              <span class="badge badge-danger" data-toggle="tooltip" title="Category status is false &#128078">Draft</span>
              @endif
            </td>
            <td>
          
              <a class="btn btn-sm btn-success" href="{{ route('admin.category.edit', $category->id) }}" data-toggle="tooltip" title="Edit &#128221"><i class="fadeIn animated bx bx-edit"></i>
              </a>
              <a class="btn btn-sm btn-danger " href="#"   onclick="return deleteItem({{$category->id}});"  ><i class="fadeIn animated bx bx-trash"></i>
              </a>
             
            
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
    function deleteItem(id) {
        
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
                window.location.href = "{{ route('admin.category.delete') }}?id=" + id;
            }
        });
        return false;
    }

</script>
@endsection

