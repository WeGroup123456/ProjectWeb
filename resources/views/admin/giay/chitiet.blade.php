@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper"  style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row"><a href="admin/giay/danhsach">Quay lại</a></div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Giày
                            <small>{{$giay->Ten}}</small>
                        </h1>

                    </div>
                    
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <div id="msg" class="hidden"></div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Mã giày</th>
                                <th>Màu</th>
                                <th>Hình bé</th>
                                <th>Nổi bật</th>
                                <th>Lượt xem</th>
                                <th>Lượt thích</th>
                                <th>Giới tính</th>
                                <th>Size</th>
                                <th>Số lượng</th>
                                <th>Giá cũ</th>
                                <th>Giá mới</th>
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach($maugiay as $mg)
                            <tr class="odd gradeX" align="center">
                                <td>{{$mg->id}}</td>
                                <td>{{$mg->MaGiay}}</td>
                                <td>{{$mg->Mau}}</td>
                                <td>
                                <img width="100px" src="upload/giay/{{$mg->MaGiay}}/chinh/{{$mg->HinhBe}}">
                                </td>
                                <td>
                                    @if($mg->NoiBat == 0)
                                        {{'Không'}}
                                    @else
                                        {{'Có'}}
                                    @endif
                                </td>
                                <td>{{$mg->LuotXem}}</td>
                                <td>{{$mg->LuotThich}}</td>
                                <td>
                                    @if($mg->GioiTinh == 0)
                                        {{'Nam'}}
                                    @else
                                        {{'Nữ'}}
                                    @endif
                                </td>
                                @php
                                    $count++;
                                @endphp
                                <td><select class="form-control" name="Size" id="Size{{$count}}">
                                    <option value="" selected="">Size</option>

                                    @foreach($mg->size as $size)
                                        <option value="{{$size->id}}">{{$size->Size}}</option>
                                    @endforeach
                                </select></td>
                                
                                <td>
                                    {{-- <div name="SoLuong" id="SoLuong{{$count}}">
                                            
                                    </div> --}}
                                    <select class="form-control" name="SoLuong" id="SoLuong{{$count}}">
                                        <option value="" selected="">Chọn Size</option>
                                    </select>
                                </td>

                                <td>{{$mg->GiaCu}}</td>
                                <td>{{$mg->GiaMoi}}</td>
                                <td>
                                    @if($mg->Status == 1)
                                        <span style="color: green;">Hoạt động</span>
                                    @else
                                        <span style="color: red;">Tắt</span>
                                    @endif
                                </td>
                                @php
                                    /*if (session('size')){
                                        $dem = session()->get('size');
                                        session()->forget('size');
                                    }else{
                                        $dem = 0;
                                    }
                                    session()->forget('size');*/
                                @endphp
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/giay/xoachitiet/{{$mg->id}}/{{$mg->idGiay}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/giay/suachitiet/{{$mg->id}}">Edit</a></td>
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

@section('script')
    

        <script type="text/javascript">
            $(document).ready(function(){
                @for ($i = $count; $i > 0 ; $i--)
                    $("#Size{{$i}}").change(function(){
                        var idSize = $(this).val();

                        $.get("admin/ajax/soluong/"+idSize,function(data){
                            $("#SoLuong{{$i}}").html(data);
                        });
                    });
                @endfor

                @for ($i = $count; $i > 0 ; $i--)
                    $("#SoLuong{{$i}}").change(function(){
                        var idSize = $("#Size{{$i}}").val();
                        var soLuong = $(this).val();

                        $.get("admin/ajax/soluongsize/"+idSize+"/"+soLuong,function(data){
                            if(data == "ok"){
                                $('#msg').removeClass('hidden');
                                $('#msg').addClass('alert alert-success');
                                document.getElementById('msg').innerHTML = 'Sửa Size thành công';
                            }else{
                                $('#msg').removeClass('hidden');
                                $('#msg').addClass('alert alert-danger');
                                document.getElementById('msg').innerHTML = 'Lỗi!!';
                            }
                        });
                    });
                @endfor
            });
        </script>

    
    
@endsection