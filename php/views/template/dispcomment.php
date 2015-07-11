<?php
foreach( $qresult as $i => $row ){
?>
			 <div class="row" id="<?php echo "comment".$row["id"]; ?>" >
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
				<span>
					<?php echo convchars($row["name"]); ?>
				</span>
				<?php
					if($row["uid"] == User::loginId()) {
				?>
				<button type="button" class="btn btn-default" aria-label="Left Align" data-id="<?php echo $row["id"]; ?>" data-type="c" onclick='obj=this;mohit.confirm("Are you sure ? ", "button.sendreq(obj);");' data-action="deleterc" data-res='$("#<?php echo "comment".$row["id"]; ?>").fadeOut();' >
				  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick='hideshowdown( "commentdispdiv<?php echo $row["id"]; ?>", "commenteditdiv<?php echo $row["id"]; ?>");' >
				  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
				<?php
					}
				?>
				 <div class="copm" id="commentdispdiv<?php echo $row["id"]; ?>" >
					<?php readmorecontent($row["content"],200);?>
				 </div>
				 <div class="editarea" style='margin-bottom:10px;display:none;' id="commenteditdiv<?php echo $row["id"]; ?>" >
				 	<form onsubmit='form.req(this);return false;' data-action='editcr' data-param='{"type":"c", "id":<?php echo $row["id"]; ?>}' data-res='$("#commentdispdiv<?php echo $row["id"]; ?>").html($(obj).find("textarea").val());hideshowdown( "commenteditdiv<?php echo $row["id"]; ?>", "commentdispdiv<?php echo $row["id"]; ?>");' >
					 	<textarea class="form-control" name="content" ><?php echo convchars($row["content"]);?></textarea>
					 	<button class='btn btn-default' type="submit"  data-type='c' >Edit</button>
					 	<button class='btn btn-default' type="button" onclick='hideshowdown( "commenteditdiv<?php echo $row["id"]; ?>", "commentdispdiv<?php echo $row["id"]; ?>");' >Cancel</button>
					 </form>
				 </div>
				</div>
			 </div>
<?php
}
?>