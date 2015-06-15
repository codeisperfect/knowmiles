<?php
include "includes/app.php";
User::logout();
Fun::redirect(HOST);
closedb();
?>