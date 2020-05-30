<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LichDat extends Model
{
    //
    protected $table = "lichdat";

    public function khachhang(){
    	return $this->belongsTo('App\NhanVien', 'nhanvien_id', 'id');
    }

    public function nhanvien(){
    	return $this->belongsTo('App\KhachHang', 'khachhang_id', 'id');
    }
}
