<?php
$iscpage = true;
foreach( $qresult as $i => $row ){
?>
			<div>
			 <div class="row">
				<div class="col-md-1 col-sm-1">
				 <img src="<?php echo $row["profilepic"]; ?>" width="50" class="img-circle" />
				 <p class="hour">
					<?php echo $row["timepassed"]; ?>
				 </p>
				</div>
				<div class="col-md-7 col-sm-7">
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
					<b>Rating</b> : <span class="label label-info"><?php echo $row["rating"]; ?></span> for <?php echo $row["TypeName"]; ?>
					<?php
					}
				 ?>
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