<script>
  var HOST="<?php echo HOST; ?>";
</script>

<?php
if(!$islogin){
?>
<header>
 <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index:9">
  <div class="container hed" style="width:92.5%;" id="section7">
   <div class="navbar-header" style="padding-top:7px;">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
     <span class="sr-only">
      Toggle navigation
     </span>
     <span class="icon-bar">
     </span>
     <span class="icon-bar">
     </span>
     <span class="icon-bar">
     </span>
    </button>
    <h1 id="logo">
     <a href="index.php">
      <img src="images/logo-light.png" alt="Wood Shed" />
     </a>
    </h1>
   </div>
   <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right pull-right right-nav">
     <li style="padding-right: 5px" id="loginbox" >
      <a class=" boxer" style="color:#fff;" href="#hidden_content" id="loginbutton" >
       Log In
      </a>
      <div id="hidden_content" style="display: none;">
       <div style="color:#069; width:450px; height:370px; margin:0; padding:20px;">
        <div class="col-md-12 login">
         <div style='color:red;' ><?php echo errormsg($login["loginec"]); ?></div>
         <h3 class="modal-title">
          Log in to your KnowMiles account
         </h3>
        </div>
        <form action="" method="post" name="formlogin">
         <div class="col-md-12 login">
          <input type="text" name="email" placeholder="Email Id" class="login-text" max="100" />
         </div>
         <div class="col-md-12 login">
          <input type="password" name="password" placeholder="Password" class="login-text" max="100" />
         </div>
         <div class="col-md-12 login">
          <label>
           <input type="checkbox" name="remember" value="1" id="remember" style="margin-top :10px;" />
          </label>
          <label for="remember">
           Remember me
          </label>
          <a class="pull-right selected-blue" href="" ng-click="close_modal('#sign-in')" style="margin-top :10px;" >
           Forgot password?
          </a>
         </div>
         <div class="col-md-12 login">
          <button class="btn btn-info btn-lg login-text" type="submit" name="loginform">
           <span class="text">
            Log in
           </span>
           <span class="spinner">
           </span>
          </button>
         </div>
         <div class="col-md-12">
          <div class="text-center" style="margin-top :10px;" >
           <label>
            Don't have a KnowMiles account?
            <a class="selected-blue" data-toggle="modal" data-target="#sign-up" onclick="lspopup('signup');" >
             Sign up
            </a>
           </label>
          </div>
         </div>
        </form>
       </div>
      </div>
     </li>
     <li>
      <a href="#sigup" class="boxer" style="color:#fff;" id="signupbutton" >
       Sign Up
      </a>
      <div id="sigup" style="display: none;">
       <div style="color:#069; width:450px; height:710px; margin:0; padding:20px;">
        <div class="col-md-12 login">
         <h3 class="modal-title">
          Create your KnowMiles account
         </h3>
         <br />
         KnowMiles respects your privacy and will never give your details to any third party without your permission.
        </div>
        <form action="" method="post" name="formsignup">
        <div class="row">
          <div class="col-sm-12">
            <div class="login1 col-md-6 col-xs-6">
              <input type="text" name="fName" placeholder="First Name" class="login-text2" max="100" required="required" />
             </div>
             <div class="login1 col-md-6 col-xs-6">
              <input type="text" name="lName" placeholder="Last Name" class="login-text2" max="100" />
             </div>
          </div>
        </div>
         
         <div class="col-md-12 login">
          <input type="email" name="emailId" placeholder="Email Id" class="login-text" max="100" required="required" />
         </div>
         <div class="col-md-12 login">
          <input type="tel" name="telephone" placeholder="Mobile No." class="login-text" max="100" required="required" />
         </div>
         <div class="col-md-12 login">
          <input type="password" name="passOne" placeholder="Password" class="login-text" max="100" required="required" />
         </div>
         <div class="col-md-12 login">
          <input type="password" name="passTwo" placeholder="Confirm Password" class="login-text" max="100" required="required" />
         </div>
         <div class="col-md-12 login">
          <select name="type" class="login-text" >
            <?php disp_olist( arr2option(array("User", "Cab Company"), 'firstchar') , array("addtext" => "Accont type") ); ?>
          </select>
         </div>
         <div class="col-md-12 row-in login">
          <input name="accept_conditions_1" type="checkbox" checked="checked" value="True" />
          <span>
           I accept the
           <a href="/page/terms-and-conditions" class="selected-blue" ng-click="close_modal('#sign-up')">
            KnowMiles terms &amp; conditions
           </a>
          </span>
         </div>
         <div class="col-md-12 login">
          <button class="btn btn-info btn-lg login-text" type="submit">
           <span class="text">
            Create Account
           </span>
           <span class="spinner">
           </span>
          </button>
         </div>
        </form>
        <div class="col-md-12 text-center login">
         Already got an account?
         <a class="selected-blue" data-toggle="modal" data-target="#sign-in" onclick='lspopup("login");'  >
          Sign in
         </a>
        </div>
       </div>
      </div>
     </li>
     <li style="padding-right: 5px">
      <a href="">
       Blog
      </a>
     </li>
     <li style="padding-right: 5px">
      <a href="#">
       Help
      </a>
     </li>
      <li>
      <div class="" style="padding:0px;">
       <form method="post">
        <select class="form-control input-sm" id="sel1" style="padding-top:5px;" onchange="button.sendreq_v3(this);" data-eparams="{'city':obj.value}" data-action="changecity" data-waittext='' >
        <?php
          disp_olist($cityolist,array("selected"=>$_SESSION["city"]));
        ?>
        </select>
       </form>
      </div>
     </li>
    </ul>
   </div>
  </div>
 </nav>
</header>
<?php
}
else{
?>
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
          <img src="images/logo-light.png"  alt="Wood Shed" />
            </a>
        </h1>
        </div>


        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right pull-right right-nav">

<li>
<div class="" style='padding:0px;' >
       <form method="post">
        <select class="form-control input-sm" id="sel1" style="padding-top:5px;" onchange="button.sendreq_v3(this);" data-eparams="{'city':obj.value}" data-action="changecity" data-waittext='' >
        <?php
          disp_olist($cityolist,array("selected"=>$_SESSION["city"]));
        ?>
        </select>
       </form>
</div>
</li>
<li style="padding-left: 10px;">
  <a href="navbar-static-top.html#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $myf["fname"]; echo " "; ?><span class="caret"></span></a>
  <?php
    load_view("template/login_dropdown_menu.php");
  ?>
</li> 
</ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>
<?php  
}
?>