<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dichvu;
use App\Loaidichvu;

class dichvuController extends Controller
{
    //get
    public function danhsach(){
    	$dichvu = Dichvu::all();
    	return view('admin.dichvu.danhsach', ['dichvu'=>$dichvu]);
    }
    public function getThem(){
    	$loaidichvu = Loaidichvu::all();
    	return view('admin.dichvu.them', ['loaidichvu'=>$loaidichvu]); 
    }
    public function getSua($iddv)
    {
    	$dichvu = Dichvu::find($iddv);
    	return view('admin.dichvu.sua', ['dichvu'=>$dichvu]);
    }
}
