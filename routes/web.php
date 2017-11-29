<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/redir', 'Other\RedirectController@index')->name('redirect');
Route::get('/home', 'HomeController@index')->name('home');

/*
|-------------------------------------------------------------------------------
| Guest Route
|-------------------------------------------------------------------------------
*/
	// Page
		Route::get('/', 														'All\GuestController@index');
	// Wisata
		Route::get('/wisata', 											'All\GuestController@Wisata');					// Lokasi Wisata
		Route::get('/wisata/{slug}',								'All\GuestController@viewWisata');
		Route::get('/event',												'All\GuestController@event'); 					// Event Wisata
		Route::get('/event/{id}',										'All\GuestController@viewEvent');
		Route::get('/ticketing/add-to-cart/{id}',   'All\GuestController@ticketAddToCart');	// Cart Ticketing
	// Lokasi Wisata
		Route::get('/paket-wisata', 								'All\GuestController@paketWisata');
		Route::get('/paket-wisata/{id}', 						'All\GuestController@viewPaketWisata');
		Route::get('/paket/add-to-cart/{id}/{cp}',  'All\GuestController@paketAddToCart');

	// Shopping Cart
		Route::get('/shopping-cart', 								'All\GuestController@shoppingCart');

		Route::get('/remove-cart', 'All\GuestController@removeCart');
/*
|-------------------------------------------------------------------------------
| Member Page
|-------------------------------------------------------------------------------
*/
	// Submit Cart
	  Route::get('/checkout',     'All\MemberController@checkout');
	  Route::post('/submit-cart', 'All\MemberController@submitCart');
	// Profile
	  Route::get('/member/profile', 'All\MemberController@profile');
	  Route::get('/member/profile/edit', 'All\MemberController@editProfile');
	  Route::post('/member/profile/update', 'All\MemberController@updateProfile');
	// Account
	  Route::get('/member/account', 'All\MemberController@account');
	  Route::get('/member/account/edit', 'All\MemberController@editAccount');
	  Route::post('/member/account/update', 'All\MemberController@updateAccount');
	// Order
	  Route::get('/member/order/history', 'All\MemberController@order');
	  Route::get('/member/order/detail/{id}', 'All\MemberController@orderDetail');
	  Route::get('/member/order/payment', 'All\MemberController@payConf');
	  Route::get('/member/review/order/{id}', 'All\MemberController@reviewOrder');
	  Route::get('/member/review/guide/{id}', 'All\MemberController@reviewGuide');


/*
// |----------------------------------------------------------------------------- 
// | Administrator
// |-----------------------------------------------------------------------------
// */
	Route::get('/a/admin', 'Admin\AllAdminController@index')->name('administrator-dashboard');

	Route::get('/a/admin/kategori', 'Admin\AllAdminController@katIndex')->name('kategori-index');
	Route::post('/a/admin/kategori/store', 'Admin\AllAdminController@katStore')->name('kategori-add');
// 	Route::get('/a/admin/kategori/edit/{id}', 'Admin\AllAdminController@katEdit');
// 	Route::post('/a/admin/kategori/update/{id}', 'Admin\AllAdminController@katUpdate');

// 	Route::get('/a/admin/product', 'Admin\AllAdminController@prodIndex');
// 	Route::get('/a/admin/product/create', 'Admin\AllAdminController@prodCreate');
// 	Route::post('/a/admin/product/store', 'Admin\AllAdminController@prodStore');
// 	Route::get('/a/admin/product/show/{id}', 'Admin\AllAdminController@prodShow');
// 	Route::get('/a/admin/product/edit/{id}', 'Admin\AllAdminController@prodEdit');
// 	Route::post('/a/admin/product/update/{id}', 'Admin\AllAdminController@prodUpdate');
// 	Route::get('/a/admin/product/destroy/{id}', 'Admin\AllAdminController@prodDestroy');

// 	Route::get('/a/admin/product-event', 'Admin\AllAdminController@prodEIndex');
// 	Route::get('/a/admin/product-event/create', 'Admin\AllAdminController@prodECreate');
// 	Route::post('/a/admin/product-event/store', 'Admin\AllAdminController@prodEStore');
// 	Route::get('/a/admin/product-event/show/{id}', 'Admin\AllAdminController@prodEShow');
// 	Route::get('/a/admin/product-event/edit/{id}', 'Admin\AllAdminController@prodEEdit');
// 	Route::post('/a/admin/product-event/update/{id}', 'Admin\AllAdminController@prodEUpdate');
// 	Route::get('/a/admin/product-event/destroy/{id}', 'Admin\AllAdminController@prodEDestroy');

