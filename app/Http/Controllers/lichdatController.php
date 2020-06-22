<?php

namespace App\Http\Controllers;
use App\CuaHang;
use DB;
use App\NhanVien;
use App\LichDat;
use App\Dichvu;
use App\lichlamviec_nhanvien;
use Illuminate\Http\Request;
use App\Http\Controllers\CalendarController;
use Carbon\Carbon;


class lichdatController extends Controller
{
    //
    public function lichdat1(){
    	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
    	return view('datlich.lichdat1', ['thanhpho'=>$thanhpho]);
    }

    public function lichdat2($id_cuahang){
        $nhanvien = NhanVien::where('cuahang_id', $id_cuahang)->get();
        return view('datlich.lichdat2', ['nhanvien'=>$nhanvien]);
    }
    public function lichdat3($id_nhanvien)
    {
        $dichvu = Dichvu::all();
        return view('datlich.lichdat3', ['id_nhanvien'=>$id_nhanvien, 'dichvu'=>$dichvu]);
    }

    public function formBooking(Request $request){
        $datebook = $request->datebook;
        $tenkhachhang = $request->ten;
        $id_nhanvien = $request->id_nhanvien;
        $timeslot = $request->timeslot;
        $id_cuahang = session()->get('id_cuahang');
        $email = $request->email;
        $sdt = session()->get('sdt');
        $id_dichvu = $request->id_dichvu;

        $lichdat = new LichDat;
        $lichdat->nhanvien_id = $id_nhanvien;
        $lichdat->tenkhachhang = $tenkhachhang;
        $lichdat->dichvu_id = $id_dichvu;
        $lichdat->thoigian = $timeslot;
        $lichdat->id_cuahang = $id_cuahang;
        $lichdat->hienthi = 1;
        $lichdat->save();

        return redirect('/')->with('<script>alert("Đặt lịch thành công.");</script>');

    }

    //admin
    public function getDanhsach(){
        $lichdat = LichDat::all();
        return view('admin.lichdat.danhsach', ['lichdat'=>$lichdat]);
    }

    public function getThem(){
        $lichdat = LichDat::all();
        $cuahang = CuaHang::all();
        return view('admin.lichdat.them', ['lichdat'=>$lichdat, 'cuahang'=>$cuahang]);
    }

    public function postThem(Request $request)
    {
        $lichdat = new LichDat;
        $lichdat->tenkhachhang = $request->txtTen;
        $lichdat->nhanvien_id = $request->chonnhanvien;
        $lichdat->dichvu_id = 1;
        $lichdat->ngay = $request->chon_ngaylamviec;
        $lichdat->thoigian = $request->chon_khunggio;
        $lichdat->id_cuahang = $request->chon_cuahang;
        $lichdat->hienthi = 1;
        $lichdat->save();
        return redirect()->route('lichdat/getDanhsach')->with('thongbao', 'Thêm mới lịch đặt thành công.');
    }

    public function getXoa($id){
        $lichdat = LichDat::find($id);
        $lichdat->hienthi = 0;
        $lichdat->save();
        return redirect()->route('lichdat/getDanhsach')->with('thongbao', 'Xóa lịch đặt thành công.');
    }

    public function getSua($id)
    {
        $lichdat = LichDat::find($id);
        $cuahang = CuaHang::all();
        return view('admin.lichdat.sua', ['lichdat'=>$lichdat, 'cuahang'=>$cuahang]);
    }
    public function postSua(Request $request, $id)
    {
        $lichdat = LichDat::find($id);
        $lichdat->tenkhachhang = $request->txtTen;
        $lichdat->nhanvien_id = $request->chonnhanvien;
        $lichdat->dichvu_id = 1;
        $lichdat->ngay = $request->chon_ngaylamviec;
        $lichdat->thoigian = $request->chon_khunggio;
        $lichdat->id_cuahang = $request->chon_cuahang;
        $lichdat->hienthi = 1;
        $lichdat->save();
        return redirect()->route('lichdat/getDanhsach')->with('thongbao', 'Sửa lịch đặt thành công.');
    }


    // -------------------////////////////////////////////
    public function getNhanvienCuahang($id_cuahang)
    {
        $nhanvien = NhanVien::where('cuahang_id', $id_cuahang)->get();
        echo '<select id="chonnhanvien" name="chonnhanvien"><option>Chọn nhân viên</option>';
        foreach($nhanvien as $nv){
          echo '<option value="'.$nv->id.'">'.$nv->user->name .' - ' . $nv->id.'</option>';
        }  
        echo '</select>';


        //phần script
        echo '<script type="text/javascript">$("#chonnhanvien").on("change", function(){
                $.get("getLichlamviecNhanvien/"+$(this).val(), function(data){
                    $("#chon_lichlamviecnhanvien").html(data);
                });
            });</script>';
    }
    public function getLichlamviecNhanvien($id_nhanvien)
    {
        $lichlamviec = lichlamviec_nhanvien::where('nhanvien_id', $id_nhanvien)->get();
        echo '<select id="chon_ngaylamviec" data-idnv="'.$id_nhanvien.'" name="chon_ngaylamviec"><option>Chọn ngày làm việc</option>';
            foreach($lichlamviec as $llv)
            {   
                if($llv->ngay >= date('Y-m-d H:i:s')){
                    echo '<option value="'.$llv->ngay.'">'.$llv->ngay.'</option>';
                }
            }
        echo '</select>';

        //phần script
        echo '<script type="text/javascript">
            $("#chon_ngaylamviec").on("change", function(){
                $.get("getKhunggio/"+$(this).val()+"/"+$(this).attr("data-idnv"), function(data){
                    $("#chon_khunggio").html(data);
                });
            });
        </script>';
    }

    public function getKhunggio($ngay, $idnv){
        $duration = 60;
        $cleanup = 0;
        $giolamviec = lichlamviec_nhanvien::where('nhanvien_id', $idnv)->where('ngay', $ngay)->get();
        if(!$giolamviec)
        {
          $start = '0:0';
          $end = '0:0';
        }
        foreach($giolamviec as $g)
        {
          $start = $g->start_time;
          $end = $g->stop_time;
        }

        $timeslot = CalendarController::timeslot($duration, $cleanup, $start, $end);
        echo '<select name="chon_khunggio">';
        foreach($timeslot as $t)
        {
            $giolamviec_daduocdangky = LichDat::where('nhanvien_id', $idnv)->where('ngay', $ngay)->where('thoigian', $t)->get()->toArray();
            if($t > Carbon::now('Asia/Ho_Chi_Minh')->hour || $ngay != Carbon::now())
            {
                if(!$giolamviec_daduocdangky)
                {
                    echo '<option value="'.$t.'">'.$t.'</option>';
                }
                
            }
        }
        echo '</select>';
    }
}

