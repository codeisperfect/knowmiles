<?php
class Disp extends Sql{
	public static function takeinp($label,$name='',$data=null,$val="",$ph="",$type='text',$cond='simple',$id='', $style='',$style1='',$o='',$ver=1 ){
		if($ver==1){
			if($type=='select'){
				$listo=$val['options'];
				$defaultv=isset($val['default']) ? $val['default']:'' ;
				$mselect=isset($val['mselect']) ? $val['mselect']:'' ;
				$selectVal=($data!=null && $name!='' && isset($data[$name])) ? $data[$name]:$defaultv;
				?>
				<div class="form-group has-feedback  " style='<?php echo $style1; ?>' >
					<label style='' ><?php echo $label; ?></label>
					<select <?php echo $mselect; ?>  data-condition='<?php echo $cond; ?>' onchange='checkValid(this,event);' class=form-control name='<?php echo $name; ?>' <?php if($id!='') echo "id=".$id; ?> style='<?php echo $style; ?>' ><?php
					for($i=0;$i<count($listo);$i++){
						if(gettype($listo[$i])!='array'){
							$val=$disptext=$listo[$i];
						}
						else{
							$val=$listo[$i]['val'];
							$disptext=$listo[$i]['disptext'];
						}
						?><option <?php if($val==$selectVal && $selectVal!='') echo 'selected';  ?> value='<?php echo $val; ?>' ><?php echo $disptext; ?></option><?php
					}
					?></select>
					<span class="glyphicon form-control-feedback  " aria-hidden="true"></span>
				</div>
				<?php
			}
			else{
				$pholder=$ph==""?"Enter the ".$label:$ph;
				?>
				<div class="form-group  has-feedback "  style='<?php echo $style1; ?>' >
					<label style='font-weight:600;' ><?php echo $label; ?></label>
					<input <?php echo $o; ?> data-condition='<?php echo $cond; ?>' onkeyup='checkValid(this,event);'  name='<?php echo $name; ?>' value='<?php if($data!=null && $name!='' && isset($data[$name] )) echo $data[$name];  else echo $val; ?>'  style='<?php echo $style; ?>' type="<?php echo $type; ?>" class="form-control" <?php if($id!='') echo "id=".$id; ?>  placeholder="<?php echo $pholder; ?>"   >
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
<?php
			}
		}
	}

	public static function takeinp_v2($inp){
		$inp=Fun::setifunset($inp,"label","");
		$inp=Fun::setifunset($inp,"name","");
		$inp=Fun::setifunset($inp,"data",null);
		$inp=Fun::setifunset($inp,"val","");
		$inp=Fun::setifunset($inp,"ph","");
		$inp=Fun::setifunset($inp,"type","text");
		$inp=Fun::setifunset($inp,"cond","simple");
		$inp=Fun::setifunset($inp,"id","");
		$inp=Fun::setifunset($inp,"id","");
		$inp=Fun::setifunset($inp,"style","");
		$inp=Fun::setifunset($inp,"onchange","");

		$inp=Fun::setifunset($inp,"style1","");
		$inp=Fun::setifunset($inp,"o","");
		$inp=Fun::setifunset($inp,"ver",1);


		$label=$inp["label"];
		$name=$inp["name"];
		$data=$inp["data"];
		$val=$inp["val"];
		$ph=$inp["ph"];
		$type=$inp["type"];
		$cond=$inp["cond"];
		$id=$inp["id"];
		$id=$inp["id"];
		$style=$inp["style"];
		$style1=$inp["style1"];
		$o=$inp["o"];
		$ver=$inp["ver"];


		if($ver==1){
			if($type=='select'){
				$listo=$val['options'];
				$defaultv=isset($val['default']) ? $val['default']:'' ;
				$mselect=isset($val['mselect']) ? $val['mselect']:'' ;
				$selectVal=($data!=null && $name!='' && isset($data[$name])) ? $data[$name]:$defaultv;
				?>
				<div class="form-group has-feedback  " style='<?php echo $style1; ?>' >
					<label style='' ><?php echo $label; ?></label>
					<select <?php echo $mselect; ?>  data-condition='<?php echo $cond; ?>' onchange='checkValid(this,event);<?php echo $inp["onchange"]; ?>' class=form-control name='<?php echo $name; ?>' <?php if($id!='') echo "id=".$id; ?> style='<?php echo $inp["style"]; ?>' ><?php
					for($i=0;$i<count($listo);$i++){
						if(gettype($listo[$i])!='array'){
							$val=$disptext=$listo[$i];
						}
						else{
							$val=$listo[$i]['val'];
							$disptext=$listo[$i]['disptext'];
						}
						?><option <?php if($val==$selectVal && $selectVal!='') echo 'selected';  ?> value='<?php echo $val; ?>' ><?php echo $disptext; ?></option><?php
					}
					?></select>
					<span class="glyphicon form-control-feedback  " aria-hidden="true"></span>
				</div>
				<?php
			}
			else{
				$pholder=$ph==""?"Enter the ".$label:$ph;
				?>
				<div class="form-group  has-feedback "  style='<?php echo $style1; ?>' >
					<label style='font-weight:600;' ><?php echo $label; ?></label>
					<input <?php echo $o; ?> data-condition='<?php echo $cond; ?>' onkeyup='checkValid(this,event);'  name='<?php echo $name; ?>' value='<?php if($data!=null && $name!='' && isset($data[$name] )) echo $data[$name];  else echo $val; ?>'  style='<?php echo $style; ?>' type="<?php echo $type; ?>" class="form-control" <?php if($id!='') echo "id=".$id; ?>  placeholder="<?php echo $pholder; ?>"   >
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
<?php
			}
		}
	}

