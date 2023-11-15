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
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
	<div class="page-featured-product-box">
	<a href="#"></a>
	<div class="page-featured-product-img">
	<img src="{!! url('assets/img/sub-category-1.png') !!}" alt="sub-category-1" class="img-fluid">
	</div>
	<h5>Subcategory Name</h5>
	</div>
	</div>
	
	  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
	<div class="page-featured-product-box">
	<a href="#"></a>
	<div class="page-featured-product-img">
	<img src="{!! url('assets/img/sub-category-1.png') !!}" alt="sub-category-1" class="img-fluid">
	</div>
	<h5>Subcategory Name</h5>
	</div>
	</div>
	
	 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
	<div class="page-featured-product-box">
	<a href="#"></a>
	<div class="page-featured-product-img">
	<img src="{!! url('assets/img/sub-category-1.png') !!}" alt="sub-category-1" class="img-fluid">
	</div>
	<h5>Subcategory Name</h5>
	</div>
	</div>
	
	 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
	<div class="page-featured-product-box">
	<a href="#"></a>
	<div class="page-featured-product-img">
	<img src="{!! url('assets/img/sub-category-1.png') !!}" alt="sub-category-1" class="img-fluid">
	</div>
	<h5>Subcategory Name</h5>
	</div>
	</div>
	
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
	<div class="container-fluid">
    <div class="row no-gutters">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
	<div class="page-description-featured-product-img">
	<img src="img/air-pump-img.png" alt="air-pump-img" class="img-fluid">
	</div>
	</div>
	
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	<div class="page-description-featured-product-text">
	
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	<p> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
	</div>
	</div>

	
	</div>
	</div>
	</section>
	
	
<div class="space-footer-section"></div>
</main>
@endsection