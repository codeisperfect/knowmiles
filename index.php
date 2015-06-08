<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();
$myf=User::myprofile();

load_view("template/index_top.php");
?>

<body id="top" class="home page page-template page-template-homepage-php no-js">

<div id="map-canvas" style="width:0px height:0px"></div>

<?php
if(true){

load_view("template/header.php",array("cityolist"=>$_ginfo["allcity"],"myf"=>$myf));

?>
<?php
}
else{
}
?>

<main>

<section class="sect-hero sect-banner js-parallax js-fadie">
 <div class="bg-video">
 </div>
 <h2>
  Travel safely for a fixed price. Mighty Minicabs 24/7.
 </h2>
 <div class="row tran">
  <div class="row">
  <?php
    load_view("locsearchform.php");
  ?>
  </div>
 </div>
 <div class="overlay">
 </div>
</section>

<section id="sect-buy" class="sect-buy dark ">
 
 <div class="block-wrap" style="padding-bottom:30px;">
  <h2 class="tab-title text-center" style="padding-top:30px;">
   Why use KnowMiles?
  </h2>
  <div class="container" style="text-align: center;">
   <div class="row">
    <div class="blog-main">
     <div class="col-md-3 col-sm-3 col-xs-12 blog-left">
      <div class="blog-one wow fadeInDown" data-wow-delay="0.16s">
       <h3 class="title">
        Many Options
       </h3>
       <div class="img-container">
        <img src="images/man.png" />
       </div>
       <p class="sav">
        Compare &amp; Choose cabs from various cab-services based on best price, earliest availability &amp; best rated.
       </p>
      </div>
     </div>
     <div class="col-md-3 col-sm-3 col-xs-12 blog-left">
      <div class="blog-one wow fadeInDown" data-wow-delay="0.14s">
       <h3 class="title">
        One Touch Booking
       </h3>
       <div class="img-container">
        <img src="images/hand.png" />
       </div>
       <p class="sav">
        Now all cabs anywhere, anytime are just a one click away.
       </p>
      </div>
     </div>
     <div class="col-md-3 col-sm-3 col-xs-12 blog-left">
      <div class="blog-one wow fadeInDown" data-wow-delay="0.12s">
       <h3 class="title">
        Rate &amp; Reviews
       </h3>
       <div class="img-container">
        <img src="images/thumb.png" />
       </div>
       <p class="sav">
        Honest ratings by fellow cab-users makes you choose the best cab &amp; hence making life simpler &amp; happier.
       </p>
      </div>
     </div>
     <div class="col-md-3 col-sm-3 col-xs-12 blog-left active">
      <div class="blog-one wow fadeInDown" data-wow-delay="0.1s">
       <h3 class="title">
        Quick &amp; Intuitive
       </h3>
       <div class="img-container">
        <img src="images/light.png" />
       </div>
       <p class="sav">
        Quick &amp; Easy to understand User Interface, advanced search-engine providing results in fractions of second.
       </p>
      </div>
     </div>
     <div class="clearfix">
     </div>
    </div>
   </div>
  </div>
 </div>
</section>
<section class="sect-banner sect-journal js-parallax js-fadie ">
 <div class="row g-full title">
 <h2>So, Book Your Cab NOW!!!</h2>
 </div>
 <div class="overlay">
 </div>
</section>

<section class="sect-instagram js-fadie">
 <div class="container" style="margin-top: 30px;">
  <div class="row">
   <div class="blog-main">
    <div class="col-md-4 col-sm-4 col-xs-12 blog-left">
     <div class="blog-one wow fadeInDown" data-wow-delay="0.4s">
      <img src="images/quote.png" width="30" height="27" />
      <p>
       Fixed price, doesn't increase with traffic couldn't ask for better taxi booking service. Watch as the taxi comes to you feature! Great app no longer have to wonder how far away your cab is.
      </p>
      <p class="author">
       — Tech Steve!, 15&nbsp;July 2014
      </p>
     </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 blog-left">
     <div class="blog-one wow fadeInDown" data-wow-delay="0.1s">
      <img src="images/quote.png" width="30" height="27" />
      <p>
       Brilliant App gets better with every update &amp; the staff are also very helpful when you call or email with your queries.
      </p>
      <p class="author">
       — Boss Lady 74, 18&nbsp;June 2014
      </p>
     </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 blog-left active">
     <div class="blog-one wow fadeInDown" data-wow-delay="0.6s">
      <img src="images/quote.png" width="30" height="27" />
      <p>
       Quick, simple and cheap mini cab bookings. Stores most used addresses and allows you to compare fares by time, price and reviews which is handy. Would recommend.
      </p>
      <p class="author">
       — DoodleDandy80,&nbsp;18&nbsp;June 2014
      </p>
     </div>
    </div>
    <div class="clearfix">
    </div>
   </div>
  </div>
 </div>
</section>
</main>

<?php
load_view("template/footer.php");
load_view("template/bottom.php");
?>


<?php

closedb();
?>
