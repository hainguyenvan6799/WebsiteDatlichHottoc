<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
	// function signin(Request $request){
	// 	$sdt = $request->input('txtSDT');
	// 	$password = $request->input('txtPW');
	// 	if(Auth::attempt(['sdt'=>$sdt, 'password'=>$password]))
	// 	{
	// 		echo 'Yes';
	// 	}
	// 	else
	// 	{
	// 		echo 'No';
	// 	}
	// }
	// public function getlogin(){
	// 	return view('pages.login');
	// }
	// public function postlogin(Request $request)
	// {
	// 	$this->validate($request, 
	// 		[
	// 			'txtSDT'=>'required|regex:/[0-9]{10}/',
	// 			'txtPW'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
	// 			'txtRPW'=>'required|same:txtPW',
	// 			'txtE'=>'required',
	// 			'txtTen'=>'required'
	// 		],
	// 		[
	// 			'txtSDT.required' => 'Bạn cần nhập số điện thoại.',
	// 			'txtSDT.regex' => 'Số điện thoại gồm 10 chữ số.',
	// 			'txtPW.required' => 'Bạn cần nhập mật khẩu.',
	// 			'txtPW.regex' => 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm cả chữ cái và chữ số.',
	// 			'txtRPW.required' => 'Bạn cần nhập lại mật khẩu một lần nữa.',
	// 			'txtRPW.same' => 'Nhập lại mật khẩu cần phải giống mật khẩu.',
	// 			'txtE.required' => 'Bạn cần nhập email.',
	// 			'txtTen' => 'Bạn cần nhập họ và tên.'
	// 		]
	// 	);
	// 	$user = new User;
	// 	$sdt = $request->txtSDT;
	// 	$password = bcrypt($request->txtPW);
	// 	$user->sdt = $sdt;
	// 	$user->password = $password;
	// 	$user->save();
	// }
}
