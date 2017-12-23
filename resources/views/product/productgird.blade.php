@section('title')
  Product
@endsection
 @extends('layout.index')
 @section('content')
 @php
   use Illuminate\Support\Facades\Input;
   use Illuminate\Support\Facades\URL;
 @endphp

 @php
   $q = null;
   if (Session::get('q') != null) {
      $q = Session::get('q');
      function highlight($str, $q) {
        $highlighted = preg_filter('/' . preg_quote($q) . '/i', '<b><span class="search-highlight" style="color:#16a085">$0</span></b>', $str);
        if (!empty($highlighted)) {
            $str = $highlighted;
        }
        return $str;
      }
    }
 @endphp

 @if (Session::get('shoe')!==null)
  @php
    $shoe = Session::get('shoe');
    //Session::forget('shoe');
  @endphp
{{--   @if (count($shoe) > 0)
    <div class="alert alert-info">Có {{count($shoe)}} kết quả</div>
  @else
    <div class="alert alert-info">Không có kết quả phù hợp</div>
  @endif --}}
@endif
<form method="get" action="productfilter" id="my_form">
 <div class="container_fullwidth">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="others leftbar" {{Input::has('gender')||Input::has('brands')||Input::has('cate')||Input::has('min_price') ? '' : 'hidden'}}>
                <h3 class="title">
                  Điều kiện lọc
                </h3>
                <div class="clearfix">
                </div>
                
                <ul id="removeCondition" style="list-style: none;">
                  <li {{Input::has('gender') ? '' : 'hidden'}}>
                    <div class="alert alert-info" name="gender" style="background: #333333;">
                      <h5 style="color: #fff;" id="genderCon">

                      </h5>
                    </div>
                  </li>
                  
                  <li {{Input::has('brands') ? '' : 'hidden'}}>
                    <div class="alert alert-info" name="brands" style="background: #333333;">
                      <h5 style="color: #fff;" id="brandCon">
                        @foreach ($shoe_brand_all as $sba)
                          @if (Input::get('brands') === $sba->TenKhongDau)
                            {{$sba->Ten}}
                          @endif
                        @endforeach
                        <i class="glyphicon glyphicon-remove pull-right"></i>
                      </h5>
                    </div>
                  </li>
                  
                  <li {{Input::has('cate') ? '' : 'hidden'}}><div class="alert alert-info" name="cate" style="background: #333333;"><h5 style="color: #fff;" id="typeShoeCon"></h5></div></li>
                  
                  <li {{Input::has('min_price') || Input::has('max_price') ? '' : 'hidden'}}><div class="alert alert-info" name="price" style="background: #333333;"><h5 style="color: #fff;" id="priceCon">Price: {{Input::has('min_price') ? number_format(Input::get('min_price')) : ''}} - {{Input::has('max_price') ? number_format(Input::get('max_price')) : ''}}<i class="glyphicon glyphicon-remove pull-right"></i></h5></div></li>
                  <div class="alert alert-info" style="background: #e74c3c;" {{Input::has('gender')||Input::has('brands')||Input::has('cate')||Input::has('min_price') ? '' : 'hidden'}}><h5 style="color: #fff; text-align: center; cursor: pointer;" onclick="window.location.href = 'productfilter'">Remove All</h5></div>
                </ul>
              </div>
              <div class="clearfix">
              </div>
              <div class="category leftbar">
                <h3 class="title">
                  Gender
                </h3>
                <?php $gender = Input::has('gender') ? Input::get('gender'): [] ; ?>
                <ul id="gender">
                  <li class="">
                    <div class="form-group">
                      <label>
                      <input type="radio" name="gender" id="men" value="0" onclick="document.getElementById('my_form').submit()" {{Input::has('gender') && Input::get('gender') == 0 ? 'checked' : ''}}>
                        Men
                      </label>
                    </div>
                  </li>
                  <li>
                    <div class="form-group">
                      <label>
                      <input type="radio" name="gender" value="1" onclick="document.getElementById('my_form').submit()" {{Input::get('gender') == 1 ? 'checked' : ''}}>
                        Women
                      </label>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
              <div class="branch leftbar">
                <h3 class="title">
                  Brand
                </h3>
                <ul id="brands">
                @foreach ($shoe_brand_all as $sba)
                  <?php
                    $nameBrand = strtolower(preg_replace('/\s+/', '', $sba->TenKhongDau));
                    $brands = Input::has('brands') ? Input::get('brands'): [] ;
                  ?>
                  <li>
                    {{-- <a href="javascript:{}" onclick="filter('brand','{{$nameBrand}}')">
                      {{$sba->Ten}}
                    </a> --}}
                    <div class="form-group">
                      <label>
                      <input type="radio" class="brands" name="brands" value="{{$nameBrand}}" onclick="document.getElementById('my_form').submit()" {{Input::get('brands') == $nameBrand ? 'checked' : ''}}>
                        {{$sba->Ten}}
                      </label>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
              <div class="clearfix">
              </div>
              <div class="branch leftbar">
                <h3 class="title">
                  Type of Shoes
                </h3>
                <ul id="typeShoes">
                @foreach ($shoe_cate_all as $sca)
                  <?php
                    $nameCate = strtolower(preg_replace('/\s+/', '', $sca->TenKhongDau));
                  ?>
                  <li>
                    {{-- <a href="#">
                      {{$sca->Ten}}
                    </a> --}}
                    <div class="form-group">
                      <label>
                      <input type="radio" name="cate" value="{{$nameCate}}" onclick="document.getElementById('my_form').submit()" {{Input::get('cate') == $nameCate ? 'checked' : ''}}>
                        {{$sca->Ten}}
                      </label>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
              <div class="clearfix">
              </div>

              

              <div class="price-filter leftbar">
                <h3 class="title">
                  Price
                </h3>
                <form class="pricing" method="get" action="productfilter">
                  <label>
                    $ 
                    <input type="number" name="min_price" style="margin-bottom: 10px;" value="{{Input::get('min_price')}}" required="">
                  </label>
                  <span class="separate">
                    - 
                  </span>
                  <label>
                    $ 
                    <input type="number" name="max_price" style="margin-bottom: 10px !important;" value="{{Input::get('max_price')}}" required="">
                  </label>
                  <input class="button" type="submit" value="Go">
                </form>
              </div>
              <div class="clearfix">
              </div>
              {{-- <div class="clolr-filter leftbar">
                <h3 class="title">
                  Color
                </h3>
                <ul>
                  <li>
                    <a href="#" class="red-bg">
                      light red
                    </a>
                  </li>
                  <li>
                    <a href="#" class=" yellow-bg">
                      yellow"
                    </a>
                  </li>
                  <li>
                    <a href="#" class="black-bg ">
                      black
                    </a>
                  </li>
                  <li>
                    <a href="#" class="pink-bg">
                      pink
                    </a>
                  </li>
                  <li>
                    <a href="#" class="dkpink-bg">
                      dkpink
                    </a>
                  </li>
                  <li>
                    <a href="#" class="chocolate-bg">
                      chocolate
                    </a>
                  </li>
                  <li>
                    <a href="#" class="orange-bg">
                      orange-bg
                    </a>
                  </li>
                  <li>
                    <a href="#" class="off-white-bg">
                      off-white
                    </a>
                  </li>
                  <li>
                    <a href="#" class="extra-lightgreen-bg">
                      extra-lightgreen
                    </a>
                  </li>
                  <li>
                    <a href="#" class="lightgreen-bg">
                      lightgreen
                    </a>
                  </li>
                  <li>
                    <a href="#" class="biscuit-bg">
                      biscuit
                    </a>
                  </li>
                  <li>
                    <a href="#" class="chocolatelight-bg">
                      chocolatelight
                    </a>
                  </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
              <div class="product-tag leftbar">
                <h3 class="title">
                  Products 
                  <strong>
                    Tags
                  </strong>
                </h3>
                <ul>
                  <li>
                    <a href="#">
                      Lincoln us
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      SDress for Girl
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Corner
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Window
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      PG
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Oscar
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Bath room
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      PSD
                    </a>
                  </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
              <div class="others leftbar">
                <h3 class="title">
                  Others
                </h3>
              </div>
              <div class="clearfix">
              </div>
              <div class="others leftbar">
                <h3 class="title">
                  Others
                </h3>
              </div>
              <div class="clearfix">
              </div> --}}
              <div class="fbl-box leftbar">
                <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=316215622172670';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-page" data-href="https://www.facebook.com/BXH-608593912643661/" data-tabs="messages, timeline, events" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" height="370"><blockquote cite="https://www.facebook.com/BXH-608593912643661/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/BXH-608593912643661/">BXH</a></blockquote></div>
                {{-- <h3 class="title">
                  Facebook
                </h3>
                <span class="likebutton">
                  <a href="#">
                    <img src="images/fblike.png" alt="">
                  </a>
                </span>
                <p>
                  12k people like Flat Shop.
                </p>
                <ul>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                </ul>
                <div class="fbplug">
                  <a href="#">
                    <span>
                      <img src="images/fbicon.png" alt="">
                    </span>
                    Facebook social plugin
                  </a>
                </div> --}}
              </div>
              {{-- <div class="clearfix">
              </div>
              <div class="leftbanner">
                <img src="images/banner-small-01.png" alt="">
              </div> --}}
            </div>
            <div class="col-md-9">
              <div class="banner">
                <div class="bannerslide" id="bannerslide">
                  <ul class="slides">
                    <li>
                      <a href="#">
                        <img src="images/banner-cus-01.jpg" alt=""/>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="images/banner-cus-03.jpg" alt=""/>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="products-grid">
                <div class="toolbar">
                  <div class="sorter">
                    <div class="view-mode">
                      {{-- <a href="productlitst.html" class="list">
                        List
                      </a> --}}
                      <a href="#" class="grid active">
                        Grid
                      </a>
                    </div>
                    <div class="sort-by">
                      Sort by : 
                      <select name="sorting" onchange="document.getElementById('my_form').submit()">
                        <option value="Select" selected disabled="">
                          Choose
                        </option>
                        <option value="name_shoe" {{Input::get('sorting') == 'name_shoe' ? 'selected' : ''}}>
                          Name
                        </option>
                        <option value="lowest_price" {{Input::get('sorting') == 'lowest_price' ? 'selected' : ''}}>
                          Lowest Price
                        </option>
                        <option value="highest_price" {{Input::get('sorting') == 'highest_price' ? 'selected' : ''}}>
                          Highest Price
                        </option>
                        <option value="latest_arrival" {{Input::get('sorting') == 'latest_arrival' ? 'selected' : ''}}>
                          Lastest Arrival
                        </option>
                      </select>
                    </div>
                    <div class="limiter">
                      Show : 
                      <select name="numItem" onchange="document.getElementById('my_form').submit()">
                        <option value="Select" selected disabled="">
                          >>
                        </option>
                        <option value="3" {{Input::get('numItem') == 3 ? 'selected' : ''}}>
                          3
                        </option>
                        <option value="6" {{Input::get('numItem') == 6 ? 'selected' : ''}}>
                          6
                        </option>
                        <option value="9" {{Input::get('numItem') == 9 ? 'selected' : ''}}>
                          9
                        </option>
                      </select>
                    </div>
                  </div>
                  <style type="text/css">
                    .pagination {
                      margin: 0;
                    }
                  </style>
                  <div class="pager">
                    {!! $shoe->links() !!}
                  </div>
                </div>
                <div class="clearfix">
                </div>
                <div class="row">
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
                @foreach ($shoe as $sh)
                  <div class="col-md-4 col-sm-6">
                    <div class="products">
                      <div class="ribbon">
                        <span>{{$sh->giay->brand->Ten}}</span>
                      </div>
                      <div class="thumbnail">
                        <a href="productdetail/{{$sh->giay->TenKhongDau}}/shoe{{$sh->id}}.html">
                          <img src="upload/giay/{{$sh->MaGiay}}/chinh/{{$sh->HinhBe}}" alt="Product Name">
                        </a>
                        <div class="sizesanco">
                           <h4>Size sẵn có:</h4>
                           <span>
                              @foreach ($sh->size as $size)
                                 <div class="pro-size">{{$size->Size}}</div>
                              @endforeach
                           </span>
                        </div>
                      </div>
                      <div class="productname">
                        <a href="productdetail/{{$sh->giay->TenKhongDau}}/shoe{{$sh->id}}.html">
                        @if ($q != null)
                          {!! highlight($sh->giay->Ten, $q) !!}
                        @else
                          {{$sh->giay->Ten}}
                        @endif
                        </a>
                      </div>
                      <div class="price">${{number_format($sh->GiaMoi)}}</div>
                      <div class="old-price">${{number_format($sh->GiaCu)}}</div>
                      <div class="sport-type">{{$sh->giay->loaigiay->Ten}}</div>
                    </div>
                  </div>
                @endforeach
                </div>
                <div class="clearfix">
                </div>
                {{-- <div class="toolbar">
                  <div class="sorter bottom">
                    <div class="view-mode">
                      <a href="productlitst.html" class="list">
                        List
                      </a>
                      <a href="#" class="grid active">
                        Grid
                      </a>
                    </div>
                    <div class="sort-by">
                      Sort by : 
                      <select id="SORTING">
                        <option value="Default" selected>
                          Default
                        </option>
                        <option value="Name">
                          Name
                        </option>
                        <option value="
                        <strong>
                        #
                        </strong>
                        ">
                          Price
                        </option>
                      </select>
                    </div>
                    <div class="limiter">
                      Show : 
                      <select name="" >
                        <option value="3" selected>
                          3
                        </option>
                        <option value="6">
                          6
                        </option>
                        <option value="9">
                          9
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="pager">
                    {!! $shoe->links() !!}
                  </div>
                </div> --}}
                <div class="clearfix">
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix">
          </div>
          @include('pages.ours_brands')
        </div>