	public static function takeinp_v3($label,$name='',$data=null,$val="",$ph="",$type='text',$cond='simple',$id='', $style='',$style1='',$o='',$ver=1 ){
		if($ver==1){
			if($type=='select'){
				$listo=$val['options'];
				$defaultv=isset($val['default']) ? $val['default']:'' ;
				$mselect=isset($val['mselect']) ? $val['mselect']:'' ;
				$selectVal=($data!=null && $name!='' && isset($data[$name])) ? $data[$name]:$defaultv;
				?>
				<div class="form-group has-feedback  " style='<?php echo $style1; ?>' >
					<label style='' ><?php echo $label; ?></label>
					<select <?php echo $mselect; ?>  data-condition='<?php echo $cond; ?>' onchange='checkValid(this,event);' class=form-control name='<?php echo $name; ?>' <?php if($id!='') echo "id=".$id; ?> style='<?php echo $style; ?>' ><?php
					for($i=0;$i<count($listo);$i++){
						if(gettype($listo[$i])!='array'){
							$val=$disptext=$listo[$i];
						}
						else{
							$val=$listo[$i]['val'];
							$disptext=$listo[$i]['disptext'];
						}
						?><option <?php if($val==$selectVal && $selectVal!='') echo 'selected';  ?> value='<?php echo $val; ?>' ><?php echo $disptext; ?></option><?php
					}
					?></select>
					<span class="glyphicon form-control-feedback  " aria-hidden="true"></span>
				</div>
				<?php
			}
			else{
				$pholder=$ph==""?"Enter the ".$label:$ph;
				?>
				<div class="form-group  has-feedback "  style='<?php echo $style1; ?>' >
					<label style='font-weight:600;' ><?php echo $label; ?></label>
					<input <?php echo $o; ?> data-condition='<?php echo $cond; ?>' onkeyup='checkValid(this,event);'  name='<?php echo $name; ?>' value='<?php if($data!=null && $name!='' && isset($data[$name] )) echo $data[$name];  else echo $val; ?>'  style='<?php echo $style; ?>' type="<?php echo $type; ?>" class="form-control" <?php if($id!='') echo "id=".$id; ?>  placeholder="<?php echo $pholder; ?>"   >
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
<?php
			}
		}
	}
	public static function selectinp($arroption,$data){
		$data=Fun::setifunset($data,'label',"Select");
		$data=Fun::setifunset($data,'dc',"simple");
		$data=Fun::setifunset($data,'onchange',"");
		$data['onchange']="checkValid(this,event);".$data['onchange'];
		$data=Fun::setifunset($data,'name',"");
		$data=Fun::setifunset($data,'id',"");
		$data=Fun::setifunset($data,'style',"");
		$data=Fun::setifunset($data,'val',null);
		$defaultv=isset($data['default']) ? $val['default']:'' ;
		$selectVal=($data['val']!=null && $data['name']!='' && isset($data['val'][$name])) ? $data[$name]:$defaultv;
?>
	<div class="form-group has-feedback" >
		<label style='' ><?php echo $data['label']; ?></label>
		<select <?php echo getparams($data); ?> ><?php
		echo count($arroption);
		for($i=0;$i<count($arroption);$i++){
			$val=$arroption[$i]['val'];
			$disptext=$arroption[$i]['disptext'];
		?><option <?php if($val==$selectVal && $selectVal!='') echo 'selected';  ?> value='<?php echo $val; ?>' ><?php echo $disptext; ?></option><?php
		}
		?></select>
	</div>
<?php
	}
	public static function inpAccountTypes($data){
		$accounts=array(array('val'=>'','disptext'=>'Select Account Type') );
		$accounts=array_merge($accounts,array('t','s'));
		for($i=1;$i<count($accounts);$i++){
			$type=$accounts[$i];
			if($type=='a')
				continue;
			$accounts[$i]=array('val'=>($type),'disptext'=>User::accountNames($type) );
		}
		Disp::takeinp("Account Type","type",$data,array('options'=> $accounts  ),"","select"  );
	}
	public static function signUpForm($action=''){
	?>
		<div style='width:250px;' >
			<form method=post onsubmit='if(submitForm(this)){request.signup(this);};return false;' action='<?php echo $action; ?>' >
				<div>
					<p class="text-success" ></p>
					<p class="text-danger" ></p>
				</div>
			<?php
			self::takeinp("Full name","name",$_POST,"","","text","simple");
			self::takeinp("Email","email",$_POST,"","","email","email");
			self::takeinp("Password","password",$_POST,"","","password","simple","password");
			self::takeinp("Re-Password","repassword",$_POST,"","ReEnter your password","password","password" );

//			self::inpAccountTypes($_POST);

			?>
			<input type='hidden' value='s' name='type' />
			<button type="submit" class="btn btn-default" name=signup >SignUp</button>
			</form>
		</div>
	<?php
	}
	public static function loginForm($action=''){
		?>
		<div style='width:250px;' >
			<form id='loginForm' method=post onsubmit='if(submitForm(this)){request.login(this);};return false;' action='<?php echo $action; ?>' >
				<div>
					<p class="text-success" ></p>
					<p class="text-danger" ></p>
				</div>
			<?php
				self::takeinp("Email","email",$_POST,"","Enter email address","text","email","login_email",'','',' autofocus ');
				self::takeinp("Password","password",$_POST,"","","password","simple","login_password");
			?>
			<button type="submit" class="btn btn-default" name=login >Login</button>
			</form>
		</div>
		<?php
	}
	public static function forgetPassword($action=''){
		?>
		<div style='width:250px;' >
			<form method=get onsubmit='if(submitForm(this)){request.forget(this);};return false;' action='<?php echo $action; ?>' >
				<div>
					<p class="text-success" ></p>
					<p class="text-danger" ></p>
				</div>
			<?php
				self::takeinp("Email","email",$_GET,"","Enter email address","text","email");
			?>
			<button type="submit" class="btn btn-default" name=forget >Reset password</button>
			</form>
		</div>
		<?php
	}
	public static function enterOTP($action=''){
		?>
		<div style='width:250px;' >
			<form method=get onsubmit='if(submitForm(this)){form.sendreq(this,$(this).find("button[type=submit]")[0]);};return false;' data-action="fillotp" data-res='window.location.href="<?php echo BASE."tprofile"; ?>";' >
				<div>
					<p class="text-success" ></p>
					<p class="text-danger" ></p>
				</div>
			<?php
				self::takeinp("One Time password","otp",$_GET,"","Enter one time password","text","otp");
			?>
			<button type="submit" class="btn btn-default" name=forget >Submit</button>
			</form>
		</div>
		<?php
	}
	public static function teacherRegForm(){
		$iitjoinyears=Fun::oneToN(date("Y"),1950,false);
		?>
		<style>
			td  {
				padding: 10px;
				min-width:250px;
			}
		</style>
		<div style='width:250px;' >
			<form id=temp1 method=get onsubmit='if(submitForm(this)){form.sendreq(this,$(this).find("button[type=submit]")[0]);};return false;' data-action="teacherreg" data-res='hideshowdown("teacherreg","otp");' >
				<div>
					<p class="text-success" ></p>
				</div>
				<input type=hidden name="sec" value="<?php echo ((isset($_GET["key"]) && $_GET["key"]=="sjdhsjdgidc")?1:0);   ?>" />
				<table>
					<tr>
						<td>
							<?php self::takeinp("Full name","name",$_POST,"","","text","simple"); ?>
						</td>
						<td>
							<?php self::takeinp("Email Id","email",$_POST,"","","email","email"); ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php  self::selectinp( Fun::addselect(Fun::arrtooption(alliits())) , array('label'=>"From which IIT You are", "name"=>'iit')); ?>
						</td>
						<td>
							<?php  self::selectinp( Fun::addselect(Fun::arrtooption(
							$iitjoinyears)) , array('label'=>"Year of joining IIT", "name"=>'iitentryyear')); ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php self::selectinp( Fun::addselect(Fun::arrtooption(degrees())) , array('label'=>"Degree",'name'=>'degree')); ?>
						</td>
						<td>
							<?php self::takeinp("Phone no.","phone",$_POST,"","","","phone"); ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php  self::takeinp("Choose a Password","password",$_POST,"","Choose Password","password","simple","password"); ?>
						</td>
						<td>
							<?php self::takeinp("Re-Password","repassword",$_POST,"","ReEnter your password","password","password" ); ?>
						</td>
					</tr>
				</table>
			<?php
				form_textarea(array('ph'=>'Any teaching experience','style'=>'width:480px;margin-left:10px;',"name"=>"experience",'dc'=>'idel'));
				form_textarea(array('ph'=>'Anything else you want to tell','style'=>'width:480px;margin-left:10px;','rows'=>3,"name"=>"addinfo",'dc'=>'idel'));

			?>
				<input type='hidden' value='t' name='type' />
				<button type="submit" class="btn btn-default" name=teacherregpage style='margin-left:10px;' >Submit</button>
			</form>
		</div>
		<?php
	}

	public static function teacherRegForm1(){
		$iitjoinyears=Fun::oneToN(date("Y"),1950,false);
		?>
		<style>
			td  {
				padding: 10px;
				min-width:250px;
			}
		</style>
		<div style='width:250px;' >
			<form id=temp1 method=get onsubmit='if(submitForm(this)){form.sendreq(this,$(this).find("button[type=submit]")[0]);};return false;' data-action="teacherreg" data-res='hideshowdown("teacherreg","otp");'  >
				<div>
					<p class="text-success" ></p>
				</div>
				<input type=hidden name="sec" value="<?php echo ((isset($_GET["key"]) && $_GET["key"]=="sjdhsjdgidc")?1:0);   ?>" />
				<table>
					<tr>
						<td>
							<?php self::takeinp("Full name","name",$_POST,"","","text","simple"); ?>
						</td>
						<td>
							<?php self::takeinp("Email Id","email",$_POST,"","","email","email"); ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php  self::selectinp( Fun::addselect(Fun::arrtooption(alliits())) , array('label'=>"From which IIT You are", "name"=>'iit')); ?>
						</td>
						<td>
							<?php  self::selectinp( Fun::addselect(Fun::arrtooption(
							$iitjoinyears)) , array('label'=>"Year of joining IIT", "name"=>'iitentryyear')); ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php self::selectinp( Fun::addselect(Fun::arrtooption(degrees())) , array('label'=>"Degree",'name'=>'degree')); ?>
						</td>
						<td>
							<?php self::takeinp("Phone no.","phone",$_POST,"","","","phone"); ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php  self::takeinp("Choose a Password","password",$_POST,"","Choose Password","password","simple","password"); ?>
						</td>
						<td>
							<?php self::takeinp("Re-Password","repassword",$_POST,"","ReEnter your password","password","password" ); ?>
						</td>
					</tr>
				</table>
			<?php
				form_textarea(array('ph'=>'Any teaching experience','style'=>'width:480px;margin-left:10px;',"name"=>"experience",'dc'=>'idel'));
				form_textarea(array('ph'=>'Anything else you want to tell','style'=>'width:480px;margin-left:10px;','rows'=>3,"name"=>"addinfo",'dc'=>'idel'));

			?>
				<button type="submit" class="btn btn-default" name=teacherregpage style='margin-left:10px;' >Submit</button>
			</form>
		</div>
		<?php
	}