// 	// Paket Wisata
// 	Route::get('/a/admin/paket-wisata', 'Admin\AllAdminController@pwIndex');
// 	Route::get('/a/admin/paket-wisata/create', 'Admin\AllAdminController@pwCreate');
// 	Route::post('/a/admin/paket-wisata/store', 'Admin\AllAdminController@pwStore');
// 	Route::get('/a/admin/paket-wisata/show/{id}', 'Admin\AllAdminController@pwShow');
// 	Route::get('/a/admin/paket-wisata/edit/{id}', 'Admin\AllAdminController@pwEdit');
// 	Route::post('/a/admin/paket-wisata/update/{id}', 'Admin\AllAdminController@pwUpdate');
// 	Route::get('/a/admin/paket-wisata/destroy/{id}', 'Admin\AllAdminController@pwDestroy');

// 	Route::get('/a/admin/wisata', 'Admin\AllAdminController@wisataIndex');
// 	Route::get('/a/admin/wisata/create', 'Admin\AllAdminController@wisataCreate');
// 	Route::post('/a/admin/wisata/store', 'Admin\AllAdminController@wisataStore');
// 	Route::get('/a/admin/wisata/show/{id}', 'Admin\AllAdminController@wisataShow');
// 	Route::get('/a/admin/wisata/edit/{id}', 'Admin\AllAdminController@wisataEdit');
// 	Route::post('/a/admin/wisata/update/{id}', 'Admin\AllAdminController@wisataUpdate');
// 	Route::get('/a/admin/wisata/destroy/{id}', 'Admin\AllAdminController@wisataDestroy');

	Route::get('/a/admin/event-wisata', 'Admin\AllAdminController@eventWindex');
	Route::get('/a/admin/event-wisata/create', 'Admin\AllAdminController@eventWcreate');
	Route::post('/a/admin/event-wisata/store', 'Admin\AllAdminController@eventWstore');
	Route::get('/a/admin/event-wisata/show/{id}', 'Admin\AllAdminController@eventWshow');
	Route::get('/a/admin/event-wisata/edit/{id}', 'Admin\AllAdminController@eventWedit');
	Route::post('/a/admin/event-wisata/update/{id}', 'Admin\AllAdminController@eventWupdate');
	Route::get('/a/admin/event-wisata/destroy/{id}', 'Admin\AllAdminController@eventWdestroy');
// /*
// |----------------------------------------------------------------------------- 
// | Ticketing
// |-----------------------------------------------------------------------------
// */
// 	// Ticketing
// 		Route::get('/a/admin/ticketing', 'Admin\AllAdminController@ticketIndex');
// 		Route::get('/a/admin/ticketing/create/{id}', 'Admin\AllAdminController@ticketCreate');
// 		Route::post('/a/admin/ticketing/store/{id}', 'Admin\AllAdminController@ticketStore');
// 		Route::get('/a/admin/ticketing/show/{id}', 'Admin\AllAdminController@ticketShow');
// 		Route::get('/a/admin/ticketing/edit/{id}', 'Admin\AllAdminController@ticketEdit');
// 		Route::post('/a/admin/ticketing/update/{id}', 'Admin\AllAdminController@ticketUpdate');
// 		Route::get('/a/admin/ticketing/penjualan/{id}', 'Admin\AllAdminController@ticketPenjualan');
// 		Route::post('/a/admin/ticketing/penjualan-store/{id}', 'Admin\AllAdminController@penjualanStore');
		
// 		Route::get('/a/admin/ticketing/detail/{id}', 'Admin\AllAdminController@ticketDetail');


// 		Route::get('/a/admin/ticketing/online/{id}', 'Admin\AllAdminController@ticketOnline');
// 		Route::post('/a/admin/ticketing/online/store/{id}', 'Admin\AllAdminController@onlineStore');

