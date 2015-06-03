<?php require_once('Connections/knowmilestest1.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_knowmilestest1, $knowmilestest1);
$query_cityNameDB2 = "SELECT * FROM city ORDER BY Name ASC";
$cityNameDB2 = mysql_query($query_cityNameDB2, $knowmilestest1) or die(mysql_error());
$row_cityNameDB2 = mysql_fetch_assoc($cityNameDB2);
$totalRows_cityNameDB2 = mysql_num_rows($cityNameDB2);

//REDIRECT
if((!isset($_GET['city'])) || (!isset($_GET['dist'])) || (!isset($_GET['loc1lat'])) || (!isset($_GET['loc1lon'])) || (!isset($_GET['loc2lat'])) || (!isset($_GET['loc2lon'])) || (!isset($_GET['fulloc1'])) || (!isset($_GET['fulloc2'])))
{
	header("Location: http://knowmiles.hostingsiteforfree.com/knowmiles/index.php");
}	


//Cheapest filling 
$city = $_GET['city'];
$distance = ceil($_GET['dist']);


$query_cheapestFill = "
SELECT `Charge`, `ProviderName`, `TypeName` FROM 
(
  ((SELECT `DayBaseFare` AS `Charge`, `fare`.`ServiceID` AS `SID` FROM `fare`, `service`, `city` 
    WHERE `DayBaseKm` >= " . $distance . "
    AND (`fare`.`ServiceID` = `service`.`ServiceID`)
    AND (`service`.`CityID` = `city`.`CityID`)
    AND (`city`.`Name` = '" . $city . "')
  )
  UNION
  (SELECT (`DayBaseFare` + ((" . $distance . "-`DayBaseKm`)*`DayFarePerKm`) ) AS `Charge`, `fare`.`ServiceID` AS `SID` FROM `fare`, `service`, `city`  
    WHERE `DayBaseKm` < " . $distance . "
    AND (`fare`.`ServiceID` = `service`.`ServiceID`)
    AND (`service`.`CityID` = `city`.`CityID`)
    AND (`city`.`Name` = '" . $city . "') 
  )) AS `ttabble`
), `provider`, `cartype`,`service` 
  WHERE `SID` = `service`.`ServiceID`
  AND `service`.`ProviderID` = `provider`.`ProviderID`
  AND `service`.`CarTypeID` = `cartype`.`CarTypeID`
  ORDER BY `Charge` ASC";

$cheapestFill = mysql_query($query_cheapestFill, $knowmilestest1) or die(mysql_error());
$row_cheapestFill = mysql_fetch_assoc($cheapestFill);
$totalRows_cheapestFill = mysql_num_rows($cheapestFill);


?>
<!DOCTYPE html>
<html lang="en">
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<!-- *************************************************************************************** -->
<head>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>

<script>

var map;
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();


  var lat1 = "<?php echo $_GET['loc1lat']; ?>";
  var lng1 = "<?php echo $_GET['loc1lon']; ?>";
  var lat2 = "<?php echo $_GET['loc2lat']; ?>";
  var lng2 = "<?php echo $_GET['loc2lon']; ?>";

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

<!-- *************************************************************************************** -->


<!-- Title and Meta
================================================== -->
<meta charset="UTF-8">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->

<title>KnowMiles</title>


<!-- Mobile
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1, user-scalable=no" />       


  

<!-- CSS & Js
================================================== -->

<link rel="stylesheet" href="wp-content/themes/woodshed/assets/css/app.min.css">
<link rel="stylesheet" href="css/second.css">
 <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="wp-content/themes/woodshed/assets/css/fonts.min.css">
<link href="lightbox/jquery.fs.boxer.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type='text/javascript' src='wp-content/themes/woodshed/assets/js/jquery.js'></script>
<script>document.documentElement.className = document.documentElement.className.replace('no-js','js');</script>

</head>
<body>
<header>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index:9">
      <div class="container hed" style="width:95%;" id="section7">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <h1 id="logo" class="log">
        <a href="index.php">
          <img src="images/logo-light.png"  alt="Wood Shed" />
            </a>
        </h1>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right pull-right right-nav">
<li style="padding-right: 5px">

              <a href="navbar-static-top.html#" class="dropdown-toggle" data-toggle="dropdown">User<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="navbar-static-top.html#">Action</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
              </ul>
</li> 
</ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>

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
</header>
<main>



<div class="container">
<div class="row">
    <form action="helper/mapsapi.php" class="new-search-sec" method="post">
            
              <div class="row">
              <div class="container">
              <div class="col-md-12 col-sm-12 sec-tran bac">
              <div class="row">
              <div class="col-md-2 col-sm-2" style="margin-top: 0px;padding-left: 10px; color:#00A0E1"><h3 class="hed" style="padding-top: 24px;
 ">Your Journey</h3></div>
              <div class="col-xs-12 col-sm-2 col-md-2 search-text-1 pad-inpu" style="margin-top: 7px; padding-top: 5px">
              <select name="city" class="text-from-2 select-3 common-dropdown-project-select-2" >
              <option selected="true">
              <?php
			  	echo $_GET['city'];
			  ?>
              </option>
                <?php
do {  
?>
                <option value="<?php echo $row_cityNameDB2['Name']?>"><?php echo $row_cityNameDB2['Name']?></option>
                <?php
} while ($row_cityNameDB2 = mysql_fetch_assoc($cityNameDB2));
  $rows = mysql_num_rows($cityNameDB2);
  if($rows > 0) {
      mysql_data_seek($cityNameDB2, 0);
    $row_cityNameDB2 = mysql_fetch_assoc($cityNameDB2);
  }
?>
              </select>
                
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2 search-text-1 pad-inpu" style="margin-top: 7px; padding-top: 5px"; >
                <input type="text" name="from" placeholder="<?php if(isset($_GET['fulloc1'])) echo $_GET['fulloc1']; else echo 'From'?>" id="pac-input" class="text-from-2 from-2" max="100" >
              </div>	
              <div class="col-xs-12 col-sm-2 col-md-2 search-text-1 pad-inpu" style="margin-top: 7px; padding-top: 5px"; >
               <input type="text" name="to" placeholder="<?php if(isset($_GET['fulloc2'])) echo $_GET['fulloc2']; else echo 'To'?>" id="pac-input2" class="text-from-2 from-2" max="100">
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2 search-text-1 pad-inpu" style="margin-top: 7px; padding-top: 5px"; >
              
                <input type="text" name="time" placeholder="ASAP" class="text-from-2 picup-1 form_datetime1" max="100" >
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2 search-text-1 pad-inpu" style="margin-top: 7px;  padding-right: 15px">
                <button type="submit" id="but" class="global-input btn-ani btn-ani-4 btn-ani-4a hvr-icon-wobble-horizontal" style="width: 100%; font-size: 20px; font-weight: 500;"> Let's go </button>
              </div>
              </div>
              </div>
              </div>
              
            </div>
          
            
      
    </form>   
  </div>
<!--
  <?php
  print_r($_GET);
?>-->
        
    <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12">
    
    <div class="row">
    
    <!-- ****************************************************************************** -->    
    
    <form style="padding-top:0% !important">
    <div class="col-md-2 col-sm-8"><h4 style="padding-top: 18px; color: #00A0E1"> Car Type</h4>
     
    </div>
    <div class="col-md-2 col-sm-8 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-4" style="margin-top: 7px;">
            <img src="images/auto.png" alt="auto" />
          </div>
    <div class="col-md-12 col-sm-4 col-xs-4">
    <input type="checkbox" id="checkbox1" class="checkbox">
    </div>
    
    <div></div>
    </div>
    <div class="col-md-2 col-sm-8 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-4" style="margin-top: 7px;">
            <img src="images/car.png" alt="auto" />
          </div>
    <div class="col-md-12 col-sm-4 col-xs-4">
    <input type="checkbox" value="" id="checkbox2" data-toggle="checkbox" class="checkbox">
    </div>
    
    <div></div>
    </div>
    <div class="col-md-2 col-sm-8 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-4" style="margin-top: 7px;">
            <img src="images/car2.png" alt="auto" />
          </div>
    <div class="col-md-12 col-sm-4 col-xs-4">
    <input type="checkbox" value="" id="checkbox3" data-toggle="checkbox" class="checkbox">
    </div>
    
    <div></div>
    </div>
    <div class="col-md-2 col-sm-8 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-4" style="margin-top: 7px;">
            <img src="images/suv.png" alt="auto" />
          </div>
    <div class="col-md-12 col-sm-4 col-xs-4">
    <input type="checkbox" value="" id="checkbox4" data-toggle="checkbox" class="checkbox">
    </div>
    
    <div></div>
    </div>
    <div class="col-md-2 col-sm-8 col-xs-12">
    <div class="col-md-12 col-sm-12 col-xs-4" style="margin-top: 7px;">
            <img src="images/suv2.png" alt="auto" />
          </div>
    <div class="col-md-12 col-sm-4 col-xs-4">
    <input type="checkbox" value="" id="checkbox5" data-toggle="checkbox" class="checkbox">
    </div>
    
    <div></div>
    </div>


    </form>
    
    <!-- ****************************************************************************** -->
    
    </div>
    <div class="row">
    <div class="col-md-12 col-sm-12">
    <div class="tabbable">
                <ul class="nav nav-tabs">
                  <li class="active tab-li col-md-4  col-sm-4 col-xs-12 pad-imp"><a href="tabs-pills.html#tabs1-pane1" data-toggle="tab" class="lef-tab teb">Cheapest</a></li>
                  <li class="tab-li col-md-4  col-sm-4 col-xs-12 pad-imp"><a href="tabs-pills.html#tabs1-pane2" data-toggle="tab" class="lef-tab teb">Closest</a></li>
                  <li class="tab-li col-md-4  col-sm-4 col-xs-12 pad-imp"><a href="tabs-pills.html#tabs1-pane3" data-toggle="tab" class="lef-tab teb">Best Rated</a></li>
                  
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tabs1-pane1">
                  
                                    
<!--********************************************************************************************************************-->   
<?php
  

  do {
      $provider = $row_cheapestFill['ProviderName'];
      $cabType = $row_cheapestFill['TypeName'];

      if(($cabType == 'Mini') || ($cabType == 'Nano') || ($cabType == 'Uber Go'))
      {
		  $cabTypeImg = 'images/car.png';
		  $cabFilter = 'hatchback';
	  }
      elseif (($cabType == 'Radio Taxi')  || ($cabType == 'Uber X') || ($cabType == 'Sedan') || ($cabType == 'Uber Dynamic'))
      {
		  $cabTypeImg = 'images/car2.png';
		  $cabFilter = 'sedan';		  
	  }
      elseif (($cabType == 'Prime') || ($cabType == 'Uber Black'))
      {
		  $cabTypeImg = 'images/suv2.png';
		  $cabFilter = 'executive';		  
	  }
      else
      {
		  $cabTypeImg = 'images/suv.png';
		  $cabFilter = 'suv';		  
	  }



      $rating = 4;
      $ratingCount = 7;
      $offerStatement = 'Get 1st ride FREE!!!';
      $cost = $row_cheapestFill['Charge'];
?>                                 
<div class="<?php echo $cabFilter?>">
                    <div class="row cab-box" >
                    
                                        <div class="col-md-12 col-sm-12" >
                                        <div class="row">
                                        <div class="col-md-2 name-cab"><?php echo $provider; ?></div>
                                        <div class="col-md-2 col-sm-4 col-xs-4 cad-pad"><img src=<?php echo $cabTypeImg; ?>  class="car-img"><span><?php echo $cabType; ?></span></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ratin">
                                        <span>
                                        <?php
                                          for ($i=0; $i < $rating; $i++) { 
                                            echo '<i class="fa fa-star"></i>';
                                          }
                                        ?>
                                          
                                        </span>
                                        <p class="per-pd">Ratings(<?php echo $ratingCount; ?>)</p>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options" ><a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h5><?php echo $offerStatement; ?></h5>" ><span class="offer">Offers!!!</span></a></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options"><a href="#" class="off-ti" data-toggle="tooltip" title="<h5>Estimated cost of <?php echo $distance ?> km ride</h5>" data-placement="bottom"><span class="rupee"><i class="fa fa-rupee"></i><?php echo $cost; ?></span></a></div>
                                       <div class="col-md-2 col-sm-2 col-xs-12 ll-l"><a href="#" class="button book-nw"><i class="fa fa-right-arrow"></i>  Book Now</a></div>
                                       </div>
                                       </div>
                                        </div>
                                        </div>
<?php
} while ($row_cheapestFill = mysql_fetch_assoc($cheapestFill));
  $rows = mysql_num_rows($cheapestFill);
  if($rows > 0) {
      mysql_data_seek($cheapestFill, 0);
    $row_cheapestFill = mysql_fetch_assoc($cheapestFill);
  }
?>

                                        
<!--********************************************************************************************************************-->
                    
                                        </div>
                                       
                  
                  <div class="tab-pane" id="tabs1-pane2">
                    <div class="row cab-box">
                                        <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                        <div class="col-md-2 name-cab"><span>Ola Cab</span></div>
                                        <div class="col-md-2 col-sm-4 col-xs-4 cad-pad"><img src="images/car.png"  class="car-img"><span>Mini/HatchBack</span></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ratin"><span><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i></span>
                                        <p class="per-pd">Ratings(7)</p>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options" ><a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" ><span class="offer">Offers!!!</span></a></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options"><a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom"><span class="rupee"><i class="fa fa-rupee"></i>  150</span></a></div>
                                       <div class="col-md-2 col-sm-2 col-xs-12 ll-l"><a href="#" class="button book-nw"><i class="fa fa-right-arrow"></i> Book Now</a></div>
                                       </div>
                                        </div>
                                        </div>
                    <div class="row cab-box">
                                        <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                        <div class="col-md-2 name-cab"><span>Meru</span></div>
                                        <div class="col-md-2 col-sm-4 col-xs-4 cad-pad"><img src="images/car.png"  class="car-img"><span>Mini/HatchBack</span></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ratin"><span><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i></span>
                                        <p class="per-pd">Ratings(7)</p>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options" ><a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" ><span class="offer">Offers!!!</span></a></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options"><a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom"><span class="rupee"><i class="fa fa-rupee"></i>  138</span></a></div>
                                       <div class="col-md-2 col-sm-2 col-xs-12 ll-l"><a href="#" class="button book-nw"><i class="fa fa-right-arrow"></i> Book Now</a></div>
                                       </div>
                                        </div>
                                        </div>
                                        <div class="row cab-box">
                                        <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                        <div class="col-md-2 name-cab"><span>Uber</span></div>
                                        <div class="col-md-2 col-sm-4 col-xs-4 cad-pad"><img src="images/car.png"  class="car-img"><span>Mini/HatchBack</span></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ratin"><span><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i></span>
                                        <p class="per-pd">Ratings(7)</p>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options" ><a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" ><span class="offer">Offers!!!</span></a></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options"><a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom"><span class="rupee"><i class="fa fa-rupee"></i>  180</span></a></div>
                                       <div class="col-md-2 col-sm-2 col-xs-12 ll-l"><a href="#" class="button book-nw"><i class="fa fa-right-arrow"></i> Book Now</a></div>
                                       </div>
                                        </div>
                                        </div>
                                        
                  </div>
                  <div class="tab-pane" id="tabs1-pane3">
                    <div class="row cab-box">
                                        <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                        <div class="col-md-2 name-cab"><span>Uber</span></div>
                                        <div class="col-md-2 col-sm-4 col-xs-4 cad-pad"><img src="images/car.png"  class="car-img"><span>Mini/HatchBack</span></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ratin"><span><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i></span>
                                        <p class="per-pd">Ratings(7)</p>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options" ><a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" ><span class="offer">Offers!!!</span></a></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options"><a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom"><span class="rupee"><i class="fa fa-rupee"></i>  180</span></a></div>
                                       <div class="col-md-2 col-sm-2 col-xs-12 ll-l"><a href="#" class="button book-nw"><i class="fa fa-right-arrow"></i> Book Now</a></div>
                                       </div>
                                        </div>
                                        </div>
                    <div class="row cab-box">
                                        <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                        <div class="col-md-2 name-cab"><span>Meru</span></div>
                                        <div class="col-md-2 col-sm-4 col-xs-4 cad-pad"><img src="images/car.png"  class="car-img"><span>Mini/HatchBack</span></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ratin"><span><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i></span>
                                        <p class="per-pd">Ratings(7)</p>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options" ><a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" ><span class="offer">Offers!!!</span></a></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options"><a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom"><span class="rupee"><i class="fa fa-rupee"></i>  138</span></a></div>
                                       <div class="col-md-2 col-sm-2 col-xs-12 ll-l"><a href="#" class="button book-nw"><i class="fa fa-right-arrow"></i> Book Now</a></div>
                                       </div>
                                        </div>
                                        </div>
                                        <div class="row cab-box">
                                        <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                        <div class="col-md-2 name-cab"><span>Ola Cab</span></div>
                                        <div class="col-md-2 col-sm-4 col-xs-4 cad-pad"><img src="images/car.png"  class="car-img"><span>Mini/HatchBack</span></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ratin"><span><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i></span>
                                        <p class="per-pd">Ratings(7)</p>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options" ><a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" ><span class="offer">Offers!!!</span></a></div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options"><a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom"><span class="rupee"><i class="fa fa-rupee"></i>  150</span></a></div>
                                       <div class="col-md-2 col-sm-2 col-xs-12 ll-l"><a href="#" class="button book-nw"><i class="fa fa-right-arrow"></i> Book Now</a></div>
                                       </div>
                                        </div>
                                        </div>                  </div>
                  
                </div><!-- /.tab-content -->
              </div>
                            </div>
    </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">

    <!-- TO INSERT HERE *************************************************************** -->
    
    


	<style type="text/css">
		#map-canvas
		{
			height: 500px;
			width: 400px;
			margin: 0px;
			padding: 0px
		}
	</style>
	    <div id='map-canvas'></div>
    </div>
    </div>
</div>
</main>
<footer class="footer-main xl">
  <div class="row">
      
      <div class="col-md-4 col-sm-4"><h3 class="fot-titele">Our company</h3>
            <ul class="ul-list">
                    <li><a href="#">Minicab locations</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <!--<li><a href="/page/press">Press</a></li>-->
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-4"><h3 class="fot-titele">Support</h3>
            <ul class="ul-list">
                    <li><a href="#">For customers</a></li>
                    <li><a href="#">For fleets</a></li>
                    <li><a href="#">For partners</a></li>
                </ul>
            </div>  
            <div class="col-md-4 col-sm-4"><h3 class="fot-titele">Legal</h3>
            <ul class="ul-list">
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>      
  </div>
  <div class="row">
            <div class="col-xs-3 col-xs-offset-3 icon-footer">
                <span class="title-footer">Keep up with us</span>
                <div class="nav horizontal">
                    <a analytics-on="click" analytics-category="Facebook" analytics-event="View" target="_blank" href="#" class="social fb ng-scope"><i class="fa fa-facebook-square"></i></a>
                        <a analytics-on="click" analytics-category="Twitter" analytics-event="View" target="_blank" href="#" class="social tw ng-scope"><i class="fa fa-twitter-square"></i></a>
                       <a analytics-on="click" analytics-category="Google +" analytics-event="View" target="_blank" href="#" class="social gp ng-scope"><i class="fa fa-google-plus-square"></i></a>
                </div>
            </div>

            <div class="col-xs-3 icon-footer">
                <span class="title-footer">Get our apps</span>
                <div class="nav horizontal">
                    <a analytics-on="click" analytics-category="Apple Store" analytics-event="View" target="_blank" href="#" class="store ios ng-scope"><i class="fa fa-apple"></i></a>
                        
                        <a analytics-on="click" analytics-category="Blackberry World" analytics-event="View" target="_blank" href="#" class="store bl ng-scope"><i class="fa fa-android"></i></a>
                        <a analytics-on="click" analytics-category="Windows Market" analytics-event="View" target="_blank" href="#" class="store win ng-scope"><i class="fa fa-windows"></i></a>
                    
                </div>

            </div>
            
        </div>
        <div class="row ">
        <div class="copyright col-xs-12  ">© Copyright 2015. All rights reserved.</div>
        </div>
</footer>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('a[href^="#"]').click(function(){  
        var the_id = $(this).attr("href");  
        $('html, body').animate({  
            scrollTop:$(the_id).offset().top  
        }, 'slow');  
        return false;  
    });

    $(".form_datetime1").datetimepicker({format: 'yyyy-mm-dd hh:ii', forceParse: true});
    
  </script>
  <script>
      $(function () { $('.tooltip-show').tooltip('show');});
      $(function () { $('.tooltip-hide').tooltip('hide');});
      $(function () { $('.tooltip-destroy').tooltip('destroy');});
      $(function () { $('.tooltip-toggle').tooltip('toggle');});
      $(function () { $(".tooltip-options a").tooltip({html : true });
      });
   </script>
</body>
</html>
<?php
mysql_free_result($cityNameDB2);
?>