<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Back-end login/logout routes

// Back-end routes
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    // routes that require admin
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'users'])->name('admin.users');

    Route::get('/create', [App\Http\Controllers\UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/create', [App\Http\Controllers\UsersController::class, 'store'])->name('admin.users.store');

    Route::get('/{user}/show', [App\Http\Controllers\UsersController::class, 'show'])->name('admin.users.show');
    Route::get('/{user}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/{user}/update', [App\Http\Controllers\UsersController::class, 'update'])->name('admin.users.update');

    Route::get('/pages', [App\Http\Controllers\PageController::class, 'index'])->name('admin.pages');
    
    Route::get('/page/auto', [App\Http\Controllers\PageController::class, 'auto'])->name('admin.pages.auto');
    Route::get('/page/autoGroup', [App\Http\Controllers\PageController::class, 'autoGroup'])->name('admin.pages.auto-group');

    Route::get('/page/create', [App\Http\Controllers\PageController::class, 'create'])->name('admin.pages.create');
    Route::post('/page/create', [App\Http\Controllers\PageController::class, 'store'])->name('admin.pages.store');




    Route::get('/{page}/show', [App\Http\Controllers\PageController::class, 'show'])->name('admin.pages.show');
    Route::get('/{page}/editPage', [App\Http\Controllers\PageController::class, 'edit'])->name('admin.pages.editPage');
    Route::patch('/{page}/updatePage', [App\Http\Controllers\PageController::class, 'update'])->name('admin.pages.updatePage');


    Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.category');
    
    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/create', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.category.store');

    Route::get('/{category}/show', [App\Http\Controllers\CategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/{category}/editCategory', [App\Http\Controllers\CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('/{category}/updateCategory', [App\Http\Controllers\CategoryController::class, 'update'])->name('admin.category.update');

    Route::get('/groupProduct', [App\Http\Controllers\ProductGroupController::class, 'index'])->name('admin.groupProduct');
    
    Route::get('/groupProduct/createGroup', [App\Http\Controllers\ProductGroupController::class, 'create'])->name('admin.groupProduct.create');
    Route::post('/groupProduct/createGroup', [App\Http\Controllers\ProductGroupController::class, 'store'])->name('admin.groupProduct.store');

    Route::get('/{groupProduct}/showGroupProduct', [App\Http\Controllers\ProductGroupController::class, 'show'])->name('admin.groupProduct.show');
    Route::get('/{groupProduct}/editGroupProduct', [App\Http\Controllers\ProductGroupController::class, 'edit'])->name('admin.groupProduct.edit');
    Route::patch('/{groupProduct}/updateGroupProduct', [App\Http\Controllers\ProductGroupController::class, 'update'])->name('admin.groupProduct.update');

    Route::get('/subcategory', [App\Http\Controllers\SubCategoryController::class, 'index'])->name('admin.subcategory');
    
    Route::get('/subcategory/createSubCategory', [App\Http\Controllers\SubCategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::post('/subcategory/createSubCategory', [App\Http\Controllers\SubCategoryController::class, 'store'])->name('admin.subcategory.store');

    Route::get('/{subcategory}/showSubCategory', [App\Http\Controllers\SubCategoryController::class, 'show'])->name('admin.subcategory.show');
    Route::get('/{subcategory}/editSubCategory', [App\Http\Controllers\SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::patch('/{subcategory}/updateSubCategory', [App\Http\Controllers\SubCategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::delete('/subcategory/destroySubCategory', [App\Http\Controllers\SubCategoryController::class, 'destroy'])->name('admin.subcategory.destroy');

    Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('admin.product');
    
    Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product/create', [App\Http\Controllers\ProductController::class, 'store'])->name('admin.product.store');

    Route::get('/{product}/showDetail', [App\Http\Controllers\ProductController::class, 'show'])->name('admin.product.show');

    Route::get('/{product}/editProduct', [App\Http\Controllers\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/{product}/updateProduct', [App\Http\Controllers\ProductController::class, 'update'])->name('admin.product.update');


    Route::get('/{product}/multi-image', [App\Http\Controllers\ProductController::class, 'updateMultiImage'])->name('admin.product.edit.multi-image');
    Route::post('/product/updateMultiImageUpdate', [App\Http\Controllers\ProductController::class, 'updateMultiImageUpdate'])->name('admin.products.update.multi-image');
    Route::get('/{multiImage}/multi-image-delete', [App\Http\Controllers\ProductController::class, 'updateMultiImageDelete'])->name('admin.products.update.multi-image.delete');


    Route::post('/product/updateMultiImageStore', [App\Http\Controllers\ProductController::class, 'updateMultiImageStore'])->name('admin.products.store.multiImage');

    Route::get('/{product}/updateStock', [App\Http\Controllers\ProductController::class, 'updateStock'])->name('admin.product.stock');
    Route::post('/product/updateStockPost', [App\Http\Controllers\ProductController::class, 'updateStockUpdate'])->name('admin.product.stock.update');
    
    Route::delete('/product/destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->name('admin.product.destroy');



    // Orders routes
    //Route::resource('/orders', OrderController::class);
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('admin.orders');

    Route::get('/orders/show/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('admin.orders.show');

    Route::get('/orders/pending/index', [App\Http\Controllers\OrderController::class, 'pendingOrderIndex'])->name('pending.orders');
    Route::get('/orders/confirmed/index', [App\Http\Controllers\OrderController::class, 'confirmedOrderIndex'])->name('confirmed.orders');
    Route::get('/orders/processing/index', [App\Http\Controllers\OrderController::class, 'processingOrderIndex'])->name('processing.orders');
    Route::get('/orders/picked/index', [App\Http\Controllers\OrderController::class, 'pickedOrderIndex'])->name('picked.orders');
    Route::get('/orders/shipped/index', [App\Http\Controllers\OrderController::class, 'shippedOrderIndex'])->name('shipped.orders');
    Route::get('/orders/delivered/index', [App\Http\Controllers\OrderController::class, 'deliveredOrderIndex'])->name('delivered.orders');
    Route::get('/orders/cancel/index', [App\Http\Controllers\OrderController::class, 'cancelOrderIndex'])->name('cancel.orders');
    Route::get('/orders/return/index', [App\Http\Controllers\OrderController::class, 'returnOrderIndex'])->name('return.orders');

    Route::get('/orders/status/update/{order_id}/{status}', [OrderController::class, 'orderStatusUpdate'])->name('order-status.update');
    // Download Invoice route - admin
    Route::get('/invoice-download/{order_id}', [App\Http\Controllers\OrderController::class, 'adminInvoiceDownload'])->name('admin-invoice-download');


    Route::get('/menus', [App\Http\Controllers\MenuController::class,'index'])->name('menu.index');
    Route::get('/menus-show', [App\Http\Controllers\MenuController::class,'show'])->name('menu.show');
    Route::post('/menus', [App\Http\Controllers\MenuController::class,'store'])->name('menus.store');
    Route::post('/menus-destroy', [App\Http\Controllers\MenuController::class,'destroy'])->name('menus.remove');
    //Route::get('/menu',[App\Http\Controllers\MenuController::class,'index'])->name('menu.get');
});

// Back-end login/logout routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login',  [App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Front-end login/logout routes


Route::get('/autocomplete', [App\Http\Controllers\PageController::class, 'autocomplete'])->name('page.autocomplete');
Route::get('/autocompleteList', [App\Http\Controllers\PageController::class, 'autocompleteGroupList'])->name('page.autocompleteList');

Route::get('/autocompleteGroups', [App\Http\Controllers\PageController::class, 'autocompleteGroups'])->name('page.autocompleteGroups');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('user.logout');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('user.login');

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('user.register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])->name('user.register.submit');


// Cart page routes
Route::get('/my-cart',[CartPageController::class,'myCartView'])->name('myCartView');
Route::get('/my-cart/list',[CartPageController::class,'showmyCartList'])->name('showmyCartList');


// Cart routes
// Add to cart Product route
Route::post('/cart/data/store', [App\Http\Controllers\CartController::class,'addToCart'])->name('productaddToCart');
Route::post('/cart/data/store/group', [App\Http\Controllers\CartController::class,'addToCartGroup'])->name('productaddToCartGroup');

// mini cart product data get route
Route::get('/product/mini/cart', [App\Http\Controllers\CartController::class,'getMiniCart'])->name('getMiniCartProduct');
// remove item from mini cart route
Route::get('/minicart/product-remove', [App\Http\Controllers\CartController::class,'removeMiniCart'])->name('removeMiniCartProduct');
Route::get('/minicart/product-update', [App\Http\Controllers\CartController::class,'updateMiniCart'])->name('updateMiniCartProduct');
Route::get('/remove-row-cart-page',[App\Http\Controllers\CartController::class,'removeRowCartPage'])->name('removeRowCart');



Route::get('/checkout-page',[App\Http\Controllers\CheckoutController::class,'checkoutPage'])->name('checkout-page');
Route::post('/checkout-store',[App\Http\Controllers\CheckoutController::class, 'checkoutStore'])->name('checkout.store');


Route::get('/remove/from-cart/{rowId}',[App\Http\Controllers\CartPageController::class,'removeFromCart'])->name('removeFromCart');
Route::get('/add/in-cart/{rowId}',[App\Http\Controllers\CartPageController::class,'addQtyToCart'])->name('addQtyToCart');
Route::get('/reduce/from-cart/{rowId}',[App\Http\Controllers\CartPageController::class,'reduceQtyFromCart'])->name('reduceQtyFromCart');

Route::get('/{id}/category',[App\Http\Controllers\FrontEndController::class,'listProductCategory'])->name('category.front.list');

Route::get('/{id}/load-more-ajax',[App\Http\Controllers\FrontEndController::class,'loadMoreAjax'])->name('load.more.products');


Route::get('/shopping-cart-page',[App\Http\Controllers\FrontEndController::class,'shoppingCartPage'])->name('shopping.cart.page');

Route::get('/product-listing-page',[App\Http\Controllers\FrontEndController::class,'showAllCategory'])->name('product.listing,page');

Route::get('/{id}/page',[App\Http\Controllers\FrontEndController::class,'showPage'])->name('show.page');


Route::post('/search-store',[App\Http\Controllers\FrontEndController::class, 'search'])->name('search.page');

Route::get('/registerUser',[App\Http\Controllers\FrontEndController::class,'register'])->name('register.user');


Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');