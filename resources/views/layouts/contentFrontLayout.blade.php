<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'St. Patricks of Texas')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}?x=4" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <!-- Core theme CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />

    <!-- Core theme CSS -->
    <link href="{{ asset('assets/css/style-guide.css') }}" rel="stylesheet" />

    <!-- Awesome Fonts -->
    <link href="{{ asset('assets/vendor/font-awesome/css/fontawesome-all.min.css') }} " rel="stylesheet"
        type="text/css">

    <!-- Scroll Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/scroll-style.css') }}" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{!! url('assets/css/custome.css') !!}?x=@php echo time(); @endphp" />
    <!-- Include Styles -->
    {{--custom css item suggest search--}}
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    .ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;}  
    .ui-widget {
        font-family: 'Barlow', sans-serif;
        font-weight: 500;
        font-size: 16px;
    }
</style>

    <!-- Include Scripts for customizer, helper, analytics, config -->
    @include('layouts/sections/scriptsIncludes')
    <script>
          var freight_only;
    </script>
</head>

<body>
    <!-- Layout Content -->
    @yield('layoutContent')

    @include('layouts/frontend/navbar')
    <!--/ Layout Content -->
    @yield('content')
    <div id="miniCart"></div>
    @include('layouts/frontend/footer')
    <!-- Include Scripts -->
    @include('layouts/sections/scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $("#autocomplete-input-search").autocomplete({
                source: "{{ route('search.page.autocomplete') }}",
                select: function( event, ui ) {
                    event.preventDefault();
                  
                }
            });
        });

        // start product view with Modal
        function productView(id) {
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function (data) {
                    $('#pname').text(data.product.product_name_en);
                    $('#pcode').text(data.product.product_code);
                    $('#category').text(data.product.category.category_name_en);
                    $('#brand').text(data.product.brand.brand_name_en);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);

                    $('#product_id').val(id);
                    $('#product_qty').val(1);

                    //product price
                    if (data.product.discount_price == null) {
                        $('#price').text(data.product.selling_price);
                        $('#oldprice').text('');
                    } else {
                        $('#price').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    }

                    // product stock
                    if (data.product.product_qty > 0) {
                        $('#Outofstock').text('');
                        $('#Instock').text('In Stock');
                    } else {
                        $('#Instock').text('');
                        $('#Outofstock').text('OUT of Stock');
                    }

                    // color and size
                    $('select[name="color"]').empty();
                    $.each(data.colors_en, function (key, value) {
                        $('select[name="color"]').append('<option value=" ' + value + ' ">' + value + '</option>')
                        if (data.colors_en == "") {
                            $('#colorArea').hide()
                        } else {
                            $('#colorArea').show()
                        }
                    })
                    $('select[name="size"]').empty();
                    $.each(data.size_en, function (key, value) {
                        $('select[name="size"]').append('<option value=" ' + value + ' ">' + value + '</option>')
                        if (data.size_en == "") {
                            $('#sizeArea').hide()
                        } else {
                            $('#sizeArea').show()
                        }
                    })
                }
            })
        }
        // miniCart();
        showMiniCart();

        function miniCart() {

            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ route('getMiniCartProduct') }}",
                success: function (response) {
                    // $('span[id="cartSubTotal"]').text(response.cart_total);
                    //$('span[id="cartQty"]').text(response.cart_qty);
                    var miniCart = "";
                   
                    $.each(response.carts, function (key, value) {
                        console.log(value);
                        miniCart += `
                    <form>
                    <div class="cart-item product-summary">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="image">
                                    <a href="#"><img src="/${value.options.image}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                <div class="price">$${value.price}</div>
                                <input type="hidden" name="rowId" value="${value.rowId}" />
                                <input type="hidden" name="productId" value="${value.id}" />
                                 <input type="text" name="qty" value="${value.qty}" />
                            </div>
                            <div class="col-xs-1 action"> 
                                <button type="button" onclick="miniCartUpdate(this)" >Update</button> 
                                <button type="button" id="${value.rowId}" onclick="miniCartRemove(this)"><i class="fa fa-trash"></i> remove</button> 
                                
                                </div>
                        </div>
                    </div>
                    <!-- /.cart-item -->
                   </form>
                    <div class="clearfix"></div>
                    <hr>
                    <a href="{{ route('checkout-page') }}">Proceed to Checkout</a>
                    `;
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }


        // Add to Cart Product
        function addToCart(elem) {

            var data = jQuery(elem).closest("form").serialize();


            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: data,
                url: "{{ route('productaddToCart') }}",
                success: function (data) {
                    // miniCart()
                    // $('#closeModal').click();
                    // console.log(data)

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
                    //miniCart();
                    showMiniCart();
                }
            })
        }

        function addToCartGroup(elem) {

            var data = jQuery(elem).closest("form").serialize();


            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: data,
                url: "{{ route('productaddToCartGroup') }}",
                success: function (data) {
                    // miniCart()
                    // $('#closeModal').click();
                    // console.log(data)

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
                    //miniCart();
                    showMiniCart();
                }
            })
        }

        function showMiniCart() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ route('getMiniCartProduct') }}",
                success: function (response) {
                    // $('span[id="cartSubTotal"]').text(response.cart_total);
                    //$('span[id="cartQty"]').text(response.cart_qty);
                    $('.total-cart').text(response.cart_qty);
                    freight_only = response.freight_only;
                    if(response.cart_qty > 0) {
                        $('.empty-cart1').hide();
                    } else {
                        $('.empty-cart1').show();
                    } 
                    checkoutFunction();

                }
            })
        }

        // mini cart remove start
        function miniCartUpdate(elem) {
            var data = jQuery(elem).closest("form").serialize();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                data: data,
                url: "{{ route('updateMiniCartProduct') }}",
                success: function (data) {
                    miniCart();
                    //start message
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
                    //end message
                }
            });
        }

        // mini cart remove start
        function miniCartRemove(elem) {
            var data = jQuery(elem).closest("form").serialize();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                data: data,
                url: "{{ route('removeMiniCartProduct') }}",
                success: function (data) {
                    miniCart();
                    //start message
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
                    //end message
                }
            });
        }

        function removeRowCart(rowId) {

            $.ajax({
                type: 'GET',
                dataType: 'json',
                data: 'rowId=' + rowId,
                url: "{{ route('removeRowCart') }}",
                success: function (data) {
                    if (data.success == 'Product Remove from Cart') {
                        $('#' + rowId).remove();
                        showMiniCart();
                        $('.subtotal').text(data.data.subtotal);
                        $('.tax').text(data.data.tax);
                        $('.cart_total').text(data.data.cart_total);


                    }


                    //start message
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
                    //end message
                }
            });
        }

    function checkoutFunction(){
        if(freight_only == 1) {
            $('.credit-card-col').hide();
            $('.sub-Food1').hide();
            $('#shipping_package').val('Large Freight Shipping').change();
            
        } else {
            $('.credit-card-col').show();
            $('.sub-Food1').show();
            $('#shipping_package').val('Ground Shipping').change();
        }
    }
    // End to Cart Product
    </script>
</body>

</html>