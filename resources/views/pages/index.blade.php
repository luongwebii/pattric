@extends('layouts/contentNavbarLayout')
@section('title')
SPoT – Pages
@endsection

@section('content')
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
  <div class="breadcrumb-title pr-3">Dashboard</div>
  <div class="pl-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Pages</li>
      </ol>
    </nav>
  </div>
</div>
<div class="card border-lg-top-info radius-15">
  <div class="card-header border-bottom-0 mb-4">
    <div class="d-flex align-items-center">
      <div>
        <h5>All static pages</h5>
      </div>
      <div class="ml-auto">
        <a class="btn btn-primary" href="{{ route('admin.pages.create') }}" data-toggle="tooltip" title="Create new static page  &#9989;"><i class="bx bx-plus"></i>Add</a>
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
            <th>Title</th>
            <th>Is Home</th>
            <th>Status</th>
            <th>Last modified</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pages as $key => $page)
          <tr>
            <td>{{ $page->id }}</td>
            <td>
              <div class="media align-items-center">
                <img @if (file_exists($page->image)) src="/{{ $page->image }}"
                @else
                src="/images/no_image.jpg" @endif
                class="rounded-circle"
                alt=""
                width="45"
                height="45">
              </div>
            </td>
            <td>{{ $page->title }}</td>
            <td>
              @if ($page->is_home)
              <span class="badge badge-info rounded " data-toggle="tooltip" title="Home Page is true &#128077">True</span>
              @else
              <span class="badge badge-danger" data-toggle="tooltip" title="Home Page is false &#128078">False</span>
              @endif
            </td>

            <td>
              @if ($page->status)
              <span class="badge badge-info rounded " data-toggle="tooltip" title="Page status is true &#128077">Active</span>
              @else
              <span class="badge badge-danger" data-toggle="tooltip" title="Page status is false &#128078">Draft</span>
              @endif
            </td>
            <td>{{ $page->updated_at->diffForHumans() }}</td>
            <td>
            
              <a class="btn btn-sm btn-success" href="{{ route('admin.pages.editPage', $page->id) }}" data-toggle="tooltip" title="Edit &#128221"><i class="fadeIn animated bx bx-edit"></i>
              </a>
            
              <a class="btn btn-sm btn-danger " href="#"   onclick="return deleteItem({{$page->id}});"  ><i class="fadeIn animated bx bx-trash"></i>
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
                window.location.href = "{{ route('admin.pages.delete') }}?id=" + id;
            }
        });
        return false;
    }

</script>
@endsection

