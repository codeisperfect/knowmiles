<div id="makeform" style="display:none;" >
	<?php
		for($i=0;$i<1;$i++){
	?>
	<div class="formelmdiv row" >
		<div class="col-md-8 forminfo" >
			Input<span>1</span> : <br>
			Type = <span>Text area</span><br>
			Name = <span>Your Hobby ?</span>
		</div>
		<div class="col-md-4" >
			<?php
				button(array("html"=>"delete"));
				button(array("html"=>"moveUp"));
			?>
		</div>
	</div>
	<?php
		}
	?>
</div>
<div style="border:solid #cccccc 1px;padding:10px;" >
	Add new input Element
	<?php
		$optionslist=array(array("val"=>"text","disptext"=>"Text Input"),array("val"=>"select","disptext"=>"Single Select"),array("val"=>"mselect","disptext"=>"Multiple Select"),array("val"=>"select_bool","disptext"=>"Select Yes No"),array("val"=>"textarea","disptext"=>"Textarea"));
		load_view("template/select.php",array("options"=>$optionslist,"label"=>"Select Input type","onchange"=>"customform.f2(this);","name"=>"selectformtype"));
		form_input(array("ph"=>"Name of input","name"=>"inputname"));
	?>
	<div id="customform_options" style="display:none;" >
		<div>
			<?php
			for($i=0;$i<2;$i++){
				form_input(array("ph"=>"Option ".($i+1),"divs"=>"margin-top:-20px;" ));
			}
			?>
		</div>
		<button class='btn btn-default' onclick="extend($($(this).parent().children()[0]),customform.f1);" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
	</div>
	<div id="customform_options_bool" style="display:none;" >
		<div>
			<?php
			$default_options=array("Yes","No");
			for($i=0;$i<2;$i++){
				form_input(array("ph"=>"Option ".($i+1),"divs"=>"margin-top:-20px;","value"=>$default_options[$i]));
			}
			?>
		</div>
		<button class='btn btn-default' onclick="extend($($(this).parent().children()[0]),customform.f1);" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
	</div>
	<?php
		button(array("html"=>"Add","onclick"=>"customform.f3(this);","style"=>"margin-top:10px;"));
	?>
</div>
