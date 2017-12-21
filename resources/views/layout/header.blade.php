<div class="header">
   <div class="container">
      <div class="row">
         <div class="col-md-2 col-sm-2">
            <div class="logo"><a href="productfilter"><img src="" alt="Shoeshi logo"></a></div>
         </div>
         <div class="col-md-10 col-sm-10">
            <div class="header_top">
               <div class="row">
                  <div class="col-md-7">
                     <ul class="topmenu">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Recruiment</a></li>
                        <li><a href="#">Media</a></li>
                        <li><a href="#">Support</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <div class="header_bottom">
               <ul class="option">
                  <li id="search" class="search">
                     <form method="get" action="search" role="search"><input class="search-submit" type="submit" value=""><input class="search-input" placeholder="Enter your search term..." type="text" value="" name="q" required=""></form>
                  </li>
                  <li class="option-cart">
                     <a href="#" class="cart-icon">cart <span class="cart_no">02</span></a>
                     <ul class="option-cart-item">
                     @foreach ($content as $item)
                        <li>
                           <div class="cart-item">
                              <div class="images" style="width: 10em;"><img src="upload/giay/{{$item->id}}/chinh/{{$item->options->image}}" alt=""></div>
                              <div class="item-description">
                                 <p class="name">{{$item->Ten}}</p>
                                 <p>Size: <span class="light-red">{{$item->options->size}}</span><br>Quantity: <span class="light-red">{{$item->qty}}</span></p>
                              </div>
                              <div class="right">
                                 <p class="price">${{number_format($item->price)}}</p>
                                 <a href="deletecart/{{$item->rowId}}" class="remove"><img src="images/remove.png" alt="remove"></a>
                              </div>
                           </div>
                        </li>
                     @endforeach
                        
                        <li><span class="total">Total <strong>${{$total}}</strong></span><button class="checkout" onClick="location.href='cart'">CheckOut</button></li>
                     </ul>
                  </li>
               </ul>
               <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
               <div class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                     <li><a href="home">HOME</a></li>
                     <li><a href="productfilter">PRODUCT</a></li>
                     <li><a href="checkorder">CHECK ORDER</a></li>
                     <li><a href="#">ABOUT US</a></li>
                     <li><a href="#">LOCATION</a></li>
                     <li><a href="#">CONTACT</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
