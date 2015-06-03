<?php
load_view("template/top_link_js.php");
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script>
  var map;
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();

  var lat1 = "<?php echo get("loc1lat"); ?>";
  var lng1 = "<?php echo get("loc1lon"); ?>";
  var lat2 = "<?php echo get("loc2lat"); ?>";
  var lng2 = "<?php echo get("loc2lon"); ?>";


function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	var latlng = new google.maps.LatLng(lat1,lng1);
	
	var mapOptions = {
		center: latlng,
		zoom: 13
	};
  	map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);
	
	var point1 = new google.maps.LatLng(lat1,lng1);
	var point2 = new google.maps.LatLng(lat2,lng2);

	var marker1 = new google.maps.Marker({
											position:point1,
											map:map,
											title:'Source',
											icon:'images/blank.png'

										});
	var marker2 = new google.maps.Marker({
											position:point2,
											map:map,
											title:'Destination',
											icon:'images/blank.png'
										});
										
	var bounds = new google.maps.LatLngBounds();
			bounds.extend(marker1.position);
			bounds.extend(marker2.position);
			map.fitBounds(bounds);

	directionsDisplay.setMap(map);
	calcRoute();

  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
	  
	var input2 = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input2'));

  var autocomplete = new google.maps.places.Autocomplete(input);
  var autocomplete2 = new google.maps.places.Autocomplete(input2);


  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      return;
    }   
  });
  
  google.maps.event.addListener(autocomplete2, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete2.getPlace();
    if (!place.geometry) {
      return;
    }   
  });

}

function calcRoute() 
    {  
        start  = new google.maps.LatLng(lat1, lng1);
        end = new google.maps.LatLng(lat2, lng2);
        var request = 
        {
            origin: start,
            destination: end,
            optimizeWaypoints: true,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                var route = response.routes[0];

            }
        });
    }

google.maps.event.addDomListener(window, 'load', initialize);
</script>

  <script>
    $(document).ready(function(){
      $('.checkbox').click(function(){
        if((!$('#checkbox1').is(':checked'))&&(!$('#checkbox2').is(':checked'))&&(!$('#checkbox3').is(':checked'))&&(!$('#checkbox4').is(':checked'))&&(!$('#checkbox5').is(':checked')))
        {
          $('.auto').show();
          $('.hatchback').show();
          $('.sedan').show();
          $('.executive').show();
          $('.suv').show();
        }
        else
        {
          if($('#checkbox1').is(':checked'))
          $('.auto').show();
        if(!$('#checkbox1').is(':checked'))
          $('.auto').hide();

        if($('#checkbox2').is(':checked'))
          $('.hatchback').show();
        if(!$('#checkbox2').is(':checked'))
          $('.hatchback').hide();

        if($('#checkbox3').is(':checked'))
          $('.sedan').show();
        if(!$('#checkbox3').is(':checked'))
          $('.sedan').hide();

        if($('#checkbox4').is(':checked'))
          $('.suv').show();
        if(!$('#checkbox4').is(':checked'))
          $('.suv').hide();

        if($('#checkbox5').is(':checked'))
          $('.executive').show();
        if(!$('#checkbox5').is(':checked'))
          $('.executive').hide();
        } 
      
    }); 
    });
  </script>
</head>
