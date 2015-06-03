<?php
$data=($data=="all"?Fun::oneToN(count($labels)) : $data);
?>
		<div style='<?php echo $divstyle; ?>' >
			<?php
				if($label!="")
					ocloset("label",$label);
				if($selectall){
			?>
				<div>
					<input <?php if($selectallselected) echo "checked"; ?>  id='select_<?php echo $name."0"; ?>' type="checkbox"  onchange='selectAll(this);inpmultiple.setvalue(this);' style='float:left;margin-top:10px;' >
					<label for='select_<?php echo $name."0"; ?>' style='float:left;margin:5px;color:gray;' >Select All</label>
					<div style='clear:both;' ></div>
				</div>
			<?php
			}
			for($i=0;$i<count($labels);$i++){
				$isselected=in_array($i+1,$data);
				$isblocked=in_array($i+1,$blocked);
			?>
				<div>
					<input <?php if($isselected) echo "checked";  ?> id='select_<?php echo $name.($i+1); ?>' <?php if($isblocked) echo "disabled"; ?> type="checkbox" onchange='inpmultiple.setvalue(this);' style='float:left;margin-top:10px;'   >
					<label for='select_<?php echo $name.($i+1); ?>' style='float:left;margin:5px;color:<?php echo ($isselected?"black":"gray"); ?>;' ><?php echo $labels[$i]; ?></label>
					<div style='clear:both;' ></div>
				</div>
			<?php
			}
			?>
			<input type=hidden name='<?php echo $name; ?>' value='<?php echo implode("-",$data); ?>' />
		</div>
