<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="UTF-8">
	<title>KnowMiles</title>
	<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1, user-scalable=no" />       
	<link rel="stylesheet" href="wp-content/themes/woodshed/assets/css/app.min.css">
	<link rel="stylesheet" href="css/third.css">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="wp-content/themes/woodshed/assets/css/fonts.min.css">
	<link href="lightbox/jquery.fs.boxer.css" media="all" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type='text/javascript' src='wp-content/themes/woodshed/assets/js/jquery.js'></script>
	<script>document.documentElement.className = document.documentElement.className.replace('no-js','js');</script>
	<?php
		addmycss();
	?>

<body>
<?php
	load_view("template/header.php",$inp);
?>
<main class="main-body">
<div class="container">

		<div class="row top-pad">
		<div class="row no-psd">
		<div class="col-md-3 col-sm-3"></div><div class="col-md-9 col-sm-9 col-xs-12 yor-bg">
		
		<div class="col-md-12 col-sm-12 know"></div>
	 
		</div>
		</div>
		</div>
		<div class="row">
		<div class="row">
		<div class="col-md-3 col-sm-3">
		<div class="col-md-12 col-sm-12 admi">
		<p class="centered"><a href="<?php echo HOST."profile.php"; ?>" ><img src="images/ui-sam.jpg" class="img-circle" width="60"></a></p>
		<h5 class="user-name"><?php echo $myf["name"]; ?></h5>
		</div>
	 
		<ul class="nav nav-tabs span2 col-md-12 " style="padding-bottom:60px">
