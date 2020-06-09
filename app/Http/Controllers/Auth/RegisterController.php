<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\SendCode;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'sdt'=>$data['sdt'],
            'quyen'=>0,
            'active'=>0,
            'password' => Hash::make($data['password']),
        ]);
    }
    public function register(Request $request){
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        if($request->xacthuc == 'email')
        {
            $data = array(
                'name'=>$request->name,
                'message'=>'Vui lòng nhấn vào đường link để xác thực Email.',
                'email'=>$request->email
            );
            if(Mail::to($request->email)->send(new SendMail($data))){
                echo '<script>Vui lòng kiểm tra email để xác nhận đăng ký.</script>';
            }
        }
        elseif($request->xacthuc == 'sdt')
        {
            $code = SendCode::sendcode($request->sdt);
            User::where('sdt',$request->sdt)->update(['code'=>$code]);
            session()->put('email', $request->email);
            return redirect('xacthucOTP');
        }
    }
}
