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
    public function postThem(Request $request){
        $this->validate($request, 
            [
                'txtTen'=>'required'
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên loại dịch vụ.'
            ]
        );
        $loaidichvu = new Loaidichvu;
        $loaidichvu->tenloai = $request->txtTen;
        $loaidichvu->tenloai_khongdau = $this->utf8tourl($request->txtTen);
        $loaidichvu->save();
        return redirect('admin/loaidichvu/danhsach')->with('thongbao', 'Thêm loại dịch vụ thành công.');
    }
    // Định dạng cho tên không dấu
    function utf8convert($str) 
    {

                if(!$str) return false;

                $utf8 = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd'=>'đ|Đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

                                                );

                foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

return $str;

    }

    function utf8tourl($text)
    {
        $text = strtolower($this->utf8convert($text));
        $text = str_replace( "ß", "ss", $text);
        $text = str_replace( "%", "", $text);
        $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
        $text = str_replace(array('%20', ' '), '-', $text);
        $text = str_replace("----","-",$text);
        $text = str_replace("---","-",$text);
        $text = str_replace("--","-",$text);
        return $text;
    }
// Định dạng cho tên không dấu

    public function postSua($id, Request $request)
    {
        $loaidichvu = Loaidichvu::find($id);
        $this->validate($request,
        [
            'txtTen'=>'required'
        ],
        [
            'txtTen.required'=>'Bạn cần nhập tên loại để chỉnh sửa.'
        ]
    );
        $loaidichvu->tenloai = $request->txtTen;
        $loaidichvu->tenloai_khongdau = $this->utf8tourl($request->txtTen);
        $loaidichvu->save();
        return redirect('admin/loaidichvu/danhsach')->with('thongbao','Sửa thông tin loại dịch vụ thành công.');
    }
}
