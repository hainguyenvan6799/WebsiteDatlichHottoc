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
    public function lichdat1(Request $request){
    	$sdt = $request->appointment_sdt;
    	$thanhpho = CuaHang::select('thanhpho')->distinct()->get()->toArray();
        session()->put('sdt', $sdt);
    	return view('datlich.lichdat1', ['thanhpho'=>$thanhpho]);
    }

    public function lichdat2(Request $request){
        $id_cuahang = $request->id_cuahang;
        session()->put('id_cuahang', $id_cuahang);
        $nhanvien = NhanVien::where('cuahang_id', $id_cuahang)->get();
        return view('datlich.lichdat2', ['nhanvien'=>$nhanvien]);
    }
    public function lichdat3(Request $request)
    {
        $dichvu = Dichvu::all();
        $id_nhanvien = $request->chonnhanvien;
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
    public function getNhanvienCuahang($id_cuahang)
    {
        $nhanvien = NhanVien::where('cuahang_id', $id_cuahang)->get();
        echo '<select id="chonnhanvien"><option>Chọn nhân viên</option>';
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
        echo '<select id="chon_ngaylamviec" data-idnv="'.$id_nhanvien.'"><option>Chọn ngày làm việc</option>';
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
        echo '<select>';
        foreach($timeslot as $t)
        {
            $giolamviec_daduocdangky = LichDat::where('nhanvien_id', $idnv)->where('ngay', $ngay)->where('thoigian', $t)->get();
            if($t > Carbon::now('Asia/Ho_Chi_Minh')->hour || !$giolamviec_daduocdangky)
            {
                echo '<option>'.$t.'</option>';
            }
        }
        echo '</select>';
    }
}

