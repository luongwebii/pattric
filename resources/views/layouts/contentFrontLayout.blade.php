<!DOCTYPE html>
<html class="light-style layout-menu-fixed layout-navbar-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title')  </title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <!-- Include Styles -->
  @include('layouts/sections/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
</head>

<body>
  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->
  @yield('content')
  <div id="miniCart"></div>

  <!-- Include Scripts -->
  @include('layouts/sections/scripts')
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    // start product view with Modal
    function productView(id){
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/'+id,
            dataType: 'json',
            success: function(data){
                $('#pname').text(data.product.product_name_en);
                $('#pcode').text(data.product.product_code);
                $('#category').text(data.product.category.category_name_en);
                $('#brand').text(data.product.brand.brand_name_en);
                $('#pimage').attr('src', '/'+data.product.product_thumbnail);

                $('#product_id').val(id);
                $('#product_qty').val(1);

                //product price
                if(data.product.discount_price == null){
                    $('#price').text(data.product.selling_price);
                    $('#oldprice').text('');
                }else{
                    $('#price').text(data.product.discount_price);
                    $('#oldprice').text(data.product.selling_price);
                }

                // product stock
                if(data.product.product_qty > 0)
                {
                    $('#Outofstock').text('');
                    $('#Instock').text('In Stock');
                }else{
                    $('#Instock').text('');
                    $('#Outofstock').text('OUT of Stock');
                }

                // color and size
                $('select[name="color"]').empty();
                $.each(data.colors_en, function(key,value){
                    $('select[name="color"]').append('<option value=" '+value+' ">'+value+'</option>')
                    if(data.colors_en == ""){
                        $('#colorArea').hide()
                    }else{
                        $('#colorArea').show()
                    }
                })
                $('select[name="size"]').empty();
                $.each(data.size_en, function(key,value){
                    $('select[name="size"]').append('<option value=" '+value+' ">'+value+'</option>')
                    if(data.size_en == ""){
                        $('#sizeArea').hide()
                    }else{
                        $('#sizeArea').show()
                    }
                })
            }
        })
    }
    miniCart();

    function miniCart(){

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: "{{ route('getMiniCartProduct') }}",
            success: function(response){
               // $('span[id="cartSubTotal"]').text(response.cart_total);
                //$('span[id="cartQty"]').text(response.cart_qty);
                var miniCart = "";
                $.each(response.carts, function(key,value){
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
    function addToCart(elem){

        var data = jQuery(elem).closest("form").serialize();
      

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: data,
            url: "{{ route('productaddToCart') }}",
            success: function(data){
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
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title:data.error,
                    })
                }
                miniCart();
            }
        })
    }

    // mini cart remove start
    function miniCartUpdate(elem){
        var data = jQuery(elem).closest("form").serialize();
        $.ajax({
            type:'GET',
            dataType: 'json',
            data: data,
            url: "{{ route('updateMiniCartProduct') }}" ,
            success: function(data){
                miniCart();
                //start message
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title:data.error,
                    })
                }
                //end message
            }
        });
    }

    // mini cart remove start
    function miniCartRemove(elem){
        var data = jQuery(elem).closest("form").serialize();
        $.ajax({
            type:'GET',
            dataType: 'json',
            data: data,
            url: "{{ route('removeMiniCartProduct') }}" ,
            success: function(data){
                miniCart();
                //start message
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title:data.error,
                    })
                }
                //end message
            }
        });
    }
    // End to Cart Product
</script>
</body>

</html>
