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

    public function choncuahang($tp, $q, $lat, $lng){
        $cuahang = [];
        if($tp == 0 && $q ==0)
        {
            $cuahang = CuaHang::all();
        }
        else
        {
            $cuahang = CuaHang::where('quan', $q)->where('thanhpho', $tp)->get()->toArray();
        }
    	foreach($cuahang as $ch)
    	{
            echo '<div class="cuahang">';
    		
    		echo '<input type="radio" name="id_cuahang" id="'.$ch['id'].'" class="id_cuahang checkbox-tools" value="'.$ch['id'].'" />';
            echo '<label class="for-checkbox-tools" for="'.$ch['id'].'"><i class="uil uil-line-alt"></i><h2>'.$ch['tencuahang'].'</h2></label>';
            echo '<br>';
            $distance = $this->distanceHaversineFormula($lat, $lng, $ch['lat'], $ch['lng']);
            echo '<h2>Cách khoảng '.$distance.' km</h2>';
            echo '</div>';
    	}
    }
    public function distanceHaversineFormula($lat1, $lng1, $lat2, $lng2){
        $r = 6371;
        $l1 = $lat1*M_PI/180;
        $l2 = $lat2*M_PI/180;
        $deltaLat = ($lat2 - $lat1)*M_PI/180;
        $deltaLng = ($lng2 - $lng1)*M_PI/180;

        $a = sin($deltaLat/2)*sin($deltaLat/2)+cos($l1)*cos($l2)*sin($deltaLng/2)*sin($deltaLng/2);
        $c = 2*atan2(sqrt($a), sqrt(1-$a));
        $d = $r*$c;
        return round($d, 2);
    }
}
