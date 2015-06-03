<?php
function get($inp){
	if(isset($_GET[$inp]))
		return $_GET[$inp];
	else
		return false;
}

function post($inp){
	if(isset($_POST[$inp]))
		return $_POST[$inp];
	else
		return false;
}



?>