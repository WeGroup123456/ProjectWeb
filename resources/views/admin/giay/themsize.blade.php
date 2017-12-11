@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Giày: {{$maugiay->giay->Ten}}|| Mã: {{$maugiay->MaGiay}}
                            <small>Thêm size</small>
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

                        <form action="admin/giay/themsize/{{$maugiay->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label>Size</label>
                                <select class="form-control" name="Size">
                                    <?php 
                                    $key = 0;
                                    for ($i = 35; $i <= 45 ; $i++) { 
                                        $key = 0;
                                        foreach ($maugiay->size as $si) {
                                            if ($si->Size == $i) {
                                                $key = 1;
                                                break;
                                            }
                                        }
                                        if ($key == 0) {
                                            echo "<option value=".$i." >".$i."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="SoLuong" placeholder="Nhập số lượng" />
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