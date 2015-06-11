<main>

<section class="sect-hero sect-banner js-parallax js-fadie">
 <div class="bg-video">
 </div>
 <h2>
  Compare & book best suited cab, with just a tap
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
       It's just perfect, odds of getting the cab at any instant is simply much higher now, no worries for me now for getting best cab.

      </p>
      <p class="author">
       - Sam Stevens, 10 June 2015

      </p>
     </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 blog-left">
     <div class="blog-one wow fadeInDown" data-wow-delay="0.1s">
      <img src="images/quote.png" width="30" height="27" />
      <p>
       Now I dont need to switch to multiple cab apps to compare timing and rates, infact it wont redirect instead simply books the cab, literally just "1-touch booking"  :)   .

      </p>
      <p class="author">
       - Crostini, 9 June 2015
      </p>
     </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 blog-left active">
     <div class="blog-one wow fadeInDown" data-wow-delay="0.6s">
      <img src="images/quote.png" width="30" height="27" />
      <p>
       Can now save my lots of money and time to get the best cab, Oh I must say it, "I'm lovin it" this time for KnowMiles, sorry McD :')  

      </p>
      <p class="author">
       — Humpty Dumpty,  11 June 2015 
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
load_view("template/bottom.php",array("dispbody"=>false));
?>
<script>
  var ecodes=<?php echo json_encode(array("ec"=>$ec)); ?>;
  $(document).ready(function(){
    if(ecodes["ec"]<0){
      $("#loginbutton").click();
    }
  });
</script>

</body>
</html>