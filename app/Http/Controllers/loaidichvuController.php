<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaidichvu;

class loaidichvuController extends Controller
{
    //get các trang
    public function danhsach(){
    	$loaidichvu = Loaidichvu::all();
    	return view('admin.loaidichvu.danhsach', ['loaidichvu'=>$loaidichvu]);
    }
    public function getThem(){
    	return view('admin.loaidichvu.them');
    }
    public function getSua($id)
    {
    	$loaidichvu = Loaidichvu::find($id);
    	return view('admin.loaidichvu.sua', ['loaidichvu'=>$loaidichvu]);
    }

    //post dữ liệu lên các trang
}
