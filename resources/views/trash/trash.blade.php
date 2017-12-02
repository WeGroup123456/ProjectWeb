          
            
          {{--@elseif(Session::get('loai')!==null)
            @php
              $loai = Session::get('loai');
            @endphp
            @foreach ($loai as $lo)
            
            @foreach ($lo->maugiay as $mg)
            <!--item-->
            <div class="col-xs-12 col-sm-4 col-md-4">
              <div class="card card-inverse card-info">
                <div class="product-frame">
                  <div class="pr-image-frame">
                    <img class="pr-image img-responsive" style="width: 100%;" src="upload/giay/{{$mg->MaGiay}}/chinh/{{$mg->HinhBe}}">
                    <div class="sizesanco">
                      <h4>Size sẵn có:</h4>
                      <span>
                      @foreach ($mg->size as $size)
                        <div class="pro-size">{{$size->Size}}</div>
                      @endforeach
                      </span>
                    </div>
                  </div>
                  <a href="productdetail/{{$mg->id}}" style="text-decoration: none;">
                  <div>
                  <div class="pr-name" style="text-transform: uppercase; height: 60px;">
                    {{$mg->giay->Ten}}<span><br>{{$mg->Mau}}</span>
                  </div>

                  <div class="pr-price col-xs-12 col-sm-12 col-md-12">
                    <div class="pr-old-price col-xs-6 col-sm-6 col-md-6" style=" text-decoration: line-through;">
                      {{$mg->GiaCu}}
                    </div>
                    <div class="pr-sale-price col-xs-6 col-sm-6 col-md-6 
                    ">
                      {{$mg->GiaMoi}}
                    </div>
                  </div>
                  <div class="pr-brand-name text-uppercase col-xs-12 col-sm-12 col-md-12">
                    {{$mg->giay->loaigiay->Ten}}
                  </div>
                  </div>
                  </a>
                </div>
              </div>
            </div>
            <!-- enditem-->
            @endforeach
            @endforeach
            {{Session::forget('loai')}}

          @elseif(Session::get('size')!==null)
            @php
              $loai = Session::get('size');
            @endphp
            @foreach ($loai as $lo)
            
            @foreach ($lo->maugiay as $mg)
            <!--item-->
            <div class="col-xs-12 col-sm-4 col-md-4">
              <div class="card card-inverse card-info">
                <div class="product-frame">
                  <div class="pr-image-frame">
                    <img class="pr-image img-responsive" style="width: 100%;" src="upload/giay/{{$mg->MaGiay}}/chinh/{{$mg->HinhBe}}">
                    <div class="sizesanco">
                      <h4>Size sẵn có:</h4>
                      <span>
                      @foreach ($mg->size as $size)
                        <div class="pro-size">{{$size->Size}}</div>
                      @endforeach
                      </span>
                    </div>
                  </div>
                  <a href="productdetail/{{$mg->id}}" style="text-decoration: none;">
                  <div>
                  <div class="pr-name" style="text-transform: uppercase; height: 60px;">
                    {{$mg->giay->Ten}}<span><br>{{$mg->Mau}}</span>
                  </div>

                  <div class="pr-price col-xs-12 col-sm-12 col-md-12">
                    <div class="pr-old-price col-xs-6 col-sm-6 col-md-6" style=" text-decoration: line-through;">
                      {{$mg->GiaCu}}
                    </div>
                    <div class="pr-sale-price col-xs-6 col-sm-6 col-md-6 
                    ">
                      {{$mg->GiaMoi}}
                    </div>
                  </div>
                  <div class="pr-brand-name text-uppercase col-xs-12 col-sm-12 col-md-12">
                    {{$mg->giay->loaigiay->Ten}}
                  </div>
                  </div>
                  </a>
                </div>
              </div>
            </div>
            <!-- enditem-->
            @endforeach
            @endforeach
            {{Session::forget('size')}}
            
          @else
          
          
          @foreach ($maugiay as $mg)
          <!--item-->
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="card card-inverse card-info">
              <div class="product-frame">
                <div class="pr-image-frame">
                  <img class="pr-image img-responsive" style="width: 100%;" src="upload/giay/{{$mg->MaGiay}}/chinh/{{$mg->HinhBe}}">
                  <div class="sizesanco">
                    <h4>Size sẵn có:</h4>
                    <span>
                    @foreach ($mg->size as $size)
                      <div class="pro-size">{{$size->Size}}</div>
                    @endforeach
                    </span>
                  </div>
                </div>
                <a href="productdetail/{{$mg->id}}" style="text-decoration: none;">
                <div>
                <div class="pr-name" style="text-transform: uppercase; height: 60px;">
                  {{$mg->giay->Ten}}<span><br>{{$mg->Mau}}</span>
                </div>

                <div class="pr-price col-xs-12 col-sm-12 col-md-12">
                  <div class="pr-old-price col-xs-6 col-sm-6 col-md-6" style=" text-decoration: line-through;">
                    {{$mg->GiaCu}}
                  </div>
                  <div class="pr-sale-price col-xs-6 col-sm-6 col-md-6 
                  ">
                    {{$mg->GiaMoi}}
                  </div>
                </div>
                <div class="pr-brand-name text-uppercase col-xs-12 col-sm-12 col-md-12">
                  {{$mg->giay->loaigiay->Ten}}
                </div>
                </div>
                </a>
              </div>
            </div>
          </div>
          <!-- enditem-->
        @endforeach

        @endif
        --}}