<?php
foreach($tabs as $id=>$value){
	if(in_array($id, $profiletabs)){
?>
<li class="<?php echo ($id==$qargs["tab"]?"active":""); ?>"><a href="tabs-pills.html#<?php echo $id; ?>" data-toggle="tab"><?php echo $value; ?></a></li>
<?php
	}
}
?>    							
								</ul></div><div class="col-md-9 col-sm-9 col-xs-12 yor-bg">
		
		<div class="col-md-12 col-sm-12 know"><div class="tab-content span5">
															
									<div id="tabs2-pane1" class="tab-pane <?php echo ($qargs["tab"]=="tabs2-pane1"? "active":""); ?>">
																<div class="col-md-12 col-sm-12 know you"> <h3>Know <i>Your</i> Miles</h3></div>
	 
										<h4>Status</h4>
										<div class="col-md-3 col-sm-3 stat"><div class="col-md-3 col-sm-6 me"><span>My Miles</span></div><div class="col-md-3 col-sm-6 "><span class="mile-con">0</span><span>Miles</span></div></div>
									</div>
									<div id="tabs2-pane2" class="tab-pane <?php echo ($qargs["tab"]=="tabs2-pane2"? "active":""); ?> ">




								<div class="panel-group" id="accordion">
						<div style="padding:15px;margin:5px;background-color:#eeeeee;border-radius:10px;" >
							<?php
							echo Fun::smilymsg($bookingmsg);
							?>
						</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="fa fa-sort-desc"></i>
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">2015</a>
							<span class="pull-right"><?php echo count($mybooking); ?> Bookings</span>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse in">
						<div class="panel-body">

							<?php
								$ordertabs = array("Date", "Destination", "", "Fleet", "Fare");
								foreach($ordertabs as $i => $val){
							?>
							<div class="<?php pit("col-sm-2 col-md-2", ($i>=3 || $i==0) , "col-sm-3 col-md-3"); ?>">
								<?php echo $val; ?>
							</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
				<?php
				foreach($mybooking as $i=>$row){
				?>
				<div class="panel panel-default">
					<div id="collapse1" class="panel-collapse collapse in panle-bg">
						<div class="panel-body">
							<div class="col-sm-2 col-md-2 ico">
								<i class="fa fa-play fon"></i><?php echo Fun::timetostr($row["time"]); ?>
							</div>
							<div class="col-sm-3 col-md-3"><?php echo $row["start_add"]; ?></div>
							<div class="col-sm-3 col-md-3"><?php echo $row["end_add"]; ?></div>
							<div class="col-sm-2 col-md-2"><?php echo $row["carname"]; ?></div>
							<div class="col-sm-2 col-md-2 know">
								<strong><i class="fa fa-inr"></i></strong> <span><?php echo $row["fare"]; ?></span>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>
									
									</div>
									<div id="tabs2-pane3" class="tab-pane <?php echo ($qargs["tab"]=="tabs2-pane3"? "active":""); ?> ">
																<div class="col-md-12 col-sm-12 know"> <h2>Profile</h2></div>
										
																	<form class="new-search" method="post" onsubmit="form.sendreq1(this,$(this).find('a[type=submit]')[0] );return false;" data-action="updateprofile" id="updateprofileform" >
																	<div class="row">
																	<div class="col-md-8 col-sm-8">
																	<div class="row">
																	<div class="col-md-5 col-sm-5 nan"><span>Your Name</span></div>
																	
																	<div class="col-md-7 col-sm-7 fist">
																	<div class="row" style="padding-left: 15px;">
														<div class="col-md-6 col-sm-6 col-xs-12 pad-imp"><input type="text" name="fname" value="<?php echo Fun::displayMsgBody($myf["fname"]); ?>" placeholder="First Name" class="login-text2 profile-login" required></div>
																		<div class="col-md-6 col-sm-6 col-xs-12 pad-imp last-na"><input type="text" value="<?php echo Fun::displayMsgBody($myf["lname"]); ?>" name="lname" placeholder="Last Name" class="login-text2 profile-login " required></div>
																		
									</div>
									</div>
									</div>
													<div class="row">
																	<div class="col-md-5 col-sm-5 nan"><span>Email Address</span></div>
																	<div class="col-md-7 col-sm-7"><input type="email" name="email" placeholder="Email Id" value="<?php echo convchars($myf["email"]); ?>" class="login-text profile-login" required></div>
																	</div>
																	<div class="row">
																	<div class="col-md-5 col-sm-5 nan"><span>Mobile Number</span></div>
																	<div class="col-md-7 col-sm-7"><input type="tel" name="phone" value="<?php echo convchars($myf["phone"]); ?>" class="login-text profile-login" ></div>
																	</div>
																	<div class="row">
																	<div class="col-md-5 col-sm-5 nan"><span>Address</span></div>
																	<div class="col-md-7 col-sm-7"><input type="text" name="address" value="<?php echo convchars($myf["address"]); ?>" class="login-text profile-login" ></div>
																	</div>
																	
																	<div class="row profile-login">
																	<div class="col-md-5 col-sm-5"></div>
																	<div class="col-md-7 col-sm-7">
														<div class="col-md-6 col-sm-6 pad-imp">

															<a type="submit" data-waittext='Updating ...' name="submit" class="button book-nw" onclick="$('#updateprofileform').submit();" style="padding:5px;" >Update Your Profile</a>
															</div>
																		<div class="col-md-6 col-sm-6"></div>
									</div>
									</div>
																	</div>
																	
																	</div> 
										</form>
									</div>


<div id="tabs2-pane4" class="tab-pane <?php echo ($qargs["tab"]=="tabs2-pane4"? "active":""); ?> ">


 <div class="row">
	<form action="<?php echo HOST."profile.php?tab=tabs2-pane4"; ?>" method="post" onsubmit="if(submitForm(this)){ form.req(this); };return false;" data-res="obj.reset();div.load($('#loadreviews')[0], 0, 1);" data-action="profilereview" >
	<div class="col-md-1 col-sm-1">
	 <img src="images/nib.png" class="img-circle" />
	</div>
	<div class="col-md-7 col-sm-7 cab-service">
	 <div class="row">
		<div class="col-md-4 col-sm-4">
		 <select class="text-from-1 search-text-1 common-dropdown-project-select-3" name="carTypeId" data-condition='simple' >
			<option value="" selected="selected">
			 Cab Service
			</option>
			<?php
				disp_olist($allcar);
			?>
		 </select>
		</div>
		<div class="col-md-4 col-sm-4">
		 <select class="text-from-1 search-text-1 common-dropdown-project-select-3" name="cityId" data-condition='simple' >
			<option value="" selected="selected">
			 Select City
			</option>
			<?php
				disp_olist($cityolist,array("selected"=>$_SESSION["city"]));
			?>
		 </select>
		</div>
		<div class="col-md-4 col-sm-4 stat-rate" style="" >
		<?php
			rating("rating",5);
		?>
		</div>
	 </div>
	 <div class="roww">
		<div class="col-sm-12 col-md-12 pad-imp">
		 <textarea class="col-sm-12 col-md-12 share-ex" placeholder="Share Your Experience....." rows="4" name="content" data-condition='simple' ></textarea>
		</div>
	 </div>
	</div>
	<div class="row">
	 <div class="col-md-3 col-sm-3">
	 </div>
	 <div class="col-md-7 col-sm-7">
	 </div>
	 <div class="col-md-2 col-sm-2" style="padding-bottom:10px">
	 	<button type='submit' class="button share-ex-2" name="review" >Done</button>
	 </div>
	</div>
	</form>
 </div>


	<div id="loadreviews" data-action="userreview" data-min="-1" data-max="-1" data-minl="3" data-maxl="-1" data-userid="<?php echo $userinfo["id"]; ?>" >
		<img src="photo/loading.gif" >
	</div>
	<button id="loadmorereview"  onclick='loadreview($("#loadmorereview")[0]);' >Load more</button>

</div>

<div id="tabs2-pane5" class="tab-pane <?php echo ($qargs["tab"]=="tabs2-pane5"? "active":""); ?> " >
	<div style="margin-top:30px;" >
		<?php
			for($i=0;$i<count($save_details);$i++){
		?>
	<div class="row">
	 <div class="col-md-8 col-sm-8">


		<div class="row">
		 <div class="col-md-5 col-sm-5 nan">
		 </div>
		 <div class="col-md-7 col-sm-7">
			<span style='font-size:25px;' ><?php echo $save_details[$i]["Name"]."'s login Details"; ?></span><br><span><?php echo $save_details[$i]["lastupdated"]; ?></span>
		 </div>
		</div>
		<form onsubmit='form.sendreq1(this,$(this).find("a[name=submit]")[0]);return false;' data-action="savecabdetails" data-res='$(obj).find("input[name=querytype]").val("update");' >
			<?php
				hidinp("CarID",$save_details[$i]["CarID"]);
				hidinp("querytype",$save_details[$i]["issaved"]==1?"update":"insert");
			?>
			<div class="row">
			 <div class="col-md-5 col-sm-5 nan">
				<span>
				 Username
				</span>
			 </div>
			 <div class="col-md-7 col-sm-7">
				<input type="text" name="email" placeholder="Username" value="<?php echo Fun::displayMsgBody($save_details[$i]["email"]); ?>" class="login-text profile-login" required="required" />
			 </div>
			</div>
			<div class="row">
			 <div class="col-md-5 col-sm-5 nan">
				<span>
				 Password
				</span>
			 </div>
			 <div class="col-md-7 col-sm-7">
				<input type="password" name="password" value="<?php echo Fun::displayMsgBody($save_details[$i]["password"]); ?>" placeholder="password" class="login-text profile-login" />
			 </div>
			</div>
			<div class="row">
			 <div class="col-md-5 col-sm-5 nan"></div>
			 <div class="col-md-7 col-sm-7" align="left" style="text-align:left;margin-bottom:10px;margin-top:-15px;" >
				<input type="checkbox" value="" placeholder="password"  id="seepassword<?php echo $i; ?>" onchange='funcs.seepassword(this);'  />
				<label style="cursor:pointer;" for="seepassword<?php echo $i; ?>" >See password</label>
			 </div>
			</div>
			<div class="row profile-login">
			 <div class="col-md-5 col-sm-5">
			 </div>
			 <div class="col-md-7 col-sm-7">
				<div >
				 <a type="submit" data-waittext="Saving ..." name="submit" class="button book-nw" onclick="$(this).parent().parent().parent().submit();" style="padding:5px;"  >
					Save <?php echo $save_details[$i]["Name"]; ?> Details
				 </a>
				</div>
			 </div>
			</div>
		</form>

	 </div>
	</div>
		<?php
			}
		?>
	</div>
</div>
<?php
	if(in_array("tabs2-pane6", $profiletabs)){
?>
	<div id="tabs2-pane6" class="tab-pane <?php echo ($qargs["tab"]=="tabs2-pane6"? "active":""); ?> " >
		<form action="profile.php?tab=tabs2-pane6" method="post" enctype="multipart/form-data" >
			Change Background pic.
			<input type="file" name="bgpic" />
			<button class='button book-nw' type="submit" >Change</button>
			<br><br>
			Change offer pic.
			<input type="file" name="offerpic" />
			<button class='button book-nw' type="submit" >Change</button>
		</form>
	</div>
<?php
	}
?>
								 </div>
	 
		</div>
		</div>
		</div>
		
		
</div>

</main>

<?php
load_view("template/footer.php");
?>


<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<?php
addmyjs();

?>

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
	<script>function toggleChevron(e) {
		$(e.target)
				.prev('.panel-heading')
				.find("i.indicator")
				.toggleClass('glyphicon-triangle-bottom glyphicon-chevron-up');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);

loadreview($("#loadmorereview")[0], -1);



</script>

</body>
</html>
