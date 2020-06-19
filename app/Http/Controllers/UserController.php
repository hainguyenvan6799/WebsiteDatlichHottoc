<?php

namespace App\Http\Controllers;
use App\User;
use App\Loaidichvu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Exception;

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

	public function danhsach(){
		$users = User::all();
		return view('admin.users.danhsach',['users'=>$users]);
	}

	public function getThem(){
		return view('admin.users.them');
	}
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'txtTen'=>'required',
			'txtEmail'=>'required|regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/',
			'txtPass'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
			'txtPassagain'=>'required|same:txtPass'
		],
		[
			'txtTen.required'=>'Bạn cần nhập thông tin về Họ và Tên',
			'txtEmail.required'=>'Bạn cần nhập email để đăng ký.',
			'txtEmail.regex'=>'Email của bạn phải có định dạng sau abc123@gmail.com',
			'txtPass.required'=>'Bạn cần nhập password.',
			'txtPass.regex'=>'Mật khẩu của bạn phải nhiều hơn 8 ký tự, có thể là chữ hoặc số.',
			'txtPassagain.required'=>'Bạn cần nhập lại mật khẩu.',
			'txtPassagain.same'=>'Nhập lại mật khẩu phải giống với mật khẩu.'
		]
	);
		$user = new User;
		$user->name = $request->txtTen;
		$user->email = $request->txtEmail;
		$user->password = bcrypt($request->txtPass);
		$user->quyen = $request->txtQuyen;
		$user->save();
		return redirect('admin/user/danhsach')->with('thongbao','Thêm mới người dùng thành công.');
	}

	public function getSua($iduser)
	{
		$user = User::find($iduser);
		return view('admin.users.sua', ['user'=>$user]);
	}
	public function postSua($iduser, Request $request)
	{
		$this->validate($request, [
			'txtTen'=>'required',
			'txtEmail'=>'required|regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/'
		],
		[
			'txtTen.required'=>'Bạn cần nhập thông tin về Họ và Tên',
			'txtEmail.required'=>'Bạn cần nhập email để đăng ký.',
			'txtEmail.regex'=>'Email của bạn phải có định dạng sau abc123@gmail.com'
		]
	);
		
	if($request->changePassword == "on")
	{
		$this->validate($request, 
			[
				'txtPass'=>'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
				'txtPassagain'=>'required|same:txtPass'
			],

			[
				'txtPass.required'=>'Bạn cần nhập password.',
				'txtPass.regex'=>'Mật khẩu của bạn phải nhiều hơn 8 ký tự, có thể là chữ hoặc số.',
				'txtPassagain.required'=>'Bạn cần nhập lại mật khẩu.',
				'txtPassagain.same'=>'Nhập lại mật khẩu phải giống với mật khẩu.'
			]
		);
	}
	$user = User::find($iduser);
		$user->name = $request->txtTen;
		$user->email = $request->txtEmail;
		$request->changePassword == "on" ? $user->password = bcrypt($request->txtPass) : $user->password;
		$user->quyen = $request->txtQuyen;
		$user->save();
		return redirect('admin/user/danhsach')->with('thongbao','Sửa thông tin người dùng thành công.');
	}

	public function getXoa($id){
		User::destroy($id);
	}
	// public function test(){
	// 	$loaidv = Loaidichvu::find(1)->get();
	// 	foreach($loaidv as $l)
	// 	{
	// 		dd($l->dichvu);
	// 	}
	// }


	//xác thực tài khoản
	public function getxacthucEmail($email){
		return view('mails.xacthucEmail', ['email'=>$email]);
	}
	public function postxacthucEmail(Request $request)
	{
		if($request->xacthucEmail == 1)
		{
			$email = $request->txtEmail;
			User::where('email', $email)->update(['active'=>1]);
			echo '<script>alert("Xác thực Email thành công.");</script>';
			echo '<script>window.location.href = "../HotToc/public/";</script>';
		}
	}
	public function getxacthucOTP(){
		return view('SDT.xacthucOTP');
	}
	public function postxacthucOTP(Request $request){
		$email = session()->has('email') ? session()->get('email') : ''; 
		$user = User::where('email', $email)->get()->toArray();
		foreach($user as $u)
		{
			if($u['code'] == $request->code)
			{
				User::where('email', $email)->update(['code'=>null, 'active'=>1]);
			}
		}
	}

	public function newtest(){
		$user = new User;
			$user->email = 'acc@gmail.com';
			$user->name = 'nguyenvanhai';
			$user->password = '123456789';
			$user->active = 0;
			$wasclean = $user->isClean();
			$result = $user->save() || $wasclean;
	}
}
