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
			<select class="form-select" aria-label="Default select example">
			  <option selected="">Variable Capacity Tank</option>
			  <option value="1">Variable Capacity Tank</option>
			  <option value="2">Variable Capacity Tank</option>
			  <option value="3">Three Name</option>
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
	

    {!! html_entity_decode($page->body) !!}
	
	
	
	
	
	
	
	
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