<?php
foreach( $qresult as $i => $row ){
?>
			 <div class="row">
				<div class="col-md-1 col-sm-1">
				 <img src="images/nib.png" class="img-circle" />
				 <p class="hour">
					<?php echo $row["bid"]; ?>
				 </p>
				</div>
				<div class="col-md-7 col-sm-7">
				 <p class="copm">
					<?php readmorecontent($row["content"],200);?>
				 </p>
				</div>
			 </div>
<?php
}
?>