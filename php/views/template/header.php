<script>
  var HOST="<?php echo HOST; ?>";
</script>

<?php
if(!$islogin){
?>
<header>
 <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index:9">
  <div class="container hed" style="width:92.5%;" id="section7">
   <div class="navbar-header">
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
     <li>
      <div class="" style="padding:0px;">
       <form method="post">
        <select class="form-control" id="sel1" style="padding:0px;" onchange="$(this).parent().submit();" name="city" >
        <?php
          disp_olist($cityolist,array("selected"=>$_SESSION["city"]));
        ?>
        </select>
        <button type="submit" style="display:none;">
        </button>
       </form>
      </div>
     </li>
     <li style="padding-right: 5px">
      <a class=" boxer" style="color:#fff;" href="#hidden_content">
       Log In
      </a>
      <div id="hidden_content" style="display: none;">
       <div style="color:#069; width:435px; height:335px;margin:0;padding:0px;">
        <div class="col-md-12 login">
         <h4 class="modal-title">
          Log in to your KnowMiles account
         </h4>
        </div>
        <form action="profile.php" method="post" name="formlogin">
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
           &nbsp;Remember me
          </label>
          <a class="pull-right selected-blue" href="" ng-click="close_modal('#sign-in')">
           Forgot password?
          </a>
         </div>
         <div class="col-md-12 login">
          <button class="btn btn-primary btn-lg login-text" type="submit" name="loginform">
           <span class="text">
            Log in
           </span>
           <span class="spinner">
           </span>
          </button>
         </div>
         <div class="col-md-12">
          <div class="text-center">
           <label>
            Donâ&euro;&trade;t have a KnowMiles account?
            <a class="selected-blue" data-toggle="modal" data-target="#sign-up" ng-click="close_modal('#sign-in')">
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
      <a href="#sigup" class="boxer" style="color:#fff;">
       Sign Up
      </a>
      <div id="sigup" style="display: none;">
       <div style="color:#069; width:435px; height: 550px;margin:0;padding:0px;">
        <div class="col-md-12 login">
         <h4 class="modal-title">
          Create your KnowMiles account
         </h4>
         <br />
         KnowMiles respects your privacy and will never give your details to any third party without your permission.
        </div>
        <form action="profile.php" method="post" name="formsignup">
         <div class="login1 col-md-6 col-xs-6">
          <input type="text" name="fName" placeholder="First Name" class="login-text2" max="100" required="required" />
         </div>
         <div class="login1 col-md-6 col-xs-6" style="padding-left:0px !important;">
          <input type="text" name="lName" placeholder="Last Name" class="login-text2" max="100" />
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
         <div class="row-in login">
          <input name="accept_conditions_1" type="checkbox" checked="checked" value="True" />
          <span>
           I accept the
           <a href="/page/terms-and-conditions" class="selected-blue" ng-click="close_modal('#sign-up')">
            KnowMiles terms &amp; conditions
           </a>
          </span>
         </div>
         <div class="col-md-12 login">
          <button class="btn btn-primary btn-lg login-text" type="submit">
           <span class="text">
            Create Account
           </span>
           <span class="spinner">
           </span>
          </button>
         </div>
        </form>
        <div class="text-center login">
         Already got an account?
         <a class="selected-blue" data-toggle="modal" data-target="#sign-in" ng-click="close_modal('#sign-up')">
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
        <select class="form-control" id="sel1" style="padding:0px;" onchange="$(this).parent().submit();" name="city" >
        <?php
          disp_olist($cityolist,array("selected"=>$_SESSION["city"]));
        ?>
        </select>
        <button type="submit" style="display:none;">
        </button>
       </form>
</div>
</li>
<li style="padding-right: 5px">
  <a href="navbar-static-top.html#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $myf["name"]; ?><span class="caret"></span></a>
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