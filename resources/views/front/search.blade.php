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

	<section class="product-category-section" >
	<div class="container-fluid">
	<div class="product-product-drop" style="background:none;border: 0;">
	<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<h2>Search Results</h2>

    <div class=" mt-4"></div>
    @foreach ($pages as $page)
       
       <div class="row  mt-4">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                   <h2  id="product-name"><a href="{{ route('show.page', $page->id) }}"> {{$page->title}}</a></h2>
               </div>
           </div>

      
       @endforeach
       @foreach ($categoryArray as $cataId => $cataName)
       <div class="row  mt-4">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                   <h2  id="product-name"><a href="{{ route('category.front.list', $cataId) }}"> {{$cataName}}</a></h2>
               </div>
           </div>
       @endforeach

	</div>
	</div>	
    </div>
    </div>
    </section>


    <section class="vent-subcategory-product-section" style="padding-top:10px;">
       


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