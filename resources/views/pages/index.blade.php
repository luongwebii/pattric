@extends('layouts/contentNavbarLayout')
@section('title')Create static pages @endsection

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
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Status</th>
            <th>Last modified</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pages as $key => $page)
          <tr>
            <td>{{ $key + 1 }}</td>
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
              @if ($page->status)
              <span class="badge badge-info rounded " data-toggle="tooltip" title="Page status is true &#128077">Active</span>
              @else
              <span class="badge badge-danger" data-toggle="tooltip" title="Page status is false &#128078">Inactive</span>
              @endif
            </td>
            <td>{{ $page->created_at->diffForHumans() }}</td>
            <td>
            
              <a class="btn btn-sm btn-success" href="{{ route('admin.pages.editPage', $page->id) }}" data-toggle="tooltip" title="Edit &#128221"><i class="fadeIn animated bx bx-edit"></i>
              </a>
            
            
              <form action="{{ route('admin.pages.updatePage', $page->id) }}" style="display: inline-block" method="POST">
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

