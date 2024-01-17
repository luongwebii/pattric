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
    <li class="breadcrumb-item"><a href="/">home</a></li>
    @if(isset($categories->id))
    <li class="breadcrumb-item"><a href="{{ route('category.front.list', $categories->id) }}">{{$categories->category_name_en}}</a></li>
    @endif

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
	 <h2>@if(isset($categories->id)){{$categories->category_name_en}}    @endif</h2>
	  </div>
	 </div>
	 

	 </div>
	  </div>
	  </div>
	</section>
	
	
	<section class="vent-subcategory-product-section">
	<div class="container-fluid">

	

	<div id="product-list">
    @foreach ($products as $product)
	<form>
	<div class="row mb-3 product">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<div class="subcategory-product-box">
	<div class="row">
    <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12">
	<div class="product-deatils-box">
	<div class="product-img-box">
	<img src="{!! url($product->image ? $product->image : 'assets/img/no-image.jpg') !!}" alt="swivelWheels-img" class="img-fluid">
	</div>
	<div class="product-text-box">
	<h4>{{ $product->product_name_en}}</h4>
	<div class="product-price-box">
    @if(empty($product->sale_price))
    <h6>price: ${{ Helper::format_numbers($product->price)}}</h6>
    @else
    <h6 class="text-deco">price: ${{ Helper::format_numbers($product->price)}}</h6>
    <h6 class="text-top">price: ${{ Helper::format_numbers($product->sale_price)}}</h6>
    @endif
    <div class="product-availability-box">
                                        @if($product->product_qty > 0)
                                            <span>in stock</span>
                                        @else 
                                        <span>out of stock</span>
                                        @endif
                                        </div>
	</div>
	</div>
	</div>
	</div>
	
	<div class="col-xl-5 col-lg-5 col-md-8 col-sm-12">
	<div class="product-cart-box">
	<div class="product-qty-box"><span>qty.</span>
	<div class="form-group qty-input">
    <input type="hidden" name="productId" value="{{ $product->id}}" />
    <input type="text" class="form-control" value="1" name="qty" placeholder="0" id="qty">
    </div>
	<a href="javascript:void(0);" @if($product->product_qty > 0) onclick="addToCart(this)" @endif  class="primary-btn" >Add to cart</a>
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
    </div>
	
	
	
	
	
	
	
	@if ($products->hasMorePages())
	<div class="row" id="load-more-button">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="lore-more-box">
            <a href="#" class="load-more"><h6> <img src="{!! url('assets/img/load-more-icon.svg') !!}" alt="load-more-icon" class="img-fluid">load more</h6></a>
            </div>
        </div>
	</div>	
	@endif
	
	
	
	
	</section>
	

<div class="space-footer-section"></div>
</main>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    var offset = 25; // Initial offset 
    var limit = 25; // Number of products to load per request 

    $(document).ready(function () {


        $('.load-more').click(function (e) {
            e.preventDefault();
          
            $.ajax({
                type: 'POST',
                dataType: 'json',
                type: 'GET', 
                data: { 
                    offset: offset, 
                    limit: limit 
                }, 
                url: "{{ route('load.more.products', $categories->id) }}",
                success: function (data) {

                    $.each(data, function(index, product) { 
                        // Append the product to the list 
                        var price = '';
                        if(product.is_price_sale.length !== 0){
                            price += '<h6  class="text-deco">price: $'+product.is_price +'</h6>';
                            price += '<h6 class="text-top">price: $'+product.is_price_sale +'</h6>';
                        } else {
                            price += '<h6>price: $'+product.is_price +'</h6>';
                        }
                        if(product.product_qty > 0){
                            price += '<div class="product-availability-box"><span>in stock</span></div>';
                        } else {
                            price += '<div class="product-availability-box"><span>out of stock</span></div>';
                        }

                        var html = `
                        <form>
                            <div class="row mb-3 product">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="subcategory-product-box">
                            <div class="row">
                            <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12">
                            <div class="product-deatils-box">
                            <div class="product-img-box">
                            <img src="/${product.image}" alt="swivelWheels-img" class="img-fluid">
                            </div>
                            <div class="product-text-box">
                            <h4>${product.product_name_en}</h4>
                            <div class="product-price-box">
                           ${price}
                            </div>
                            </div>
                            </div>
                            </div>
                            
                            <div class="col-xl-5 col-lg-5 col-md-8 col-sm-12">
                            <div class="product-cart-box">
                            <div class="product-qty-box"><span>qty.</span>
                            <div class="form-group qty-input">
                            <input type="hidden" name="productId" value="${product.id}" />
                            <input type="text" class="form-control" value="1" name="qty" placeholder="0" id="qty">
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
                            ${product.long_description_en}
                            </div>
                            </div>
                            </div>
                            
                            
                            
                            </div>
                            </div>
                            </div>
                            </form>
                        
                        
                        `;
                        $('#product-list').append(html); 
                    }); 

                    var products = document.getElementsByClassName("product");
                    var productCount = products.length;

                    if (productCount == {{$products->total()}}) {
                    document.getElementById("load-more-button").style.display = "none";
                    }

        
                    offset += limit; // Increment the offset for the next request 
                    
                   
                },
                error: function (reject) {
                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        console.log(errors.errors);
                        $.each(errors.errors, function (key, val) {
                            
                            $("#" + key + "_error").text(val[0]);
                        });
                    }
                }

            })


        });
    });
</script>
@endsection