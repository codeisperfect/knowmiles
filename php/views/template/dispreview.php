<?php
foreach( $qresult as $i => $row ){
	if(true){
?>
 				<div class="col-xs-12">
					<div class="col-xs-1" style="font-size:30px;">
						<img src='photo/human3.png' height="40" />
					</div>
					<div class="col-xs-11" >
						<h4><strong><?php echo $row["name"]; ?></strong></h4>
						Rating : <span class="label label-warning"><?php echo $row["rating"]; ?></span>
					</div>
				</div>
				<div class="col-xs-12">
					<div style="display:none;" >
					<?php echo $row["TypeName"]." (".$row["carname"].") ,".$row["cityname"]; ?>
					</div>
					<p><?php readmorecontent($row["content"],200);?></p>
					<p><?php echo $row["timepassed_t2"]; ?></p>

				</div>
<?php
	} else {
?>
			 <div class="row">
				<div class="col-md-1 col-sm-1">
				 <img src="images/nib.png" class="img-circle" />
				 <p class="hour">
					<?php echo $row["timepassed"]; ?>
				 </p>
				</div>
				<div class="col-md-7 col-sm-7">
				 <h4>
					<?php echo $row["TypeName"]." (".$row["carname"]."), ".$row["cityname"]; ?>
				 </h4>
				 <p>
				 <?php
					for($j=0;$j<$row["rating"];$j++){
				 ?>
					<i class="fa fa-star">
					</i>
					<?php
					}
					?>
				 </p>
				 <p class="copm">
					<?php readmorecontent($row["content"],200);?>
				 </p>
				 <div class="col-md-11 col-sm-11 like-bok">
					<div class="row">
					 <div class="col-md-3 col-sm-3 like pad-imp">
						<div class="col-md-7 col-sm-7 like-her">
						 <i class="fa fa-heart">
						 </i>
						 <span>
							Like
						 </span>
						</div>
						<div class="col-md-4 col-sm-4 count-like">
						 <span>
							0
						 </span>
						</div>
					 </div>
					</div>
				 </div>
				 <div class="col-md-1 col-sm-1 like pad-imp">
					<a href="#">
					 rw
					</a>
				 </div>
				</div>
			 </div>
<?php
	}
}
?>