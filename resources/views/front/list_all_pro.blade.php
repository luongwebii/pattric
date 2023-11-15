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
	
	
	<section class="product-category-add-section">
	<div class="container-fluid">
	<section class="add-list-category-block">
	 <div class="row">
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	 <div class="product-adding-heading">
	 <h2>Tank Vent Adapters</h2>
	 </div>
	 </div>
	  </div>

	   
	 
	<div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	
	<span onclick="openModal();currentSlide(1)" class="hover-shadow cursor"></span> 
	</div>
	<div class="product-text-box">
	<h4>Vent-211</h4>
	<h6>Adapter to replace Vent-211 with 2" Triclamp port. 304 stainless. Includes gasket.
</h6>
	<div class="product-price-box">
	<h6>price: $50.00</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	   <div class="row">
	  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	   <div class="pera-text-product">
	  <ul class="solid-main">
	  <li>Standard on our tanks</li>
	  <li>Pressure vents at 0.05 psi</li>
	  <li>Vacuum break at 0.05 psi (let air/gas into tank when tank is drained)</li>
	  <li>Max flow rate 125 GPM (Be sure the flow rate matches or exceeds the pump speed when filling/emptying)</li>
	  <li>Associated lid tube mitigates wime coming through (as with inexpensive white vents)</li>
	  <li>Easy to remove and clean</li>
	  <li>Better seal than white plastic vents</li>
	  <li>Hard grey plastic</li>
	  </ul>
	   </div>
	   </div>
	  
	  </div>
	 </div>
	 
	 
	 
	 
	 <div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>2" TC x female Adapter</h4>
	<h6>Adapter to replace Vent-211 with 2" Triclamp port.
304 stainless. Includes gasket.</h6>
	<div class="product-price-box">
	<h6>price: $120.00</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number" data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	 </div>
	 
	 
	 
	 
	 <div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Replacement rubber Gasket</h4>
	
	<div class="product-price-box">
	<h6>price: $4.00</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	 </div>
	 
	 
	 
	 </section>
	</div>
	 
	</section>
	
	
	
	<section class="product-category-add-section">
	<div class="container-fluid">
	<section class="add-list-category-block">
	 <div class="row">
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	  <div class="product-adding-heading">
	 <h2>Spray Ball</h2>
	 </div>
	 </div>
	  </div>
	   
	 
	<div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Thru-Wall Revolving Spray Ball 1.5"-2"</h4>
	<h6>These are placed through a TriClamp port on a tank.All of 
our closed top tanks have extra 2" TC port on top.</h6>
	<div class="product-price-box">
	<h6>price: $150.00</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	   <div class="row">
	  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	   <div class="pera-text-product">
	  <ul class="solid-main">
	  <li>Fits 2" TriClamp port on tank. Inlet is 1.5" Triclamp. Ball diameter 1.75". Total length 12.5" 304 stainless.</li>
	  <li>Pressure: 30 psi</li>
	  <li>Flow: 50 GPM</li>
	  <li>Cleaning diameter: 8'</li>
	  <li>Lubricate periodically with food grade silicone spray. Be sure to rinse well with water after cleaning. Always lubricate after cleaning.</li>
	  </ul>
	   </div>
	  </div>
	  
	  </div>
	 </div>
	 
	 </section>
	</div>
	 
	</section>
	
	
	
	<section class="product-category-add-section">
	<div class="container-fluid">
	<section class="add-list-category-block">
	 <div class="row">
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	 <div class="product-adding-heading">
	 <h2>Agitator</h2>
	 </div>
	  </div>
	  </div>
	   
	 
	<div class="product-deatils-outside">
	  <div class="row">
	<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Removable Agitator, 2" TriClamp</h4>
	
	<div class="product-price-box">
	<h6>price: $1895</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	  
	 </div>
	 
	 
	<div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>2" TC x female Adapter</h4>
	<h6>Adapter to replace Vent-211 with 2" Triclamp port.
