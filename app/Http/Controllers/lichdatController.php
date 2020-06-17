<?php

namespace App\Http\Controllers;
use App\CuaHang;
use DB;
use App\NhanVien;
use App\LichDat;

use Illuminate\Http\Request;

class lichdatController extends Controller
{
    //
    public function lichdat1(Request $request){
    	$sdt = $request->appointment_sdt;
    	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
        session()->put('sdt', $sdt);
    	return view('datlich.lichdat1', ['thanhpho'=>$thanhpho]);
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

    public function formBooking(Request $request){
        $datebook = $request->datebook;
        $tenkhachhang = $request->ten;
        $id_nhanvien = $request->id_nhanvien;
        $timeslot = $request->timeslot;
        $id_cuahang = session()->get('id_cuahang');
        $email = $request->email;
        $sdt = session()->get('sdt');
        $lichdat = new LichDat;
        $lichdat->nhanvien_id = $id_nhanvien;
        $lichdat->tenkhachhang = $tenkhachhang;
        // $dichvu_id = null;
        $lichdat->thoigian = $timeslot;
        $lichdat->id_cuahang = $id_cuahang;
        $lichdat->save();
        return redirect('/')->with('<script>alert("Đặt lịch thành công.");</script>');

    }
}

