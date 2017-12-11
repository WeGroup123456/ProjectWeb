@extends('admin.layout.index')

@section('content')
	<!-- Page Content -->
        <div id="page-wrapper" style="margin: 0px 0px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
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

                        <form action="admin/user/sua/{{$user->id}}" method="POST"  enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="name" placeholder="Nhập tên người dùng" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changePassword" name="changePassword">
                                <label>Đổi mật khẩu</label>
                                <input type="password" class="form-control password" name="password" placeholder="Nhập mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control password" name="passwordAgain" placeholder="Nhập mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                @if ($user->avatar != "")
                                    <img width="100px" src="upload/user/{{$user->avatar}}">
                                    <br>
                                @endif
                                <input class="form-control" type="file" name="avatar">
                            </div>
                            <div class="form-group">
                                <label>Quyền người dùng</label>
                                <label class="radio-inline">
                                    <input name="level" value="0" 
                                    @if($user->level == 0)
                                    {{"checked"}}
                                    @endif
                                    
                                     type="radio" checked="">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="level" 
                                    @if($user->level == 1)
                                    {{"checked"}}
                                    @endif

                                     value="1" type="radio">Admin
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái người dùng</label>
                                <label class="radio-inline">
                                    <input name="status" value="1" 
                                    @if($user->status == 1)
                                    {{"checked"}}
                                    @endif
                                    
                                     type="radio" checked="">Hoạt động
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="0" 
                                    @if($user->status == 0)
                                    {{"checked"}}
                                    @endif

                                     value="1" type="radio">Tắt
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
        $('#changePassword').change(function(){
            if($(this).is(":checked")){
                $(".password").removeAttr('disabled');
            }else{
                $(".password").attr('disabled','');
            }
        });
    });
</script>

@endsection