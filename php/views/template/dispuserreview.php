<?php
$iscpage = ($action == "carreview");
foreach( $qresult as $i => $row ){
?>
			<div id="<?php echo "review".$row["id"]; ?>" >
			 <div class="row">
				<div class="col-md-1 col-sm-1 " align="center" >
					<div>
						<img src="<?php echo $row["profilepic"]; ?>" width="50" class="img-circle" />
					</div>
					<div  >
						<span class="hour" style='padding:0px;margin:0px;' >
							<?php echo $row["timepassed"]; ?>
						</span>
					</div>
				</div>
				<div class="col-md-11 col-sm-11">
				<?php
					if(!$iscpage) {
				?>
				 <h4>
					<?php echo $row["TypeName"]." (".$row["carname"]."), ".$row["cityname"]; ?>
				 </h4>
				 <?php
					} else {
					?>
				 <h4>
					<?php echo $row["name"]; ?>
				 </h4>
				 <?php
				 	dummyheight(5);
				 ?>
					<b>Rating</b> : <span class="label label-info"><?php echo $row["rating"]; ?></span> &nbsp;&nbsp;for <?php echo $row["TypeName"]; ?>
					<?php
					}
				 ?>
				 <div class="copm" id="reviewdispdiv<?php echo $row["id"]; ?>" >
					<?php readmorecontent($row["content"],200);?>
				 </div>
				 <div class="editarea" style='margin-bottom:10px;display:none;' id="revieweditdiv<?php echo $row["id"]; ?>" >
				 	<form onsubmit='form.req(this);return false;' data-action='editcr' data-param='{"type":"r", "id":<?php echo $row["id"]; ?>}' data-res='$("#reviewdispdiv<?php echo $row["id"]; ?>").html($(obj).find("textarea").val());hideshowdown( "revieweditdiv<?php echo $row["id"]; ?>", "reviewdispdiv<?php echo $row["id"]; ?>");' >
					 	<textarea class="form-control" name="content" ><?php echo convchars($row["content"]);?></textarea>
					 	<button class='btn btn-default' type="submit"  data-type='c' >Edit</button>
					 	<button class='btn btn-default' type="button" onclick='hideshowdown( "revieweditdiv<?php echo $row["id"]; ?>", "reviewdispdiv<?php echo $row["id"]; ?>");' >Cancel</button>
					 </form>
				 </div>

				 <div class="col-md-11 col-sm-11 like-bok">
					<div class="row">
					 <div class="col-md-2 col-sm-2 like pad-imp">
						<div class="col-md-7 col-sm-7 like-her likebutton <?php pit("likebuttonliked", $row["amiliked"]); ?>" style="cursor:pointer;" data-action="<?php pit("like", !$row["amiliked"]);pit("dislike", $row["amiliked"]); ?>" data-bid="<?php echo $row["id"]; ?>" data-type="r" data-res='ldlike.onres(obj);funcs.likedislike(obj);' onclick="button.sendreq_v2(this);" >
						 <i class="fa fa-heart">
						 </i>
						</div>
						<div class="col-md-4 col-sm-4 count-like">
						 <span class="likecount" ><?php echo 0+$row["numlikes"]; ?></span>
						</div>
					 </div>
					 <?php
					 	if($row["uid"] == User::loginId()) {
					 ?>
					 <div>
						<button type="button" class="btn btn-default" aria-label="Left Align" data-id="<?php echo $row["id"]; ?>" data-type="r" onclick='obj=this;mohit.confirm("Are you sure ? ", "button.sendreq(obj);");' data-action="deleterc" data-res='$("#<?php echo "review".$row["id"]; ?>").fadeOut();' >
						  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default" aria-label="Left Align" onclick='hideshowdown( "commentdispdiv<?php echo $row["id"]; ?>", "revieweditdiv<?php echo $row["id"]; ?>");' >
						  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
					 </div>
					 <?php
					 	}
					 ?>
					</div>
				 </div>
				 <div class="col-md-1 col-sm-1 like pad-imp">
					<a onclick="funcs.openreply(this);" >
					 rw
					</a>
				 </div>
				</div>
			 </div>
			 <div class="row reviewreplydiv" style='display:none;' >
				<div class="col-md-1 col-sm-1">
				</div>
				<div class="col-md-11 col-sm-11" >
					<div class="replies" data-action="reviewreply" data-min="-1" data-minl="-1" data-max="0" data-maxl="-1" data-bid="<?php echo $row["id"]; ?>" >
						<?php
							//load_view("template/dispcomment.php", array("row" => $row));
						?>
					</div>
					 <?php
						if(User::loginId() == $row["uid"] || User::loginId() == $row["cid"] ){
					 ?>
						<div >
							<form style="padding:0px;" data-action='reviewcomment' onsubmit='if(form.valid.action1(this)){form.req(this);};return false;' method="post" data-res='obj.reset();div.load( $(obj).parent().prev()[0], 0, 0);' >
								<?php
									hidinp("bid", $row["id"]);
								?>
								<textarea class="form-control" rows="1" placeholder="Reply" name="content" data-condition="simple" ></textarea>
								<div style="padding-top:5px;">
									<button type="submit" class="btn btn-info pull-right" >Submit</button>	
								</div>
							</form>
						</div>
					 <?php
						}
					 ?>
				</div>
			 </div>
			</div>
<?php
}
?>