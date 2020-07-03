<!DOCTYPE HTML>

<html>
   <head>
      
   </head>
   <title>My Google Map Store</title>
   <style type="text/css">
      #map{
         height: 400px;
         width: 500px;
      }
   </style>
   <body>
      <h2>My Google Map</h2>
      <div id="map"></div>
   </body>
   <script type="text/javascript">
      function initMap(){
         if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            console.log(pos.lat);
            console.log(pos.lng);
            var options = 
         {
            zoom: 15,
            center:{lat:pos.lat,lng:pos.lng}
         };
         var map= new google.maps.Map(document.getElementById('map'), options);

         var marker = new google.maps.Marker({
            position:{lat:pos.lat,lng:pos.lng},
            map:map
         });

         var infoWindow = new google.maps.InfoWindow({
            content:'<h2>Shop 1</h2>'
         });

         marker.addListener('click', function(){
            infoWindow.open(map, marker);
         });

      });
       }
    }
   </script>
   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJD-Hv4SomH0-BDoKTc9hUTY2SmrWFAzA&callback=initMap">
    </script>
</html>