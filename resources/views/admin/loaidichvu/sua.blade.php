@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại dịch vụ
                            <small>Sửa thông tin dịch vụ</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        <form action="admin/loaidichvu/sua/{{$loaidichvu->id}}" method="POST">
                            {{csrf_field()}}
                            @if(count($errors)>0)
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
                                <label>Tên loại sản phẩm</label>
                                <input class="form-control" name="txtTen" placeholder="Nhập tên loại sản phẩm muốn chỉnh sửa..." value="{{$loaidichvu->tenloai}}" />
                            </div>

                             <div class="form-group">
                                <label>Tên không dấu</label>
                                <input class="form-control" name="txtTenkhongdau" placeholder="Nhập tên loại sản phẩm muốn chỉnh sửa..." value="{{$loaisanpham->tenkhongdau}}" />
                            </div>

                            <div class="form-group">
                                <label>Tên thể loại</label>
                                <select name="id_theloai">
                                    @foreach($theloai as $tl)
                                        <option value="{{$tl->id}}">{{$tl->tentheloai}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection