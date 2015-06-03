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
$query_cityNameDB = "SELECT * FROM city ORDER BY Name ASC";
$cityNameDB = mysql_query($query_cityNameDB, $knowmilestest1) or die(mysql_error());
$row_cityNameDB = mysql_fetch_assoc($cityNameDB);
$totalRows_cityNameDB = mysql_num_rows($cityNameDB);
?>
<!DOCTYPE html>
<html lang="en">
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<!-- Title and Meta
================================================== -->
<meta charset="UTF-8">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->

<title>Quick Pic Up</title>


<!-- Mobile
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1, user-scalable=no" />				


	

<!-- CSS & Js
================================================== -->

<link rel="stylesheet" href="wp-content/themes/woodshed/assets/css/app.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
 <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="wp-content/themes/woodshed/assets/css/fonts.min.css">
<link href="lightbox/jquery.fs.boxer.css" media="all" rel="stylesheet" type="text/css" />
<!--animated-css-->
		<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/wow.min.js"></script>
		<script>
		 new WOW().init();
		</script>
<!--animated-css-->  
<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type='text/javascript' src='wp-content/themes/woodshed/assets/js/jquery.js'></script>
<script>document.documentElement.className = document.documentElement.className.replace('no-js','js');</script>

</head>

<body id="top" class="home page page-template page-template-homepage-php no-js">

<!-- Header
================================================== -->

<header >
 
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index:9">
      <div class="container hed" style="width:92.5%;" id="section7">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <h1 id="logo">
  	  	<a href="index.html">
  	  		<img src="images/logo-light.png"	alt="Wood Shed"	/>
						</a>
				</h1>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right pull-right right-nav">

<li style="padding-right: 5px">
<a class=" boxer" style="color:#fff;"  href="#hidden_content">
Log In
</a>
<div id="hidden_content" style="display: none;">
                  <div style="color:#069; width:435px; height:335px;margin:0;padding:0px;">
                  <div class="col-md-12 login"><h4 class="modal-title">Log in to your KnowMiles account</h4>
                  </div>
<?php          
/*Login Form *******************************************************************************************
*/
?>                  
<form action="helper/login_helper.php" method="post" name="formlogin">                  
				<div class="col-md-12 login"><input type="text" name="Email" placeholder="Email Id" class="login-text" max="100"></div>
                <div class="col-md-12 login"><input type="password" name="Email Id" placeholder="Password" class="login-text" max="100"></div>
                <div class="col-md-12 login">
    	<label>
    		<input type="checkbox" name="remember" value="1" id="remember" style="margin-top :10px;">			<label for="remember">&nbsp;Remember me</label>	    </label><a class="pull-right selected-blue" href="#/account/password/renew" ng-click="close_modal('#sign-in')">Forgot password?</a>
	</div>
                  <div class="col-md-12 login"><button class="btn btn-primary btn-lg login-text" type="submit" >
                                <span class="text">Log in</span>
                                <span class="spinner"></span>
                            </button></div>
                  <div class="col-md-12"><div class="text-center">
                            <label>Don’t have a KnowMiles account? <a class="selected-blue" data-toggle="modal" data-target="#sign-up" ng-click="close_modal('#sign-in')">Sign up</a></label>
                        </div></div></form>
                  
    			
                  </div>
                    
                 
                </div>
</li>
<li>


<a href="#sigup" class="boxer" style="color:#fff;">
Sign Up
</a>
<div id="sigup" style="display: none;">
                  <div style="color:#069; width:435px; height: 550px;margin:0;padding:0px;">
                  
                  <div class="col-md-12 login"><h4 class="modal-title">Create your KnowMiles account</h4>
                  <br>
                  KnowMiles respects your privacy and will never give your details to any third party without your permission.
                  </div>
                  <!--<div class="row row-in">                  !-->
                  
