<?php
foreach( $qresult as $i => $row ){
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
						<div class="col-md-7 col-sm-7 like-her likebutton likebuttonliked " style="cursor:pointer;" data-action="like" data-bid="<?php echo $row["id"]; ?>" data-type="r" >
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
?>