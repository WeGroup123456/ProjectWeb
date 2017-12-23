@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Giày
                            <small>Thêm chi tiết</small>
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

                        <form action="admin/giay/themchitiet/{{$giay->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label>Mã giày</label>
                                <input class="form-control" name="MaGiay" placeholder="Nhập mã giày" required="" />
                            </div>
                            <div class="form-group">
                                <label>Tên giày</label>
                                <input class="form-control" name="Ten" placeholder="{{$giay->Ten}}" value="{{$giay->Ten}}" disabled="" required="" />
                            </div>
                            <div class="form-group">
                                <label>Màu</label>
                                <input class="form-control" name="Mau" placeholder="Nhập màu" required="" />
                            </div>

                            @if(session('loi'))
                            <div class="alert alert-danger">
                                {{session('loi')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Ảnh chính</label>
                                <input class="form-control" type="file" name="HinhBe" required="" >
                            </div>

                            @if(session('loi'))
                            <div class="alert alert-danger">
                                {{session('loi')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Tập ảnh nhỏ</label>
                                <input class="form-control" type="file" name="upload[]" multiple required="" >
                            </div>

                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio">Có
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Giới tính</label>
                                <label class="radio-inline">
                                    <input name="GioiTinh" value="0" checked="" type="radio">Nam
                                </label>
                                <label class="radio-inline">
                                    <input name="GioiTinh" value="1" type="radio">Nữ
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Giá cũ</label>
                                <input class="form-control" name="GiaCu" placeholder="Nhập giá cũ" required="" />
                            </div>

                            <div class="form-group">
                                <label>Giá mới</label>
                                <input class="form-control" name="GiaMoi" placeholder="Nhập giá mới" required="" />
                            </div>

                            {{-- <div class="form-group">
                                <label>Size</label>
                                <select class="form-control" name="Size">
                                    @for ($i = 35; $i <= 45 ; $i++)
                                        <option value="{{$i}}" >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="SoLuong" placeholder="Nhập số lượng" required="" />
                            </div> --}}

                            <div class="form-group">
                                <label>Status</label>
                                <label class="radio-inline">
                                    <input name="Status" value="0" checked="" type="radio">Tắt
                                </label>
                                <label class="radio-inline">
                                    <input name="Status" value="1" type="radio">Hoạt động
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Thêm</button>
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