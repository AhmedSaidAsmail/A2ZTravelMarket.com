<?php

// Auth 
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login/supplier','Auth_Supplier\LoginController@showLoginForm')->name('supplier.login');
Route::post('/login/supplier','Auth_Supplier\LoginController@login')->name('supplier.login');
//Auth end
Route::get('/', ['uses' => 'Web\HomeController@welcome'])->name('home');
Route::get('/allTours', ['uses' => 'Web\HomeController@allTours'])->name('allTours.show');
Route::get('/topics/{topicsName}', ['uses' => 'Web\HomeController@topicsShow'])->name('topics.show');
Route::get('Category/{city?}/{id}', ['uses' => 'Web\HomeController@citiesShow'])->name('cities.show');
Route::get('/{city}/tour/{tour}/{id}', ['uses' => 'Web\HomeController@tourShow'])->name('tour.show');
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
    // Item Details
    Route::resource('/Item/{itemID}/Detail', 'Admin\DetailsController');
    // Informations
    Route::resource('/Item/{itemID}/Information', 'Admin\ItemDetailsController');
    //gallery
    Route::resource('/Item/{itemID}/ItemGallery', 'Admin\ItemGalleryController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::delete('/Item/{itemID}/ItemGallery', 'Admin\ItemGalleryController@destroy')->name('ItemGallery.destroy');
    //price
    //Route::post('addNew', ['uses' => 'Admin\PricesController@addPrice'])->name('Item.addPrice');
    Route::resource('/Item/{itemID}/Price', 'Admin\PricesController');
    Route::resource('/Item/{itemID}/Private', 'Admin\PrivatePricesController');
    //exploration
    Route::resource('/Item/{itemID}/Exploration', 'Admin\ExplorationController');
    //topics
    Route::resource('/Topics', 'Admin\TopicsController');
    Route::resource('/Topics/{TopicId}/Gallery', 'Admin\GalleryController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::delete('/Item/{itemID}/Gallery', 'Admin\GalleryController@destroy')->name('Gallery.destroy');
    Route::resource('/Articles', 'Admin\ArticlesController');
    Route::resource('/leftsSide', 'Admin\LeftSideController');
    Route::resource('/vars', 'Admin\VarsController');
    Route::resource('/Transfers', 'Admin\TransferController');
    Route::resource('/Paypal', 'Admin\PaypalController');
    Route::resource('/Reservation', 'Admin\ReservationController');
    // Reviews
    Route::get('/Review/Show/All', ['uses' => 'ReviewController@index'])->name('review.index');
});

Auth::routes();

