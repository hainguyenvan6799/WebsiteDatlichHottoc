<?php
  use App\Http\Controllers\CalendarController;

  $duration = 60;
  $cleanup = 0;
  $start = 0;
  $stop = 0;
  use App\lichlamviec_nhanvien;
   $now = Carbon\Carbon::now()->toDateString();
      $nextdate = Carbon\Carbon::tomorrow()->toDateString();
      $nextnextdate = Carbon\Carbon::tomorrow()->addDays()->toDateString(); 
      $getnowday = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
      $start = '';
      $end = '';
      //echo '<script>alert(document.cookie);</script>';
      //echo $_COOKIE['abc'];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script type="text/javascript">
  var res = "success";
</script>
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
}
</style>
</head>
<body>

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
      <div class="col-md-2" id="timeslot">
        @if($t <= Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour && $dateArray[$i] <= $now) 
          <button type="button" class="btn btn-info btn-lg book" data-toggle="modal" data-target="#myModal" data-timeslot="{{$t}}" title="Booked" disabled="">{{$t}}</button>
        @else
          <button type="button" class="btn btn-info btn-lg book" data-toggle="modal" data-target="#myModal" data-timeslot="{{$t}}" title="Book now">{{$t}}</button>
        @endif
        
      </div>
    <?php } ?>
</div>


<?php } ?>


{{-- && lichlamviec_nhanvien::where('id_nhanvien', $nv->id)->where('ngaylamviec', ) --}}
<script>
function openCity(evt, cityName) {
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
</body>
</html> 
