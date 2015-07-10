<?php
foreach( $qresult as $i => $row ){
?>
			 <div class="row">
				<div class="col-md-1 col-sm-1" align="center" >
					<div>
					 <img src="<?php echo $row["profilepic"]; ?>" class="img-circle" />
					</div>
					<div class='' >
						<span class="hour" style='padding:0px;margin:0px;' >
							<?php echo Fun::timepassed_t2(time() - $row["time"]); ?>
						</span>
					</div>
				</div>
				<div class="col-md-11 col-sm-11">
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