// 		Route::get('/a/admin/ticketing/online-cari/{id}', 'Admin\AllAdminController@ticketOnlineCari');
// 		Route::get('/a/admin/ticketing/online-cari-post', 'Admin\AllAdminController@ticketOnlineHasil');
// 		Route::get('/a/admin/ticketing/online-cari-get', 'Admin\AllAdminController@ticketOnlineHasils');
// 		Route::get('/a/admin/ticketing/online-penjualan/{id}', 'Admin\AllAdminController@ticketOnlineIsi');
// 		Route::post('/a/admin/ticketing/penjualan-store-online/{id}', 'Admin\AllAdminController@ticketOnlinePenjualan');

// 	// Account Operator
// 		Route::get('/ot', 'Admin\AllAdminController@indexOp');
// 		Route::get('/ot/create', 'Admin\AllAdminController@createOp');
// 		Route::post('/ot/store', 'Admin\AllAdminController@storeOp');
// 		Route::get('/ot/edit/{id}', 'Admin\AllAdminController@editOp');
// 		Route::post('/ot/update/{id}', 'Admin\AllAdminController@updateOp');
// 		Route::get('/ot//destroy/{id}', 'Admin\AllAdminController@destroyOp');
// 	// Guide
// 		Route::get('/guide', 'Admin\AllAdminController@indexGuide');
// 		Route::get('/guide/create', 'Admin\AllAdminController@createGuide');
// 		Route::post('/guide/store', 'Admin\AllAdminController@storeGuide');
// 		Route::get('/guide/show/{id}', 'Admin\AllAdminController@showGuide');
// 		Route::get('/guide/edit/{id}', 'Admin\AllAdminController@editGuide');
// 		Route::post('/guide/update/{id}', 'Admin\AllAdminController@updateGuide');
// 		Route::get('/guide/destroy/{id}', 'Admin\AllAdminController@destroyGuide');

// 	Route::get('/cek/{email}/{username}', 'Admin\AllAdminController@cekPass');


// /*
// |-----------------------------------------------------------------------------
// |	Visitor
// |-----------------------------------------------------------------------------
// */
// 	Route::get('/remove-session', 'Visitor\CartController@removeS');
// 	Route::get('/remove-cart', 'Visitor\CartController@removeS');
// 	// Lokasi Wisata
// 	Route::get('/visit', 'Visitor\VisitorController@index');
// 	Route::get('/lokasi/view/{slug}', 'Visitor\VisitorController@viewLok');
	
// 	// Cart ==================================================================================
// 		Route::get('/ticketing/add-to-cart/{id}/{cp}',   'Visitor\CartController@ticketAddToCart');// Cart Ticketing
// 		Route::get('/paket-wisata/view/{slug}', 'Visitor\VisitorController@viewPaket');// Paket Wisata
// 		Route::get('/shopping-cart', 'Visitor\CartController@shoppingCart');

// 	  // Route::get('/ticketing/shopping-cart',           'Visitor\CartController@shoppingCart');
// 	  // Route::get('/ticketing/delete-cart',             'Visitor\CartController@deleteItemCart');
// 	  // Route::get('/ticketing/checkout',           		 'Visitor\UserController@checkout');
// 	  // Route::post('/submit-shopping-cart',    				 'Visitor\UserController@submitCart');
	
// 	// Cart Paket
// 		Route::get('/paket/add-to-cart/{id}/{cp}',   'Visitor\CartController@paketAddToCart');
// 	  // Route::get('/paket/shopping-cart',           'Visitor\CartController@paketShoppingCart');
	  
// 	  // Route::get('/paket/delete-cart',             'Visitor\CartController@deleteItemCart');
// 	  Route::get('/checkout',           		 'Visitor\UserController@newCheckout');
// 	  Route::post('/submit-cart',    		 'Visitor\UserController@newSubmitCart');

// 	// Profile Visitor
// 	  Route::get('user/profile', 'Visitor\UserController@userProfile')->name('user-profile');
// 	  Route::get('user/order/detail/{id}', 'Visitor\UserController@detailOrder');
// 	  Route::get('user/order/konfirmasi-pembayaran/{id}', 'Visitor\UserController@konfPay');
// 	  Route::post('user/order/konfirmasi-pembayaran/{id}', 'Visitor\UserController@konfPayPost');
