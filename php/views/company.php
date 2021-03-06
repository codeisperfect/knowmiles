<?php

load_view("template/company_top.php");

?>

<body id="top" class="home page page-template page-template-homepage-php no-js"  >

<?php
load_view("template/header.php", $inp);
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
	 				<?php echo $carinfo["name"]; ?>
	 			</h1>
	 		</div>
	 		<div class="col-sm-1" >
	 			<h1><span class="label label-success"><?php echo number_format($carinfo["avgrating"],1); ?></span></h1>
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



<div style="width:95%; margin: 0 auto;" >
	<div class="container-fluid col-centered" style="margin-top:30px;">
		<div class="col-md-3">
			<?php
				if($carinfo["offerpic"]!=""){
			?>
			<h3>Offers for <?php echo $carinfo["name"]; ?></h3>
			<hr>
			<img src="<?php echo $carinfo["offerpic"]; ?>" alt="Ola Offer" style="padding-bottom:20px;">
			<?php
				}
			?>

		</div>
		<div class="col-md-6">
			<?php
				if(User::isloginas("u")) {
			?>
			<h4>Write a Review</h4>

			<form role="form" style="padding-top:5px; padding-bottom:5px;" method="post"  data-res='obj.reset();div.load($("#loadreviews")[0], 0, 1);' onsubmit="return form.req(this);" data-action="review" >
				<?php
					hidinps(array("cid" => $carinfo["cid"], "city" => $carinfo["city"]));
				?>
				<div class="form-group">
					 <div class="row">
						<div class="col-md-4 col-sm-4">
						 <select class="text-from-1 search-text-1 common-dropdown-project-select-3" name="carTypeId" >
							<?php
								disp_olist($cabtypes);
							?>
						 </select>
						</div>
						<div class="col-md-8 col-sm-8 stat-rate" style="cursor:pointer;" >
							<input class="rating" min="0" max="5" step="1" data-size="xs" data-default-caption="{rating}" data-star-captions="{}" name="rating" style='cursor:pointer;' >
						</div>
					 </div>

					<textarea class="form-control" rows="3" id="comment" placeholder="Write down your experience for the world to see." name="content" ></textarea>
					<div style="padding-top:5px;">
						<button type="submit" class="btn btn-info pull-right" name="reviewform" >Submit</button>	
					</div>
				</div>
			</form>
			<?php
				}
			?>


			<hr>
			
			<h3 style="padding-bottom:10px;">Reviews by other users</h3>
			<br><br>

			<div class="row" id="loadreviews" data-action="carreview" data-min="-1" data-max="-1" data-minl="3" data-maxl="-1" data-cid="<?php echo $carinfo["cid"]; ?>" >
				<img src="photo/loading.gif" >


<!--  				<div class="col-xs-12">
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
 --> 				

			</div>
			<button onclick="loadreview(this);" id="loadmorereviews" >Load more</button>
			



		</div>
				

		<div class="col-md-3" style='' >
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
load_view("template/bottom.php", Fun::mergeifunset($inp, array("dispbody" => false)));
?>

<script>
	var mybgimg = "<?php echo $carinfo["bgpic"]; ?>";
	$(document).ready(function(){
		loadreview($("#loadmorereviews")[0], -1);
		$(".sect-journal").css("background-image", 'url("'+mybgimg+'")');
	});
</script>

</body></html>