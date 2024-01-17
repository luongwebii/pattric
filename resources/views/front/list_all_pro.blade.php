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
    @foreach ($categoryData as $categoryDataValua)
    <!-- category -->
    @if(count($categoryDataValua->products))
    <section class="product-category-add-section">
        <div class="container-fluid">
            <section class="add-list-category-block">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="product-adding-heading">
                            <h2>{{$categoryDataValua->category_name_en}}</h2>
                        </div>
                    </div>
                </div>

                <!-- product -->
                @foreach ($categoryDataValua->products as $product)
                <form>
                <div class="product-deatils-outside">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <div class="product-deatils-box">
                                <div class="product-img-box">
                                    <img src="{!! url($product->image ? $product->image : 'assets/img/no-image.jpg') !!}" alt="swivelwheels-img-new">

                                    <span onclick="openModal();currentSlide(1)" class="hover-shadow cursor"></span>
                                </div>
                                <div class="product-text-box">
                                    <h4>{{ $product->product_name_en}}</h4>
                                    <h6>{!! html_entity_decode($product->short_description_en) !!} 
                                    </h6>
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

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="add-product-add-cart-box">
                                <div class="product-add-cart-btn">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn btn-number"
                                                data-type="minus" data-field="">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </span>
                                        <input type="hidden" name="productId" value="{{ $product->id}}" />
                                        <input type="text" id="quantity" name="qty" 
                                            class="form-control input-number" value="1" min="1" max="100">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-number"
                                                data-type="plus" data-field="">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <a href="javascript:void(0);"  @if($product->product_qty > 0) onclick="addToCart(this)" @endif class="primary-btn">Add to cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="pera-text-product">
                                <ul class="solid-main">
                                    <li>{!! html_entity_decode($product->long_description_en) !!}</li>
                                   
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end product -->
                </form>
                @endforeach


         


         


            </section>
        </div>

    </section>
    @endif
	@endforeach
  <!-- end category -->



    <div class="space-footer-section"></div>
</main>
@endsection