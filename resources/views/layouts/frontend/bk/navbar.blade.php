<nav class="navbar navbar-expand-xl navbar-dark fixed-top">
  <a class="navbar-brand" href="/"><img src="{!! url('assets/img/St-Patricks-Texas-logo.svg') !!}" alt="dry-care-footer-logo"></a>
  
  <button  class="navbar-toggler collapsed"  type="button"   data-toggle="collapse"  data-target="#navbarCollapse"  aria-controls="navbarCollapse"  aria-expanded="false" aria-label="Toggle navigation"
  >
   
    <span class="icon-bar top-bar"></span>
				<span class="icon-bar middle-bar"></span>
				<span class="icon-bar bottom-bar"></span>
  </button>

  <div class="collapse navbar-collapse collapse show" id="navbarCollapse">
 

	 
      <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
	  
	 
      @foreach ($left_menus as $menuDataValueLeft)
        
       
        @foreach ($menuDataValueLeft->childs as $menuDataValue)
        <li class="nav-item" style="margin-bottom:15px;">
            <a class="nav-link" href="{{$menuDataValue->url}}">
              <span class="nav-link-text">{{$menuDataValue->title}}</span>
            </a>
          </li>
          @if(count($menuDataValue->childs))
		   @include('_partials.manageChildFront',['childs' => $menuDataValue->childs])
	        @endif
        @endforeach

       

       
    

      @endforeach
	   
	  
    </ul>
	
	
	<div class="form-inline ml-auto mt-2 mt-md-0">
    <form class="form-search" action="{{ route('search.page') }}"  method="get" >
    @csrf
    <input class="form-control mr-sm-2" id="autocomplete-input-search" type="text" name="name" value="{{ app('request')->input('name') }}" placeholder="Search type here..." aria-label="Search">
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><img src="{!! url('assets/img/search-icon.svg') !!}" alt="search-icon"></button>
    </form>
	
	<div class="shopping-cart-icon desktop-shopping-show"> <a href="{{ route('shopping.cart.page') }}"><img src="{!! url('assets/img/shopping-cart-icon.svg') !!}" alt="shopping-cart-icon"><span class="total-cart">0</span></a></div>
	
	 </div>
	
	
	 </div>
	
	
	
	 
	 	
	 
  </div>
  
  <div class="shopping-cart-icon mobile-shopping-show"> <a href="{{ route('shopping.cart.page') }}"><img src="{!! url('assets/img/shopping-cart-icon.svg') !!}" alt="shopping-cart-icon"><span class="total-cart">0</span></a></div>
</nav>