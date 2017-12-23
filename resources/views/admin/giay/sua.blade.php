@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Giày
                            <small>Sửa</small>
                            <br>
                            <a href="admin/giay/danhsach" class="btn btn-primary">Quay lại</a>
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

                        <form action="admin/giay/sua/{{$giay->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Hãng giày</label>
                                <select disabled="" class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($brand as $br)
                                        <option
                                        @if($giay->brand->id == $br->id)
                                        {{"selected"}}
                                        @endif
                                         value="{{$br->id}}">{{$br->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại giày</label>
                                <select disabled="" class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach($loaigiay as $lg)
                                        <option
                                        @if($giay->loaigiay->id == $lg->id)
                                        {{"selected"}}
                                        @endif
                                         value="{{$lg->id}}">{{$lg->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tên giày</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên giày" value="{{$giay->Ten}}" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3" >{{$giay->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5" >{{$giay->NoiDung}}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection