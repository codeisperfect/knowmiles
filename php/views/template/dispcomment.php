<?php
foreach( $qresult as $i => $row ){
?>
			 <div class="row">
				<div class="col-md-1 col-sm-1">
				 <img src="<?php echo $row["profilepic"]; ?>" class="img-circle" />
				 <p class="hour">
					<?php echo Fun::timepassed_t2(time() - $row["time"]); ?>
				 </p>
				</div>
				<div class="col-md-7 col-sm-7">
				<h5>
					<?php echo convchars($row["name"]); ?>
				</h5>
				 <p class="copm">
					<?php readmorecontent($row["content"],200);?>
				 </p>
				</div>
			 </div>
<?php
}
?>