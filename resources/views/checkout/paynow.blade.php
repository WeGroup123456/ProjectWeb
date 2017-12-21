@extends('layout.index')
@section('title')
  Order Infomation
@endsection
@section('content')
<style type="text/css">
</style>
<div class="container" style="background: #fff;">
  <div class="row" style="margin-top: 30px;">
        <div class="col-sm-12">
            {{-- <legend>Thông tin đặt hàng</legend> --}}
        </div>
        <!-- panel -->
        <div class="col-sm-7">
            <h4>Shipping address:</h4>
            <br>
            <div class="panel panel-default">
                <form class="panel-body form-horizontal payment-form" method="post" action="paynow">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <!-- email input-->
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="giftID">Email</label>  
                    <div class="col-md-8">
                    <input id="Email" name="Email" type="text" placeholder="Please enter email:" class="form-control input-md">
                    </div>
                  </div>

                  <!-- name input-->
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="giftName">Name</label>  
                    <div class="col-md-8">
                    <input id="Ten" name="Ten" type="text" placeholder="Enter name" class="form-control input-md" required="">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="shippingDays">Address</label>  
                    <div class="col-md-8">
                    <textarea class="form-control input-md" rows="3" maxlength="255" placeholder="Enter Address" data-field="input" data-address="vn" name="DiaChi" id="txtautocomplete" aria-required="true" aria-invalid="true"></textarea>
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="shippingDays">Phone number</label>
                    <div class="col-md-5">
                    <input id="DienThoai" name="DienThoai" type="text" placeholder="Enter your phone number" class="form-control input-md" required="">
                    </div>
                    <span class="help-block col-md-4">Our automated switchboard will contact you at this number for confirmation or notice of delivery</span>
                  </div>

                  <div class="form-group">
                      <div class="col-sm-6 text-left"></div>
                  </div>

                  <div class="form-group">
                      <div class="col-sm-12 text-left">
                          <button type="submit" class="snip1434">
                              <span class="glyphicon glyphicon-bell"></span> Continue
                          </button>
                      </div>
                  </div>
                </form>
            </div>            
        </div> 
        <!-- / panel info -->
        <div class="col-sm-5">
            <h4>Order infomation:</h4>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table preview-table">
                            <thead>
                                <tr>
                                  <th>Product</th>
                                  <th>Size</th>
                                  <th>Amount</th>
                                  <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($content as $item)
                                  <tr class="odd gradeX" align="center">
                                      <td>{{$item->name}}</td>
                                      <td>{{$item->options->size}}</td>
                                      <td>{{$item->qty}}</td>
                                      @php
                                        $sl = $item->qty;
                                        $gia = $item->price;
                                        $sum = $sl * $gia;
                                      @endphp
                                      <td>{{number_format($sum)}}</td>
                                  </tr>
                              @endforeach
                            </tbody> <!-- preview content goes here-->
                        </table>
                    </div>                            
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
              <label class="col-md-3 control-label" for="shippingDays">Ship: </label>  
              <br>
              <div class="col-md-9">
                <p id="paragraph"></p>
              </div>
              <br>
              </div>
            </div>
            <div class="row text-left">
                <div class="col-xs-12">
                    <h4>Total: {{$total}}<strong><span class="preview-total"></span></strong></h4>
                </div>
                <hr style="border:1px dashed #dddddd;">
            </div>
            
        </div>
        
  </div>

  <div class="row">
      <div class="col-md-12">
        <div id="msg" class="hidden"></div>
        <div id="map" class="map"><div id="popup"></div></div>
        <!-- <button id="zoom-out">Zoom out</button>
        <button id="zoom-in">Zoom in</button>
        <br>
        <br> -->
        <!-- <button type="submit"  onclick="pointToPoint()" class="btn btn-primary" id="find">Vẽ đường đến cửa hàng gần nhất</button> -->
      </div>
  </div>
</div>
@endsection

