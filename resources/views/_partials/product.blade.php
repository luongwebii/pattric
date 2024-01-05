<form>
<div class="product-deatils-outside">
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
            <div class="product-deatils-box">
                <div class="product-img-box">
                    <img src="{!! url($product->image ? $product->image : 'assets/img/no-image.jpg') !!}" alt="swivelwheels-img-new">

                    <span onclick="openModal();currentSlide(1)"
                        class="hover-shadow cursor"></span>
                </div>
                <div class="product-text-box">
                    <h4>{{ $product->product_name_en}}</h4>
                    <h6>{{ $product->model}}
                    </h6>
                    <div class="product-price-box">
                        @if(empty($product->sale_price))
                        <h6>price: ${{ Helper::format_numbers_2($product->price)}}</h6>
                        @else
                        <h6 class="text-deco">price: ${{ Helper::format_numbers_2($product->price)}}</h6>
                        <h6 class="text-top">price: ${{ Helper::format_numbers_2($product->sale_price)}}</h6>
                        @endif
                      
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
                            <button type="button" class="quantity-left-minus btn btn-number"
                                data-type="minus" data-field="">
                                <i class="fas fa-minus"></i>
                            </button>
                        </span>
                        <input type="hidden" name="productId" value="{{ $product->id}}" />
                        <input type="text" id="quantity" name="quantity"
                            class="form-control input-number" value="1"  name="qty" min="1" max="100">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-number"
                                data-type="plus" data-field="">
                                <i class="fas fa-plus"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <a href="#" class="primary-btn"  onclick="addToCart(this)" >Add to cart</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="pera-text-product">
                {!! html_entity_decode($product->long_description_en) !!}
            </div>
        </div>

    </div>
</div>
</form>