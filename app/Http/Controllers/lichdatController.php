<?php

namespace App\Http\Controllers;
use App\CuaHang;
use DB;
use App\NhanVien;

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
        $nhanvien = NhanVien::where('cuahang_id', $id_cuahang)->get();
        return view('datlich.lichdat2', ['nhanvien'=>$nhanvien]);
    }
    public function lichdat3(Request $request)
    {
        $id_nhanvien = $request->chonnhanvien;
        return view('datlich.lichdat3', ['id_nhanvien'=>$id_nhanvien]);
    }
    public function getlichdat3($id)
    {
        return view('datlich.lichdat3', ['newvar'=>$id]);
    }
}

