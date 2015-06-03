<div>
	<label><?php echo $label; ?></label>
	<div>
		<?php
			foreach($options as $i=>$val){
				button(array("html"=>$val,"onclick"=>"button.selectme(this);","data-val"=>$i+1 ));
			}
			hidinp($name,"",array());
		?>
	</div>

</div>