@extends('layouts/contentFrontLayout')


@section('content')
<style>
table{width:100%;}

.page-detail ul {
  padding-left: 2rem;
}
.page-detail ul li {
  list-style: inherit;
}
.page-detail ul { 
   list-style-type: disc; 

}
.page-detail ol { 
   list-style-type: decimal; 

}
.page-detail ul ul, ol ul { 
   list-style-type: circle; 

   margin-left: 15px; 
}
.page-detail ol ol, ul ol { 
   list-style-type: lower-latin; 

   margin-left: 15px; 
}
.front-page .product-img-box{width:130px;}
.front-page .product-img-box img{width:130px;}
.front-page .product-img-box{margin-right:0;}
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



	
	
	<section class="vent-subcategory-product-section page-detail front-page">
	<div class="container-fluid">
	

	

    {!! $body !!}
	
	
	
	

    </div>
	
	
	
	</section>
	

<div class="space-footer-section"></div>
</main>
@endsection