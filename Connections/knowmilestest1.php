<?php
$hostname_knowmilestest1 = "poorvi.cse";
$database_knowmilestest1 = "mohit";
$username_knowmilestest1 = "mohitsaini";
$password_knowmilestest1 = "mohit";
echo "111";
$knowmilestest1 = mysqli_connect($hostname_knowmilestest1, $username_knowmilestest1, $password_knowmilestest1) or trigger_error(mysql_error(),E_USER_ERROR); 
?>