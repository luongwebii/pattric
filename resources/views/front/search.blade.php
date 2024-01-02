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
                                <li class="breadcrumb-item"><a href="#">product category</a></li>

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
                                    <select class="form-select" aria-label="Default select example"
                                        onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                        <option value="">Select Option</option>
                                        @foreach ($pages as $page1)
                                        <option value="{{ route('show.page', $page1->id) }}">{{$page1->title}}</option>
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
	<section class="product-category-section" >
	<div class="container-fluid">
	<div class="product-product-drop" style="background:none;border: 0;">
	<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<h2>Search Results</h2>
	</div>
	</div>	
    </div>
    </div>
    </section>


    <section class="vent-subcategory-product-section" style="padding-top:10px;">
       



        @foreach ($categoryArray as $cataName => $products)
            <section class="product-category-add-section">
                <div class="container-fluid">
                    <section class="add-list-category-block">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="product-adding-heading">
                                    <h2>{{$cataName}}</h2>
                                </div>
                            </div>
                        </div>


                        @foreach ($products as  $product)
                        

                        @include('_partials/product')
                       
                        @endforeach


                    </section>
                </div>

            </section>
        @endforeach

        
        @foreach ($resultGroups as $group)

        <section class="vent-subcategory-product-section">
	    <div   div class="container-fluid">
        <form>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h2  id="product-name">{{$group['value']}}</h2>
                </div>
            </div>
            <section id="examples" class="order-form-product-list-table ">
                <!-- content -->
                <div id="content-8" class="content">

                    <table class="table table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Model</th>
                                <th scope="col">Price</th>
                                <th scope="col">buy qty.</th>
                                <th scope="col">drawing</th>
                                <th scope="col">orient.</th>
                                <th scope="col">area SM</th>
                                <th scope="col">bottom butter.</th>
                                <th scope="col">racking butter.</th>


                            </tr>
                        </thead>
                        <tbody class="group-content">

                        @foreach ($group['products'] as  $product)
                        <tr>
                        <td>{{$product->model}}</td>
                        <td>

                        @if(empty($product->sale_price))
                        <span>price: ${{ Helper::format_numbers_2($product->price)}}</span>
                        @else
                        <span class="text-deco">price: ${{ Helper::format_numbers_2($product->price)}}</span>
                        <span class="text-top">price: ${{ Helper::format_numbers_2($product->sale_price)}}</span>
                        @endif

                        </td>
                        <td>
                            <div class="form-group qty-input">
                            <input type="hidden" name="productIds[]" value="{{$product->id}}" id="productId"/>
                                <input type="text" class="form-control	"  value="1" name="qtys[]"  placeholder="0" id="qty">
                            </div>
                        </td>
                        <td class="dra-link"><a href="#">{{$product->drawing}}</a></td>
                        <td>{{$product->orient}}</td>
                        <td>{{$product->area_sm}}</td>
                        <td>{{$product->bottom_butter}}</td>
                        <td>{{$product->racking_butter}}</td>
                        </tr>
                        
                       
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </section>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="add-cart-box">
                        <a href="javascript:void(0);" onclick="addToCartGroup(this)" class="primary-btn">Add to cart</a>
                    </div>
                </div>
            </div>
        </form>
        </div>

        </section>
        @endforeach





        @foreach ($pages as $page)
        <section class="vent-subcategory-product-section">
        <div class="container-fluid">
        <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h2  id="product-name">{{$page1->title}}</h2>
                </div>
            </div>

        

        {!! html_entity_decode($page->body) !!}
        
        
        
        

        
        </div>
        
        
        </section>
        @endforeach

        @if($flag)
        <section class="vent-subcategory-product-section">
       



      
          
               <div class="container-fluid">
                 
                       <div class="row">
                           <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                               <div class="product-adding-heading">
                                   <h3>There were no results for your search words. Please try again. Or click the menu to browse items. </h3>
                               </div>
                           </div>
                       </div>
                
               </div>   
          
        
        </section>
        @endif





    </section>


    <div class="space-footer-section"></div>
</main>
@endsection