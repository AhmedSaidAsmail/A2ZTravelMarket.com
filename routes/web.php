<?php

// Auth 
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login/supplier', 'Auth_Supplier\LoginController@showLoginForm')->name('supplier.login');
Route::post('/login/supplier', 'Auth_Supplier\LoginController@login')->name('supplier.login');
Route::post('/register/supplier', 'Auth_Supplier\RegisterController@register')->name('supplier.register');
Route::get('/logout/supplier', 'Auth_Supplier\LoginController@logout')->name('supplier.logout');
// customer login
//Route::get('/login/customer', 'Auth_Customer\LoginController@showLoginForm')->name('customer.login');
Route::post('/login/customer', 'Auth_Customer\LoginController@login')->name('customer.login');
Route::get('/logout/customer', 'Auth_Customer\LoginController@logout')->name('customer.logout');
Route::get('/register/customer', 'Auth_Customer\RegisterController@showRegistrationForm')->name('customer.register');
Route::post('/register/customer', 'Auth_Customer\RegisterController@register')->name('customer.register');
Route::get('/profile/customer', 'Auth_Customer\ProfileController@showProfileForm')->name('customer.profile');
Route::put('/profile/customer', 'Auth_Customer\ProfileController@updateProfile')->name('customer.profile');
Route::get('/profile/password', 'Auth_Customer\ProfileController@showPasswordForm')->name('customer.password');
Route::put('/profile/password', 'Auth_Customer\ProfileController@updatePassword')->name('customer.password');
Route::get('/profile/password/reset', 'Auth_Customer\ProfileController@resetPassword')->name('customer.password.reset');
Route::post('/profile/password/reset', 'Auth_Customer\ProfileController@sendResetLink')->name('customer.password.reset');
Route::get('/profile/password/reset/success', 'Auth_Customer\ProfileController@resetSuccess')->name('customer.password.reset.success');
Route::get('/profile/password/reset/email/{email}/{token}/{session_time}', 'Auth_Customer\ProfileController@resetPasswordBack')->name('customer.password.reset.back');
Route::put('/profile/password/reset/final', 'Auth_Customer\ProfileController@resetPasswordFinal')->name('customer.password.reset.final');
Route::get('/profile/my-bookings', 'Auth_Customer\ProfileController@bookings')->name('customer.bookings');
Route::get('/profile/my-bookings/items/{reservation_id}', 'Auth_Customer\ProfileController@bookingsItems')->name('customer.bookings.items');
//Auth end
Route::get('/', ['uses' => 'Web\HomeController@welcome'])->name('home');
Route::get('/quickSearch/attractions', ['uses' => 'Web\HomeController@search'])->name('home.search');
Route::get('/City/{id}', ['uses' => 'Web\CityController@show'])->name('city.show');
Route::get('/City/show/all/{id}', ['uses' => 'Web\CityController@showAll'])->name('city.show.all');
Route::get('/City/show/availability/{id}', ['uses' => 'Web\CityController@showAvailability'])->name('city.show.available');
Route::get('/Attraction/{id}', ['uses' => 'Web\AttractionController@showAttractions'])->name('attraction.show');
Route::get('/Attraction/show/all/{id}', ['uses' => 'Web\AttractionController@showAllAttractions'])->name('attraction.show.all');
Route::get('/Attraction/show/availability/{id}', ['uses' => 'Web\AttractionController@showAvailability'])->name('attraction.show.available');
Route::get('showTour/{city}/{tour}/{id}', ['uses' => 'Web\ItemsController@show'])->name('tour.show');
Route::post('/tour/{id}', ['uses' => 'Web\ItemsController@showPrices'])->name('tour.get.prices');
Route::get('/wishlist', ["uses" => 'Web\WishlistController@index'])->name('wishlist.index');
Route::get('/wishlist/add', ["uses" => 'Web\WishlistController@addToWishlist'])->name('wishlist.add');
Route::get('/wishlist/remove', ["uses" => 'Web\WishlistController@removeFromWishlist'])->name('wishlist.remove');
Route::post('/reservation/add/cart', ['uses' => 'Web\ReservationController@addToCart'])->name('reservation.cart.add');
Route::get('/reservation/cart', ['uses' => 'Web\ReservationController@showCart'])->name('reservation.cart.show');
Route::get('/reservation/cart/remove/{id}', ['uses' => 'Web\ReservationController@removeFromCart'])->name('reservation.cart.remove');
Route::get('/reservation/cart/checkout/', ['uses' => 'Web\ReservationController@showSheckoutForm'])->name('reservation.checkout');
Route::post('/reservation/cart/proceed-to-payment/', ['uses' => 'Web\ReservationController@proceedPayment'])->name('reservation.proceedPayment');
Route::get('/reservation/cart/final/', ['uses' => 'Web\ReservationController@finalProceed'])->name('reservation.final');
Route::get('/reservation/cart/final/success/{paymentId?}', ['uses' => 'Web\ReservationController@proceedSuccess'])->name('reservation.final.success');
Route::get('/reservation/cart/final/false', ['uses' => 'Web\ReservationController@proceedFalse'])->name('reservation.final.false');
// reviews 
Route::post('/reveiws/write/{id}', ['uses' => 'ReviewController@store'])->name('review.store');
Route::post('/reveiws/write', ['uses' => 'ReviewController@edit'])->name('review.edit');
Route::get('/reveiws/showall', ['uses' => 'ReviewController@showAll'])->name('review.all');


// Supllier sector 
Route::get('supplier/welcome/home', ['uses' => 'SupplierWeb\MainController@index'])->name('supplierWeb.index');
Route::get('/register/supplier', 'SupplierWeb\MainController@showRegisterForm')->name('supplier.reigister');
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
    Route::resource('/Item/Price', 'Supplier\PricesController', ['only' => ['store', 'update', 'destroy']]);
    Route::post('/Item/Price/{id}', ['uses' => 'Supplier\PricesController@updateDiscount'])->name('Price.update.discount');
    Route::resource('/reviews_supplier', 'Supplier\ReviewsController', ['only' => ['index', 'show']]);
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function() {
    Route::get('',['uses'=>'HomeController@index'])->name('welcome');
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
    Route::resource('/reviews', 'Admin\ReviewsController', ['only' => ['show', 'update', 'destroy']]);
    // Item Details
//    Route::resource('/Item/{itemID}/Detail', 'Admin\DetailsController');
    //topics
    Route::resource('/Topics', 'Admin\TopicsController');
    Route::resource('/Topics/{TopicId}/Gallery', 'Admin\GalleryController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::resource('/Articles', 'Admin\ArticlesController');
    Route::resource('/vars', 'Admin\VarsController');
    
    Route::resource('/Reservation', 'Admin\ReservationController');
    Route::resource('/suppliers','Admin\SuppliersController');
    Route::resource('/customers','Admin\CustomersControllers');
    Route::get('/Profile/changeDetails',['uses'=>'Admin\ProfileController@showProfileForm'])->name('admin.change.profile');
    Route::put('/Profile/changeDetails',['uses'=>'Admin\ProfileController@changeDetails'])->name('admin.change.profile');
    Route::resource('/Paypal', 'Admin\PaypalController');
    // Reviews
//    Route::get('/Review/Show/All', ['uses' => 'ReviewController@index'])->name('review.index');
});

Auth::routes();

