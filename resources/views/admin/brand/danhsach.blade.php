@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Brand
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
                                <th>Tên</th>
                                <th>Tên không dấu</th>
                                <th>Mô tả</th>
                                <th>Hình</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($brand as $br)
                            <tr class="odd gradeX" align="center">
                                <td>{{$br->id}}</td>
                                <td>{{$br->Ten}}</td>
                                <td>{{$br->TenKhongDau}}</td>
                                <td>{{$br->MoTa}}</td>
                                <td><img width="100px" src="upload/brand/{{$br->Hinh}}"></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/brand/xoa/{{$br->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/brand/sua/{{$br->id}}">Edit</a></td>
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
