@extends('layouts/contentFrontLayout')


@section('content')
<style>
table{width:100%;}

</style>
<main class="content-wrapper">


<section class="breadcrumb-main">
  <div class="container-fluid">
  <div class="row">
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
  <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">home</a></li>
    @if(isset($page->id))
    <li class="breadcrumb-item"><a href="{{ route('show.page', $page->id) }}">{{$page->title}}</a></li>
    @endif
  </ol>
	</nav>
	</div>
	</div>
	</div>
	</div>
	</section>



	
	
	<section class="vent-subcategory-product-section">
	<div class="container-fluid">
	

	

    {!! $body !!}
	
	
	
	

    </div>
	
	
	
	</section>
	

<div class="space-footer-section"></div>
</main>
@endsection