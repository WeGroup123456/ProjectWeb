@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại giày
                            <small>Thêm</small>
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

                        @if(session('thatbai'))
                            <div class="alert alert-danger">
                                {{session('thatbai')}}
                            </div>
                        @endif

                        <form action="admin/loaigiay/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Hãng</label>
                                <select class="form-control" name="Brand" id="Brand">
                                    @foreach($brand as $br)
                                        <option value="{{$br->id}}">{{$br->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tên loại giày</label>
                                <select class="form-control" name="LoaiGiay" id="LoaiGiay">
                                    @foreach($loaigiay as $lg)
                                        <option value="{{$lg->id}}">{{$lg->Ten}}</option>
                                    @endforeach
                                </select>
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