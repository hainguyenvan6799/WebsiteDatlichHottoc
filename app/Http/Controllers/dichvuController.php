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

    //post
    public function postThem(Request $request){
        $this->validate($request,
            [
                'txtTen'=>'required',
                'txtGia'=>'required',
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên dịch vụ.',
                'txtGia.required'=>'Bạn cần nhập giá.'
            ]
        );
        $dichvu = new Dichvu;
        $dichvu->tendichvu = $request->txtTen;
        $dichvu->gia = $request->txtGia;
        $dichvu->tendichvu_khongdau = utf8tourl($request->txtTen);
        $dichvu->id_loaidichvu = $request->txtloaidichvu;
        $dichvu->mota = $request->txtMota;
        $dichvu->luotyeuthich = 0;
        if(!$request->hasFile('filehinh'))
        {
            return redirect('admin/dichvu/them')->with('loi','Dịch vụ chưa có ảnh đại diện.');
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalName = $filehinh->getClientOriginalName();
            $extendOfFile = $filehinh->getClientOriginalExtension();
            if($extendOfFile != 'jpg' && $extendOfFile != 'png')
            {
                return redirect('admin/dichvu/them')->with('loi','Bạn chỉ được thêm file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalName;
                while(file_exists("images/dichvu/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalName;
                }
                $filehinh->move('images/dichvu/',$newname);
                $dichvu->anhdaidien = $newname;
            }
        }
        $dichvu->save();
        return redirect('admin/dichvu/danhsach')->with('thongbao','Thêm dịch vụ thành công.');
    }

    public function postSua($id, Request $request)
    {
        $this->validate($request,
            [
                'txtTen'=>'required',
                'txtGia'=>'required',
            ],
            [
                'txtTen.required'=>'Bạn cần nhập tên dịch vụ.',
                'txtGia.required'=>'Bạn cần nhập giá của dịch vụ'
            ]
        );
        $dichvu = Dichvu::find($id);
        $dichvu->tendichvu = $request->txtTen;
        $dichvu->gia = $request->txtGia;
        $dichvu->mota = $request->txtMota;
        if(!$request->hasFile('filehinh'))
        {
            $dichvu->anhdaidien = $dichvu->anhdaidien;
        }
        else
        {
            $filehinh = $request->file('filehinh');
            $originalName = $filehinh->getClientOriginalName();
            $extendOfFile = $filehinh->getClientOriginalExtension();
            if($extendOfFile != 'jpg' && $extendOfFile != 'png')
            {
                return redirect('admin/dichvu/sua/'.$id)->with('loi', 'Chỉ được phép chọn file .jpg hoặc .png');
            }
            else
            {
                $newname = str_random(4) . '_' . $originalName;
                while(file_exists("images/dichvu/".$newname))
                {
                    $newname = str_random(4) . '_' . $originalName;
                }
                $filehinh->move("images/dichvu",$newname);
                $dichvu->anhdaidien = $newname;
            }
        }
        $dichvu->save();
        return redirect('admin/dichvu/danhsach')->with('thongbao','Chỉnh sửa thông tin dịch vụ thành công.');
    }
}
