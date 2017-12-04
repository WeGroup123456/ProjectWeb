@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper"  style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Giày
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
                                <th>Tóm tắt</th>
                                <th>Nội dung</th>
                                <th>Loại giày</th>
                                <th>Hãng</th>
                                <th>Detail</th>
                                <th>Add Detail</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($giay as $gi)
                            <tr class="odd gradeX" align="center">
                                <td>{{$gi->id}}</td>
                                <td>{{$gi->Ten}}</td>
                                <td>{{$gi->TenKhongDau}}</td>
                                <td>{{$gi->TomTat}}</td>
                                <td>{{$gi->NoiDung}}</td>
                                <td>{{$gi->loaigiay->Ten}}</td>
                                <td>{{$gi->brand->Ten}}</td>

                                <td class="center"><i class="fa fa-pencil  fa-fw"></i><a href="admin/giay/chitiet/{{$gi->id}}">Detail</a></td>
                                <td class="center"><i class="fa fa-pencil  fa-fw"></i><a href="admin/giay/themchitiet/{{$gi->id}}">Add Detail</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/giay/sua/{{$gi->id}}">Edit</a></td>
                                <td class="center"><i class="fa fa-trash fa-fw"></i> <a href="admin/giay/xoa/{{$gi->id}}">Delete</a></td>
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