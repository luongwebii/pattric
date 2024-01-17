@extends('layouts/contentFrontLayout')


@section('content')
<style>
   .input-big {  
  transform: scale(2);
  font-size: .5em;
  height: 20.5px;
  padding: 0 0 0 5px;
  margin-left: 2.7em;  
  border-radius: 2px;
}

</style>
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


    <form class="shipping-form" method="POST" action="{{ route('checkout.store') }}">
        @csrf

        <section class="shopping-category-section">
            <div class="container-fluid">
                <div class="accordion" id="accordionExample">

                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-link"  type='button' data-toggle="collapse" data-target="#collapseOne">
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

                                                                    <td>
                                                                        <div class="form-group qty-input">
                                                                            <input type="number" class="form-control"
                                                                                name="qty[{{$cart->rowId}}]"
                                                                                value="{{$cart->qty}}" placeholder="0"
                                                                                id="qty">
                                                                        </div>
                                                                    </td>

                                                                    <td class="price-text-box">${!!
                                                                        Helper::format_numbers($cart->price) !!}</td>
                                                                    <td>
                                                                        <div class="form-group write-notes-input">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Write Notes"
                                                                                name="notes[{{$cart->rowId}}]"
                                                                                value="{{$cart->options->has('notes') ?? $cart->options->notes}}">
                                                                        </div>
                                                                    </td>

                                                                    <td><a href="javascript:void(0)"
                                                                            onclick="removeRowCart('{{$cart->rowId}}')"
                                                                            class="remove" index="{{$cart->rowId}}"><img
                                                                                src="{!! url('assets/img/close-icon.svg') !!}"
                                                                                alt="close-icon"></a></td>

                                                                </tr>
                                                                @endforeach



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </section>
                                            </div>
                                          @php
                                         
                                          $style="";
                                          if(count($carts) > 0) {
                                            $style='display:none;';
                                          }
                                                                    

                                          @endphp
                                            <div class="subtotal-section">
                                            <div class="row empty-cart empty-cart1" style="{{$style}}">

                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="">
                                                        There are no items in your order yet. Please continue shopping and add some products to your cart.
                                                </div>
                                            </div>

                                                <div class="row">

                                                    <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12"></div>
                                                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">
                                                        <table class="table-shipping-block">

                                                            <tbody>
                                                                <tr>
                                                                    <td>subtotal :</td>
                                                                    <td>$<span class="subtotal">{{$subtotal}}</span>
                                                                    </td>

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
                                <button class="btn btn-link" type='button' data-toggle="collapse" data-target="#collapseTwo">
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
                                                            <input type="text" class="form-control" id="fname"
                                                                value="{{ Auth::user()->first_name ?? ''}}"
                                                                placeholder="Enter First Name" name="first_name">
                                                            <span class="alert text-danger"
                                                                id="first_name_error"></span>

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="lname">Last name<span>*</span></label>
                                                            <input type="text" class="form-control" id="lname"
                                                                placeholder="Enter Last Name"
                                                                value="{{ Auth::user()->last_name  ?? ''}}" name="last_name">
                                                            <span class="alert text-danger" id="last_name_error"></span>

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="email">e-mail<span>*</span></label>
                                                            <input type="email" class="form-control"
                                                                value="{{ Auth::user()->email  ?? ''}}"
                                                                placeholder="Enter Email Address" name="email">
                                                            <span class="alert text-danger" id="email_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control" id="phone"
                                                                value="{{ Auth::user()->phone  ?? ''}}"
                                                                placeholder="Enter Phone Number" name="phone">
                                                            <span class="alert text-danger" id="phone_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="address">address<span>*</span></label>
                                                            <input type="text" id="billing_address" class="form-control" id="address"
                                                                value="{{ $userProfile->billing_address  ?? ''}}"
                                                                placeholder="" name="billing_address">
                                                            <span class="alert text-danger"
                                                                id="billing_address_error"></span>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="address-1">&nbsp;</label>
                                                            <input type="text" id="billing_suite" class="form-control" id="address-1"
                                                                placeholder="" value="{{ $userProfile->billing_suite  ?? ''}}"
                                                                name="billing_suite">
                                                            <span class="alert text-danger"
                                                                id="billing_suite_error"></span>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="city-name">city<span>*</span></label>
                                                            <input type="text" class="form-control" id="billing_city"
                                                                placeholder="Enter City Name"
                                                                value="{{ $userProfile->billing_city  ?? ''}}"
                                                                name="billing_city">
                                                            <span class="alert text-danger"
                                                                id="billing_city_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="country-name">country<span>*</span></label>
                                                            <div class="select-dropdown">
                                                                <select class="form-select"  id="billing_country" name="billing_country"
                                                                    aria-label="Default select example">
                                                                    <option value="">Select Country</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="MX">Mexico</option>
                                                                </select>
                                                            </div>
                                                            <span class="alert text-danger"
                                                                id="billing_country_error"></span>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="country-name">State/province<span>*</span></label>
                                                            <div class="select-dropdown">
                                                                <select class="form-select" id="billing_state" name="billing_state"
                                                                    aria-label="Default select example">
                                                                    <option value="">Select State</option>
                                                                </select>
                                                            </div>
                                                            <span class="alert text-danger"
                                                                id="billing_state_error"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                                        <div class="form-group form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="create_account" id="customSwitch1">
                                                            <label class="form-check-label"
                                                                for="customSwitch1"><span>Crete
                                                                    an account for later use</span></label>


                                                        </div>
                                                    </div>


                                                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                                        <div class="form-group form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                                name="ship_the_same" >
                                                            <label class="form-check-label" id="thesamship"
                                                                for="customSwitch2"><span>ship
                                                                    to the same address</span></label>
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
                                <button class="btn btn-link" type='button' data-toggle="collapse" id="ship-collapse" data-target="#collapseThree">
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
                                                            <input type="radio" class="form-check-input" value="1" name="shipping_quote"
                                                                id="customSwitch3">
                                                            <label class="form-check-label"
                                                                for="customSwitch3"><span>Custom
                                                                    Shipping Quote</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-check radio-btn">

                                                            <input type="radio" class="form-check-input"  value="2" name="shipping_quote"
                                                                id="customSwitch4">
                                                            <label class="form-check-label"
                                                                for="customSwitch4"><span>Local Pickup</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12"></div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="country-name">Shipping Package.<span>*</span></label>
                                                            <div class="select-dropdown">
                                                                <select class="form-select"  id="shipping_package" name="shipping_package"
                                                                    aria-label="Default select example">
                                                                    <option value="">Select Shipping</option>
                                                                    <option class="sub-Food1" value="Ground Shipping" selected>Ground Shipping</option>
                                                                    <option class="sub-Food1" value="1 Day Shipping" >1 Day Shipping</option>
                                                                    <option class="sub-Food1" value="2 Day Shipping">2 Day Shipping</option>
                                                                    <option value="Large Freight Shipping">Large Freight Shipping</option>
                                                                   
                                                                </select>
                                                            </div>
                                                            <span class="alert text-danger"
                                                                id="shipping_package_error"></span>
                                                        </div>
                                                    </div>



                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="address">address<span>*</span></label>
                                                            <input id="shipping_street" type="text" class="form-control" placeholder=""
                                                                value="{{ $userProfile->shipping_street }}"
                                                                name="shipping_street">
                                                            <span class="alert text-danger"
                                                                id="shipping_street_error"></span>

                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="address-1">&nbsp;</label>
                                                            <input type="text" id="shipping_suite" class="form-control" id="address-1"
                                                                placeholder=""
                                                                value="{{ $userProfile->shipping_suite }}"
                                                                name="shipping_suite">
                                                        </div>
                                                        <span class="alert text-danger"
                                                                id="shipping_suite_error"></span>
                                                    </div>



                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="city-name">city<span>*</span></label>
                                                            <input type="text" id="shipping_city" class="form-control" id="city-name"
                                                                placeholder="Enter City Name"
                                                                value="{{ $userProfile->shipping_city }}"
                                                                name="shipping_city">
                                                            <span class="alert text-danger"
                                                                id="shipping_city_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="country-name">country<span>*</span></label>
                                                            <div class="select-dropdown">
                                                                <select class="form-select" id="shipping_country"
                                                                    aria-label="Default select example"
                                                                    name="shipping_country">
                                                                    <option value="">Select Country</option>
                                                                    <option value="US">United States</option>
                                                                    <option value="CA">Canada</option>
                                                                    <option value="MX">Mexico</option>
                                                                </select>
                                                            </div>
                                                            <span class="alert text-danger"
                                                                id="shipping_country_error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="country-name">State/province<span>*</span></label>
                                                            <div class="select-dropdown">
                                                                <select class="form-select" id="shipping_state"
                                                                    aria-label="Default select example"
                                                                    name="shipping_state">
                                                                    <option value="">Select State</option>
                                                                   
                                                                </select>
                                                              
                                                            </div>
                                                            <span class="alert text-danger" id="shipping_state_error"></span>
                                                          
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">

                                                    <button type="button" class="btn primary-btn save-address">
                                                    SAVE AND CONTINUE
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
                            <button class="btn btn-link" type='button' id="payment-info" data-target="#collapseFour">
                                <i class="fa fa-plus"></i> <span>4. payment info</span>
                            </button>
                        </div>
                        <div class="collapse" id="collapseFour" data-parent="#accordionExample">
                            <div class="card-body">

                            <div class="table-shipping-block-section ship">Shipping: <span class="shipping-section"></span>&nbsp;&nbsp;&nbsp;SubTotal: <span class="subtotal1-section"></span>&nbsp;&nbsp;&nbsp;Tax: <span class="tax-section"></span>&nbsp;&nbsp;&nbsp;Total: <span class="total1-section"></span></div>          

                                <div class="row">
                                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                                     
                                        <div class="payment-information-section">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 credit-card-col-top">
                                                    <div class="pay-card credit-card">
                                                        <p><input type="radio" class=" payment-method" name="payment_method" id="payment_method" value="Credit Card" />  <span style="padding-left:5px;">PAY WITH CREDIT CARD</span></p>
                                                        <ul>
                                                            <li><img src="{!! url('assets/img/visa-icon.svg') !!}" alt="visa-icon"></li>
                                                            <li><img src="{!! url('assets/img/maestro-icon.svg') !!}" alt="maestro-icon"></li>
                                                            <li><img src="{!! url('assets/img/discover-icon.svg') !!}" alt="discover-icon">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                    <div class="pay-card ach-payment">
                                                        <p><input type="radio" class=" payment-method"  name="payment_method" id="payment_method" value="Check / ACH Payment" /> <span style="padding-left:5px;">  Check / ACH Payment</span></p>
                                                        
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 credit-card-col">
                                                    <div class="form-group mt-3">
                                                        <label for="name-card">Name on card<span>*</span></label>
                                                        <input type="text" class="form-control" id="name-card"
                                                            placeholder="Enter Name on Card" name="card_name">
                                                        <span class="alert text-danger" id="card_name_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 credit-card-col">
                                                    <div class="form-group">
                                                        <label for="number-card">card number<span>*</span></label>
                                                        <input type="text" class="form-control" id="number-card"
                                                            placeholder="Enter Card Number" name="card_number">
                                                        <span class="alert text-danger" id="card_number_error"></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 credit-card-col">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label for="expiration-name">expiration date</label>
                                                                <input type="text" class="form-control" id="name-card_month" maxlength='2' placeholder="Enter Month" name="card_month">
                                                                <span class="alert text-danger"
                                                                id="card_month_error"></span>                                   
                                                            </div>
                                                           
                                                        </div>


                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label for="country-name">&nbsp;</label>
                                                                <input type="text" class="form-control" id="name-card_year" maxlength='2' placeholder="Enter Year" name="card_year">
                                                                <span class="alert text-danger"
                                                                    id="card_year_error"></span>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 credit-card-col">
                                                    <div class="form-group">
                                                        <label for="cvv-card">CVV<span>*</span></label>
                                                        <input type="text" class="form-control" id="cvv-card"
                                                            placeholder="" maxlength='3' name="card_code">
                                                        <span class="alert text-danger" id="card_code_error"></span>
                                                    </div>
                                                </div>



                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3">

                                                    <button type="submit" class="btn primary-btn save-form">
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
    </form>

    <div class="space-footer-section"></div>
