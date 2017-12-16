 @extends('layout.index_general')
 @section('content')
 @php
   use Illuminate\Support\Facades\Input;
   use Illuminate\Support\Facades\URL;
 @endphp

 @if (Session::get('shoe')!==null)
  @php
    $shoe = Session::get('shoe');
    //Session::forget('shoe');
  @endphp
  @if (count($shoe) > 0)
    <div class="alert alert-info">Có {{count($shoe)}} kết quả</div>
  @else
    <div class="alert alert-info">Không có kết quả phù hợp</div>
  @endif
@endif
<form method="get" action="productfilter" id="my_form">
 <div class="container_fullwidth">
        <div class="container">
          <div class="row">
            <div class="col-md-3">

              <div class="others leftbar">
                <h3 class="title">
                  Điều kiện lọc
                </h3>
                <div class="form-group">
                  <label>
                  <input type="checkbox" name="" {{Input::has('gender') ? 'checked' : ''}}>
                    Gender
                  </label>
                </div>
              </div>
              <div class="clearfix">
              </div>

              <div class="category leftbar">
                <h3 class="title">
                  Gender
                </h3>
                <?php $gender = Input::has('gender') ? Input::get('gender'): [] ; ?>
                <ul>
                  <li class="">
                    <div class="form-group">
                      <label>
                      <input type="radio" name="gender" id="men" value="0" onclick="document.getElementById('my_form').submit()" {{Input::get('gender') == 0 ? 'checked' : ''}}>
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
                <ul>
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
                      <input type="radio" name="brands" value="{{$nameBrand}}" onclick="document.getElementById('my_form').submit()" {{Input::get('brands') == $nameBrand ? 'checked' : ''}}>
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
                <ul>
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
                <form class="pricing">
                  <label>
                    $ 
                    <input type="number" name="min_price" value="{{Input::get('min_price')}}">
                  </label>
                  <span class="separate">
                    - 
                  </span>
                  <label>
                    $ 
                    <input type="number" name="max_price" value="{{Input::get('max_price')}}">
                  </label>
                  <input type="submit" value="Go">
                </form>
              </div>
              <div class="clearfix">
              </div>
              <div class="clolr-filter leftbar">
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
              </div>
              <div class="fbl-box leftbar">
                <h3 class="title">
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
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="leftbanner">
                <img src="images/banner-small-01.png" alt="">
              </div>
            </div>
            <div class="col-md-9">
              <div class="banner">
                <div class="bannerslide" id="bannerslide">
                  <ul class="slides">
                    <li>
                      <a href="#">
                        <img src="images/banner-01.jpg" alt=""/>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="images/banner-02.jpg" alt=""/>
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
                      <a href="productlitst.html" class="list">
                        List
                      </a>
                      <a href="#" class="grid active">
                        Grid
                      </a>
                    </div>
                    <div class="sort-by">
                      Sort by : 
                      <select name="" >
                        <option value="Default" selected>
                          Default
                        </option>
                        <option value="Name">
                          Name
                        </option>
                        <option value="Price">
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
                      <div class="offer">
                        New
                      </div>
                      <div class="thumbnail">
                        <a href="productdetail/{{$sh->giay->TenKhongDau}}/shoe{{$sh->id}}.html">
                          <img src="upload/giay/{{$sh->MaGiay}}/chinh/{{$sh->HinhBe}}" alt="Product Name">
                        </a>
                      </div>
                      <div class="productname">
                        {{$sh->giay->Ten}}
                      </div>
                      <h4 class="price">
                        ${{number_format($sh->GiaMoi)}}
                      </h4>
                      <div class="button_group">
                        <button class="button add-cart" type="button">
                          Add To Cart
                        </button>
                        <button class="button compare" type="button">
                          <i class="fa fa-exchange">
                          </i>
                        </button>
                        <button class="button wishlist" type="button">
                          <i class="fa fa-heart-o">
                          </i>
                        </button>
                      </div>
                    </div>
                  </div>
                @endforeach
                </div>
                <div class="clearfix">
                </div>
                <div class="toolbar">
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
                      <select name="">
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
                </div>
                <div class="clearfix">
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix">
          </div>
          <div class="our-brand">
            <h3 class="title">
              <strong>
                Our 
              </strong>
              Brands
            </h3>
            <div class="control">
              <a id="prev_brand" class="prev" href="#">
                &lt;
              </a>
              <a id="next_brand" class="next" href="#">
                &gt;
              </a>
            </div>
            <ul id="braldLogo">
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
</div>
</form>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      
    });
  </script>
@endsection