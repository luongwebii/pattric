@extends('layouts/contentNavbarLayout')
@section('title')
Product details
@endsection
@push('css')

@endpush
@section('content')
<div class="product-breadcrumb d-none d-md-flex align-items-center mb-3">
  <div class="breadcrumb-title pr-3">Dashboard</div>
  <div class="pl-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"></a>
        </li>
        <li class="breadcrumb-item active" aria-current="product">
          Product details</li>
      </ol>
    </nav>
  </div>
</div>
<div class="row">
  <div class=" col-lg-12">
    <div class="card radius-15 border-lg-top-info">
      <div class="card-header border-bottom-0 mb-4">
        <div class="text-center">
          <div>
            <h5 class="mb-0 text-center">Product Details</h5>
            <hr>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label text-bold">Main Thambnail</label>
              <input type="file" class="dropify" data-width="100" data-default-file="/{{ $product->image }}" disabled />
            </div>
            @forelse ($product->multi_images as $key=> $multiImage)
            <div class="col-md-3">
              <label class="col-form-label">Multi image {{ $key+1 }}</label>
              <input type="file" class="dropify" data-width="150" data-default-file="/{{ $multiImage->image_name }}" disabled />
            </div>
            @empty
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-lg-9">
    <div class="card">
      <div class="card-body">
        <h2>Long description</h2>
        <p>{!! $product->long_description_en !!}</p>
      </div>
    </div>
   

  </div>
  <div class="col-12 col-lg-3">
    <div class="card">
      <div class="card-body">

        <p style="font-size:18px">Product Code <span class="badge badge-primary" style="font-size:13px">{{ $product->product_code }}</span></p>

        <p style="font-size:18px">Price <span style="font-size:13px">{{ $product->price_en }} Taka</span></p>
      
        <hr>
        <p style="font-size:18px">Size Available <span style="font-size:13px">{{ $product->size }}</span></p>
        <hr>
        <p style="font-size:18px">Color <span style="font-size:13px">{{ $product->product_color_en }}</span></p>
     
        <hr>
        <p style="font-size:18px">Category <span class="badge badge-info" style="font-size:13px">{{ $product->category->category_name_en }}</span></p>
       
        <hr>
      
        <p style="font-size:18px">Last Modified <span style="font-size:13px">{{ $product->updated_at->diffForHumans() }}</span></p>
      

      </div>
    </div>
  </div>
</div>
@endsection

<script type="text/javascript">
  window.onload = function() {

    $('.dropify').dropify({
    messages: {
      'default': 'Drag and drop a file here or click'
      , 'replace': 'Drag and drop or click to replace'
      , 'remove': 'Remove'
      , 'error': 'Ooops, something wrong happended.'
    }
  });
  }

</script>