</main>

<script type="text/javascript">
     freight_only = {{$freight_only}};
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })


    $(document).ready(function () {

        checkoutFunction();
        
        $('.payment-method').on('change', function(e) {
            var method = this.value ;
            if(method != 'Credit Card') {
                $('.credit-card-col').hide();
                if(freight_only == 1) {
                   
                    $('.credit-card-col-top').hide();
                }
                $('.sub-Food1').hide();
            } else {
                $('.credit-card-col').show();
                $('.sub-Food1').show();
            }
          
        });
        $('#billing_country').on('change', function(e) {
             var country = this.value ;
            e.preventDefault();
            $.ajax({
                type: 'get',
                dataType: 'json',
                data: 'country='+ country,
                url: "{{ route('get.state') }}",
                success: function (data) {
                    if(data.result == 'OK') {
                        $('#billing_state').empty().append(data.txt);
                    }
                }
            });
          
        });

        $('#shipping_country').on('change', function(e) {
             var country = this.value ;
            e.preventDefault();
            $.ajax({
                type: 'get',
                dataType: 'json',
                data: 'country='+ country,
                url: "{{ route('get.state') }}",
                success: function (data) {
                    if(data.result == 'OK') {
                        $('#shipping_state').empty().append(data.txt);
                    }
                }
            });
          
        });

        
        $('#payment-info').click(function (e) {
            e.preventDefault();
            var data = $(".shipping-form").serialize();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: data,
                url: "{{ route('save.shipping') }}",
                success: function (data) {
                    
                    $('.shipping-section').text(data.shipping_package);
                    $('.subtotal1-section').text(data.sub_total);
                    $('.tax-section').text(data.tax);
                    $('.tax-section').text(data.tax);
                    $('.total1-section').text(data.cart_total);
                    
                    if(data.tax > 0){
                        $('.tax-hide').hide();
                    }
                    $('.tax-hide').hide();
                    $('#payment-info').attr('data-toggle',"collapse");
                 
                   
                   
                },
                error: function (reject) { //console.log(reject);
                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        console.log(errors);
                        //console.log(errors.errors);
                        var errorString = '<ul>';
                        $.each(errors.errors, function (key, val) {
                            console.log(val);
                            $("#" + key + "_error").text(val);
                            errorString += '<li>' + val + '</li>';
                        });
                        errorString += '</ul>';
                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 3000
                        });
                        Toast.fire({
                                type:'success',
                                title: errorString,
                            });
                    
                    }
                }

            })

        });


        $('.save-address').click(function (e) {
            e.preventDefault();
            var data = $(".shipping-form").serialize();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: data,
                url: "{{ route('save.shipping') }}",
                success: function (data) {
                    
                    $('.shipping-section').text(data.shipping_package);
                    $('.subtotal1-section').text(data.sub_total);
                    $('.tax-section').text(data.tax);
                    $('.tax-section').text(data.tax);
                    $('.total1-section').text(data.cart_total);
                  
                   
                    $('#payment-info').attr('data-toggle',"collapse");
                 
                    $('#payment-info').trigger('click');
                   
                },
                error: function (reject) { //console.log(reject);
                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        console.log(errors);
                        //console.log(errors.errors);
                        var errorString = '<ul>';
                        $.each(errors.errors, function (key, val) {
                            console.log(val);
                            $("#" + key + "_error").text(val);
                            errorString += '<li>' + val + '</li>';
                        });
                        errorString += '</ul>';
                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 3000
                        });
                        Toast.fire({
                                type:'success',
                                title: errorString,
                            });
                    
                    }
                }

            })


           
        });

        
        $('#thesamship').on('click', function() {
            var flag = $(this).closest('.form-group').find('[type=checkbox]').is(':checked');
            console.log(flag);
            if(!flag) {
                $('#shipping_street').val($('#billing_address').val());
                $('#shipping_suite').val($('#billing_suite').val());
                $('#shipping_city').val($('#billing_city').val());
                $('#shipping_country').val($('#billing_country').val());
                $('#shipping_state').val($('#billing_state').val());
                $(this).closest('.form-group').find('[type=checkbox]').prop('checked', true);
                $('#ship-collapse').trigger('click');
                
              
                var conceptName = $('#billing_country').find(":selected").val();
                var state = $('#billing_state').find(":selected").val();
                $('#shipping_country').val(conceptName);

                var $options2 = $("#billing_state > option").clone();

                $('#shipping_state').empty().append($options2);
                $('#shipping_state').val(state);


            } else {
                $(this).closest('.form-group').find('[type=checkbox]').prop('checked', false);
            }
           
        });
        
        $('.save-form').click(function (e) {
            e.preventDefault();
            var data = $(".shipping-form").serialize();


            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: data,
                url: "{{ route('checkout.store') }}",
                success: function (data) {
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }
                    window.location.href = "{{ route('home') }}";
                   
                },
                error: function (reject) { //console.log(reject);
                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        console.log(errors);
                        //console.log(errors.errors);
                        var errorString = '<ul>';
                        $.each(errors.errors, function (key, val) {
                            console.log(val);
                            $("#" + key + "_error").text(val);
                            errorString += '<li>' + val + '</li>';
                        });
                        errorString += '</ul>';
                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 3000
                        });
                        Toast.fire({
                                type:'success',
                                title: errorString,
                            });
                    
                    }
                }

            })


        });
    });

  
</script>
@endsection