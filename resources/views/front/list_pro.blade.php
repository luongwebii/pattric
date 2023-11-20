@extends('layouts/contentFrontLayout')


@section('content')
<main class="content-wrapper">


<section class="breadcrumb-main">
  <div class="container-fluid">
  <div class="row">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
  <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">home</a></li>
    <li class="breadcrumb-item"><a href="#">product category</a></li>
    <li class="breadcrumb-item active" aria-current="page">product name</li>
  </ol>
	</nav>
	</div>
	</div>
	</div>
	</div>
	</section>


	<section class="product-category-section">
	<div class="container-fluid">
	<div class="product-product-drop">
	 <div class="row">
	 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	  <div class="category-product-group">
	 <h2>product category</h2>
	  </div>
	 </div>
	 
	 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	 <div class="product-category-search-box">
	 <span>Jump to </span>
	 
	 <div class="form-group">
          
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                <option value="">Select Option</option>
            @foreach ($pages as $page)
			    <option value="{{ route('show.page', $page->id) }}">{{$page->title}}</option>
            @endforeach
			</select>
		</div>
        </div>
	 </div>
	  </div>
	 </div>
	  </div>
	  </div>
	</section>
	
	
	<section class="vent-subcategory-product-section">
	<div class="container-fluid">
	
	<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<h2>subcategory name</h2>
	</div>
	</div>	
	

	
    @foreach ($categories->products as $product)
	<form>
	<div class="row mb-3">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<div class="subcategory-product-box">
	<div class="row">
    <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12">
	<div class="product-deatils-box">
	<div class="product-img-box">
	<img src="{!! url($product->image) !!}" alt="swivelWheels-img" class="img-fluid">
	</div>
	<div class="product-text-box">
	<h4>{{ $product->product_name_en}}</h4>
	<div class="product-price-box">
	<h6>price: ${{ $product->price}}</h6>
	</div>
	</div>
	</div>
	</div>
	
	<div class="col-xl-5 col-lg-5 col-md-8 col-sm-12">
	<div class="product-cart-box">
	<div class="product-qty-box"><span>qty.</span>
	<div class="form-group qty-input">
    <input type="hidden" name="productId" value="{{ $product->id}}" />
    <input type="text" class="form-control" name="qty" placeholder="0" id="qty">
    </div>
	<a href="javascript:void(0);"  onclick="addToCart(this)"  class="primary-btn" >Add to cart</a>
	</div>
	
	</div>
	</div>
	
	<div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
	<div class="product-info-box">
	<p class="filter-option-heading"></p>
	</div>
	
	</div>
	</div>
	
	<div class="row">
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	 
	 <div class="filter-option-content">
     {!! html_entity_decode($product->long_description_en) !!}
    </div>
	</div>
	</div>
	
	
	
	</div>
	</div>
	</div>
    </form>
	@endforeach
	
	
	
	
	
	
	
	
	<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<div class="lore-more-box">
	<h6> <img src="{!! url('assets/img/load-more-icon.svg') !!}" alt="load-more-icon" class="img-fluid">load more</h6>
	 </div>
	</div>
	</div>	
	
	
	
	
	
	</section>
	

<div class="space-footer-section"></div>
</main>
@endsection