304 stainless. Includes gasket.</h6>
	<div class="product-price-box">
	<h6>price: $120.00</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number" data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	 </div>
	 
	 </section>
	</div>
	 
	</section>
	
	
	
	<section class="product-category-add-section">
	<div class="container-fluid">
	<section class="add-list-category-block">
	 <div class="row">
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	 <div class="product-adding-heading">
	 <h2>Carbonation/Aeration Stone</h2>
	 </div>
	  </div>
	  </div>
	   
	 
	<div class="product-deatils-outside">
	  <div class="row">
	<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Tank Carbonation/Aeration Assembly</h4>
	
	<div class="product-price-box">
	<h6>price: $245</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	   <div class="row">
	  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
 <div class="pera-text-product">
	  <p>Complete with 1.5" TriClamp coupler, Stone, and 1/4" stainless ball valve.
St. Pat's design eliminates the leaks and assembly fuss of competitive stones. Competitive products either 1)  weld the stone to an end cap which makes cleaning difficult and flexibility impossible or 2)press the stone between two gaskets which is prone to leaks.
(Must have 1.5" TC port. Will not fit thru a 1" TC port.)</p>
	   </div>
	   </div>
	  
	  </div>
	  
	  
	 </div>
	 
	 
	 <div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Stone Only</h4>
	<h6>316 stainless, 2 micron porosity. 9.5" Length x 1" diameter. 1/2" MPT 
in one end, other end closed.</h6>
	<div class="product-price-box">
	<h6>price: $150.00</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	   <div class="row">
	  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
 <div class="pera-text-product">
	  <p>The agitator can be attached directly to the racking port of our Letina tanks without a supporting stand. 
The reinforcing ring on the racking port, a Letina innovation from nearly 20 years ago, permits this.</p>
	   </div>
	   </div>
	  
	  </div>
	 </div>
	 
	 
	 <div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Special Fitting for Carbonation/Aeration Stone</h4>
	<h6>1.5" TriClamp Coupler—1/4" MPT x 1/2" FPT
End Cap with 1/4" MPT on external face, 1/2" FPT on internal face. This is fitting used on our tank gas diffusion stone at left.
</h6>
	<div class="product-price-box">
	<h6>price: $150.00</h6>
	<div class="product-availability-box">
	<span>in stock</span>
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
                                        <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                           <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                           <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
	 </div>
	 <a href="#" class="primary-btn">Add to cart</a>
	  </div>
	  </div>
	  </div>
	  
	   
	 </div>
	 
	 <div class="row">
	  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
 <div class="pera-link-product">
	 <ul>
	 <li><a href="#" class="text-btn">How to Determine TriClamp Size</a></li>
	 <li><a href="#"  class="text-btn">How to Determine Pipe Thread Size</a></li>
	 </ul>
	   </div>
	   </div>
	  
	  </div>
	 
	 
	 
	 
	 
	 </section>
	</div>
	 
	</section>
	
	
	
	
	
	
	
	<section class="product-category-add-section">
	<div class="container-fluid">
	<section class="add-list-category-block">
	 <div class="row">
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	 <div class="product-adding-heading">
	 <div class="card-text-paragraph">
	 <h2>Rotating Arm</h2>
	 <h3>Rotating Arm for TriClamp Valve</h3>
	 <p>The original simple Rotating Arm—designed, manufactured, and introduced to the wine industry by St. Pat's.
