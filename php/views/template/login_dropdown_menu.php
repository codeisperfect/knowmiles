<?php
	if( $islogin == 'u' ){
?>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo HOST."profile.php"; ?>">Profile</a></li>
                <li class="divider"></li>
                <li>
                	<a href="<?php echo HOST."logout.php?".http_build_query(array("ref" => Fun::getcururl(null, 2) )); ?>" >Logout</a>
                </li>
              </ul>
<?php
	} else if ($islogin == 'c') {
?>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo HOST."company.php"; ?>">Company</a></li>
                <li><a href="<?php echo HOST."profile.php"; ?>">Profile</a></li>
                <li class="divider"></li>
                <li>
                  <a href="<?php echo HOST."logout.php?".http_build_query(array("ref" => Fun::getcururl(null, 2) )); ?>" >Logout</a>
                </li>
              </ul>
<?php
	}
?>