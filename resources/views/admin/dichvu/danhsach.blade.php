@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">dịch vụ
                            <small>Danh sách dịch vụ</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên dịch vụ</th>
                                <th>Giá</th>
                                <th>Mô tả</th>
                                <th>Hình</th>
                                <th>Tên loại dịch vụ</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dichvu as $dv)
                            <tr class="odd gradeX" align="center">
                                <td>{{$dv->id}}</td>
                                <td>{{$dv->tendichvu}}</td>
                                <td>{{$dv->gia}}</td>
                                <td>{{$dv->mota}}</td>
                                <td><img src="../public/images/dichvu/{{$dv->anhdaidien}}" style="width: 200px;"></td>
                                <td>{{$dv->loaidichvu->tenloai}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/dichvu/xoa/{{$dv->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/dichvu/sua/{{$dv->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection
