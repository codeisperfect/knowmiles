				<div class="form-group has-feedback  " style='' >
					<label style='' ><?php echo $label; ?></label>
					<select  data-condition='<?php echo $dc; ?>' onchange='checkValid(this,event);<?php echo $onchange; ?>' class=form-control name='<?php echo $name; ?>' ><?php
					for($i=0;$i<count($options);$i++){
						if(gettype($options[$i])!='array'){
							$val=$disptext=$options[$i];
						}
						else{
							$val=$options[$i]['val'];
							$disptext=$options[$i]['disptext'];
						}
						?><option <?php if($val==$selectval && $selectval!='') echo 'selected';  ?> value='<?php echo $val; ?>' ><?php echo $disptext; ?></option><?php
					}
					?></select>
					<span class="glyphicon form-control-feedback  " aria-hidden="true"></span>
				</div>
