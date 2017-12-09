@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper"  style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bảo hành
                            <small>{{$baohanh->TieuDe}}</small>
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

                        <form action="admin/baohanh/sua/{{$baohanh->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" value="{{$baohanh->TieuDe}}" />
                            </div>
                            <div class="form-group">
                                <label>Kiểu</label>
                                <label class="radio-inline">
                                    <input name="Kieu" value="1" 
                                    @if($baohanh->Kieu == 1)
                                        {{"checked"}}
                                    @endif type="radio">Kiểu 1
                                </label>
                                <label class="radio-inline">
                                    <input name="Kieu" value="2" 
                                    @if($baohanh->Kieu == 2)
                                        {{"checked"}}
                                    @endif type="radio">Kiểu 2
                                </label>
                                <label class="radio-inline">
                                    <input name="Kieu" value="3" 
                                    @if($baohanh->Kieu == 3)
                                        {{"checked"}}
                                    @endif type="radio">Kiểu 3
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3" >{{$baohanh->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5" >{{$baohanh->NoiDung}}</textarea>
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