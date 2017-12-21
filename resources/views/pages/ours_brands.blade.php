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
      @foreach ($shoe_brand_all as $sba)
        <li>
          <a href="productfilter?brands={{$sba->TenKhongDau}}">
            <div class="brand-logo">
              <img src="upload/brand/{{$sba->Hinh}}" alt="" style="height: 60px;">
            </div>
          </a>
        </li>
      @endforeach
      </ul>
    </li>
  </ul>
</div>