<?php

// Auth 
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login/supplier', 'Auth_Supplier\LoginController@showLoginForm')->name('supplier.login');
Route::post('/login/supplier', 'Auth_Supplier\LoginController@login')->name('supplier.login');
// customer login
//Route::get('/login/customer', 'Auth_Customer\LoginController@showLoginForm')->name('customer.login');
Route::post('/login/customer', 'Auth_Customer\LoginController@login')->name('customer.login');
Route::get('/logout/customer', 'Auth_Customer\LoginController@logout')->name('customer.logout');
//Auth end
Route::get('/', ['uses' => 'Web\HomeController@welcome'])->name('home');
Route::get('/Attraction/{id}', ['uses' => 'Web\AttractionController@showAttractions'])->name('attraction.show');
Route::get('/Attraction/show/all/{id}', ['uses' => 'Web\AttractionController@showAllAttractions'])->name('attraction.show.all');
Route::get('/Attraction/show/availability/{id}', ['uses' => 'Web\AttractionController@showAvailability'])->name('attraction.show.available');
Route::get('/{city}/{tour}/{id}', ['uses' => 'Web\ItemsController@show'])->name('tour.show');
Route::post('/tour/{id}',['uses' => 'Web\ItemsController@showPrices'])->name('tour.get.prices');
Route::post('/reservation/add/cart', ['uses' => 'Web\ReservationController@addToCart'])->name('reservation.cart.add');
Route::get('/reservation/cart', ['uses' => 'Web\ReservationController@showCart'])->name('reservation.cart.show');
Route::get('/reservation/cart/remove/{id}', ['uses' => 'Web\ReservationController@removeFromCart'])->name('reservation.cart.remove');
Route::get('/wishlist',["uses"=>'Web\WishlistController@index'])->name('wishlist.index');
Route::get('/wishlist/add',["uses"=>'Web\WishlistController@addToWishlist'])->name('wishlist.add');
Route::get('/wishlist/remove',["uses"=>'Web\WishlistController@removeFromWishlist'])->name('wishlist.remove');
// reviews 
Route::get('/reveiws/write/{id}', ['uses' => 'ReviewController@store'])->name('review.store');
Route::post('/reveiws/write', ['uses' => 'ReviewController@edit'])->name('review.edit');
Route::get('/reveiws/showall', ['uses' => 'ReviewController@showAll'])->name('review.all');


// Supllier sector 
Route::group(['prefix' => 'supplier', 'middleware' => 'auth:supplier'], function() {
    Route::get('', function() {
        return view('Supplier.Welcome');
    })->name('spplier.welcome');
    // Items
    Route::resource('/suItems', 'Supplier\ItemsController');
    //exploration
    Route::resource('/Item/{itemID}/Exploration', 'Supplier\ExplorationController');
    // Informations
    Route::resource('/Item/{itemID}/Information', 'Supplier\ItemDetailsController');
    //gallery
    Route::resource('/Item/{itemID}/ItemGallery', 'Supplier\ItemGalleryController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::delete('/Item/{itemID}/ItemGallery', 'Supplier\ItemGalleryController@destroy')->name('ItemGallery.destroy');
    // price section
    Route::resource('/Item/Price_Definitions', 'Supplier\PriceDefController', ['except' => ['index', 'destroy', 'show', 'edit']]);
    Route::resource('/Item/Price', 'Supplier\PricesController',['only'=>['store','update','destroy']]);
    Route::post('/Item/Price/{id}',['uses'=>'Supplier\PricesController@updateDiscount'])->name('Price.update.discount');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function() {
    Route::get('', function() {
        return view('Admin.Welcome');
    })->name('welcome');
    route::get('/Error505', function() {
        return view('Admin.Error500');
    })->name('Error505');
    //Main Category
    Route::resource('/MainCategory', 'Admin\MainCategoriesController');
    // Category
    Route::resource('Category', 'Admin\CategoriesController', ['except' => ['create', 'show']]);
    //Attraction
    Route::resource('Attraction', 'Admin\AttractionController', ['except' => ['create', 'show']]);
    //items
    Route::resource('/Items', 'Admin\ItemsController');
   Route::get('/reviews/all/{item_id?}', 'Admin\ReviewsController@index')->name('reviews.index');
    Route::resource('/reviews', 'Admin\ReviewsController',['only'=>['show','update','destroy']]);
    // Item Details
//    Route::resource('/Item/{itemID}/Detail', 'Admin\DetailsController');
    //topics
    Route::resource('/Topics', 'Admin\TopicsController');
    Route::resource('/Topics/{TopicId}/Gallery', 'Admin\GalleryController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::resource('/Articles', 'Admin\ArticlesController');
    Route::resource('/vars', 'Admin\VarsController');
    Route::resource('/Paypal', 'Admin\PaypalController');
    Route::resource('/Reservation', 'Admin\ReservationController');
    // Reviews
//    Route::get('/Review/Show/All', ['uses' => 'ReviewController@index'])->name('review.index');
});

Auth::routes();

