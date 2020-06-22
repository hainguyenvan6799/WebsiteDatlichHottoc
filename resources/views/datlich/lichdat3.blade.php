<?php
  use App\Http\Controllers\CalendarController;

  $duration = 60;
  $cleanup = 0;
  $start = 0;
  $stop = 0;
  use App\lichlamviec_nhanvien;
  use App\LichDat;
   $now = Carbon\Carbon::now()->toDateString();
      $nextdate = Carbon\Carbon::tomorrow()->toDateString();
      $nextnextdate = Carbon\Carbon::tomorrow()->addDays()->toDateString(); 
      $getnowday = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
      $start = '';
      $end = '';
      //echo '<script>alert(document.cookie);</script>';
      //echo $_COOKIE['abc'];
?>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  width: 100%;
  height: 500px;
}
</style>

<h2>Tabs</h2>
<p>Click on the buttons inside the tabbed menu:</p>

<div class="tab">
  <button class="tablinks active" onclick="openCity(event, '{{$now}}')" id="defaultOpen">Ngày hôm nay {{$now}}</button>
  <button class="tablinks" onclick="openCity(event, '{{$nextdate}}')">Ngày mai {{$nextdate}}</button>
  <button class="tablinks" onclick="openCity(event, '{{$nextnextdate}}')">Ngày kia {{$nextnextdate}}</button>
</div>

<?php $dateArray = [$now, $nextdate, $nextnextdate];
  for($i = 0; $i < count($dateArray); $i++) {?>

<div id="{{$dateArray[$i]}}" class="tabcontent">
  <?php
    $giolamviec = lichlamviec_nhanvien::where('nhanvien_id', $id_nhanvien)->where('ngay', $dateArray[$i])->get()->toArray();
    
    if(!$giolamviec)
    {
      $start = '0:0';
      $end = '0:0';
    }
    foreach($giolamviec as $g)
    {
      $start = $g['start_time'];
      $end = $g['stop_time'];
    }
    $timeslot = CalendarController::timeslot($duration, $cleanup, $start, $end);
    foreach($timeslot as $t){ ?>
    
      <div class="col-md-6" id="timeslot">
        @if($t <= Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour && $dateArray[$i] <= $now) 
          <button type="button" class="btn btn-info btn-lg book" data-toggle="modal" data-target="#myModal" data-timeslot="{{$t}}" title="Booked" disabled="">{{$t}}</button>
        @elseif(LichDat::where('nhanvien_id', $id_nhanvien)->where('ngay', $dateArray[$i])->where('thoigian', $t)->get()->toArray())
          <button type="button" class="btn btn-info btn-lg book" data-toggle="modal" data-target="#myModal" data-timeslot="{{$t}}" title="Booked" disabled="">{{$t}}</button>
        @else
          <button type="button" class="btn btn-info btn-lg book" data-toggle="modal" data-target="#myModal" data-timeslot="{{$t}}" data-datebook="{{$dateArray[$i]}}" data-idnhanvien="{{$id_nhanvien}}" title="Book now">{{$t}}</button>
        @endif
        
      </div>
    <?php } ?>

    
</div>


{{-- modal --}}
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center">Booking <span id="slot"></span></h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <form action="formBooking" method="post" id="formBooking">
                        {{csrf_field()}}
                        <div class="form-group">
                          <label for="">Timeslot</label>
                          <input type="text" readonly="" name="timeslot" id="form-timeslot" class="form-control" value="">
                          <input type="hidden" name="datebook" id="datebook">
                          <input type="hidden" name="id_nhanvien" id="id_nhanvien">
                          <input type="hidden" name="id_dichvu" id="id_dichvu">
                        </div>

                        <div class="form-group">
                          <label for="ten">Tên</label>
                          <input type="text" name="ten" id="ten" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" name="email" id="email" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <input class="btn btn-primary" type="submit" name="submit" value="Book">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

          {{-- end modal --}}


<?php } ?>

<select name="dichvu" id="dichvu">
      @foreach($dichvu as $dv)
        <option value="{{$dv->id}}">{{$dv->tendichvu}}</option>
      @endforeach
</select>

{{-- && lichlamviec_nhanvien::where('id_nhanvien', $nv->id)->where('ngaylamviec', ) --}}
<script>
function openCity(evt, cityName) {
  evt.preventDefault();
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  
  
}

document.getElementById('defaultOpen').click();

document.cookie = "abc=VanHai";
</script>

<script type="text/javascript">
  $('.book').click(function(){
    var timeslot = $(this).attr('data-timeslot');
    var date = $(this).attr('data-datebook');
    var id_nhanvien = $(this).attr('data-idnhanvien');
    var id_dichvu = $('#dichvu').val();
    // alert(id_dichvu);
    // alert(id_nhanvien);
    $('#slot').html(timeslot);
    $('#form-timeslot').val(timeslot);
    $('#datebook').val(date);
    $('#id_nhanvien').val(id_nhanvien);
    $('#id_dichvu').val(id_dichvu);
  });
</script>