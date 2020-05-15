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

Route::get('/', function () {
    return view('pages.index');
});
Route::view('/index', 'pages.index');
Route::view('/about', 'pages.about');
Route::view('/blog-single', 'pages.blog-single');
Route::view('/blog', 'pages.blog');
Route::view('/contact', 'pages.contact');
Route::view('/gallery', 'pages.gallery');
Route::view('/services', 'pages.service');
Route::view('/rating', 'pages.rating');

//đăng nhập và đăng ký tài khoản để tiến hành đặt lịch
// Route::post('/signin', 'UserController@signin');
// //đăng ký nè
// Route::get('/login', 'UserController@getlogin');
// Route::post('/login', 'UserController@postlogin');
Auth::routes();

Route::get('logout', function(){
	if(Auth::check())
	{
		Auth::logout();
	}
	return redirect('/index');
});
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('test', function(){
// 	$ratings = App\Rating::all();
// 	foreach($ratings as $r)
// 	{
// 		echo $r->user->name;
// 	}
// });

//post Rating form
Route::post('postRating', 'RatingController@postRating');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'], function(){
	// Route::group(['prefix'=>'theloai'], function(){
	// 	//thêm vào danh sách thể loại
	// 	Route::get('them', 'theloaiController@getThem');
	// 	Route::post('them', 'theloaiController@postThem');

	// 	//Hiển thị danh sách thể loại
	// 	Route::get('danhsach', 'theloaiController@danhsach');

	// 	//Sửa 1 thể loại
	// 	Route::get('sua/{id}','theloaiController@getSua');
	// 	Route::post('sua/{id}','theloaiController@postSua');

	// 	//Xóa 1 thể loại
	// 	Route::get('xoa/{id}', 'theloaiController@xoa');

	// });
	// Route::group(['prefix'=>'loaisanpham'], function(){
	// 	//thêm vào danh sách loại sản phẩm
	// 	Route::get('them', 'loaisanphamController@getThem');
	// 	Route::post('them', 'loaisanphamController@postThem');

	// 	//danh sách các loại sản phẩm của cửa hàng
	// 	Route::get('danhsach', 'loaisanphamController@danhsach');

	// 	//sửa 1 loại sản phẩm
	// 	Route::get('sua/{id}', 'loaisanphamController@getSua');
	// 	Route::post('sua/{id}', 'loaisanphamController@postSua');

	// });

	Route::group(['prefix'=>'sanpham'], function(){
		// thêm vào danh sách sản phẩm
		Route::get('them', 'sanphamController@getThem');
		// Route::post('them', 'sanphamController@postThem');

		// //danh sách các loại sản phẩm
		// Route::get('danhsach', 'sanphamController@danhsach');

		// //sửa 1 sản phẩm
		// Route::get('sua/{id}', 'sanphamController@getSua');
		// Route::post('sua/{id}', 'sanphamController@postSua');
	});

	Route::group(['prefix'=>'ajax'], function(){
		Route::get('loaisanpham/{idtheloai}', 'ajaxController@getLoaisanpham');
	});
});