</div>
</form>
@endsection

@section('script')
  <script type="text/javascript">
    jQuery(function($) {
      // window.checkCheck = function(){
      //   if($('#men').is(':checked')){
      //     $('#men').on('click', function() {
      //         var unsetcon = $(this).attr("name");
      //         window.location.href = 'productfilter/'+unsetcon;
      //     });
      //   }else{
      //     document.getElementById('my_form').submit()
      //   }
      // }

      // if($('#men').is(':checked')){
      //     $('#men').on('click', function() {
      //         var unsetcon = $(this).attr("name");
      //         window.location.href = 'productfilter/'+unsetcon;
      //         window.stop();
      //     });
      //   }

      // $('#men').on('click', function() {
      //     alert("ok");
      //     document.getElementById('my_form').submit();
      // });

      // $('#abc').on('click', function() {
      //     var unsetcon = $('#men').attr("name");
      //     window.location.href = 'productfilter/'+unsetcon;
      // });

      $( "#removeCondition > li > div" ).each(function() {
        $(this).on('click', function() {
          var unsetcon = $(this).attr('name');
          window.location.href = 'productfilter/'+unsetcon;
        });
      });

      $( "#gender input" ).each(function() {
        $(this).on('click', function() {
          var name = $(this).parent().text();
          localStorage.setItem('genderName',name);
        });
      });

      // $( "#brands input" ).each(function() {
      //   $(this).on('click', function() {
      //     var name = $(this).parent().text();
      //     localStorage.setItem('brandName',name);
      //   });
      // });

      $( "#typeShoes input" ).each(function() {
        $(this).on('click', function() {
          var name = $(this).parent().text();
          localStorage.setItem('typeShoeName',name);
        });
      });

      if (localStorage.getItem('genderName') != null) {
        document.getElementById("genderCon").innerHTML = 'Gender: '+localStorage.getItem('genderName') + '<i class="glyphicon glyphicon-remove pull-right"></i>';
      }
      // if (localStorage.getItem('brandName') != null) {
      //   document.getElementById("brandCon").innerHTML = 'Brand: '+localStorage.getItem('brandName') + '<i class="glyphicon glyphicon-remove pull-right"></i>';
      // }
      if (localStorage.getItem('typeShoeName') != null) {
        document.getElementById("typeShoeCon").innerHTML = 'TS: '+localStorage.getItem('typeShoeName') + '<i class="glyphicon glyphicon-remove pull-right"></i>';
      }

    });
  </script>
@endsection