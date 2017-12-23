@section('title')
  Payment
@endsection
@extends('layout.index')
@section('content')
<link href="vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">  
<link href="https://pay.vnpay.vn/lib/vnpay/vnpay.css" rel="stylesheet" />
<div class="container" style="background: #fff;">
  <div style="width: 100%;padding-top:100px;font-weight: bold;color: #333333; text-align: center;";><h3>Tạo mới đơn hàng</h3></div>
  <div style="width: 100%" >
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
      @php
        $customer = null;
        if(Session::get('customer') != null){
          $customer = Session::get('customer');
          
        }
        
      @endphp
      <div class="col-md-2"></div>
      <form class="col-md-8" action="{{URL::to('/')}}/vnpay_php/vnpay_ajax.php" id="frmCreateOrder" method="post" style="padding: 20px 30px 20px 30px;">        
          <div class="form-group">
              <label style="padding-bottom: 10px;" for="language">Loại hàng hóa </label>
              <select style="margin-left: 0;" name="ordertype" id="ordertype" class="form-control">
                  <!-- <option value="topup">Nạp tiền điện thoại</option>
                  <option value="billpayment">Thanh toán hóa đơn</option> -->
                  <option value="fashion">Thời trang</option>
              </select>
          </div>
          <div class="form-group">
              <label style="padding-bottom: 10px;" for="name">User ID: </label>
              <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The userid field is required." id="userid" max="100000000" min="1" name="userid" type="number" value="{{$customer->id}}" {{-- value="{{$customer->id}}" disabled="" --}} />
          </div>
          <div class="form-group">
              <label style="padding-bottom: 10px;" for="amount">Số tiền</label>
              <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number" value="{{preg_replace("/([^0-9\\.])/i", "", $total)}}" {{-- value="{{$total}}" placeholder="{{$total}}" disabled="" --}} />
          </div>
          {{-- <div class="form-group">
              <label style="padding-bottom: 10px;" for="">Tổng tiền:</label>
              <div style="border: 1px solid #bdc3c7; border-radius: 10px;">
                <p style="padding: 8px; margin:0">{{$total}}</p>
              </div>
          </div> --}}
           
          <div class="form-group">
              <label style="padding-bottom: 10px;" for="OrderDescription">Nội dung thanh toán</label>
              <textarea class="form-control" cols="20" id="orderDesc" name="orderDesc" rows="2">Thanh toan don hang test</textarea>
          </div>
          <div class="form-group">
              <label style="padding-bottom: 10px;" for="bankcode">Ngân hàng</label>
              <select style="margin-left: 0;" name="bankcode" id="bankcode" class="form-control">
                  <option value="">Không chọn </option>
                  <option value="NCB">Ngan hang NCB</option>
                  <option value="SACOMBANK">Ngan hang SacomBank  </option>
                  <option value="EXIMBANK">Ngan hang EximBank </option>
                  <option value="MSBANK"> Ngan hang MSBANK </option>
                  <option value="NAMABANK"> Ngan hang NamABank </option>
                  <option value="VISA">   Thanh toan qua VISA/MASTER</option>
                  <option value="VNMART">  Vi dien tu VnMart</option>
                  <option value="VIETINBANK">Ngan hang Vietinbank  </option>
                  <option value="VIETCOMBANK"> Ngan hang VCB </option>
                  <option value="HDBANK">Ngan hang HDBank</option>
                  <option value="DONGABANK">  Ngan hang Dong A</option>
                  <option value="TPBANK"> Ngân hàng TPBank </option>
                  <option value="OJB">Ngân hàng OceanBank</option>
                  <option value="BIDV"> Ngân hàng BIDV </option>
                  <option value="TECHCOMBANK"> Ngân hàng Techcombank </option>
                  <option value="VPBANK"> Ngan hang VPBank </option>
                  <option value="AGRIBANK"> Ngan hang Agribank </option>
                  <option value="MBBANK"> Ngan hang MBBank </option>
                  <option value="ACB"> Ngan hang ACB </option>
                  <option value="OCB"> Ngan hang OCB </option>
              </select>
          </div>

          <div class="form-group">
              <label style="padding-bottom: 10px;" for="language">Ngôn ngữ</label>
              <select style="margin-left: 0;" name="language" id="language" class="form-control">
                  <option value="vn">Tiếng Việt</option>
                  <option value="en">English</option>
              </select>
          </div>
          <input type="submit" name="popup" id="popup" class="btn btn-default" value="Thanh toán Popup" />
          <input type="submit" name="redirect" class="btn btn-default" value="Thanh toán Redirect" />
      </form>
  </div>
</div>
@endsection

@section('script')
  <script src="https://pay.vnpay.vn/lib/vnpay/vnpay.js"></script>
  <script type="text/javascript">
      $("#popup").click(function () {
          var postData = $("#frmCreateOrder").serialize();
      console.log(postData)
          var submitUrl = $("#frmCreateOrder").attr("action");    
          $.ajax({
              type: "POST",
              url: submitUrl,
        
              data: postData,
              dataType: 'JSON',
              success: function (x) {
                  if (x.code === '00') {
                      if (window.vnpay)
                      {
                          vnpay.open({width: 480, height: 600, url: x.data});
                      } else
                      {
                          window.location.href = x.data;
                      }
                      return false;
                  } else {
                      alert(x.Message);
                  }
              }
          });
          return false;
      });
  </script>
@endsection