@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại dịch vụ
                            <small>Thêm loại dịch vụ</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->

                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/loaidichvu/them" method="POST">
                            
                            {{csrf_field()}}
                            
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach
                                </div>
                            @endif

                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Nhập tên khách hàng</label>
                                <input type="text" class="form-control" name="txtTen" placeholder="Nhập tên loại dịch vụ." required="" />
                            </div>

                            <div class="form-group">
                                <label>Chọn Cửa hàng</label>

                                <select name="chon_cuahang">
                                    @foreach($cuahang as $ch)
                                        <option>{{$ch->tencuahang}} - {{'Đường ' . $ch->duong . ', Phường ' . $ch->phuong . ', Quận ' . $ch->quan . ', TP ' . $ch->thanhpho}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn nhân viên</label>
                                
                            </div>

                            <div class="form-group">
                                <label>Nhập tên khách hàng</label>
                                <input type="text" class="form-control" name="txtTen" placeholder="Nhập tên loại dịch vụ." required="" />
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection 