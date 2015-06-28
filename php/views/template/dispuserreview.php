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
						<div class="col-md-7 col-sm-7 like-her likebutton <?php pit("likebuttonliked", $row["amiliked"]); ?>" style="cursor:pointer;" data-action="<?php pit("like", !$row["amiliked"]);pit("dislike", $row["amiliked"]); ?>" data-bid="<?php echo $row["id"]; ?>" data-type="r" data-res='ldlike.onres(obj);funcs.likedislike(obj);' onclick="button.sendreq_v2(this);" >
						 <i class="fa fa-heart">
						 </i>
						 <span>
							Like
						 </span>
						</div>
						<div class="col-md-4 col-sm-4 count-like">
						 <span class="likecount" ><?php echo 0+$row["numlikes"]; ?></span>
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