<?php          
/*SignUp *******************************************************************************************
*/
?>                   
                 <form action="helper/signup_helper.php" method="post" name="formsignup"> <div class="login1 col-md-6 col-xs-6"><input type="text" name="fName" placeholder="First Name" class="login-text2" max="100"></div>
                  <div class="login1 col-md-6 col-xs-6"  style="padding-left:0px !important;"><input type="text" name="lName" placeholder="Last Name" class="login-text2" max="100"></div>
                  <!--</div>!-->
                  <div class="col-md-12 login"><input type="email" name="emailId" placeholder="Email Id" class="login-text" max="100"></div>
                   <div class="col-md-12 login"><input type="tel" name="telephone" placeholder="Mobile No." class="login-text" max="100"></div>
                    <div class="col-md-12 login"><input type="password" name="passOne" placeholder="Password" class="login-text" max="100"></div>
                     <div class="col-md-12 login"><input type="password" name="passTwo" placeholder="Confirm Password" class="login-text" max="100"></div>
                  <div class="row-in login">
                            <input name="accept_conditions_1" type="checkbox" checked="checked" value="True">
                            <span>I accept the <a href="/page/terms-and-conditions" class="selected-blue" ng-click="close_modal('#sign-up')">KnowMiles terms &amp; conditions</a></span>
                        </div>
                  <div class="col-md-12 login"><button class="btn btn-primary btn-lg login-text" type="submit" >
                                <span class="text">Create Account</span>
                                <span class="spinner"></span>
                            </button></div></form>
                            
                            
                  <div class="text-center login">
                            Already got an account? <a class="selected-blue" data-toggle="modal" data-target="#sign-in" ng-click="close_modal('#sign-up')">Sign in</a>
                        </div>
                  
    			
                  </div>
                    
                 
                </div>
</li> 
<li style="padding-right: 5px">
<a href="">
Blog
</a>
<li style="padding-right: 5px">
<a href="#">
Help
</a>
</ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>


<!-- Main
================================================== -->
<main>
<!-- sect: Hero
================================================== -->
<?php
/*Form One - Main *******************************************************************************************
*/
?>
<section class="sect-hero sect-banner js-parallax js-fadie">
<div class="bg-video"></div>
	<h2>Travel safely for a fixed price. Mighty Minicabs 24/7.</h2>
    <div class="row tran">
		<div class="row">
		<form action="helper/mapsapi.php" class="new-search-sec" method="post">
          	
              <div class="row">
              <div class="container"><div class="col-md-1"></div>
              <div class="col-md-11 col-sm-11 sec-tran bac">
              
              <div class="row">
              
              <div class="col-xs-12 col-sm-3 col-md-3 search-text pad-inpu" style="margin-top: 7px;">
                <select name="city" class="text-from select common-dropdown-project-select">
                  <?php
do {  
?>
<?php 
	//Chenged from 'CityID' to 'Name' in the first square bracket !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
?>
                  <option value="<?php echo $row_cityNameDB['Name']?>"><?php echo $row_cityNameDB['Name']?></option>
                  <?php
} while ($row_cityNameDB = mysql_fetch_assoc($cityNameDB));
  $rows = mysql_num_rows($cityNameDB);
  if($rows > 0) {
      mysql_data_seek($cityNameDB, 0);
	  $row_cityNameDB = mysql_fetch_assoc($cityNameDB);
  }
?>
                </select>
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2 search-text pad-inpu" style="margin-top: 7px;">
                <input type="text" name="from" placeholder="From" class="text-from from" max="100">
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2 search-text pad-inpu" style="margin-top: 7px;">
               <input type="text" name="to" placeholder="To" class="text-from from" max="100">
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3 search-text pad-inpu" style="margin-top: 7px;">
              
                <input type="text" name="time" placeholder="ASAP" class="text-from picup form_datetime1" max="100">
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2 search-text pad-inpu" style="margin-top: 7px;  padding-right: 10px;">
                <button type="submit" id="but" class="global-input btn-ani btn-ani-4 btn-ani-4a hvr-icon-wobble-horizontal" style="width: 100%; font-size: 20px; font-weight: 500;"> Let's go </button>
              </div>
              </div>
              </div>
              </div>
              
            </div>
       		
            
      
    </form>
	</div>
	</div>
    
	<div class="overlay"></div>
</section>

<!-- sect: Intro
================================================== -->
<!--<section class="sect-banner sect-journal js-parallax js-fadie">
  
</section>-->

<!-- sect: Where to Buy
================================================== -->

<section id="sect-buy" class="sect-buy dark ">
<!--<img	class="icon icon-buy" src="images/icon-wheretobuy.png"	alt=""	/>-->
<div class="block-wrap">
<h2 class="tab-title text-center">
      Why use KnowMiles?
    </h2>
	 
		<div class="container">
        <div class="row">
			<div class="blog-main">
				<div class="col-md-3 col-sm-3 col-xs-12 blog-left">
					<div class="blog-one wow bounceInLeft" data-wow-delay="0.1s">
						<h3 class="title">Many Options</h3>
                    <div class="img-container"><img src="images/how-it-works-1.png"></div>
                    <p class="sav">
                        Compare &amp; Choose cabs from various cab-services based on best price, earliest availability &amp; best rated. 
                    </p>
						
						
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 blog-left">
					<div class="blog-one wow bounce" data-wow-delay="0.1s">
						<h3 class="title">One Touch Booking</h3>
                    <div class="img-container"><img src="images/how-it-works-2.png"></div>
                    <p class="sav">
                       Now all cabs anywhere, anytime are just a one click away. 
                    </p>
					</div>
				</div>
                <div class="col-md-3 col-sm-3 col-xs-12 blog-left">
					<div class="blog-one wow bounce" data-wow-delay="0.4s">
						<h3 class="title">Rate &amp; Reviews</h3>
                    <div class="img-container"><img src="images/how-it-works-3.png"></div>
                    <p class="sav">
                        Honest ratings by fellow cab-users makes you choose the best cab &amp; hence making life simpler &amp; happier.
                    </p>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 blog-left active">
					<div class="blog-one wow bounceInRight" data-wow-delay="0.1s">
						<h3 class="title">Quick &amp; Intuitive</h3>
                    <div class="img-container"><img src="images/how-it-works-4.png"></div>
                    <p class="sav">
                        Quick &amp; Easy to understand User Interface, advanced search-engine providing results in fractions of second.  
                    </p>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
            </div>
		</div>
	
    
	</div>
