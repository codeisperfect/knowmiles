<?php
include "includes/app.php";
User::logout();
Fun::redirect(get("ref", HOST));
closedb();
?>