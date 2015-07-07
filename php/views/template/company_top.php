<?php
load_view("template/top_link_js.php");
?>
  <script src="js/wow.min.js"></script>
  <script>
   new WOW().init();
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
  <script>
    function initialize() {
      var mapOptions = {
        center: new google.maps.LatLng(-33.8688, 151.2195),
        zoom: 13
      };
      var map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);

      var input = /** @type {HTMLInputElement} */(
          document.getElementById('pac-input'));
        
      var input2 = /** @type {HTMLInputElement} */(
          document.getElementById('pac-input2'));
      
      

      var autocomplete = new google.maps.places.Autocomplete(input);
      var autocomplete2 = new google.maps.places.Autocomplete(input2);
      

      google.maps.event.addListener(autocomplete, 'place_changed', function() {
//        infowindow.close();
//        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          return;
        }

      });
      
      google.maps.event.addListener(autocomplete2, 'place_changed', function() {
//        infowindow.close();
//        marker.setVisible(false);
        var place = autocomplete2.getPlace();
        if (!place.geometry) {
          return;
        }   
      });

    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>

<style>
.btn-trans{

  background: transparent;
  color: #FFFFFF;

  -webkit-transition: background .2s ease-in-out, border .2s ease-in-out;
  -moz-transition: background .2s ease-in-out, border .2s ease-in-out;
  -ms-transition: background .2s ease-in-out, border .2s ease-in-out;
  -o-transition: background .2s ease-in-out, border .2s ease-in-out;
  transition: background .2s ease-in-out, border .2s ease-in-out;

}

.col-centered{
    float: none;
    margin: 0 auto;
}

</style>

<link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

<script src="js/star-rating.js" type="text/javascript"></script>

</head>