	public static function dispButton($name,$text,$extra=''){
?>
		<button <?php echo $extra; ?> type="submit" class="btn btn-default" name="<?php echo $name; ?>"  ><?php echo $text; ?></button>
<?php
	}
	public static function disp_apply_button($pos){//Required => isloginas('u')
?>
	<?php
		if(User::isloginas('u')) {
			if(!Help::hasapplied($pos) ){
?>
		<textarea id='applycomment' class=form-control placeholder="You want to say something ? " style='resize:none;margin-bottom:5px;' ></textarea>
		<p><button data-waittext='Appling..' data-res='ab.disabled=true;$("#applycomment").hide();' data-restext='Applied' class="btn btn-primary" role="button" data-action='applyforpos' data-params='{"pos":"<?php echo $pos; ?>","comment":$("#applycomment").val(),"action":"applyforpos"}' data-pos='<?php echo $pos; ?>' onclick='ab=this;mohit.confirm(conftext,"button.sendreq(ab);");' >Apply</button></p>
		<?php
			}
			else{
		?>
		<p><button  data-toggle="tooltip" data-placement="right" title="You have already applied for it."  class='btn btn-primary'  >Applied !! </button></p>
		<?php
			}
		}
		else{
		?>
		<p><button data-toggle="modal" data-target="#loginPopupId" aria-hidden="true" class='btn btn-primary'  >Apply</button></p>
		<?php
		}
		?>
<?php		
	}
	public static function dispTableTitle($ttitle,$style=''){
		?>
			<tr>
			<?php
				for($i=0;$i<count($ttitle);$i++){
			?>
				<td style='padding:10px;<?php echo $style; ?>' ><?php echo $ttitle[$i]; ?></td>
			<?php
				}
			?>
			</tr>
		<?php
	}
	public static function mysubjects($tid){
		dispTableTitle(array("S.No.","Class","Subject","Topic", "Time required","Price","Apx. Cost"),"font-size:15px;font-weight:800");
		$sublist=Help::listsubject($tid);
		for($i=0;$i<count($sublist);$i++){
			$row_inputs=array($i+1,$sublist[$i]["class"],$sublist[$i]["subject"],$sublist[$i]["topic"],$sublist[$i]["timer"]." hours",$sublist[$i]["price"]." Rs./hr", floor($sublist[$i]["price"]*$sublist[$i]["timer"]));
			if($tid==User::loginId())
				$row_inputs[]= "<span><a onclick='deletesubj(this);' >Delete</a></span>";
			dispTableTitle($row_inputs);
		}
	}
	public static function mytimings(){
		$timelist=Help::listtiming();
		dispTableTitle(array("S.No.","Date","Time"));
		for($i=0;$i<count($timelist);$i++){
			dispTableTitle(array($i+1, Fun::timetodate($timelist[$i]["timeslot"]) , Fun::timetotime($timelist[$i]["timeslot"])  ));
		}
	}
	public static function pendingrequests(){//Only Admin can call this function.
		$aid=User::loginId();
		$tl=Sql::getArray("select  teachers.*,users.name from teachers left join users on users.id=tid where isselected='f'" );
	?>
			<a  class="dropdown-toggle" data-toggle="dropdown"  role="button"  >Requests
			<?php
				if(count($tl)>0){
			?>
				<span class="badge"><?php echo count($tl); ?></span>
				<?php
				}
				?>
			 <span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu" style='padding:10px;width:300px;' >
				<?php
					if(count($tl)==0){
						echo "No Pending approvel";
					}
					for($i=0;$i<count($tl);$i++){
				?>
				<li style='border-left:solid red 0px;' >
					<span ><a href="" style='margin-right:20px;' ><?php echo $tl[$i]['name']; ?></a>
						<button  data-tid="<?php echo $tl[$i]['tid']; ?>" 
						type=button class="btn btn-primary" onclick='button.sendreq(this);' data-action='acceptreq' data-restext="Accepted"  data-res="request.load_pendr();" >Accept</button></span>
				</li>
				<li class="divider"></li>
				<?php
					}
				?>
			</ul>
		<?php
	}
	public static function dispcal($datetoday,$seen,$whom,$tid){
?>
		<table class='table-block-hover' ><tr>
			<td style='padding:10px;' ><button class='btn btn-default' onclick='request.loadcal(this,<?php echo $datetoday; ?>,"p","<?php echo $tid; ?>");' >Pre <img src='<?php echo CDN; ?>icons/loading2.gif' style='margin-top:-5px;margin-bottom:-5px;visibility:hidden;' /></button></td>
			<td style='padding:10px;font-weight:700;' ><?php echo date("F Y",$datetoday); ?></td>
			<td style='padding:10px;' ><button class='btn btn-default' onclick='request.loadcal(this,<?php echo $datetoday; ?>,"n","<?php echo $tid; ?>");'  >Next <img src='<?php echo CDN; ?>icons/loading2.gif' style='margin-top:-5px;margin-bottom:-5px;visibility:hidden;' /></button></td>
		</tr></table>
		<table class='table-block-hover table-bordered' >
	<?php
		dispTableTitle(array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"));

		$datetodaynum=date("d",$datetoday);//today date integer (1-31)
		$daytodaynum=date("w",$datetoday);//today Day interger (0-6)
		$firstday=($daytodaynum-$datetodaynum+1+70)%7;//b/w 0-6 telling me sunday,munday of starting day.
		$maxdays=date('t',$datetoday);//Max days in this month
		$days=array();
		$cur=1;
		$mycal=Help::getTeacherCal($datetoday,$tid);

		for($i=0;$i<6;$i++){
			if($cur>$maxdays)
				break;
			$days[]=array();
			for($j=0;$j<7;$j++){
				$days[$i][]="";
				if($cur>1 || $j==$firstday){
					if($cur<=$maxdays){
						$dateonday=Fun::datetoday($datetoday+24*3600*($cur-$datetodaynum));
						$add="<div style='width:140px;height:80px;' onclick='".($seen=='t' ? "opencaltime":"bookslot"  )."(this,".'"'.(Fun::timetodate($dateonday)).'"'.",".$dateonday.",".$tid.");'  >";
						if(isset($mycal[$dateonday]))
							$add.="".($mycal[$dateonday]["num_book"]==0?"":"Booked Slot : ".$mycal[$dateonday]["num_book"]." <br> ").""."".(Fun::getslottext($mycal[$dateonday]["fslot"]));
						if( $dateonday==Fun::datetoday())
							$days[$i][$j]="<div style='background-color:yellow;width:20px;height:20px;border-radius:10px;' align=center >$cur</div>";
						else
							$days[$i][$j]=$cur;
						$add.="</div>";
						$days[$i][$j].=$add;
					}
					$cur=$cur+1;
				}
			}
		}
		for($i=0;$i<count($days);$i++)
			dispTableTitle($days[$i],'min-width:100px;');
		?>
	</table>
<?php
	}
	public static function inpMultiple($labels,$name,$namelabel,$title,$data=null,$style='',$onchange='',$style1='',$checked=false){
?>
		<div class="form-group  has-feedback "  style='<?php echo $style; ?>' >
			<label style='font-weight:600;' ><?php echo $title; ?></label>
			<ul class="nav nav-tabs" style='margin-top:0px;' >
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" style='color:black;border:solid #bbbbbb 1px;padding:5px;' >
						Select <?php echo $namelabel; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style='padding:10px;width:200px;<?php echo $style1; ?>' >
						<div>
							<input id='select_<?php echo $name."0"; ?>' type="checkbox" onload='changelabelcolor(this);'  onchange='changelabelcolor(this);selectAll(this);<?php echo $onchange; ?>' style='float:left;margin-top:10px;' >
							<label for='select_<?php echo $name."0"; ?>' style='float:left;margin:5px;color:gray;' >Select All</label>
							<div style='clear:both;' ></div>
						</div>
						<?php
						for($i=0;$i<count($labels);$i++){
							$ln=$name.($i+1);
						?>
							<div>
								<input <?php if($checked &&(  $data==null || in_array(($i+1),$data )  )) echo "checked";  ?> id='select_<?php echo $name.($i+1); ?>' type="checkbox"  onchange='changelabelcolor(this);<?php echo $onchange; ?>' name="<?php echo $ln; ?>" style='float:left;margin-top:10px;' >
								<label for='select_<?php echo $name.($i+1); ?>' style='float:left;margin:5px;color:gray;' ><?php echo $labels[$i]; ?></label>
								<div style='clear:both;' ></div>
							</div>
						<?php
						}
						?>
						<input type=hidden name='num_<?php echo $name; ?>' value='<?php echo count($labels); ?>' />
					</ul>
				</li>
			</ul>
		</div>
<?php
	}
	public static function inpMultiple_v2($labels,$name,$namelabel,$title,$data=null,$style='',$onchange=''){
?>
		<div class="form-group  has-feedback "  style='<?php echo $style; ?>' >
			<label style='font-weight:600;' ><?php echo $title; ?></label>
			<ul class="nav nav-tabs" style='margin-top:0px;' >
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" style='color:black;border:solid #bbbbbb 1px;padding:5px;' >
						Select <?php echo $namelabel; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style='padding:10px;width:200px;' >
						<div>
							<input id='select_<?php echo $name."0"; ?>' type="checkbox" onload='changelabelcolor(this);'  onchange='changelabelcolor(this);selectAll(this);<?php echo $onchange; ?>' style='float:left;margin-top:10px;' >
							<label for='select_<?php echo $name."0"; ?>' style='float:left;margin:5px;color:gray;' >Select All</label>
							<div style='clear:both;' ></div>
						</div>
						<?php
						for($i=0;$i<count($labels);$i++){
							$ln=$name.($i+1);
						?>
							<div>
								<input <?php if($data==null || in_array(($i+1),$data )  ) echo "checked";  ?> id='select_<?php echo $name.($i+1); ?>' type="checkbox" onload='changelabelcolor(this);'  onchange='changelabelcolor(this);<?php echo $onchange; ?>' name="<?php echo $ln; ?>" style='float:left;margin-top:10px;' >
								<label for='select_<?php echo $name.($i+1); ?>' style='float:left;margin:5px;color:gray;' ><?php echo $labels[$i]; ?></label>
								<div style='clear:both;' ></div>
							</div>
						<?php
						}
						?>
						<input type=hidden name='num_<?php echo $name; ?>' value='<?php echo count($labels); ?>' />
					</ul>
				</li>
			</ul>
		</div>
<?php
	}

	public static function inpMultiple_v3($labels,$inp){
		$inp=Fun::mergeifunset($inp,array("name"=>"","data"=>Fun::oneToN(count($labels)),"divstyle"=>"","onchange"=>"","style"=>"","blocked"=>array(),"selectall"=>true,"onchangeind"=>Fun::copy_arr( count($labels) ) , 'onclickind'=>Fun::copy_arr( count($labels) ) ));
		$name=$inp["name"];
?>
		<div style='padding:10px;<?php echo $inp["divstyle"]; ?>' >
			<?php
				if($inp["selectall"]){
			?>
				<div>
					<input id='select_<?php echo $inp["name"]."0"; ?>' type="checkbox" onload='changelabelcolor(this);'  onchange='changelabelcolor(this);selectAll(this);inpmultiple.setvalue(this);<?php echo $inp["onchange"]; ?>' style='float:left;margin-top:10px;' >
					<label for='select_<?php echo $inp["name"]."0"; ?>' style='float:left;margin:5px;color:gray;' >Select All</label>
					<div style='clear:both;' ></div>
				</div>
			<?php
			}
			for($i=0;$i<count($labels);$i++){
				$isselected=in_array($i+1,$inp["data"]);
				$isblocked=in_array($i+1,$inp["blocked"]);
			?>
				<div>
					<input <?php if($isselected) echo "checked";  ?> id='select_<?php echo $name.($i+1); ?>' <?php if($isblocked) echo "disabled"; ?> type="checkbox" onchange='changelabelcolor(this);inpmultiple.setvalue(this);<?php echo $inp["onchangeind"][$i]; ?><?php echo $inp["onchange"]; ?>' style='float:left;margin-top:10px;'   >
					<label for='select_<?php echo $name.($i+1); ?>' style='float:left;margin:5px;color:<?php echo ($isselected?"black":"gray"); ?>;' ><?php echo $labels[$i]; ?></label>
					<div style='clear:both;' ></div>
				</div>
			<?php
			}
			?>
			<input type=hidden name='<?php echo $name; ?>' value='<?php echo implode("-",$inp["data"]); ?>' />
		</div>
<?php
	}
	public static function inpMultiple_dropdown($labels,$inp){
		$inp=Fun::mergeifunset($inp,array("label"=>"","title"=>""));
?>
		<div class="form-group  has-feedback "  style='<?php echo ""; ?>' >
			<label style='font-weight:600;' ><?php echo $inp["title"]; ?></label>
			<ul class="nav nav-tabs" style='margin-top:0px;' >
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" style='color:black;border:solid #bbbbbb 1px;padding:5px;' >
						<?php echo $inp["label"]; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style='padding:10px;width:300px;' >
					<?php
						Disp::inpMultiple_v3($labels,$inp);
					?>
					</ul>
				</li>
			</ul>
		</div>
<?php
	}
	public static function disp_slots($date,$tid){
		$allslots=Sqle::selectVal("timeslot","slot",array("tid"=>$tid,"daytime"=>$date));
		$sids=array();
		for($i=0;$i<count($allslots);$i++)
			$sids[]=$allslots[$i]["slot"];
		$times=array();
		for($i=0;$i<24;$i++){
			$times[]=Fun::timetotime($date+$i*3600 )." - ".Fun::timetotime($date+($i+1)*3600-1 ) ;
		}
		$name="disptimeslot";
?>
		<div  style='padding:10px;width:200px;' >
			<div >
				<input id='select_<?php echo $name."0"; ?>' type="checkbox" onload='changelabelcolor(this);'  onchange='changelabelcolor(this);selectAll(this);addremts(this,"<?php echo $date; ?>","<?php echo 24; ?>");' style='float:left;margin-top:10px;' >
				<label for='select_<?php echo $name."0"; ?>' style='float:left;margin:5px;color:gray;' >Select All</label>
				<div style='clear:both;' ></div>
			</div>
			<?php
			$labels=$times;
			for($i=0;$i<count($labels);$i++){
				$ln=$name.($i+1);
			?>
				<div>
					<input <?php if(in_array($i,$sids)) echo "checked";  ?> id='select_<?php echo $name.($i+1); ?>' type="checkbox"  onchange='changelabelcolor(this);addremts(this,"<?php echo $date; ?>","<?php echo $i; ?>");' name="<?php echo $ln; ?>" style='float:left;margin-top:10px;' >
					<label for='select_<?php echo $name.($i+1); ?>' style='float:left;margin:5px;color:gray;' ><?php echo $labels[$i]; ?></label>
					<div style='clear:both;' ></div>
				</div>
			<?php
			}
			?>
			<input type=hidden name='num_<?php echo $name; ?>' value='<?php echo count($labels); ?>' />
		</div>
<?php
	}
	public static function comment($data){
?>
		<div class=comment data-cid='<?php echo $data["id"]; ?>' style='border-bottom:solid #dddddd 1px;' >
			<div style='float:left;margin-right:5px;' >
				<img src='<?php echo HOST; ?>photo/mohit.jpg' width='38' class='img-circle' />
			</div>
			<div style='padding-left:10px;float:right;' >
				<?php
					if($data['uid']==User::loginId() || true ){
				?>
				<ul class="nav nav-tabs" style='border:solid gray 0px;' >
					<li role="presentation" style='padding:0px;border:solid gray 0px;' class='pull-left' >
						<a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style='padding:3px 6px;border:solid gray 0px;' ><span class='caret' ></span></a>
						<ul class="dropdown-menu pull-right" role="menu" role="menu">
							<li><a  >Edit</a></li>
							<li><a  >Delete</a></li>
						</ul>
					</li>
				</ul>
				<?php
					}
					else if($data["puid"]==User::loginId()){
						dropdown(array("Delete"));
					}
				?>
			</div>
			<div style='float:left;width:446px;' >
				<div>
					<?php 
						echo disp_sprofilename($data);
						echo " ".htmlspecialchars($data["ctext"]);
					 ?>
				</div>
				<table><tr>
					<td>
						<span class='timepassed' ><?php echo Fun::timepassed(time()-$data['time']); ?></span>
					</td>
					<td style='padding-left:10px;' >
						<a data-action='like' onclick='button.sendreq(this);' data-waittext="Liking .." data-at="l" data-res='onres.like(obj);' data-pid="<?php echo $data["id"]; ?>" data-type="c" >Like</a>
					</td>
					<td style='padding-left:10px;' >
						<a><span class='glyphicon glyphicon-thumbs-up' ></span> 12</a>
					</td>
				</tr></table>
			</div>
			<div class='clear'></div>
		</div>
<?php
	}

	public static function disp_comment($data){
?>
		<div class=comment >
			<div style='float:left;margin-right:5px;' >
				<img src='<?php echo $data["profilepic"]; ?>' width='38' class='img-circle' />
			</div>

			<div style='float:left;width:446px;' >
				<div>
					<?php textarea(array('rows'=>1,'data-maxrows'=>4,'onkeyup'=>'textarea.resize(this);', 'ph'=>"Review here","onkeydown"=>"textarea.resize(this);request.load_comment(event,this,".$data["pid"].",\"n\"".");","id"=>"inpcomment_".$data["pid"],"style"=>"resize:none;")); ?>
				</div>
			</div>
			<div style='float:left;margin-left:4px;' ><img  id="comment_loadingimg_<?php echo $data["pid"]; ?>" src='<?php echo HOST; ?>photo/icons/loading2.gif' style='display:none;' /></div>
			<div class='clear'></div>
		</div>
<?php
	}
	public static function disp_courses(){
		$subt=getsubt();
?>
							<div style='padding:10px;' >
								<div class="nav nav-tabs" style='margin:0px;padding:0px;'  >
								<?php
									$subkeys=array_keys($subt);
									for($i=0;$i<count($subkeys);$i++){
								?>
									<li class="<?php if($i==1) echo "active"; ?>" style='margin:0px;padding:0px;' >
										<a  id="<?php echo "temp_".$i; ?>" style="margin:3px;padding:5px;" onclick='var temp_allsub=$("#<?php echo "sub".$i; ?>");temp_allsub.siblings().hide();$(this).parent().siblings().removeClass("active");$(this).parent().addClass("active");temp_allsub.slideDown();' ><?php echo $subkeys[$i]; ?></a>
									</li>
								<?php
									}
								?>
								</div>
								<div  class="tab-content">
									<?php
									for($i=0;$i<count($subkeys);$i++){
									?>
									<div  id="<?php echo "sub".$i; ?>"  style='<?php if($i!=0) echo "display:none;"; ?>' align=left >
										<div>
											<div class="nav nav-tabs"  >
											<?php
											$subsubjects=$subt[$subkeys[$i]];
											$count=0;
											foreach( $subsubjects as $j=>$val){
											?>
												<li class="">
													<a style='color:black;' onmouseenter='$("#<?php echo "dropd_".$i."_".$count; ?>").siblings().slideUp();$("#<?php echo "dropd_".$i."_".$count; ?>").slideDown();' ><?php  echo $j; ?></a>
												</li>
											<?php
												$count+=1;
											}?>
											</div>
											<div id="<?php echo "tl_".$i; ?>" >
											<?php
											$count=0;
											foreach( $subsubjects as $j=>$val){
												?>
												<div style='padding:10px;font-size:15px;font-weight:900;display:none;' align=left  id='<?php echo "dropd_".$i."_".$count;?>' >
													
													<div style='font-size:15px;'  align=left >
													<?php
														for($k=0;$k<count($val) ;$k++){
														?>
															<a data-dispname="<?php echo $subkeys[$i]." : "; ?>" style='font-weight:100'  href='<?php echo BASE."?course=".urlencode($subkeys[$i])."&subject=".urlencode($j)."&topic=".$val[$k] ; ?>' ><?php echo $val[$k]; ?></a><br>
														<?php
														}
													?>
													</div>
												</div>
												<?php
												$count+=1;
											}
										?>
											</div>
										</div>
									</div>
									<?php
									}
									?>
								</div>
							</div>
<?php	
	}
	public static function  disp_table($inp){
			if(count($inp)>0){
		?>
		<table border="1" style="margin-bottom:100px;">
			<?php
			dispTableTitle(array_keys($inp[0]));
			for($i=0;$i<count($inp);$i++){
				dispTableTitle(Fun::get_key_values($inp[$i]));
			}
			?>
		</table>
<?php
		}
		else
			echo "Empty Table";
	}
	public static function teacherprofile_self($tprofile,$tid,$tabid){
		include "includes/data_subj.php";

?>
		<script>
		var topics=<?php echo json_encode($subt); ?>;
		topics['']=[];
		</script>
		<?php

		if($tprofile['isselected']=='t'){
			$arr_tabs=array("timeline"=>"Profile","subjects"=>"Topics","cal"=>"Calander","bookedslot"=>"Booked Slots","reviews"=>"Reviews" );
		?>
		<div style='padding:10px;' >
			<ul  class="nav nav-tabs" role="tablist">
				<?php
					foreach($arr_tabs as $key=>$val){
				?>
				<li class="<?php if($tabid==$key) echo "active"; ?>">
					<a href="#<?php echo $key; ?>" role="tab" data-toggle="tab" style='' ><?php echo $val; ?></a>
				</li>
				<?php
					}
				?>
			</ul>
			<br>
			<div  class="tab-content">
				<div class="tab-pane fade <?php if($tabid=="timeline")echo "active in"; ?>" id="timeline">
					<?php Disp::teacher_timeline($tid); ?>
				</div>
				<div class="tab-pane fade <?php if($tabid=="subjects")echo "active in"; ?>" id="subjects">
					<p style='font-size:20px;' >Please Choose Subject of Your Choice</p>
		<?php
			include "includes/content/choosesubject.php";
		?>
					<table class='table-hover table table-bordered' id='mysubjects' >
					<?php
						Disp::mysubjects($tid);
					?>
					</table>
				</div>
				<div class="tab-pane fade <?php if($tabid=="timing")echo "active in"; ?>" id="timing" style='display:none;' >
		<?php
		include "includes/content/timing.php";
		?>
				</div>
				<div class="tab-pane fade <?php if($tabid=="cal")echo "active in"; ?>" id="cal">
					<?php
						$weekdays=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
						$times=array();
						for($i=0;$i<24;$i++){
							$times[]=Fun::timetotime($datetoday+$i*3600 )." - ".Fun::timetotime($datetoday+($i+1)*3600-1 ) ;
						}
					?>
					<p style='font-size:20px;' >Please Update the time you want to teach</p>
					<div align=center >
						<form id='addtimeslot' >
							<table><tr>
								<td style='padding:10px;' ><?php //Disp::takeinp_v2(array( 'name'=>'weekdays', 'label'=>'Select Day','type'=>'select','val'=>array('options'=>$weekdays,'mselect'=>'multiple' ),'style'=>'height:160px;overflow-y:hidden;') ); ?></td>
								<td style='padding:10px;' ><?php // Disp::takeinp_v2(array( 'name'=>'timeslots', 'label'=>"Select Time Slot",'type'=>'select','val'=>array('options'=>$times,'mselect'=>'multiple'),'style'=>'height:160px;')); ?></td>
								<td style='padding:10px;' ><?php Disp::inpMultiple($weekdays,"weekdays","weekdays","Select Day"); ?></td>
								<td style='padding:10px;' ><?php Disp::inpMultiple($times,"timeslot","timeslot","Select Timeslot",null,"","","height:300px;overflow-y:scroll;"); ?></td>


								<td style='padding:10px;' ><?php button(array("html"=>"Add","name"=>"addtimeslot","onclick"=> 'if(submitForm($("#addtimeslot")[0]))button.sendreq(this);' ,"data-params"=>'getFormInputs($("#addtimeslot")[0],"addtimeslot");' ,"data-action"=>"addtimeslot","data-restext"=>"Added" , "data-waittext"=>"Adding.." ,"data-ar"=>"a","data-res"=> 'setTimeout(function(){obj.innerHTML="Add";},1000);$("#addtimeslot")[0].reset();request.loadcal(obj,'.(Fun::datetoday()).',"","'.$tid.'");')); ?></td>
								<td style='padding:10px;' ><?php button(array("html"=>"Remove","name"=>"remtimeslot","onclick"=> 'if(submitForm($("#addtimeslot")[0]))button.sendreq(this);' ,"data-params"=>'getFormInputs($("#addtimeslot")[0],"");' ,"data-action"=>"remtimeslot","data-restext"=>"Removed" , "data-waittext"=>"Remove.." ,"data-ar"=>"r",  "data-res"=> 'setTimeout(function(){obj.innerHTML="Remove";},1000);$("#addtimeslot")[0].reset();request.loadcal(obj,'.(Fun::datetoday()).',"","'.$tid.'");')); ?></td>


							</tr></table>
						</form>
					</div>
					<div align=center id='mycal' >
		<?php



				$inp=Fun::datetoday();
				$inp=Fun::timeofnextmonth($inp);
				$inp=Fun::timeofprvmonth($inp);
				Disp::dispcal($inp,"t","t",User::loginId());
		?>
					</div>
				</div>
				<?php
					Disp::open_tab("open","bookedslot",$tabid);
					Disp::bookedslot_teacher(User::loginId());
					Disp::open_tab("close","bookedslot",$tabid);
					
					Disp::open_tab("open","reviews",$tabid);
					Disp::disp_feedback(User::loginId());
					Disp::open_tab("close","reviews",$tabid);
					



				?>
			</div>
		</div>
		<?php
		}
		else{
		?>

		<div style='padding:20px;' >Your request is sent ! we will inform you if you will select</div>
		<?php
		}
	}
	public static function teacherprofile_student($tprofile,$tid,$tabid){


?>
		<?php
		if($tprofile['isselected']=='t'){
			$arr_tabs=array("timeline"=>"Profile","subjects"=>"Topics","cal"=>"Calander","reviews"=>"Reviews" );
		?>
		<div style='padding:10px;' >
			<ul  class="nav nav-tabs" role="tablist">
				<?php
					foreach($arr_tabs as $key=>$val){
				?>
				<li class="<?php if($tabid==$key) echo "active"; ?>">
					<a href="#<?php echo $key; ?>" role="tab" data-toggle="tab" style='' ><?php echo $val; ?></a>
				</li>
				<?php
					}
				?>
			</ul>
			<br>
			<div  class="tab-content">
				<div class="tab-pane fade <?php if($tabid=="timeline")echo "active in"; ?>" id="timeline">
					<?php Disp::teacher_timeline($tid); ?>
				</div>
				<div class="tab-pane fade <?php if($tabid=="subjects")echo "active in"; ?>" id="subjects">
					<table class='table-hover table table-bordered' id='mysubjects' >
					<?php
						Disp::mysubjects($tid);
					?>
					</table>
				</div>
				<div class="tab-pane fade <?php if($tabid=="cal")echo "active in"; ?>" id="cal">
					<div align=center id="mycal" >
		<?php
				$inp=Fun::datetoday();
				$inp=Fun::timeofnextmonth($inp);
				$inp=Fun::timeofprvmonth($inp);
				Disp::dispcal($inp,"s","t",$tid);
		?>
					</div>
				</div>

				<?php

					Disp::open_tab("open","reviews",$tabid);
					Disp::disp_feedback($tid);
					Disp::open_tab("close","reviews",$tabid);

				?>
			</div>
		</div>
		<?php
		}
	}
	public static function open_booking_slots($tid,$daytime){
		$allslots=Sqle::selectVal("timeslot","*",array("tid"=>$tid,'daytime'=>$daytime ));
		$labels=array();
		$blocked=array();
		$onchangeind=array();
		for($i=0;$i<count($allslots);$i++){
			$labels[]=Fun::timetotime($daytime+3600*$allslots[$i]["slot"]);
			if($allslots[$i]["sid"]!=0){
				$blocked[]=($i+1);
			}
			$slotid=$allslots[$i]["slot"];
			$onchangeind[]="if(this.checked){book_slot($tid,$daytime,$slotid );}";
		}
		Disp::inpMultiple_v3($labels,array("data"=> array() , 'blocked'=>$blocked , 'selectall'=>false , 'onchangeind'=>$onchangeind ));
	}
	public static function teacher_timeline($tid){
		$udata=Sql::getArray("select teachers.*,users.name,users.profilepic,rating.rate from teachers left join users on users.id=teachers.tid left join (select tid,avg(rate) as rate from timeslot where rate is not null group by tid) rating on rating.tid=teachers.tid where teachers.tid=? limit 1",'i',array(&$tid));
		if(count($udata)>0){
			$udata=$udata[0];
			Disp::timeline($tid,$udata);
		}
	}
	public static function student_timeline($sid){
	}
	public static function timeline($uid,$udata){
		if($uid==User::loginId()){
		?>
			<a onclick='$(this).next().slideToggle();' >Edit</a>
			<div style='display:none;' >
				<form method=post enctype='multipart/form-data' action='<?php echo BASE.(User::loginType())."profile?tabid=timeline"; ?>' >
					<?php
						echo "Upload Profile Pic";
						input(array('type'=>'file','name'=>"profilepic","class"=>""));
						button(array("html"=>"Submit","type"=>"submit" ));
					?>
				</form>
				<form method=post  action='<?php echo BASE.(User::loginType())."profile?tabid=timeline"; ?>' >
					<?php
						form_input(array('ph'=>"Youtube Link","name"=>"youtubelink","value"=>$udata["youtubelink"]));
						echo "Date Of Birth";
						form_input(array('ph'=>"DD-MM-YYYY","name"=>"dob","value"=>$udata["dob"]));
						button(array("html"=>"Submit","type"=>"submit"));
					?>
				</form>
			</div>
		<?php
		}
		?>
		<div>
			<div style='float:left;'>
				<img src='<?php echo $udata["profilepic"]; ?>' height='100' width='100' />
				<table class='table-hover ' >
					<?php
						$toshow=array();
						$toshow["Name"]=$udata["name"];
						if($udata["dob"]!="")
							$toshow["Age"]=date("Y")-date("Y",strtotime($udata["dob"]));
						$toshow["Rate"]="<b>".number_format($udata["rate"],2)." / 5</b>";
						$toshow["Experience"]="<div>".Fun::displayMsgBody($udata["experience"])."</div>";
						$alliit=alliits();
						$alldeg=degrees();
						$toshow["Studies in IIT-"]="".$alliit[$udata["iit"]-1];
						$toshow["Year of Joining : "]=(2016-$udata["iitentryyear"]);
						$toshow["Degree : "]=$alldeg[$udata["degree"]-1];

						foreach($toshow as $key=>$val){
							dispTableTitle(array($key,$val));
						}
					?>
				</table>
			</div>
			<div style='float:left' >
				<?php
					if($udata["youtubelink"]!=""){
				?>
				<iframe title="Introduction About me." type="text/html" width="640" height="390" src="<?php echo str_replace("youtube.com","youtube.com/embed",$udata["youtubelink"]); ?>" frameborder="0" allowFullScreen></iframe>
				<?php
					}
				?>
			</div>
			<div class='clear' ></div>
		</div>
		<?php
	}
	public static function disp_notf(){
		global $page;
?>
		<li role="presentation" class="dropdown <?php if($page=="notf") echo "active"; ?> " >
			<?php
				$top3notf=Help::mynotf(3);
				$num_unread=Help::num_unreadmsg();
			?>
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Notifications<?php if($num_unread>0){ ?>
				<span class="badge"><?php echo $num_unread; ?></span>
				<?php
			}
				?>
			</a>
			<ul class="dropdown-menu" role="menu">
				<?php
					if(count($top3notf)==0){
				?>
				<li>
					<a>There is no notifications</a>
				</li>
				<?php
					}
				for($i=0;$i<count($top3notf);$i++){
			?>
				<li><a href="<?php echo $top3notf[$i]["url"]; ?>">
					<span style='<?php if($top3notf[$i]['isr']=='0') echo "font-weight:700;"; ?>' ><?php echo Fun::displayMsgBody($top3notf[$i]["content"]); ?></span>
					<div align=right class='notf_time' ><?php echo Fun::timepassed(time()-$top3notf[$i]['time']); ?></div>
				</a></li>
				<?php
					if($i!=count($top3notf)-1){
				?>
				<li class="divider"></li>
			<?php
					}
				}
			?>
			<?php
				if(count($top3notf)>=3){
			?>
				<li class="divider"></li>
				<li><a href="<?php echo BASE."notf";  ?>" style='color:#428BCA;' >See all</a></li>
			<?php
				}
			?>
			</ul>
		</li>
<?php		
	}
	public static function open_tab($oc,$id,$selid){
		if($oc=='open'){
?>
		<div class="tab-pane fade <?php if($id==$selid) echo "active in"; ?>" id="<?php echo $id; ?>">
<?php
		}
		else if($oc='close'){
?>
		</div>
<?php
		}
	}
	public static function disp_feedback($tid){
		$fbacks=Sqle::getArray("select timeslot.feedback,timeslot.rate,users.name from timeslot left join users on users.id=timeslot.tid where sid!=0 AND rate is not NULL AND feedback!='' AND tid=? order by (daytime+3600*slot) ",'i',array(&$tid));
		for($i=0;$i<count($fbacks);$i++){
		?>
			<div class='notf_msg' >
				<a >
					<div  ><?php echo Fun::displayMsgBody($fbacks[$i]["feedback"] ); ?>
					</div>
				</a>
				<div style='float:right;' ><?php echo Fun::displayMsgBody($fbacks[$i]["name"]); ?></div>
				<div class='clear' ></div>
			</div>
		<?php
		}
	}
	public static function bookedslot($sid){//For a Student
		$stdslots=Sql::getArray("select timeslot.*,users.name,(daytime+3600*slot) as apptime from timeslot left join users on users.id=timeslot.tid where sid=? order by  (daytime+3600*slot) desc",'i',array(&$sid));
		opent("table",array("class"=>"table-hover table-bordered"));
		dispTableTitle(array("S.No.","Teacher","Timing","","Teaching URL","Feedback","Test Papers","Solutions","Marks"));
		for($i=0;$i<count($stdslots);$i++){
			$tprofileurl=BASE."tprofile?tid=".$stdslots[$i]["tid"];
			$row=array($i+1,"<a href='$tprofileurl' >".$stdslots[$i]["name"]."</a>" );
			$row[]=Fun::timetostr($stdslots[$i]["daytime"]+$stdslots[$i]["slot"]*3600);
			$row[]=($stdslots[$i]["apptime"]>time())?"Upcoming":"Past";
			if($stdslots[$i]["url"]!="")
				$row[]="<a href='".$stdslots[$i]["url"]."' >URL</a>";
			else
				$row[]="";
			if($stdslots[$i]["url"]!=""){
				$tid=$stdslots[$i]["tid"];
				$daytime=$stdslots[$i]["daytime"];
				$slot=$stdslots[$i]["slot"];
				if($stdslots[$i]["rate"]=="" )
					$row[]="<button class='btn btn-default' onclick='openedfromme=this;student_feedback(this,$tid,$daytime,$slot);' >Feedback</button>";
				else
					$row[]="Submited";
				$row[]=implode(" | ",Fun::filestodownload_link($stdslots[$i]["testfiles"]));
				if($stdslots[$i]["solnfiles"]=="" && $stdslots[$i]["testfiles"]!="" ){
					$hinputs=hinp("daytime",$stdslots[$i]["daytime"] ).hinp("slot",$stdslots[$i]["slot"] ).hinp("tid",$stdslots[$i]["tid"] );
					$testpaper="<form method=post action='".BASE."sprofile?tabid=bookedslot' enctype='multipart/form-data' ><input type=file multiple name='solnquestions[]' />".$hinputs."<button type=submit >Submit</button></form>";
				}
				else{
					$testpaper=implode(" | " , Fun::filestodownload_link( $stdslots[$i]['solnfiles']  ) );
				}
				$row[]=$testpaper;
			}
			else{
				$row[]="";
				$row[]="";
				$row[]="";
			}
			$row[]=$stdslots[$i]["marks"];
			dispTableTitle($row);
		}
		closet("table");
	}
	public static function pendingtests_student($sid){
		$stdslots=Sql::getArray("select timeslot.*,users.name,(daytime+3600*slot) as apptime from timeslot left join users on users.id=timeslot.tid where sid=? AND testfiles is NOT NULL order by solnfiles asc,(daytime+3600*slot) desc",'i',array(&$sid));
		opent("table",array("class"=>"table-hover table-bordered"));
		dispTableTitle(array("S.No.","Teacher","Timing","Test Papers","Solutions","Marks"));
		for($i=0;$i<count($stdslots);$i++){
			$tprofileurl=BASE."tprofile?tid=".$stdslots[$i]["tid"];
			$row=array($i+1,"<a href='$tprofileurl' >".$stdslots[$i]["name"]."</a>" );
			$row[]=Fun::timetostr($stdslots[$i]["daytime"]+$stdslots[$i]["slot"]*3600);
			if($stdslots[$i]["url"]!=""){
				$tid=$stdslots[$i]["tid"];
				$daytime=$stdslots[$i]["daytime"];
				$slot=$stdslots[$i]["slot"];
				$row[]=implode(" | ",Fun::filestodownload_link($stdslots[$i]["testfiles"]));
				if($stdslots[$i]["solnfiles"]=="" && $stdslots[$i]["testfiles"]!="" ){
					$hinputs=hinp("daytime",$stdslots[$i]["daytime"] ).hinp("slot",$stdslots[$i]["slot"] ).hinp("tid",$stdslots[$i]["tid"] );
					$testpaper="<form method=post action='".BASE."sprofile?tabid=pendingtests' enctype='multipart/form-data' ><input type=file multiple name='solnquestions[]' />".$hinputs."<button type=submit >Submit</button></form>";
				}
				else{
					$testpaper=implode(" | " , Fun::filestodownload_link( $stdslots[$i]['solnfiles']  ) );
				}
				$row[]=$testpaper;
			}
			else{
				$row[]="";
				$row[]="";
				$row[]="";
			}
			$row[]=$stdslots[$i]["marks"];
			dispTableTitle($row);
		}
		closet("table");
	}
	public static function bookedslot_teacher($tid){//For a Teacher
		$stdslots=Sql::getArray("select timeslot.*,users.name,(daytime+3600*slot) as apptime from timeslot left join users on users.id=timeslot.sid where sid!=0  AND tid=? order by  (daytime+3600*slot) desc",'i',array(&$tid));
		opent("table",array("class"=>"table-hover table-bordered"));
		dispTableTitle(array("S.No.","Student","Timing","","Teaching url","Post Test Paper","Solutions","Marks"));
		for($i=0;$i<count($stdslots);$i++){
			$tprofileurl=BASE."sprofile?sid=".$stdslots[$i]["sid"];
			$row=array($i+1,"<a href='$tprofileurl' >".$stdslots[$i]["name"]."</a>" );
			$row[]=Fun::timetostr($stdslots[$i]["daytime"]+$stdslots[$i]["slot"]*3600);
			$row[]=($stdslots[$i]["apptime"]>time())?"Upcoming":"Past";
			$teachingurl=$stdslots[$i]["url"];
			if( $stdslots[$i]["url"]=="" ){
				$tu="<button onclick='button.sendreq(this);' data-sid='".$stdslots[$i]["sid"]."' data-apptime='".$stdslots[$i]["apptime"]."' data-action='put_teachingurl' class='btn btn-default' data-res='onres.hideme_show_set_href(obj,data);' >Create Teaching URL</button><a href='$teachingurl' style='display:none;' >URL</a>";
				$testpaper="";
			}
			else{
				$tu="<a href='$teachingurl' >URL</a>";
				if($stdslots[$i]["testfiles"]==""){
					$hinputs=hinp("daytime",$stdslots[$i]["daytime"] ).hinp("slot",$stdslots[$i]["slot"] );
					$testpaper="<form method=post action='".BASE."tprofile?tabid=bookedslot' enctype='multipart/form-data' ><input type=file multiple name='testquestions[]' />".$hinputs."<button type=submit >Submit</button></form>";
				}
				else{
					$testpaper=array();
					$files=Fun::myexplode(",",$stdslots[$i]["testfiles"]);
					foreach($files as $ind=>$val){
						$testpaper[]=("<a href='".$val."' >File".($ind+1)."</a>");
					}
					$testpaper=implode(" | " , $testpaper );
				}
			}
			$row[]=$tu;
			$row[]=$testpaper;
			$row[]=implode(" | ",Fun::filestodownload_link($stdslots[$i]["solnfiles"]));
			if($stdslots[$i]["solnfiles"]!=""){
				$putmarks="<form onsubmit='form.sendreq1(this,$(this).find(\"button\")[0]);return false;' data-action='update_marks' data-daytime='".$stdslots[$i]["daytime"]."' data-slot='".$stdslots[$i]["slot"]."' data- ><input name=marks type=text class='form-control' value='".$stdslots[$i]["marks"]."' style='width:100px;'  /><button type=sumit  >Submit</button></form>";
				$row[]=$putmarks;
			}

			dispTableTitle($row);
		}
		closet("table");
	}
	public static function studentprofile_self($sid,$tabid){
		$arr_tabs=array("timeline"=>"Profile","bookedslot"=>"Booked Slots","pendingtests"=>"Pending Tests");
?>
		<div style='padding:10px;' >
			<ul  class="nav nav-tabs" role="tablist">
				<?php
					foreach($arr_tabs as $key=>$val){
				?>
				<li class="<?php if($tabid==$key) echo "active"; ?>">
					<a href="#<?php echo $key; ?>" role="tab" data-toggle="tab" style='' ><?php echo $val; ?></a>
				</li>
				<?php
					}
				?>
			</ul>
			<br>
			<div  class="tab-content">
				<?php
					Disp::open_tab("open","timeline",$tabid);
					Disp::student_timeline($sid);
					Disp::open_tab("close","timeline",$tabid);

					Disp::open_tab("open","bookedslot",$tabid);
					Disp::bookedslot($sid);
					Disp::open_tab("close","bookedslot",$tabid);

					Disp::open_tab("open","pendingtests",$tabid);
					Disp::pendingtests_student($sid);
					Disp::open_tab("close","pendingtests",$tabid);

				?>
			</div>
		</div>
<?php
	}
	public static function feedback_form_student($tid,$daytime,$slot){
?>
		<form onsubmit="if(submitForm(this)){form.sendreq1(this,$(this).find('button[type=submit]')[0]);};return false;" data-action="feedbackform_student" data-tid="<?php echo $tid; ?>" data-daytime="<?php echo $daytime; ?>" data-slot="<?php echo $slot; ?>" data-res="var divc=$(obj).children();$(divc[0]).slideDown();$(divc[1]).slideUp();openedfromme.disabled=true;" >
			<div style='display:none;' >
				Thank You.
			</div>
			<div>
<?php
		Disp::takeinp_v2(array('type'=>'select','val'=>array('options'=>array(array('disptext'=>"Rating","val"=>""),1,2,3,4,5)),"name"=>"rate" ));
		form_textarea(array("ph"=>"Feedback here","name"=>"feedback"));
		button(array("type"=>"submit","html"=>"Submit"));
?>
			</div>
		</form>
<?php
	}
}
?>





