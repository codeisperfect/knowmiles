<?php

$config = array("addccode"=>false);

include "includes/app.php";


if(server!='server'){
//	sleep(1);
}


handle_disp($_POST);



closedb();
?>