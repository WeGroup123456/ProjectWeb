@extends('layout.index')
@section('content')

@include('slide.index')

<div class="clearfix"></div>
<div class="container_fullwidth">
   <div class="container">
      <div class="hot-products">
         <marquee style="width: 150px;"><h3 class="title">Hot Products</h3></marquee>
         <div class="control"><a id="prev_hot" class="prev" href="#">&lt;</a><a id="next_hot" class="next" href="#">&gt;</a></div>
         <ul id="hot">
            <li>
               <div class="pr-sc row">
                  @foreach ($hot_shoes_1 as $hs1)
                     <div class="col-md-3 col-sm-6">
                        <div class="products">
                           <div class="ribbon"><span>HOT</span></div>
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
                              <a href="productdetail/{{$hs1->giay->TenKhongDau}}/shoe{{$hs1->id}}.html">{{$hs1->giay->Ten}}
                              </a>
                           </div>
                           <div class="price">${{number_format($hs1->GiaMoi)}}</div>
                           <div class="old-price">${{number_format($hs1->GiaCu)}}</div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </li>
            <li>
               <div class="pr-sc row">
                  @foreach ($hot_shoes_2 as $hs2)
                     <div class="col-md-3 col-sm-6">
                        <div class="products">
                           <div class="ribbon"><span>HOT</span></div>
                           <div class="thumbnail"><a href="productdetail/{{$hs2->giay->TenKhongDau}}/shoe{{$hs2->id}}.html"><img src="upload/giay/{{$hs2->MaGiay}}/chinh/{{$hs2->HinhBe}}" alt="Product Name"></a>
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
                              <a href="productdetail/{{$hs2->giay->TenKhongDau}}/shoe{{$hs2->id}}.html">{{$hs2->giay->Ten}}
                              </a>
                           </div>
                           <div class="price">${{number_format($hs2->GiaMoi)}}</div>
                           <div class="old-price">${{number_format($hs2->GiaCu)}}</div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </li>
         </ul>
      </div>
      <div class="clearfix"></div>
      <div class="featured-products">
         <h3 class="title"><strong>Featured </strong> Products</h3>
         <div class="control"><a id="prev_featured" class="prev" href="#">&lt;</a><a id="next_featured" class="next" href="#">&gt;</a></div>
         <ul id="featured">
            <li>
               <div class="pr-sc row">
                  @foreach ($new_shoes_1 as $ns1)
                     <div class="col-md-3 col-sm-6">
                        <div class="products">
                           <div class="ribbon"><span>NEW</span></div>
                           <div class="thumbnail"><a href="productdetail/{{$ns1->giay->TenKhongDau}}/shoe{{$ns1->id}}.html"><img src="upload/giay/{{$ns1->MaGiay}}/chinh/{{$ns1->HinhBe}}" alt="Product Name"></a>
                              <div class="sizesanco">
                                 <h4>Size sẵn có:</h4>
                                 <span>
                                    @foreach ($ns1->size as $size)
                                       <div class="pro-size">{{$size->Size}}</div>
                                    @endforeach
                                 </span>
                              </div>
                           </div>
                           <div class="productname">
                              <a href="productdetail/{{$ns1->giay->TenKhongDau}}/shoe{{$ns1->id}}.html">{{$ns1->giay->Ten}}
                              </a>
                           </div>
                           <div class="price">${{number_format($ns1->GiaMoi)}}</div>
                           <div class="old-price">${{number_format($ns1->GiaCu)}}</div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </li>
            <li>
               <div class="pr-sc row">
                  @foreach ($new_shoes_2 as $ns2)
                     <div class="col-md-3 col-sm-6">
                        <div class="products">
                           <div class="ribbon"><span>NEW</span></div>
                           <div class="thumbnail"><a href="productdetail/{{$ns2->giay->TenKhongDau}}/shoe{{$ns2->id}}.html"><img src="upload/giay/{{$ns2->MaGiay}}/chinh/{{$ns2->HinhBe}}" alt="Product Name"></a>
                              <div class="sizesanco">
                                 <h4>Size sẵn có:</h4>
                                 <span>
                                    @foreach ($ns2->size as $size)
                                       <div class="pro-size">{{$size->Size}}</div>
                                    @endforeach
                                 </span>
                              </div>
                           </div>
                           <div class="productname">
                              <a href="productdetail/{{$ns2->giay->TenKhongDau}}/shoe{{$ns2->id}}.html">{{$ns2->giay->Ten}}
                              </a>
                           </div>
                           <div class="price">${{number_format($ns2->GiaMoi)}}</div>
                           <div class="old-price">${{number_format($ns2->GiaCu)}}</div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </li>
         </ul>
      </div>
      <div class="clearfix"></div>
      <div class="our-brand">
         <marquee style="width: 150px;"><h3 class="title">Our Brands</h3></marquee>
         <div class="control"><a id="prev_brand" class="prev" href="#">&lt;</a><a id="next_brand" class="next" href="#">&gt;</a></div>
         <ul id="braldLogo">
            <li>
               <ul class="brand_item">
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/envato.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/themeforest.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/photodune.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/activeden.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/envato.png" alt=""></div>
                     </a>
                  </li>
               </ul>
            </li>
            <li>
               <ul class="brand_item">
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/envato.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/themeforest.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/photodune.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/activeden.png" alt=""></div>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="brand-logo"><img src="images/envato.png" alt=""></div>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
</div>
@endsection
