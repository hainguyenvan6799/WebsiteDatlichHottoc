<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loaisanpham;
use App\Sanpham;

class sanphamController extends Controller
{
    //
    public function danhsach(){
    	$loaisanpham = Sanpham::all();
    	return view('admin.sanpham.danhsach');
    }
    public function getThem(){
    	return view('admin.sanpham.them');
    }
    public function getSua($id)
    {
    	$sanpham = Sanpham::find($id);
    	return view('admin.sanpham.sua', ['sanpham'=>$sanpham]);
    }
}
