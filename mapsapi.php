<?php
include "includes/app.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

    $loc1=get("from",'Hauz Khas, New Delhi').", ".get("city");
    $loc2=get("to",'Green Park, New Delhi').", ".get("city");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="noindex,follow" />
    <title>Loading KnowMiles</title>
    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA7j_Q-rshuWkc8HyFI4V2HxQYPm-xtd00hTQOC0OXpAMO40FHAxT29dNBGfxqMPq5zwdeiDSHEPL89A" type="text/javascript"></script>
    <!-- According to the Google Maps API Terms of Service you are required display a Google map when using the Google Maps API. see: http://code.google.com/apis/maps/terms.html -->
    <script type="text/javascript">

    var geocoder, location1, location2, gDir;

    function initialize(){
        geocoder = new GClientGeocoder();
        gDir = new GDirections();
        GEvent.addListener(gDir, "load", function() 
								        {
                                            var time="<?php echo get("time"); ?>";
								            var drivingDistanceMiles = gDir.getDistance().meters / 1609.344;
								            var drivingDistanceKilometers = gDir.getDistance().meters / 1000;       
								            //document.getElementById('results').innerHTML = '<strong>Address 1: </strong>' + location1.address + ' (' + location1.lat + ':' + location1.lon + ')<br /><strong>Address 2: </strong>' + location2.address + ' (' + location2.lat + ':' + location2.lon + ')<br /><strong>Driving Distance: </strong>' + f + ' miles (or ' + drivingDistanceKilometers + ' kilometers)';
								            var resul = "fulloc1=" + location1.address + "&loc1lat=" + location1.lat + "&loc1lon=" + location1.lon + "&fulloc2=" + location2.address + "&loc2lat=" + location2.lat + "&loc2lon=" + location2.lon + "&dist=" + drivingDistanceKilometers+"&duration_min="+(gDir.getDuration ().seconds/60)+"&time="+time;
                                            
								            window.parent.location.href = "<?php echo HOST; ?>book.php?" + encodeURI(resul);
								        });
		
    }

    function showLocation() 
	{
		
		var loca1 = "<?php echo $loc1; ?>";
		var loca2 = "<?php echo $loc2; ?>";
        geocoder.getLocations(loca1, function (response) 
		{
            if (!response || response.Status.code != 200)
            {
                alert("Sorry, we were unable to geocode the first address");
            }
            else
            {
                location1 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                geocoder.getLocations(loca2, function (response) {
                    if (!response || response.Status.code != 200)
                    {
                        alert("Sorry, we were unable to geocode the second address");
                    }
                    else
                    {
                        location2 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                        gDir.load('from: ' + location1.address + ' to: ' + location2.address);
						
                    }
                });
            }
        });
		
		
    }

    </script>
</head>

<body onload="initialize();showLocation(); return false;">

<!--    <form action="#" onsubmit="showLocation(); return false;">
        <p>
            <input type="text" name="address1" value="Address 1" />
            <input type="text" name="address2" value="Address 2" />
            <input type="submit" value="Search" />
        </p>
    </form>-->
    Loading...
    <p id="results"></p>
    


</body>
    
</html>
<?php
closedb();
?>