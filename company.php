<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();
$myf=User::myprofile();

load_view("template/index_top.php");
?>

<body id="top" class="home page page-template page-template-homepage-php no-js">

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

<section class="sect-banner sect-journal js-parallax js-fadie" style="padding-top:200px; padding-bottom:170px;">
 <!-- <div class="row g-full title">
 <h2>So, Book Your Cab NOW!!!</h2>
 </div> -->
 <div class="overlay">
 	<div class="container">
 		<div class="row" style="top:250px; text-align:left;">
 			<div class="col-sm-12">
	 			<h1>
	 				Ola Cabs		
	 			</h1>
	 		</div>
	 		<div class="col-sm-12">
	 			<h3>
	 				Users Rating : <span class="label label-success">4.4</span>
	 				<h5 style="font-size:10px;">(Ola Cabs, Delhi(All Cab Options))</h5>
	 			</h3>
				<div class="row" style="padding-bottom:20px; padding-top:10px;">
					<div class="col-sm-2" style="padding-right:2px;">
						<select class="form-control input-sm">
							<option>Ola Cabs</option>
							<option>TaxiForSure</option>
							<option>Uber</option>
						</select> 
					</div>
					<div class="col-sm-2" style="padding-right:2px; padding-left:2px;">
						<select class="form-control input-sm">
							<option>Delhi</option>
							<option>Jodhpur</option>
							<option>Vadodara</option>
						</select> 
					</div>
				</div>
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


<div style="width:85%; margin: 0 auto;" >
	<div class="container-fluid" style="margin-top:30px;">
		<div class="col-md-3">
			<h3>Offers for Ola Cabs</h3>
			<hr>

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
			<div class="row">
				<div class="col-xs-12"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores consectetur beatae ea ad ab illum unde ratione, id accusamus, recusandae eos rerum, in sed explicabo voluptatibus ullam itaque. Quisquam, ad.</p></div>
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

