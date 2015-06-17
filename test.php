<?php
include "includes/app.php";


$time=time()-2000;
$time=$time-$time%(15*60);

echo date("d/m/Y",$time)."<br>";
echo date("H:i",$time);


closedb();
?>