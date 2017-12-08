@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Giày
                            <small>Sửa chi tiết</small>
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

                        <form action="admin/giay/suachitiet/{{$maugiay->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label>Mã giày</label>
                                <input class="form-control" name="MaGiay" placeholder="Nhập mã giày" value="{{$maugiay->MaGiay}}" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Tên giày</label>
                                <input class="form-control" name="Ten" placeholder="{{$maugiay->Ten}}" value="{{$maugiay->Ten}}" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Màu</label>
                                <input class="form-control" name="Mau" placeholder="Nhập màu" value="{{$maugiay->Mau}}" />
                            </div>

                            @if(session('loi'))
                            <div class="alert alert-danger">
                                {{session('loi')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Hình chính</label>
                                <br>
                                <img width="100px" src="upload/giay/{{$maugiay->MaGiay}}/chinh/{{$maugiay->HinhBe}}">
                                <br>
                                <input class="form-control" type="file" name="HinhBe">
                            </div>

                            @if(session('loi'))
                            <div class="alert alert-danger">
                                {{session('loi')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Hình chi tiết</label>
                                <br>

                                @foreach ($maugiay->hinhgiay as $element)
                                    <img width="100px" src="upload/giay/{{$maugiay->MaGiay}}/hinhphu/{{$element->Hinh}}">
                                @endforeach
                                
                                <br>
                                <input class="form-control" type="file" name="upload[]" multiple>
                            </div>

                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0"
                                    @if($maugiay->NoiBat == 0)
                                        {{"checked"}}
                                    @endif
                                     type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" 
                                    @if($maugiay->NoiBat == 1)
                                        {{"checked"}}
                                    @endif 
                                    type="radio">Có
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Giới tính</label>
                                <label class="radio-inline">
                                    <input name="GioiTinh" value="0"
                                    @if($maugiay->GioiTinh == 0)
                                        {{"checked"}}
                                    @endif
                                     type="radio">Nam
                                </label>
                                <label class="radio-inline">
                                    <input name="GioiTinh" value="1" 
                                    @if($maugiay->GioiTinh == 1)
                                        {{"checked"}}
                                    @endif 
                                    type="radio">Nữ
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Giá cũ</label>
                                <input class="form-control" name="GiaCu" placeholder="Nhập giá cũ" value="{{$maugiay->GiaCu}}" />
                            </div>

                            <div class="form-group">
                                <label>Giá mới</label>
                                <input class="form-control" name="GiaMoi" placeholder="Nhập giá mới" value="{{$maugiay->GiaMoi}}" />
                            </div>

                            <div class="form-group">
                                <label>Size</label>
                                <select class="form-control" name="Size">
                                    @for ($i = 35; $i <= 45 ; $i++)
                                        <option value="{{$i}}" >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="SoLuong" id="SoLuong" placeholder="Nhập số lượng" value="" />
                            </div>

                            <!-- <div class="form-group">
                                <label>Số lượng cũ: </label>
                                <div id="SoLuongCu"></div>
                            </div>
                            
                            <div class="form-group">
                                <label>Số lượng mới</label>
                                <input class="form-control" name="SoLuong" id="SoLuong" placeholder="Nhập số lượng" value="{{--$maugiay->size[0]->SoLuong--}}" />
                            </div> -->

                            <div class="form-group">
                                <label>Status</label>
                                <label class="radio-inline">
                                    <input name="Status" value="0"
                                    @if($maugiay->Status == 0)
                                        {{"checked"}}
                                    @endif
                                     type="radio">Tắt
                                </label>
                                <label class="radio-inline">
                                    <input name="Status" value="1" 
                                    @if($maugiay->Status == 1)
                                        {{"checked"}}
                                    @endif 
                                    type="radio">Hoạt động
                                </label>
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
            $("#Size").change(function(){
                var idSize = $(this).val();
                $.get("admin/ajax/soluong2/"+idSize,function(data){
                    $("#SoLuongCu").html(data);
                });
            });
        });
    </script>
    
@endsection