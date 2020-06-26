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
use App\CuaHang;
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
	Route::group(['prefix'=>'dashboard'], function(){
		Route::get('index', 'dashboardController@getIndex');
	});

	Route::group(['prefix'=>'loaidichvu'], function(){
		//thêm vào danh sách loại sản phẩm
		Route::get('them', 'loaidichvuController@getThem');
		Route::post('them', 'loaidichvuController@postThem');

		//danh sách các loại sản phẩm của cửa hàng
		Route::get('danhsach', 'loaidichvuController@danhsach');

		//sửa 1 loại sản phẩm
		Route::get('sua/{id}', 'loaidichvuController@getSua');
		Route::post('sua/{id}', 'loaidichvuController@postSua');

		Route::get('xoa/{id}', 'loaidichvuController@xoa');

	});

	Route::group(['prefix'=>'dichvu'], function(){
		// thêm vào danh sách sản phẩm
		Route::get('them', 'dichvuController@getThem')->name('dichvu/getThem');
		Route::post('them', 'dichvuController@postThem')->name('dichvu/postThem');

		// //danh sách các loại sản phẩm
		Route::get('danhsach', 'dichvuController@danhsach')->name('dichvu/getDanhsach');

		// //sửa 1 sản phẩm
		Route::get('sua/{id}', 'dichvuController@getSua')->name('dichvu/getSua');
		Route::post('sua/{id}', 'dichvuController@postSua')->name('dichvu/postSua');

		Route::get('xoa/{id}', 'dichvuController@getXoa')->name('dichvu/getXoa');

	});

	Route::group(['prefix'=>'lichdat'], function(){
		Route::get('them', 'lichdatController@getThem')->name('lichdat/getThem');
		Route::post('them', 'lichdatController@postThem')->name('lichdat/postThem');

		// //danh sách các loại sản phẩm
		Route::get('danhsach', 'lichdatController@getDanhsach')->name('lichdat/getDanhsach');

		// //sửa 1 sản phẩm
		Route::get('sua/{id}', 'lichdatController@getSua')->name('lichdat/getSua');
		Route::post('sua/{id}', 'lichdatController@postSua')->name('lichdat/postSua');

		Route::get('xoa/{id}', 'lichdatController@getXoa')->name('lichdat/getXoa');
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
		Route::post('them', 'LoaisanphamController@postThem');

		Route::get('sua/{id}', 'LoaisanphamController@getSua');
		Route::post('sua/{id}', 'LoaisanphamController@postSua');
	});

	Route::group(['prefix'=>'sanpham'], function(){
		Route::get('danhsach', 'sanphamController@danhsach');

		Route::get('them', 'sanphamController@getThem');
		Route::post('them', 'sanphamController@postThem');

		Route::get('sua/{id}', 'sanphamController@getSua');
		Route::post('sua/{id}', 'sanphamController@postSua');
	});

	Route::group(['prefix'=>'nhanvien'], function(){
		Route::get('danhsach', 'nhanvienController@danhsach');

		Route::get('them', 'nhanvienController@getThem');
		//Route::post('them', 'nhanvienController@postThem');

		Route::get('sua/{id}', 'nhanvienController@getSua');
		// Route::post('sua/{id}', 'nhanvienController@postSua');
	});


	Route::group(['prefix'=>'khachhang'], function(){
		Route::get('danhsach', 'khachhangController@danhsach');

		Route::get('them', 'khachhangController@getThem');
		// Route::post('them', 'khachhangController@postThem');

		Route::get('sua/{id}', 'khachhangController@getSua');
		// Route::post('sua/{id}', 'khachhangController@postSua');
	});



	// Route::group(['prefix'=>'ajax'], function(){
	// 	Route::get('loaisanpham/{idtheloai}', 'ajaxController@getLoaidichvu');
	// });
});

Route::get('test', 'UserController@test');

//Xác thực email và OTP
Route::get('/xacthucEmail/{email}', 'UserController@getxacthucEmail');
Route::post('/xacthucEmail', 'UserController@postxacthucEmail');
Route::get('/xacthucOTP', 'UserController@getxacthucOTP');
Route::post('/xacthucOTP', 'UserController@postxacthucOTP');

//newtest
Route::get('newtest', 'UserController@newtest');

Route::view('googlemap', 'googlemap');

//đặt lịch nào

Route::get('lichdat1', function(){
	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
	return view('datlich.lichdat1', ['thanhpho'=>$thanhpho]);
});

Route::get('lichdat2/{id_cuahang}', 'lichdatController@lichdat2');
Route::get('lichdat3/{id_nhanvien}', 'lichdatController@lichdat3');
Route::get('lichdat4', 'lichdatController@lichdat4');

//ajax nào các bạn
Route::get('ajax/chonthanhpho/{tp}', 'ajaxController@chonquan');
Route::get('ajax/choncuahang/{tp}/{q}/{lat}/{lng}', 'ajaxController@choncuahang');

Route::post('formBooking', 'lichdatController@formBooking');

Route::get('dbtable', function(){
	$a = DB::table('users')->get();
	foreach($a as $data)
	{
		dd($data);
	}
});


//get nhân viên của cửa hàng
Route::get('getNhanvienCuahang/{id_cuahang}', 'lichdatController@getNhanvienCuahang')->name('getNhanvienCuahang');
//get lịch làm việc của nhân viên nào đó
Route::get('getLichlamviecNhanvien/{id_nhanvien}', 'lichdatController@getLichlamviecNhanvien')->name('getLichlamviecNhanvien');
//get khung giờ làm việc của nhân viên trong ngày đó
Route::get('getKhunggio/{ngay}/{idnv}', 'lichdatController@getKhunggio')->name('getKhunggio');

Route::get('multistepform', function(){
	return view('datlich.datlichnhieubuoc');
});
Route::get('testdt', function(){
	return view('datlich.test');
});