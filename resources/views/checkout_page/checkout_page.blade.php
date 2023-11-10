@extends('layouts/contentFrontLayout')

@section('title')
    Al Araf Fashion - Checkout Page
@endsection

@section('content')
<form class="shipping-form" method="POST" action="{{ route('checkout.store') }}">
@csrf

    <div class="checkout-box ">
        <div class="row">
            <div class="col-md-4">
                <h4 class="checkout-subtitle"><b>Payment and Shipping Form</b></h4>
                    <div class="form-group">
                        <label class="info-title" for="shippingName">First Name<span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input"
                            id="first_name" placeholder="Enter your First Name here"
                            name="first_name" value="{{ Auth::user()->first_name }}">
                            @error('first_name')
                                <span class="alert text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="shippingName">Last Name<span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input"
                            id="last_name" placeholder="Enter your Last Name here"
                            name="last_name" value="{{ Auth::user()->last_name }}">
                            @error('last_name')
                                <span class="alert text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="shippingPhone">Phone<span>*</span></label>
                        <input type="phone" class="form-control unicase-form-control text-input"
                            id="phone" placeholder="Enter your phone number"
                            name="phone" value="{{ Auth::user()->phone }}">
                            @error('phone')
                                <span class="alert text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="shippingEmail">Email
                            <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input"
                            id="email" placeholder="Enter your email here"
                            name="email" value="{{ Auth::user()->email }}">
                            @error('email')
                                <span class="alert text-danger">{{ $message }}</span>
                            @enderror
                    </div>


            </div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group checkout-steps" id="accordion">
                    <!-- checkout-step-01  -->
                    <div class="panel panel-default checkout-step-01">

                        <div  class="panel-collapse ">
                            <!-- panel-body  -->
                            <div class="panel-body">
                                <div class="row">

                                    <!-- guest-login -->
                                    <div class="col-md-6 col-sm-6 already-registered-login">
                                        <h4 class="checkout-subtitle"><b>SHIPPING INFO</b></h4>

                                        

                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">Company Name <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_company_name" placeholder="Enter your email here"
                                                    name="shipping_company_name" value="{{ $userProfile->shipping_company_name }}">
                                                    @error('shipping_company_name')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">Department <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_department" placeholder="Enter your email here"
                                                    name="shipping_department" value="{{ $userProfile->shipping_department }}">
                                                    @error('shipping_department')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">Street <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_street" placeholder="Enter your email here"
                                                    name="shipping_street" value="{{ $userProfile->shipping_street }}">
                                                    @error('shipping_street')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">Apt/Suite <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_suite" placeholder="Enter your email here"
                                                    name="shipping_suite" value="{{ $userProfile->shipping_suite }}">
                                                    @error('shipping_suite')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">City <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_city" placeholder="Enter your email here"
                                                    name="shipping_city" value="{{ $userProfile->shipping_city }}">
                                                    @error('shipping_city')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">State/Province <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_state" placeholder="Enter your email here"
                                                    name="shipping_state" value="{{ $userProfile->shipping_state }}">
                                                    @error('shipping_state')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">ZIP/Postal Code <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_zip" placeholder="Enter your email here"
                                                    name="shipping_zip" value="{{ $userProfile->shipping_zip }}">
                                                    @error('shipping_zip')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">Country <span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shipping_country" placeholder="Enter your email here"
                                                    name="shipping_country" value="{{ $userProfile->shipping_country }}">
                                                    @error('shipping_country')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">Instructions <span>*</span></label>
                                                <textarea name="shipping_instructions" id="" cols="30" rows="10" class="form-control unicase-form-control text-input" id="shipping_instructions" placeholder="any Shipping notes">{{ $userProfile->shipping_instructions }}</textarea>
                                                
                                                @error('shipping_instructions')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                    </div>
                                    <!-- guest-login -->

                                    <!-- already-registered-login -->
                                    <div class="col-md-6 col-sm-6 already-registered-login">
                                        <h4 class="checkout-subtitle"><b>Billing details</b></h4>

                                        <div class="form-group">
                                            <label class="info-title" for="shippingEmail">Billing Address  <span>*</span></label>
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                id="billing_address" placeholder="Enter your email here"
                                                name="billing_address" value="{{ $userProfile->billing_address }}">
                                                @error('billing_address')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="info-title" for="shippingEmail">Billing Apt/Suite <span>*</span></label>
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                id="billing_suite" placeholder="Enter your email here"
                                                name="billing_suite" value="{{ $userProfile->billing_suite }}">
                                                @error('billing_suite')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="info-title" for="shippingEmail">Billing City <span>*</span></label>
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                id="billing_city" placeholder="Enter your email here"
                                                name="billing_city" value="{{ $userProfile->billing_city }}">
                                                @error('billing_city')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="info-title" for="shippingEmail">Billing State/Province <span>*</span></label>
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                id="billing_state" placeholder="Enter your email here"
                                                name="billing_state" value="{{ $userProfile->billing_state }}">
                                                @error('billing_state')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title" for="shippingEmail">Billing ZIP/Postal Code <span>*</span></label>
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                id="billing_zip" placeholder="Enter your email here"
                                                name="billing_zip" value="{{ $userProfile->billing_zip }}">
                                                @error('billing_zip')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                       
                                           
                                    </div>
                                    <!-- already-registered-login -->

                                </div>
                            </div>
                            <!-- panel-body  -->

                        </div><!-- row -->
                    </div>
                    <!-- checkout-step-01  -->

                </div><!-- /.checkout-steps -->
            </div>
            
            <div class="col-md-6">
                <h4 class="checkout-subtitle"><b>PAYMENT INFO</b></h4>
                <div class="form-group">
                    <label for="card_name" class="light-text">Cardholder Name as it appears on your credit card</label>
                    <input type="text" name="card_name" value="{{ old('card_name') }}" class="form-control my-input" required>
                </div>
                <div class="form-group">
                    <label for="card_number" class="light-text">Enter Credit Card Number-carefully</label>
                    <input type="tel" name="card_number" value="{{ old('card_number') }}"  class="form-control my-input" required>
                </div>
                <div class="form-group">
                    <label for="card_expired" class="light-text">Expiration (MM/YY) </label>
                    <input type="text" name="card_expired" value="{{ old('card_expired') }}"  class="form-control my-input" required>
                </div>
                <div class="form-group">
                    <label for="card_code" class="light-text">Card Security Code</label>
                    <input type="text" name="card_code" value="{{ old('card_code') }}"  class="form-control my-input" required>
                </div>

            </div>
        

            <div class="col-md-12">
                <!-- checkout-progress-sidebar -->
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                            </div>
                            <div class="___class_+?71___">
                                <ul class="nav nav-checkout-progress list-unstyled">
                                    @foreach ($carts as $item)
                                        <li>
                                            <strong>Image: </strong>
                                            <img src="{{ asset($item->options->image) }}"
                                                style="height: 50px; width: 50px;" alt="">
                                        </li>
                                        <li>
                                            <strong>Qty:</strong>
                                            {{ $item->qty }}
                                            <strong>Color:</strong>
                                            {{ $item->options->color }}
                                            <strong>Size:</strong>
                                            {{ $item->options->size }}
                                        </li>
                                    @endforeach
                                    <hr>
                                    <li>
                                        @if (Session::has('coupon'))
                                            <strong>SubTotal: </strong> ${{ $cart_total }}
                                            <hr>
                                            <strong>Coupon Name: </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            ( {{ session()->get('coupon')['coupon_discount'] }} %)
                                            <hr>
                                            <strong>Coupon Discount:
                                            </strong>(-)${{ session()->get('coupon')['discount_amount'] }}
                                            <hr>
                                            <strong>Grand Total: </strong>${{ session()->get('coupon')['total_amount'] }}
                                            <hr>
                                        @else
                                            <strong>SubTotal: </strong> ${{ $cart_total }}
                                            <hr>
                                            <strong>Grand Total: </strong> ${{ $cart_total }}
                                            <hr>
                                        @endif

                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- checkout-progress-sidebar -->

            </div>
            <hr>
            <button type="submit" class="btn btn-primary checkout-page-button">Order
                Confirm</button>
            
        </div><!-- /.row -->
    </div>
</form>
@section('script')

    <script type="text/javascript">
            $(document).ready(function() {
                $('select[name="division_id"]').on('change', function(){
                    var division_id = $(this).val();
                    if(division_id) {
                        $.ajax({
                            url: "{{  url('/division/district/ajax') }}/"+division_id,
                            type:"GET",
                            dataType:"json",
                            success:function(data) {
                                $('select[name="state_id"]').html('');
                                var d =$('select[name="district_id"]').empty();
                                    $.each(data, function(key, value){
                                        $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                                    });
                            },
                        });
                    } else {
                        alert('danger');
                    }
                });
            });
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function(){
                var district_id = $(this).val();
                if(district_id) {
                    $.ajax({
                        url: "{{  url('/district/state/ajax') }}/"+district_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="state_id"]').empty();
                                $.each(data, function(key, value){
                                    $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                                });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
@endsection
