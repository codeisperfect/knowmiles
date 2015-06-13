<?php
$config=array('calallcity'=>true);
include "includes/app.php";
$qargs=Fun::mergeifunset($_GET,array("CarID"=>1,"CarTypeID"=>1));

$cabname=Sqle::getRow("select * from car where CarID=?",'i',array(&$qargs["CarID"]));
Fun::redirectinv($cabname==null);
$cabname=$cabname["Name"];
$offers=array(1=>"offer.jpg",2=>"tfsoffer1.png");
$bgpics=array();


Funs::setcity();
$myf=User::myprofile();

load_view("template/index_top.php");

?>

<style>
.btn-trans{

	background: transparent;
	color: #FFFFFF;

	/* CSS Transition */
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
<body id="top" class="home page page-template page-template-homepage-php no-js"  >

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

<section class="sect-banner sect-journal js-parallax js-fadie" style="padding-top:200px; padding-bottom:200px;">
 <!-- <div class="row g-full title">
 <h2>So, Book Your Cab NOW!!!</h2>
 </div> -->
 <div class="overlay">
 	<div class="container">
 		<div class="row" style="top:250px; text-align:left;">
 			<div class="col-sm-11">
	 			<h1>
	 				<?php echo $cabname." Cabs"; ?>
	 			</h1>
	 		</div>
	 		<div class="col-sm-1" >
	 			<h1><span class="label label-success">4.4</span></h1>
	 		</div>
 		</div>
 	</div>
 	<div class="container">
 		<div class="row" style="top:250px; width:105%;">
 			<div class="col-sm-12">
 				<hr>
 			</div>	
 		</div>
 		<div class="row" style="top:240px;">
 			<div class="col-xs-1">
 				<input type="submit" class="btn btn-info btn-trans btn-lg" value="Book Now">
 			</div>
 		</div>
 	</div>
 </div>
 <!-- <h2 style="top:30%; padding-top:100px;">
 	YOOO
 </h2> -->
</section>

<link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

<script src="js/star-rating.js" type="text/javascript"></script>


<div style="width:95%; margin: 0 auto;" >
	<div class="container-fluid col-centered" style="margin-top:30px;">
		<div class="col-md-3">
			<h3>Offers for <?php echo $cabname; ?> Cabs</h3>
			<hr>
			<img src="images/company/<?php echo $offers[$qargs["CarID"]]; ?>" alt="Ola Offer" style="padding-bottom:20px;">

		</div>
		<div class="col-md-6">
			<h4>Write a Review</h4>
			<form role="form" style="padding-top:5px; padding-bottom:5px;">
				<div class="form-group">
					<input class="rating" min="0" max="5" step="1" data-size="xs" data-default-caption="{rating}" data-star-captions="{}">
					<textarea class="form-control" rows="3" id="comment" placeholder="Write down your experience for the world to see."></textarea>
					<div style="padding-top:5px;">
						<button type="submit" class="btn btn-info pull-right">Submit</button>	
					</div>
				</div>
			</form>             


			<hr>
			
			<h3 style="padding-bottom:10px;">Reviews by other users</h3>

			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-1" style="font-size:30px;">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					<div class="col-xs-11" >
						<h4><strong>Mike</strong></h4>
						Rating : <span class="label label-warning">2</span>
					</div>
				</div>
				<div class="col-xs-12">
					<p>Debitis assumenda illo, commodi quisquam, molestias vitae ipsa. Delectus soluta molestias ab, minima illum, harum voluptatibus eaque. Nobis cum, corporis voluptatibus quod!</p>	
				</div>

				<div class="col-xs-12">
					<div class="col-xs-1" style="font-size:30px;">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					<div class="col-xs-11">
						<h4><strong>Paul</strong></h4>
						Rating : <span class="label label-info">4</span>
					</div>
				</div>

				<div class="col-xs-12">
					<p>Quod, quaerat iusto aut doloremque perferendis fugiat odio excepturi facilis aliquid perspiciatis explicabo soluta inventore delectus voluptatibus temporibus, eius debitis laboriosam voluptates.</p>	
				</div>
				

			</div>
			

				

		</div>
				

		<div class="col-md-3">
			<p class="text-muted">Sponsored Ads</p>
			<div class="row" style="padding-top:5px; padding-bottom:5px;">
				<div class="col-xs-12">
					<img src="images/company/ad_0.png" alt="Ad1">
				</div>
			</div>
			<div class="row" style="padding-top:5px; padding-bottom:5px;">
				<div class="col-xs-12">
					<img src="images/company/ad_1.png" alt="Ad2">
				</div>
			</div>
			<div class="row" style="padding-top:5px; padding-bottom:5px;">
				<div class="col-xs-12">
					<img src="images/company/ad_2.png" alt="Ad3">
				</div>
			</div>
				
			</div>
		
		</div>
	</div>
</div>

</main>

<?php
load_view("template/footer.php");
load_view("template/bottom.php");
?>


<?php

closedb();
?>

