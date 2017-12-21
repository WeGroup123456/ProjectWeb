@section('title')
  Check order
@endsection
@extends('layout.index')
@section('content')
<div class="container" style="height:80vh;">
  <div style="width: 100%; margin-top: 50px;" class="col-md-12">
      <form action="checkorder" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group col-md-12">
              <label class="col-md-2 title" for="MaDonHang">Mã đơn hàng: </label>
              <input class="col-md-3" type="number" name="MaDonHang" required="">
          </div>
          <div class="form-group col-md-12">
              <label class="col-md-2 title" for="Email">Địa chỉ email: </label>
              <input class="col-md-3" type="email" name="Email" required="">
          </div>
          <div class="form-group col-md-12">
              <input type="submit" name="check" class="col-md-2 button" value="Check now" />
          </div>
          
      </form>
  </div>
</div>
@endsection