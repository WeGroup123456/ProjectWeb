@section('title')
  About us
@endsection
@extends('layout.index')
@section('content')

@include('slide.index')

<div class="clearfix"></div>
<div class="container_fullwidth">
   <div class="container">
   <div class="row">
      <div class="col-md-12">
        <div class="clearfix">
        </div>
        <div class="container-fluid bg-grey">
        <div class="row">
          <div class="col-sm-4">
            <div class="shop-img"><img src="images/jakob-owens-102203.jpg"></div>
          </div>
          <div class="col-sm-8">
            <h2>Shoeshi Store</h2><br>
            <p class="aboutUs-text"><strong>Quá trình phát triển:</strong> Cơ sở đầu tiên khai trương ngày 10/09/2017 tại số 26 Nguyễn Trãi, Thanh Xuân, Hà Nội. </p><br>
            <p class="aboutUs-text"><strong>Phương châm:</strong> Chúng tôi cam kết bán hàng chính hãng, uy tín, chính sách hỗ trợ khách hàng nhiệt tình.</p>
            <p class="aboutUs-text"><strong>Đội ngũ nhân viên</strong></p>
            <ul style="padding-left: 10px;">
              <li>Dương Hồng Đức</li>
              <li>Lê Phương Quỳnh</li>
              <li>Đoàn Văn Thức</li>
              <li>Phan Hồ Cầm</li>
              <li>Trần Bá Hoa</li>
              <li>Nhữ Anh Dũng</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </div>
      @include('pages.ours_brands')
   </div>
</div>
@endsection
