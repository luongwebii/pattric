@extends('layouts/contentFrontLayout')


@section('content')

<main class="content-wrapper">


    <section class="breadcrumb-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="breadcrumb-container">
                        <nav aria-label="breadcrumb" style="display:none;">
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


    <section class="header-banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="product-banner-section">
                        <h5>Announcements/Special</h5>
                        <h1>Tank closeout! 15% Off SLPED BOTTOM</h1>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="page-featured-product-section">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
   


                @foreach ($products as $product)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="page-featured-product-box">
                        <a href="{{ route('category.front.list', $product->category_id) }}"></a>
                        <div class="page-featured-product-img">
                            <img src="{!! url($product->image ? $product->image : 'assets/img/no-image.jpg') !!}" alt="sub-category-1"
                                class="img-fluid">
                        </div>
                        <h5>{{$product->product_name_en}}</h5>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>


    <section class="page-description-product-section-heading">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h2>Air Pumps Product </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="page-description-product-section">
        
      
        {!! html_entity_decode($page->body) !!}
     
    </section>


    <div class="space-footer-section"></div>
</main>
@endsection