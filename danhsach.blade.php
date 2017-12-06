@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bảo hành
                            <small>Danh sách</small>
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
                                <th>Tiêu đề</th>
                                <th>Kiểu</th>
                                <th>Tên không dấu</th>
                                <th>Tóm tắt</th>
                                <th>Nội dung</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($baohanh as $bh)
                            <tr class="odd gradeX" align="center">
                                <td>{{$bh->id}}</td>
                                <td>{{$bh->TieuDe}}</td>
                                <td>{{$bh->Kieu}}</td>
                                <td>{{$bh->TenKhongDau}}</td>
                                <td>{{$bh->TomTat}}</td>
                                <td>{{$bh->NoiDung}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/baohanh/xoa/{{$bh->id}}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/baohanh/sua/{{$bh->id}}">Sửa</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection