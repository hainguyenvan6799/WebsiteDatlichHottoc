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
	Route::group(['prefix'=>'loaidichvu'], function(){
		//thêm vào danh sách loại sản phẩm
		Route::get('them', 'loaidichvuController@getThem');
		// Route::post('them', 'loaidichvuController@postThem');

		//danh sách các loại sản phẩm của cửa hàng
		Route::get('danhsach', 'loaidichvuController@danhsach');

		//sửa 1 loại sản phẩm
		Route::get('sua/{id}', 'loaidichvuController@getSua');
		// Route::post('sua/{id}', 'loaisanphamController@postSua');

	});

	Route::group(['prefix'=>'dichvu'], function(){
		// thêm vào danh sách sản phẩm
		Route::get('them', 'dichvuController@getThem');
		// Route::post('them', 'sanphamController@postThem');

		// //danh sách các loại sản phẩm
		Route::get('danhsach', 'dichvuController@danhsach');

		// //sửa 1 sản phẩm
		Route::get('sua/{id}', 'dichvuController@getSua');
		// Route::post('sua/{id}', 'sanphamController@postSua');
	});

	Route::group(['prefix'=>'user'], function(){
		Route::get('danhsach', 'UserController@danhsach');

		Route::get('them', 'UserController@getThem');
		Route::post('them', 'UserController@postThem');

		Route::get('sua/{iduser}', 'UserController@getSua');
		Route::post('sua/{iduser}', 'UserController@postSua');

		Route::get('xoa/{id}' , 'UserController@getXoa');
	});

	Route::group(['prefix'=>'loaisanpham'], function(){
		Route::get('danhsach', 'LoaisanphamController@danhsach');

		Route::get('them', 'LoaisanphamController@getThem');

		Route::get('sua/{id}', 'LoaisanphamController@getSua');
	});

	Route::group(['prefix'=>'sanpham'], function(){
		Route::get('danhsach', 'sanphamController@danhsach');

		Route::get('them', 'sanphamController@getThem');

		Route::get('sua/{id}', 'sanphamController@getSua');
	});

	// Route::group(['prefix'=>'ajax'], function(){
	// 	Route::get('loaisanpham/{idtheloai}', 'ajaxController@getLoaidichvu');
	// });
});

Route::get('test', 'UserController@test');
