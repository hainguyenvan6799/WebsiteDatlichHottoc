@extends('datlich.layout_lichdat')

@section('title')
  <title>Bước 2 - Chọn nhân viên</title>
@endsection

@section('css')
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
@endsection

@section('content')
  <form action="lichdat3" method="POST">
    {{csrf_field()}}
    @foreach($nhanvien as $nv)
    <input type="radio" name="chonnhanvien" class="chonnhanvien" value="{{$nv['id']}}">{{$nv->user->name}}
    @endforeach
    <input type="submit" name="submit" value="Tiếp theo" class="btn btn-success">
  </form>
@endsection

