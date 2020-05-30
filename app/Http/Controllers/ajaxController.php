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

    public function choncuahang($tp, $q){
    	$cuahang = CuaHang::where('quan', $q)->where('thanhpho', $tp)->get()->toArray();
    	foreach($cuahang as $ch)
    	{
    		echo '<h2>'.$ch['tencuahang'].'</h2>';
    		echo '<br>';
    		echo '<h3>'.$ch['sdt'].'</h3>';
    		echo '<input type="hidden" name="id_cuahang" value="'.$ch['id'].'" />'
    	}
    }
}
