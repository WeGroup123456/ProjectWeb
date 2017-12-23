@section('title')
  Product Detail
@endsection
 @extends('layout.index')
 @section('content')
<div class="container_fullwidth">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <div class="products-details">
                <div class="preview_image">
                  <div class="preview-small">
                    <img id="zoom_03" src="upload/giay/{{$shoe->MaGiay}}/chinh/{{$shoe->HinhBe}}" data-zoom-image="upload/giay/{{$shoe->MaGiay}}/chinh/{{$shoe->HinhBe}}" alt="">
                  </div>
                  <div class="thum-image">
                    <ul id="gallery_01" class="prev-thum">
                    @foreach ($shoe->hinhgiay as $hg)
                      <li>
                        <a href="#" data-image="upload/giay/{{$shoe->MaGiay}}/hinhphu/{{$hg->Hinh}}" data-zoom-image="upload/giay/{{$shoe->MaGiay}}/hinhphu/{{$hg->Hinh}}">
                          <img src="upload/giay/{{$shoe->MaGiay}}/hinhphu/{{$hg->Hinh}}" alt="">
                        </a>
                      </li>
                    @endforeach
                    </ul>
                    <a class="control-left" id="thum-prev" href="javascript:void(0);">
                      <i class="fa fa-chevron-left">
                      </i>
                    </a>
                    <a class="control-right" id="thum-next" href="javascript:void(0);">
                      <i class="fa fa-chevron-right">
                      </i>
                    </a>
                  </div>
                </div>
                <form action="insertcart/{{$shoe->id}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="products-description">
                  <h5 class="name">
                    {{$shoe->giay->Ten}}<br><br>
                    @if ($shoe->GioiTinh == 0)
                      {{"Nam"}}
                    @else
                      {{"Nữ"}}
                    @endif
                  </h5>
                  {{-- <p>
                    <img alt="" src="images/star.png">
                    <a class="review_num" href="#">
                      02 Review(s)
                    </a>
                  </p> --}}
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
                  <div class="available-size inline-block" style="margin: 10px 0px;">
                    Available Size:
                    <ul class="list-inline" style="list-style: none;">
                      @foreach ($sort as $so)
                        <li>
                            <input type="radio" value="{{$so->Size}}" name="Size" idparent="{{$so->mau_giay_id}}">
                            <label>
                              {{$so->Size}}
                            </label>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="available-color">
                    Màu sẵn có:
                    <ul class="list-inline" style="list-style: none; margin-top: 5px;">
                      @foreach ($shoe_all as $sa)
                      @if ($sa->idGiay == $shoe->idGiay)
                      <li class="pr-color">
                        <a href="productdetail/{{$sa->giay->TenKhongDau}}/shoe{{$sa->id}}.html">
                          <img src="upload/giay/{{$sa->MaGiay}}/chinh/{{$sa->HinhBe}}" style="width: 50px; height: 50px;">
                        </a>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  <p>
                    Availability: 
                    <span class="light-red hidden" id="available-size">
                      In Stock
                    </span>
                  </p>
                  <hr class="border">
                  <div class="price">
                    Price : 
                    <span class="new_price">
                      {{number_format($shoe->GiaMoi)}}
                      <sup>
                        $
                      </sup>
                    </span>
                    <span class="old_price">
                      {{number_format($shoe->GiaCu)}}
                      <sup>
                        $
                      </sup>
                    </span>
                  </div>
                  <hr class="border">
                  <div class="wided">
                    <div class="qty" id="qty-size">
                      Qty &nbsp;&nbsp;: 
                      <select>
                        <option>
                          1
                        </option>
                      </select>
                    </div>
                    
                      <div class="button_group">
                        <button class="button" id="cart-size">
                          Add To Cart
                        </button>
                        {{-- <button class="button compare">
                          <i class="fa fa-exchange">
                          </i>
                        </button>
                        <button class="button favorite">
                          <i class="fa fa-heart-o">
                          </i>
                        </button>
                        <button class="button favorite">
                          <i class="fa fa-envelope-o">
                          </i>
                        </button> --}}
                      </div>
                    
                  </div>
                  <div class="clearfix">
                  </div>
                  {{-- <hr class="border">
                  <img src="images/share.png" alt="" class="pull-right"> --}}
                </div>
                </form>
              </div>
              <div class="clearfix">
              </div>
              <div class="tab-box">
                <div id="tabnav">
                  <ul>
                    <li>
                      <a href="productdetail/nemeziz-tango-17-1-trainers/shoe22.html#Descraption">
                        DESCRIPTION
                      </a>
                    </li>
                    {{-- <li>
                      <a href="productdetail/nemeziz-tango-17-1-trainers/shoe22.html#Reviews">
                        REVIEW
                      </a>
                    </li>
                    <li>
                      <a href="productdetail/nemeziz-tango-17-1-trainers/shoe22.html#tags">
                        PRODUCT TAGS
                      </a>
                    </li> --}}
                  </ul>
                </div>
                <div class="tab-content-wrap">
                  <div class="tab-content" id="Descraption">
                    <p>
                      <article>{!!$shoe->giay->TomTat!!}
                    </p>
                    <p>
                      {!!$shoe->giay->NoiDung!!}</article>
                    </p>
                  </div>
                  <div class="tab-content" id="Reviews">
                    <form>
                      <table>
                        <thead>
                          <tr>
                            <th>
                              &nbsp;
                            </th>
                            <th>
                              1 star
                            </th>
                            <th>
                              2 stars
                            </th>
                            <th>
                              3 stars
                            </th>
                            <th>
                              4 stars
                            </th>
                            <th>
                              5 stars
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              Quality
                            </td>
                            <td>
                              <input type="radio" name="quality" value="Blue"/>
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Price
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Value
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row">
                            <label class="lebel-abs">
                              Your Name 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="text" name="" class="input namefild">
                          </div>
                          <div class="form-row">
                            <label class="lebel-abs">
                              Your Email 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="email" name="" class="input emailfild">
                          </div>
                          <div class="form-row">
                            <label class="lebel-abs">
                              Summary of You Review 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="text" name="" class="input summeryfild">
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row">
                            <label class="lebel-abs">
                              Your Name 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <textarea class="input textareafild" name="" rows="7" >
                            </textarea>
                          </div>
                          <div class="form-row">
                            <input type="submit" value="Submit" class="button">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-content" >
                    <div class="review">
                      <p class="rating">
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star-half-o gray">
                        </i>
                        <i class="fa fa-star-o gray">
                        </i>
                      </p>
                      <h5 class="reviewer">
                        Reviewer name
                      </h5>
                      <p class="review-date">
                        Date: 01-01-2014
                      </p>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer a eros neque. In sapien est, malesuada non interdum id, cursus vel neque.
                      </p>
                    </div>
                    <div class="review">
                      <p class="rating">
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star-half-o gray">
                        </i>
                        <i class="fa fa-star-o gray">
                        </i>
                      </p>
                      <h5 class="reviewer">
                        Reviewer name
                      </h5>
                      <p class="review-date">
                        Date: 01-01-2014
                      </p>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer a eros neque. In sapien est, malesuada non interdum id, cursus vel neque.
                      </p>
                    </div>
                  </div>
                  <div class="tab-content" id="tags">
                    <div class="tag">
                      Add Tags : 
                      <input type="text" name="">
                      <input type="submit" value="Tag">
                    </div>
                  </div>
                  
                </div>

              </div>
              <div class="clearfix">
              </div>
              <div class="tab-content" id="Descraption">
                    <!-- Facebook API Comment -->
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=316215622172670';
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                  
                    <div class="fb-comments" data-href="{{URL::to('/')}}/productdetail/{{$shoe->giay->TenKhongDau}}/shoe{{$shoe->id}}.html" data-numposts="5" data-width="100%"></div>
                  </div>
              <div id="productsDetails" class="hot-products">
                <h3 class="title">
                  <strong>
                    Hot
                  </strong>
                  Products
                </h3>
                <div class="control">
                  <a id="prev_hot" class="prev" href="#">
                    &lt;
                  </a>
                  <a id="next_hot" class="next" href="#">
                    &gt;
                  </a>
                </div>
                <ul id="hot">
                  <li>
                    <div class="row" style="margin-top: 20px;">
                     @foreach ($hot_shoes_1 as $hs1)
                        {{-- <div class="col-md-4 col-sm-4">
                           <div class="products">
                              <div class="offer">- %{{number_format((1-($hs1->GiaMoi/$hs1->GiaCu))*100)}}</div>
                              <div class="thumbnail"><a href="productdetail/{{$hs1->giay->TenKhongDau}}/shoe{{$hs1->id}}.html"><img src="upload/giay/{{$hs1->MaGiay}}/chinh/{{$hs1->HinhBe}}" alt="Product Name"></a></div>
                              <div class="productname">{{$hs1->giay->Ten}}</div>
                              <h4 class="price">${{number_format($hs1->GiaCu)}}</h4>
                              <div class="button_group"><button class="button add-cart" type="button">Add To Cart</button><button class="button compare" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                           </div>
                        </div> --}}
                        <div class="col-md-4 col-sm-6">
                          <div class="products">
                            <div class="ribbon">
                              <span>{{$hs1->giay->brand->Ten}}</span>
                            </div>
                            <div class="thumbnail">
                              <a href="productdetail/{{$hs1->giay->TenKhongDau}}/shoe{{$hs1->id}}.html">
                                <img src="upload/giay/{{$hs1->MaGiay}}/chinh/{{$hs1->HinhBe}}" alt="Product Name">
                              </a>
                              <div class="sizesanco">
                                 <h4>Size sẵn có:</h4>
                                 <span>
                                    @foreach ($hs1->size as $size)
                                       <div class="pro-size">{{$size->Size}}</div>
                                    @endforeach
                                 </span>
                              </div>
                            </div>
                            <div class="productname">
                              <a href="productdetail/{{$hs1->giay->TenKhongDau}}/shoe{{$hs1->id}}.html">
                              {{$hs1->giay->Ten}}
                              </a>
                            </div>
                            <div class="price">${{number_format($hs1->GiaMoi)}}</div>
                            <div class="old-price">${{number_format($hs1->GiaCu)}}</div>
                            <div class="sport-type">{{$hs1->giay->loaigiay->Ten}}</div>
                          </div>
                        </div>
                     @endforeach
                    </div>
                  </li>
                  <li>
                    <div class="row">
                      @foreach ($hot_shoes_2 as $hs2)
                        <div class="col-md-4 col-sm-6">
                          <div class="products">
                            <div class="ribbon">
                              <span>{{$hs2->giay->brand->Ten}}</span>
                            </div>
                            <div class="thumbnail">
                              <a href="productdetail/{{$hs2->giay->TenKhongDau}}/shoe{{$hs2->id}}.html">
                                <img src="upload/giay/{{$hs2->MaGiay}}/chinh/{{$hs2->HinhBe}}" alt="Product Name">
                              </a>
                              <div class="sizesanco">
                                 <h4>Size sẵn có:</h4>
                                 <span>
                                    @foreach ($hs2->size as $size)
                                       <div class="pro-size">{{$size->Size}}</div>
                                    @endforeach
                                 </span>
                              </div>
                            </div>
                            <div class="productname">
                              <a href="productdetail/{{$hs2->giay->TenKhongDau}}/shoe{{$hs2->id}}.html">
                              {{$hs2->giay->Ten}}
                              </a>
                            </div>
                            <div class="price">${{number_format($hs2->GiaMoi)}}</div>
                            <div class="old-price">${{number_format($hs2->GiaCu)}}</div>
                            <div class="sport-type">{{$hs2->giay->loaigiay->Ten}}</div>
                          </div>
                        </div>
                     @endforeach
                    </div>
                  </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
            </div>
            <div class="col-md-3">
              <div class="special-deal leftbar">
                <h4 class="title">
                  Special 
                  <strong>
                    Deals
                  </strong>
                </h4>
                @foreach ($special_deals as $sd)
                <div class="special-item">
                  
                  <div class="product-image">
                    <a href="productdetail/{{$sd->giay->TenKhongDau}}/shoe{{$sd->id}}.html">
                      <img src="upload/giay/{{$sd->MaGiay}}/chinh/{{$sd->HinhBe}}" alt="">
                    </a>
                  </div>
                  <div class="product-info">
                    <p>
                      {{$sd->giay->Ten}}
                    </p>
                    <h5 class="price">
                      {{number_format($sd->GiaCu)}}<p><div class="offer" style="position: static !important; color: #fff; background-color: #f7544a;">- %{{$sd->GiaCu == 0 ? 'N' : number_format((1-($sd->GiaMoi/$sd->GiaCu))*100)}}</div></p>
                    </h5>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="clearfix">
              </div>
              {{-- <div class="product-tag leftbar">
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
              <div class="get-newsletter leftbar">
                <h3 class="title">
                  Get 
                  <strong>
                    newsletter
                  </strong>
                </h3>
                <p>
                  Casio G Shock Digital Dial Black.
                </p>
                <form>
                  <input class="email" type="text" name="" placeholder="Your Email...">
                  <input class="submit" type="submit" value="Submit">
                </form>
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
              <div class="clearfix">
              </div>
            </div>
          </div>
          <div class="clearfix">
          </div>
          @include('pages.ours_brands')
        </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
    jQuery(function($) {

      $(".available-size > ul > li > input").each(function() {
        $(this).on('click', function() {
          var size = $(this).val();
          var idparent = $(this).attr('idparent');
          
          $.ajax({
            url:'ajax/checksize/'+idparent+'/'+size,
            type:'GET',
            cache: false,
            data:{
              "idparent":idparent,
              "size":size
            },
            success: function(data){
              if (data == "avail"){
                document.getElementById('available-size').innerHTML = 'In Stock';
                $('#qty-size').removeClass('hidden');
                $('#cart-size').removeClass('hidden');
              }else{
                document.getElementById('available-size').innerHTML = 'Out of Stock';
                $('#qty-size').addClass('hidden');
                $('#cart-size').addClass('hidden');
              }
              $('#available-size').removeClass('hidden');
            },error: function(){
              alert("error");
            }
          });
        });
      });
      
    });
    </script>
@endsection