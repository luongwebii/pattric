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
    <li class="breadcrumb-item active" aria-current="page">Check out</li>
  </ol>
	</nav>
	</div>
	</div>
	</div>
	</div>
	</section>
	
	
	
	
	<section class="shopping-category-section">
	<div class="container-fluid">
	<div class="accordion" id="accordionExample">

		<div class="card">
			<div class="card-header">
				<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne">
					<i class="fa fa-plus"></i> <span>1. review and check out</span>
				</button>
			</div>
			<div class="collapse show" id="collapseOne" data-parent="#accordionExample">
				<div class="card-body">
				
	
	<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<div class="product-list-table">
	
	<div id="demo" class="showcase">
	<section id="examples">
	<!-- content -->
	<div id="content-8" class="content">
	<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">product list</th>
      <th scope="col">quantity</th>
      <th scope="col">total price</th>
      <th scope="col">Special Notes</th>
	  <th scope="col"></th>
    </tr>
  </thead>
  <tbody class="product-shopping-list">

  @foreach ($carts as $key => $cart)
    <tr id="{{$cart->rowId}}">
       <td>
        
        {{$cart->name}} 
      </td>
      
      <td><div class="form-group qty-input">
      <input type="text" class="form-control" name="qty[{{$cart->rowId}}]" value="{{$cart->qty}}" placeholder="0" id="qty">
      </div></td>
	  
	 <td class="price-text-box">${!! Helper::format_numbers($cart->price) !!}</td>
	 <td><div class="form-group write-notes-input">
      <input type="text" class="form-control" placeholder="Write Notes" name="notes[{{$cart->rowId}}]" value="{{$cart->options->has('notes') ?? $cart->options->notes}}" >
        </div></td>
	 
	  <td><a href="javascript:void(0)"  onclick="removeRowCart('{{$cart->rowId}}')" class="remove" index="{{$cart->rowId}}"><img src="{!! url('assets/img/close-icon.svg') !!}" alt="close-icon"></a></td>
	 
    </tr>
    @endforeach
	
	
	
	
  </tbody>
</table>
</div>
</section>
</div>

			<div class="subtotal-section">
			<div class="row">
			
			<div class="col-xl-6 col-lg-6 col-md-4 col-sm-12"></div>
			<div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">
			<table class="table-shipping-block">
			
			<tbody>
			  <tr>
				<td>subtotal :</td>
				<td>$<span class="subtotal">{{$subtotal}}</span></td>
				
			  </tr>
			  <tr>
				<td>shipping :</td>
				<td>Shipping amount will be added when the order is shipped</td>
				
			  </tr>
			  <tr>
				<td>taxes :</td>
				<td>$<span class="tax">{{$tax}}</span></td>
				
			  </tr>
			</tbody>
		  </table>			
			
			</div>
			</div>
			
			<div class="total-section">
			<div class="row">
			
			<div class="col-xl-6 col-lg-6 col-md-4 col-sm-12">
			
			<a href="/" class="text-btn">continue shopping</a>
			</div>
			
			<div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">
			
			
			<table class="table-total-block">
			
			<tbody>
			  <tr>
				<td>Total :</td>
				<td>$<span class="cart_total">{{$cart_total}}</span></td>
				
			  </tr>
			 
			 
			</tbody>
		  </table>		
			</div>
			</div>
			</div>
			
			
			
			</div>

	
	</div>
	</div>	
					
					
				</div>
			</div>
		</div>
		
		<div class="card">
			<div class="card-header">
				<button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo">
					<i class="fa fa-plus"></i> <span>2. Billing address</span>
				</button>
			</div>
			
			<div class="collapse" id="collapseTwo" data-parent="#accordionExample">
				<div class="card-body">
					<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
	<div class="billing-address-section">
	<div class="row">
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="fname">First name<span>*</span></label>
                <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
            </div>
	</div>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="lname">Last name<span>*</span></label>
                <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
            </div>
	</div>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="email">e-mail<span>*</span></label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email">
            </div>
	</div>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone">
            </div>
	</div>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="address">address<span>*</span></label>
                <input type="text" class="form-control" id="address" placeholder="" name="address">
            </div>
	</div>
	
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="address-1">&nbsp;</label>
                <input type="text" class="form-control" id="address-1" placeholder="" name="address-1">
            </div>
	</div>
	
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="city-name">city<span>*</span></label>
                <input type="text" class="form-control" id="city-name" placeholder="Enter City Name" name="city-name">
            </div>
	</div>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	<div class="form-group">
           <label for="country-name">country<span>*</span></label>
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example">
			  <option selected="">United States</option>
			  <option value="1">United States</option>
			  <option value="2">United States</option>
			  <option value="3">United States</option>
			</select>
		</div>
        </div>
	</div>

	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	<div class="form-group">
           <label for="country-name">State/province<span>*</span></label>
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example">
			  <option selected="">Massachusetts</option>
			  <option value="1">Massachusetts</option>
			  <option value="2">Massachusetts</option>
			  <option value="3">Massachusetts</option>
			</select>
		</div>
        </div>
	</div>
	</div>
	
	
	<div class="row">	
	<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
	<div class="form-group form-check">
    <input class="form-check-input" type="checkbox" name="remember" id="customSwitch1"> 
    <label class="form-check-label" for="customSwitch1"><span>Crete an account for later use</span></label>
    </div>
	</div>
	
	
	<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
	<div class="form-group form-check">
    <input class="form-check-input" type="checkbox" name="remember" id="customSwitch2"> 
    <label class="form-check-label" for="customSwitch2"><span>ship to the same address</span></label>
    </div>
	</div>
	</div>
	
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
		
		
		<div class="card">
			<div class="card-header">
				<button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree">
					<i class="fa fa-plus"></i> <span>3.Shipping Information</span>
				</button>
			</div>
			<div class="collapse" id="collapseThree" data-parent="#accordionExample">
				<div class="card-body">
					
				<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="shipping-information-section">
				<div class="row mb-4">
				
				
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	<div class="form-check radio-btn">
		<input type="radio" class="form-check-input" name="optradio" id="customSwitch3">
	 <label class="form-check-label" for="customSwitch3"><span>Custom Shipping Quote</span></label>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