@section('script')
  <script src="op/jquery/dist/jquery.js"></script>
  <script type="text/javascript" src="op/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="op/openlayers/ol.js"></script>
  <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
  <!-- <script src="node_modules/openlayers/build/ol-custom.js"></script> -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed in=true&libraries=places"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGbAhxRzN8jcLiA0yXcZ6M4z8lPI8B4-M&libraries=geometry,places">
  </script>
  <script type="text/javascript">
    var lon_cus = 0;
    var lat_cus = 0;
    var lon_shop = 0;
    var lat_shop = 0;

    msg_el = document.getElementById('msg'),
    styles = {
      route: new ol.style.Style({
        stroke: new ol.style.Stroke({
          width: 6, color: [40, 40, 40, 0.8]
        })
      })
    };

      var array = [
        {
         gis_data: [ 20.9790077,105.78563780000002 ],
         id: 1,
         place_id: "Ej4xMTAgVHLhuqduIFBow7osIFbEg24gUXXDoW4sIEjDoCDEkMO0bmcsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ",
         name: "Cửa hàng số 1 tại Hồ Gươm Plaza",
         description: "abc",
         image: "op/upload/icon.png"
        },
        {
         gis_data: [ 21.0028475,105.81508659999997 ],
         id: 2,
         place_id: "ChIJxaRE-ZqsNTERySGL-Sv9C-0",
         name: "Cửa hàng số 2 tại Royal City",
         description: "abc",
         image: "op/upload/icon.png"
        },
        {
         gis_data: [ 20.9948186,105.86831329999995 ],
         id: 3,
         place_id: "ChIJo4YF2gSsNTERL3dPEDR6s4E",
         name: "Cửa hàng số 3 tại Times City",
         description: "abc",
         image: "op/upload/icon.png"
        },
      ];

      setup_map(); // Khởi tạo nền map
      get_fields(); // Gắn các object

      function setup_map(){

        
        fields_vector_source = new ol.source.Vector({});
        var center = ol.proj.transform([105.8324146270752,20.992414585826108], 'EPSG:4326', 'EPSG:3857');
        map = new ol.Map({
        target: $('#map')[0],

        layers: [
            new ol.layer.Tile({
              source: new ol.source.OSM({
               url: 'http://mt{0-3}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
               attribution: [
                new ol.Attribution({ html: 'Google'}),
                new ol.Attribution({ html: '<a href="https://developers.google.com/maps/terms">Terms of Use.</a>'}),
               ]
              })
          }),
            new ol.layer.Vector({
             source: fields_vector_source
            })
         ],
         
         view: new ol.View({
            center: center,
            zoom: 13
         }),
         
         controls: ol.control.defaults({
          attribution: false,
          zoom: false,
         })
       });
      }

      function get_fields(){
         var vectorSource = new ol.source.Vector({

        });
        //array
        for(var i = 0; i<array.length;i++ ){

          var iconFeature = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([array[i].gis_data[1],array[i].gis_data[0]], 
                                                  'EPSG:4326','EPSG:3857')), //lon,lat
            name: array[i].name,
            image: array[i].image,
            id: array[i].id,
            description: array[i].description,           
          });

          var iconStyle = new ol.style.Style({    
            image: new ol.style.Icon({
            anchor: [0.4, 1],
            src: 'op/upload/icon.png'
            })
          });
          iconFeature.setStyle(iconStyle);
          vectorSource.addFeature(iconFeature);
        }

        var vectorLayer = new ol.layer.Vector({
          source: vectorSource,
        });
        map.addLayer(vectorLayer);

        //drawRoute(vectorSource,vectorLayer);
      }

      function pointToPoint(){
        if($('#txtautocomplete').val() != ''){
          getRoute(lon_cus,lat_cus,lon_shop,lat_shop);
        }else{
          $('#msg').addClass('alert alert-danger');
          $('#msg').removeClass('hidden');
          msg_el.innerHTML = 'Bạn chưa điền địa chỉ';
        }
      }

      function getRoute(lon_cus,lat_cus,lon_shop,lat_shop) {
        var vectorSource = new ol.source.Vector({
        });
          var iconFeature = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([lon_cus,lat_cus], 
                                                  'EPSG:4326','EPSG:3857')),
            name: "Địa chỉ của bạn",
          });

          var iconStyle = new ol.style.Style({    
            image: new ol.style.Icon({
            anchor: [0.4, 1],
            src: 'op/upload/blue-dot.png'
            })
          });
          iconFeature.setStyle(iconStyle);
          vectorSource.addFeature(iconFeature);

        var vectorLayer = new ol.layer.Vector({
          source: vectorSource,
        });
        map.addLayer(vectorLayer);

        //drawRoute(vectorSource,vectorLayer,lon_cus,lat_cus,lon_shop,lat_shop);
        fetch('https://router.project-osrm.org/route/v1/driving/'+lon_cus+','+lat_cus+';'+lon_shop+','+lat_shop).then(function(r) { 
          return r.json();
        }).then(function(json) {
          if(json.code !== 'Ok') {
            $('#msg').addClass('alert alert-danger');
            $('#msg').removeClass('hidden');
            msg_el.innerHTML = 'Không tìm được đường';
            return;
          }
          $('#msg').addClass('alert alert-success');
          $('#msg').removeClass('hidden');
          msg_el.innerHTML = 'Tìm đường thành công';
          //points.length = 0;
          //createRoute(json.routes[0].geometry,vectorSource,vectorLayer);
          var route = new ol.format.Polyline({
            factor: 1e5
          }).readGeometry(json.routes[0].geometry, {
            dataProjection: 'EPSG:4326',
            featureProjection: 'EPSG:3857'
          });
          var feature = new ol.Feature({
            type: 'route',
            geometry: route
          });
          feature.setStyle(styles.route);
          vectorSource.addFeature(feature);
        });

        map.getView().setCenter(ol.proj.transform([(lon_cus+lon_shop)/2, (lat_cus+lat_shop)/2], 'EPSG:4326', 'EPSG:3857'));
        map.getView().setZoom(12);
      }

      function drawPoint(lat,lon){
         var vectorSource = new ol.source.Vector({
        });
          var iconFeature = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([lon,lat], 
                                                  'EPSG:4326','EPSG:3857'))
          });

          var iconStyle = new ol.style.Style({    
            image: new ol.style.Icon({
            anchor: [0.4, 1],
            src: 'op/upload/icon.png'
            })
          });
          iconFeature.setStyle(iconStyle);
          vectorSource.addFeature(iconFeature);

        var vectorLayer = new ol.layer.Vector({
          source: vectorSource,
        });
        map.addLayer(vectorLayer);
      }

      google.maps.event.addDomListener(window,'load', intilize);
      function intilize() {
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('txtautocomplete'));
        google.maps.event.addListener(autocomplete, 'place_changed',function(){
          var place = autocomplete.getPlace();
          var lat = place.geometry.location.lat();
          var lon = place.geometry.location.lng();
          var origin = lat+","+lon;

          var destination = ["20.9790077,105.78563780000002","21.0028475,105.81508659999997","20.9948186,105.86831329999995"];
          var shortest = 9999;
          var ij = 0;
          for (ij = 0; ij < destination.length; ij++) {
            
            $.ajax({
              type: "GET",
              dataType: "json",
              crossDomain: true,
              data: "origin="+origin+"&destination="+destination[ij]+"&key=AIzaSyCGbAhxRzN8jcLiA0yXcZ6M4z8lPI8B4-M",
              url: "https://maps.googleapis.com/maps/api/directions/json",
              success: function(data) {
                /*get-info*/
                var distance = data.routes[0].legs[0].distance.value/1000;
                var dist = parseFloat(distance);

                if (shortest > dist) {
                  shortest = dist;
                    var start_location_lat = data.routes[0].legs[0].start_location.lat;
                    var start_location_lon = data.routes[0].legs[0].start_location.lng;
                    
                    lat_cus = data.routes[0].legs[0].start_location.lat;
                    lon_cus = data.routes[0].legs[0].start_location.lng;
                    lat_shop = data.routes[0].legs[0].end_location.lat;
                    lon_shop = data.routes[0].legs[0].end_location.lng;
                    

                    drawPoint(parseInt(start_location_lat),parseInt(start_location_lon));

                    var place_id = data.geocoded_waypoints[1].place_id;
                  

                    //Tinh tien
                    if (shortest <= 2) {
                      var total = 11000;
                    }else{
                      var total = 11000 + (shortest-2)*3800;
                    }
                    var num = total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');

                    //array

                    for (var i = 0; i < array.length; i++) {
                      if(array[i].place_id == place_id){
                        var nameShop = array[i].name;
                      }
                    }

                    $('#paragraph').html("Giá: "+num + " VND" + "<br>Khoảng cách: "+shortest+" km <br>Tới Shop gần nhất: "+nameShop);
                    pointToPoint();
                  }
              },
              error: function() {
                alert("err");
              }

            });
          }

        });
      }

      function drawRoute(vectorSource,vectorLayer,lon_cus,lat_cus,lon_shop,lat_shop){
        //lon,lat;lon,lat
        fetch('https://router.project-osrm.org/route/v1/driving/'+lon_cus+','+lat_cus+';'+lon_shop+','+lat_shop).then(function(r) { 
          return r.json();
        }).then(function(json) {
          if(json.code !== 'Ok') {
            $('#msg').addClass('alert alert-danger');
            $('#msg').removeClass('hidden');
            msg_el.innerHTML = 'Không tìm được đường';
            return;
          }
          $('#msg').addClass('alert alert-success');
          $('#msg').removeClass('hidden');
          msg_el.innerHTML = 'Thêm đường thành công';
          //points.length = 0;
          createRoute(json.routes[0].geometry,vectorSource,vectorLayer);
        });
      }

      function createRoute(polyline,vectorSource,vectorLayer) {
        // route is ol.geom.LineString
        var route = new ol.format.Polyline({
          factor: 1e5
        }).readGeometry(polyline, {
          dataProjection: 'EPSG:4326',
          featureProjection: 'EPSG:3857'
        });
        var feature = new ol.Feature({
          type: 'route',
          geometry: route
        });
        feature.setStyle(styles.route);
        vectorSource.addFeature(feature);
      }

      /*POP-UP*/
      var element = document.getElementById('popup');

      var popup = new ol.Overlay({
        element: element,
        positioning: 'bottom-center',
        stopEvent: false
      });
      map.addOverlay(popup);

      // display popup on pointermove
      map.on('pointermove', function(evt) {
        var feature = map.forEachFeatureAtPixel(evt.pixel,
            function(feature, layer) {
              return feature;
            });
        if (feature) {
          var geometry = feature.getGeometry();
          var coord = geometry.getCoordinates();
          popup.setPosition(coord);
          $(element).popover({
            'placement': 'bottom',
            'html': true,
            'content': "<p style='width:100px;'>"+feature.get('name')+"</p>"
          });
          $(element).popover('show');
        } else {
          $(element).popover('destroy');
        }
      });

      // change mouse cursor when over marker
      map.on('pointermove', function(e) {
        if (e.dragging) {
          $(element).popover('destroy');
          return;
        }
        var pixel = map.getEventPixel(e.originalEvent);
        var hit = map.hasFeatureAtPixel(pixel);
        map.getTarget().style.cursor = hit ? 'pointer' : '';
      });
      /*END-POP-UP*/

      /*ZOOM*/
      /*document.getElementById('zoom-out').onclick = function() {
        var view = map.getView();
        var zoom = view.getZoom();
        view.setZoom(zoom - 1);
      };

      document.getElementById('zoom-in').onclick = function() {
        var view = map.getView();
        var zoom = view.getZoom();
        view.setZoom(zoom + 1);
      };*/
      /*END-ZOOM*/
  </script>
@endsection