</section>


<section class="sect-banner sect-journal js-parallax js-fadie ">
	<div class="row g-full title">
	</div>
	
	<div class="overlay"></div>
</section>


<!-- sect: instagram
================================================== -->
<section class="sect-instagram js-fadie">


<div class="container" style="margin-top: 30px;">
        <div class="row">
			<div class="blog-main">
				<div class="col-md-4 col-sm-4 col-xs-12 blog-left">
					<div class="blog-one wow bounceInLeft" data-wow-delay="0.4s">
						<img src="images/quote.png" width="30" height="27">
                    <p>
                        Fixed price, doesn't increase with traffic couldn't ask for better taxi booking service. Watch as the taxi comes to you feature! Great app no longer have to wonder how far away your cab is.
                    </p>
                    <p class="author">— Tech Steve!, 15&nbsp;July 2014</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 blog-left">
					<div class="blog-one wow bounce" data-wow-delay="0.1s">
						<img src="images/quote.png" width="30" height="27">
                    <p>
                        Brilliant App gets better with every update &amp; the Kabbee staff are also very helpful when you call or email with your queries.
                    </p>
                    <p class="author">— Boss Lady 74, 18&nbsp;June 2014</p>
					</div>
				</div>
                
				<div class="col-md-4 col-sm-4 col-xs-12 blog-left active">
					<div class="blog-one wow bounceInRight" data-wow-delay="0.6s">
						<img src="images/quote.png" width="30" height="27">
                    <p>
                        Quick, simple and cheap mini cab bookings. Stores most used addresses and allows you to compare fares by time, price and reviews which is handy. Would recommend.
                    </p>
                    <p class="author">— DoodleDandy80,&nbsp;18&nbsp;June 2014</p>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
            </div>
		</div>


</section>

<!-- sect:Bio
================================================== -->

<!--<section class="sect-banner sect-journal js-parallax js-fadie ">
	<div class="row g-full title">
		<!--<a class="link-line" href="#"><h2>Wood Shed Journal</h2></a>-->
	<!--</div>
	
	<div class="overlay"></div>
</section>

</main>

<!-- ==============================================
Where To Buy
=================================================== -->	



</main>

<!-- Footer
================================================== -->	
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

<!-- Le javascript
================================================== -->	
<script type='text/javascript' src='wp-content/themes/woodshed/assets/js/plugins.min.js'></script>
<script type='text/javascript' src='wp-content/themes/woodshed/assets/js/scripts.min.js'></script>
<script type='text/javascript' src='wp-includes/js/comment-reply.min.js'></script>
<script src="lightbox/jquery.fs.boxer.js"></script><script>
			$(document).ready(function() {
				$(".boxer").not(".retina, .boxer_fixed, .boxer_top, .boxer_format, .boxer_mobile, .boxer_object").boxer();

				$(".boxer.boxer_fixed").boxer({
					fixed: true
				});

				$(".boxer.boxer_top").boxer({
					top: 50
				});

				$(".boxer.retina").boxer({
					retina: true
				});

				$(".boxer.boxer_format").boxer({
					formatter: function($target) {
						return '<h3>' + $target.attr("title") + "</h3>";
					}
				});

				$(".boxer.boxer_object").click(function(e) {
					e.preventDefault();
					e.stopPropagation();

					
				});

				$(".boxer.boxer_mobile").boxer({
					mobile: true
				});
			});
		</script>

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
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

    $('.show1').click(function(){
	$('#pop1').simplePopup();
    });
  
    $('.show2').click(function(){
	$('#pop2').simplePopup();
    });  
  
});

</script>
</body>
</html>
<?php
mysql_free_result($cityNameDB);
?>
>
<?php
;
?>
>