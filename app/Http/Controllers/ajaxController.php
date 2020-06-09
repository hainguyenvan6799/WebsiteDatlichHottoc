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
    	$cuahang = CuaHang::where('quan', $q)->where('thanhpho', $tp)->get()->toArray();
    	foreach($cuahang as $ch)
    	{
    		echo '<h2>'.$ch['tencuahang'].'</h2>';
    		echo '<br>';
    		echo '<h3>'.$ch['sdt'].'</h3>';
    		echo '<input type="radio" name="id_cuahang" class="id_cuahang" value="'.$ch['id'].'" />';
            $distance = $this->distance($lat, $lng, $ch['lat'], $ch['lng']);
            echo '<h2>Cách khoảng '.$distance.' km</h2>';
    	}
    }
    public function distance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371;
        $latFrom = deg2rad($lat1);
        $lngFrom = deg2rad($lng1);
        $latTo = deg2rad($lat2);
        $lngTo = deg2rad($lng2);

        $latDelta = $latTo - $latFrom;
        $lngDelta = $lngTo - $lngFrom;
        $angle = 2*asin(sqrt(pow(sin($latDelta/2),2)+ cos($latFrom)*cos($latTo)*pow(sin($lngDelta/2),2)));
        $result = $angle*$earthRadius;
        return $result;
    }
}
