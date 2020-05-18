<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loaisanpham;
use App\Sanpham;

class LoaisanphamController extends Controller
{
    //
    public function danhsach(){
    	$loaisanpham = Loaisanpham::all();
    	return view('admin.loaisanpham.danhsach');
    }
    public function getThem(){
    	return view('admin.loaisanpham.them');
    }
    public function getSua($id)
    {
    	$loaisanpham = Loaisanpham::find($id);
    	return view('admin.loaisanpham.sua', ['loaisanpham'=>$loaisanpham]);
    }
}
