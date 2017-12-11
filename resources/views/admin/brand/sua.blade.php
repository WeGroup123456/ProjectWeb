@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hãng
                            <small>{{$brand->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/brand/sua/{{$brand->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên hãng</label>
                                <input class="form-control" name="Ten" disabled="" value="{{$brand->Ten}}" />
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="MoTa" id="demo" class="form-control ckeditor" rows="3" >{{$brand->MoTa}}</textarea>
                            </div>
                            @if(session('loi'))
                            <div class="alert alert-danger">
                                {{session('loi')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <img width="100px" src="upload/brand/{{$brand->Hinh}}">
                                <br>
                                <input class="form-control" type="file" name="Hinh">
                            </div>

                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