Allows you to drain up to 8" above or below the racking valve of the tank. It is also an answer to a tank with only one valve and the lees at the valve height.</p>
	<div class="moreParagraphs">
	  <ul class="solid-main">
	  <li>Change a fixed height valve into a variable height valve Drain tank from up to 8" above or below a racking valve Drain tank from up to 8" above the lowest side wall valve. Fittings to fit 1.5" or 2" TriClamp</li>
	  <li>TC Clamp and Teflon Gasket included</li>
	  <li>Maximum pressure 2.5 bar (36 psi)</li>
	  <li>304 stainless steel. Polished finish.</li>
	  <li>Use 3/4" ID hose/tubing for chill lines.</li>
	  <li>The plates require a minimum of 4" plus the plate height. For example, the no. 12 plate needs 36" minimum of vertical space in the tank (4" + 32").</li>
	  </ul>
	 </div>
        <div class="overlay"></div>
	     </div>
   
    <div class="more">
        <button id="loadMore">
            
        </button>
    </div>

	  </div>
	 
	 
	 
	  </div>
	    </div>
	 
	<div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>RA150 1.5"</h4>
	<h6>Includes 1.5" TC Clamp and teflon gasket</h6>
	<div class="product-price-box">
	<h6>price: $205</h6>
	<div class="product-availability-box">
	<span>In stock</span>
	</div>
	</div>
	</div>
	</div>
	  </div>
	  
	  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
	 <div class="add-schematic-add-cart-box">
	 <a href="#" class="text-btn">Click for Schematic</a>
	  </div>
	  </div>
	  </div>
	  
	  
	 </div>
	 
	 
	 
	 
	 <div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>RA200 2"</h4>
	<h6>Includes 2 " TC Clamp and teflon gasket</h6>
	<div class="product-price-box">
	<h6>price: $79</h6>
	<div class="product-availability-box">
	<span>In stock</span>
	</div>
	</div>
	</div>
	</div>
	  </div>
	  
	  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
	 <div class="add-schematic-add-cart-box">
	 <a href="#" class="text-btn">Click for Schematic</a>
	  </div>
	  </div>
	  </div>
	  
	  
	 </div>
	 </div>
	 
	 </section>
	</div>
	 
	</section>
	
	
	
	
	
	
	
	<section class="product-category-add-section">
	<div class="container-fluid">
	<section class="add-list-category-block">
	 <div class="row">
	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	 <div class="product-adding-heading">
	 <h2>Letina Cooling Plates----arriving January</h2>
	 <h3>For small tanks and bins</h3>
	  <ul class="solid-main">
	  <li>Easily installed into lids of variable capacity tanks. No welding needed.</li>
	  <li>You need a 1-1/8" bimetal hole saw (Home Depot etc) to drill 2 holes in lid.</li>
	  <li>Maximum pressure 2.5 bar (36 psi)</li>
	  <li>304 stainless steel. Polished finish.</li>
	  <li>Use 3/4" ID hose/tubing for chill lines.</li>
	  <li>The plates require a minimum of 4" plus the plate height. For example, the no. 12 plate needs 36" minimum of vertical space in the tank (4" + 32").</li>
	  </ul>
	 </div>
	  </div>
	    </div>
	 
	<div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Plate no. 12</h4>
	<h6>32" x 15", for >600 liter tank</h6>
	<div class="product-price-box">
	<h6>price: $205</h6>
	<div class="product-availability-box">
	<span class="out-stock-text">Out of stock</span> <span class="arriving-date">arriving January</span>
	</div>
	</div>
	</div>
	</div>
	  </div>
	  
	  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	 <div class="add-schematic-add-cart-box">
	 <a href="#" class="text-btn">Click for Schematic</a>
	  </div>
	  </div>
	  </div>
	  
	  
	 </div>
	 
	 
	 
	 
	 <div class="product-deatils-outside">
	  <div class="row">
	 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	 <div class="product-deatils-box">
	<div class="product-img-box">
	<img src="img/swivelwheels-img-new.png" alt="swivelwheels-img-new">
	</div>
	<div class="product-text-box">
	<h4>Plate no. 01</h4>
	<h6>24" x10.5", for 300-600 liter tank</h6>
	<div class="product-price-box">
	<h6>price: $165</h6>
	<div class="product-availability-box">
	<span class="out-stock-text">Out of stock</span> <span class="arriving-date">arriving January</span>
	</div>
	</div>
	</div>
	</div>
	  </div>
	  
	  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	 <div class="add-schematic-add-cart-box">
	 <a href="#" class="text-btn">Click for Schematic</a>
	  </div>
	  </div>
	  </div>
	  
	  
	 </div>
	 </div>
	 
	 </section>
	</div>
	 
	</section>
	
	<div class="space-footer-section"></div>
</main>
@endsection