<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loaidichvu;
use App\Dichvu;
use App\CuaHang;

class ajaxController extends Controller
{
    //
    public function chonquan($tp){
    	$quan = CuaHang::select('quan')->where('thanhpho', $tp)->distinct()->get()->toArray();
    	foreach($quan as $q)
    	{
    		echo '<option value="'.$q['quan'].'">Quận '.$q['quan'].'</option>';
    	}
    }
}
