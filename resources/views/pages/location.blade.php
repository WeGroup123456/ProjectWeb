@section('title')
  Location
@endsection
@extends('layout.index')
@section('content')

@include('slide.index')

<div class="clearfix"></div>
<div class="container_fullwidth">
   <div class="container">
      <section id="location" class="location">
  <h3 class="location-shop text-center" style="padding:20px 100px;color:#2d3033;font-weight: 700;">Các cơ sở của shop</h3><hr>
  <div id="map" style="height:500px;width:100%;"><div id="popup"></div></div>
   <script src="op/jquery/dist/jquery.js"></script>
  <script type="text/javascript" src="op/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="op/openlayers/ol.js"></script>
  <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
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
            'content': "<p style='width: 150px;'>"+feature.get('name')+"</p>"
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
  </script>
</section>
      @include('pages.ours_brands')
   </div>
</div>
@endsection