<div class="form-check radio-btn">
  
    <input type="radio" class="form-check-input" name="optradio" id="customSwitch4">
	<label class="form-check-label" for="customSwitch4"><span>Local Pickup</span></label>
</div>
</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12"></div>
				
				</div>
				
				
				<div class="row">
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	<div class="form-group">
           <label for="country-name">Apply only to small package items.<span>*</span></label>
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example">
			  <option selected="">1 Day Shipping</option>
			  <option value="1">2 Day Shipping</option>
			  <option value="2">3 Day Shipping</option>
			  <option value="3">4 Day Shipping</option>
			</select>
		</div>
        </div>
	</div>
	
	
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="address">address<span>*</span></label>
                <input type="text" class="form-control" id="address" placeholder="" name="address">
            </div>
	</div>
	
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="address-1">&nbsp;</label>
                <input type="text" class="form-control" id="address-1" placeholder="" name="address-1">
            </div>
	</div>
	
	
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	 <div class="form-group">
                <label for="city-name">city<span>*</span></label>
                <input type="text" class="form-control" id="city-name" placeholder="Enter City Name" name="city-name">
            </div>
	</div>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	<div class="form-group">
           <label for="country-name">country<span>*</span></label>
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example">
			  <option selected="">United States</option>
			  <option value="1">United States</option>
			  <option value="2">United States</option>
			  <option value="3">United States</option>
			</select>
		</div>
        </div>
	</div>
	
	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
	<div class="form-group">
           <label for="country-name">State/province<span>*</span></label>
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example">
			  <option selected="">Massachusetts</option>
			  <option value="1">Massachusetts</option>
			  <option value="2">Massachusetts</option>
			  <option value="3">Massachusetts</option>
			</select>
		</div>
        </div>
	</div>
	
	</div>

	<div class="row">
	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
	
	<button type="submit" class="btn primary-btn">
               Save Address
            </button>
	
	</div>
	
				</div>
				</div>
				</div>
				</div>	
					
					
					
				</div>
			</div>
		</div>
		
		
		<div class="card">
			<div class="card-header">
				<button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour">
					<i class="fa fa-plus"></i> <span>4. payment info</span>
				</button>
			</div>
			<div class="collapse" id="collapseFour" data-parent="#accordionExample">
				<div class="card-body">
					
					
				<div class="row">
				<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
				<div class="payment-information-section">
				<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="pay-card">
				<p>PAY WITH</p>
				<ul>
				<li><img src="img/visa-icon.svg" alt="visa-icon"></li>
				<li><img src="img/maestro-icon.svg" alt="maestro-icon"></li>
				<li><img src="img/discover-icon.svg" alt="discover-icon"></li>
				</ul>
				</div>
				</div>
				</div>
				
				
				<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
				 <div class="form-group">
							<label for="name-card">Name on card<span>*</span></label>
							<input type="text" class="form-control" id="name-card" placeholder="Enter Name on Card" name="name-card">
						</div>
				</div>
	
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
				 <div class="form-group">
							<label for="number-card">card number<span>*</span></label>
							<input type="text" class="form-control" id="number-card" placeholder="Enter Card Number" name="number-card">
						</div>
				</div>
				
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
				<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-6">
				<div class="form-group">
           <label for="expiration-name">expiration date</label>
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example">
			  <option selected="">MM</option>
			  <option value="1">MM</option>
			  <option value="2">MM</option>
			  <option value="3">MM</option>
			</select>
		</div>
        </div>
				</div>
				
				
				<div class="col-xl-6 col-lg-6 col-md-6 col-6">
				<div class="form-group">
				<label for="country-name">&nbsp;</label>
          <div class="select-dropdown">
         
          <div class="select-dropdown">
			<select class="form-select" aria-label="Default select example">
			  <option selected="">YYYY</option>
			  <option value="1">YYYY</option>
			  <option value="2">YYYY</option>
			  <option value="3">YYYY</option>
			</select>
		</div>
        </div>
				</div>
				
				</div>
				</div>
				
				</div>
				
				
				
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
				 <div class="form-group">
							<label for="cvv-card">CVV<span>*</span></label>
							<input type="text" class="form-control" id="cvv-card" placeholder="" name="cvv-card">
						</div>
				</div>
				
				
				
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	
					<button type="submit" class="btn primary-btn">
							   Place Order 
							</button>
					
					</div>
				
				
				
				</div>
				</div>
				</div>	
				</div>
				
				
				
			</div>
		</div>
		
		
	</div><!-- .accordion -->
</div>
	</section>
	
	
<div class="space-footer-section"></div>
</main>
@endsection