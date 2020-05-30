<?php

namespace App\Http\Controllers;
use App\CuaHang;
use DB;

use Illuminate\Http\Request;

class lichdatController extends Controller
{
    //
    public function lichdat(Request $request){
    	$sdt = $request->appointment_sdt;
    	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
    	return view('datlich.lichdat', ['sdt'=>$sdt, 'thanhpho'=>$thanhpho]);
    }

    public function lichdat1(Request $request){
    }
}
