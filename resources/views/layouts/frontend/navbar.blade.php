<nav class="navbar navbar-expand-xl navbar-dark fixed-top">
  <a class="navbar-brand" href="/"><img src="{!! url('assets/img/St-Patricks-Texas-logo.svg') !!}" alt="dry-care-footer-logo"></a>
  
  <button  class="navbar-toggler collapsed"  type="button"   data-toggle="collapse"  data-target="#navbarCollapse"  aria-controls="navbarCollapse"  aria-expanded="false" aria-label="Toggle navigation"
  >
   
    <span class="icon-bar top-bar"></span>
				<span class="icon-bar middle-bar"></span>
				<span class="icon-bar bottom-bar"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarCollapse">
 
  
  
  
    <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
      
    @foreach ($categoryData as $categoryList)
    @if (empty($categoryList->parent_id))
      <li class="nav-item">
        <a
          class="nav-link nav-link-collapse"
          href="#"
          id="hasSubItems"
          data-toggle="collapse"
          data-target="#collapseSubItems{{$categoryList->id}}"
          aria-controls="collapseSubItems{{$categoryList->id}}"
          aria-expanded="false"
        ><span>{{$categoryList->category_name_en}}</span></a>
        @if ($categoryList->children)
        <ul class="nav-second-level collapse" id="collapseSubItems{{$categoryList->id}}" data-parent="#navAccordion">
        @foreach ($categoryList->children as $sub)  
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.front.list', $sub->id) }}">
              <span class="nav-link-text">{{$sub->category_name_en}}</span>
            </a>
          </li>
        @endforeach

        </ul>
        @endif
      </li>
      @endif
      @endforeach

      
	  
	 
	  
	  
	  
	   <li class="nav-item all-parts-link">
        <a class="nav-link" href="{{ route('product.listing,page') }}">All Parts</a>
      </li>
      
	   <li class="nav-item order-shipping-info">
        <a class="nav-link" href="{{ route('shopping.cart.page') }}">Order and Shipping Info</a>
      </li>
	  
    </ul>
	
	
	<div class="form-inline ml-auto mt-2 mt-md-0">
    <form class="form-search" action="{{ route('search.page') }}"  method="post" >
    @csrf
    <input class="form-control mr-sm-2" type="text" placeholder="Search type here..." aria-label="Search">
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><img src="{!! url('assets/img/search-icon.svg') !!}" alt="search-icon"></button>
    </form>
	
	<div class="shopping-cart-icon desktop-shopping-show"> <a href="{{ route('shopping.cart.page') }}"><img src="{!! url('assets/img/shopping-cart-icon.svg') !!}" alt="shopping-cart-icon"><span class="total-cart">0</span></a></div>
	
	 </div>
	
	
	 </div>
	
	
	
	 
	 	
	 
  </div>
  
  <div class="shopping-cart-icon mobile-shopping-show"> <a href="{{ route('shopping.cart.page') }}"><img src="{!! url('assets/img/shopping-cart-icon.svg') !!}" alt="shopping-cart-icon"><span class="total-cart">0</span></a></div>
</nav>