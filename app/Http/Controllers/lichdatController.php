<?php

namespace App\Http\Controllers;
use App\CuaHang;
use DB;

use Illuminate\Http\Request;

class lichdatController extends Controller
{
    //
    public function lichdat1(Request $request){
    	$sdt = $request->appointment_sdt;
    	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
    	return view('datlich.lichdat1', ['sdt'=>$sdt, 'thanhpho'=>$thanhpho]);
    }

    public function lichdat2(Request $request){
    	$id_cuahang = $request->id_cuahang;
    	session()->put('id_cuahang', $id_cuahang);
    	return view('datlich.lichdat2');
    }
}
