@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm người dùng</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(count($errors)>0)
                        @foreach($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{$err}}<br>
                            </div>
                        @endforeach
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/them" method="POST">
                            {{csrf_field()}}
                            
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input class="form-control" name="txtTen" placeholder="Nhập tên người dùng..." />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="txtEmail" placeholder="Nhập email..." />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="txtPass" placeholder="Nhập password tại đây" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại password</label>
                                <input type="password" class="form-control" name="txtPassagain" placeholder="Nhập lại password tại đây" />
                            </div>
                            <div class="form-group">
                                <label>Quyền người dùng</label>
                                <label class="radio-inline">
                                    <input name="txtQuyen" value="0" checked="" type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="txtQuyen" value="1" type="radio">Admin
                                </label>
                            </div>

                            {{-- <div class="form-group">
                                <label>Tesst</label>
                                <input name="txtTest">
                            </div> --}}
                            <button type="submit" class="btn btn-default">Thêm người dùng</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection 