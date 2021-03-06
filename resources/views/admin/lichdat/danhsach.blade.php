@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Lịch đặt
                            <small>Danh sách lịch đặt</small>
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
                                <th>Tên nhân viên</th>
                                <th>Tên khách hàng</th>
                                <th>Tên dịch vụ</th>
                                <th>Thời gian</th>
                                <th>Tên cửa hàng</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lichdat as $ld)
                            @if($ld->hienthi == 1)
                            <tr class="odd gradeX" align="center">
                                <td>{{$ld->id}}</td>
                                <td>{{$ld->nhanvien->user->name}}</td>
                                <td>{{$ld->tenkhachhang}}</td>
                                <td>{{$ld->dichvu->tendichvu}}</td>
                                <td>{{$ld->thoigian}}</td>
                                <td>{{$ld->cuahang->tencuahang}}</td> 
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a id="xoa" class="xoa" href="{{URL::to('admin/lichdat/xoa/'.$ld->id)}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('lichdat/getSua', ['id'=>$ld->id])}}">Edit</a></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection

{{-- @section('script')
    <script type="text/javascript">
        
        $(document).ready(function(){
            $('.xoa').on('click', function(){
                if(confirm("Bạn có chắc chắn muốn xóa lịch đặt này?"))
            {
                return true;
            }
            else
            {
                return false;
            }
            });
            
        });
            
    </script>
@endsection --}}


