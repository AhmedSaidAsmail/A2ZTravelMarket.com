<?php

// Auth 
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login/supplier', 'Auth_Supplier\LoginController@showLoginForm')->name('supplier.login');
Route::post('/login/supplier', 'Auth_Supplier\LoginController@login')->name('supplier.login');
//Auth end
Route::get('/', ['uses' => 'Web\HomeController@welcome'])->name('home');
Route::get('/Attraction/{id}', ['uses' => 'Web\AttractionController@showAttractions'])->name('attraction.show');
Route::get('/Attraction/show/all/{id}', ['uses' => 'Web\AttractionController@showAllAttractions'])->name('attraction.show.all');
Route::get('/Attraction/show/availability/{id}', ['uses' => 'Web\AttractionController@showAvailability'])->name('attraction.show.available');
Route::get('/{city}/{tour}/{id}', ['uses' => 'Web\ItemsController@show'])->name('tour.show');
Route::post('/tour/{id}',['uses' => 'Web\ItemsController@showPrices'])->name('tour.get.prices');
//old
Route::get('/allTours', ['uses' => 'Web\HomeController@allTours'])->name('allTours.show');
Route::get('/topics/{topicsName}', ['uses' => 'Web\HomeController@topicsShow'])->name('topics.show');
Route::get('Category/{city?}/{id}', ['uses' => 'Web\HomeController@citiesShow'])->name('cities.show');
Route::post('/add-to-cart/{id}', ['uses' => 'Web\HomeController@addToCart'])->name('add.to.cart');
Route::get('my-cart', ['uses' => 'Web\HomeController@cartShow'])->name('cart');
route::get('/my-cart/remove/{id}', ['uses' => 'Web\HomeController@removeFromCart'])->name('remove.from.cart');
Route::get('/my-cart/check-out', ['uses' => 'Web\HomeController@checkOut'])->name('Web.checkout');
Route::post('/my-cart/fianlCheckOut', ['uses' => 'Web\HomeController@finalCheckOut'])->name('finalCheckOut');
Route::get('/search-items/result', ['uses' => 'Web\HomeController@searchItems'])->name('Web.searchItems');
Route::get('/search-transfer-dist', ['uses' => 'Web\HomeController@searchDist'])->name('searchDist');
Route::get('/booking-done', ['uses' => 'Web\HomeController@bookingDone'])->name('bookingDone');
Route::get('/getDays/{id}', ['uses' => 'Web\HomeController@getDays'])->name('getDays');
Route::get('/hotDeals', ['uses' => 'Web\HomeController@hotDealsShow'])->name('hotDeals');
Route::get('/transfer', ['uses' => 'Web\HomeController@transferShow'])->name('transfersShow');
//transfer
Route::post('/add-transfer-to-cart', ['uses' => 'Web\HomeController@addTransferToCart'])->name('add.transfer.to.cart');
Route::get('transfer/all', ['uses' => 'Web\TransferController@transferAllShow'])->name('trnafsre.all');
Route::get('transfer/{id}', ['uses' => 'Web\TransferController@transferOneShow'])->name('trnafsre.one');
Route::post('transfer/get', ['uses' => 'Web\TransferController@transferGetOne'])->name('transfer.get');
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

