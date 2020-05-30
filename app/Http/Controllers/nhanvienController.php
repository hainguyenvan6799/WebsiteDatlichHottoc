<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NhanVien;

class nhanvienController extends Controller
{
    //get
    public function danhsach(){
    	$nhanvien = NhanVien::all();
    	return view('admin.nhanvien.danhsach', ['nhanvien'=>$nhanvien]);
    }
    public function getThem(){
    	return view('admin.nhanvien.them');
    }
    public function getSua($id)
    {
    	$nhanvien = NhanVien::find($id);
    	return view('admin.nhanvien.sua', ['nhanvien'=>$nhanvien]);
    }

    //post

}
