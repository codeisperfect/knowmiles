<?php
class Disps extends Sql{
	public static function bottom_js(){
?>

<?php
popupalert(null);
popupconfirm(null);
?>
<script src="bootstrap-3.1.1-dist/js/jquery1.js" ></script>
<script src="bootstrap-3.1.1-dist/js/bootstrap.js" ></script>
<script src="bootstrap-3.1.1-dist/js/lib.js" ></script>
<script src="bootstrap-3.1.1-dist/js/mohit.js" ></script>
<script src="js/errorcodes.js" ></script>
<script src="js/mohitlib.js" ></script>
<script src="js/main.js" ></script>
<?php
	}
	public static function page_top($inp=array()){
		$inp=Fun::mergeifunset($inp,array("title"=>"getIITians"));
		$inp=Fun::setifunset($inp,"js",array("js/jquery-1.8.3.min.js","wp-content/themes/woodshed/assets/js/jquery.js"));
		$inp=Fun::setifunset($inp,"css",array("wp-content/themes/woodshed/assets/css/app.min.css","css/third.css","css/bootstrap-datetimepicker.min.css","css/font-awesome.min.css","wp-content/themes/woodshed/assets/css/fonts.min.css", "lightbox/jquery.fs.boxer.css"  ));

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8">
<title>KnowMiles</title>
<meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1, user-scalable=no" />				
  <?php
   opent("base",array("href"=>HOST));
   foreach($inp["css"] as $i=>$val){
   	opent("link",array("rel"=>"stylesheet","type"=>"text/css","href"=>$val));
    echo "\n";
   }
   foreach ($inp["js"] as $i => $val) {
   	opent("script",array("type"=>"text/javascript","src"=>$val));
   	closet("script");
    echo "\n";
   }
  ?>
 </head>
<?php
	}
	public static function page_header($myf=null,$inp=array()){
?>
<script>
var HOST="<?php echo HOST; ?>";
</script>
<header>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index:9">
      <div class="container hed" style="width:95%;" id="section7">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <h1 id="logo" class="log">
  	  	<a href="index.php">
  	  		<img src="images/logo-light.png"	alt="Wood Shed"	/>
						</a>
				</h1>
        </div>


        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right pull-right right-nav">

<li>
<div class="" style='padding:0px;' >
  <form method="post" >
    <?php
      Disps::disp_city_list();
    ?>
    <button type="submit" style="display:none;" ></button>
  </form>
</div>
</li>


<li style="padding-right: 5px">

              <a href="navbar-static-top.html#" class="dropdown-toggle" data-toggle="dropdown"><?php echo val($myf,"name",array("ret"=>"Profile")); ?><span class="caret"></span></a>
              <?php
              Disps::profiletablist();
              ?>
</li> 
</ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>
<?php		
	}
	public static function profiletablist(){
		if(User::islogin()){
?>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo HOST."profile.php"; ?>">Profile</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">
                	<a href="<?php echo HOST."logout.php"; ?>" >Logout</a>
                </li>
              </ul>
<?php		
		}
	}
  public static function disp_city_list(){
    $allcity=Sql::getArray("select Name,Name from city order by Name asc");
  ?>
      <select name="city" class="text-from select common-dropdown-project-select" style="padding:3px;" onchange="$(this).parent().submit();" >
      <?php
        optionslist($allcity,"Name","Name",array("selected"=>$_SESSION["city"]));
      closet("select");
  }
}
?>