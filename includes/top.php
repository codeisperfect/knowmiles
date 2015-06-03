<!DOCTYPE html>
<html>
<head>
<base href="<?php echo HOST; ?>" >
<title><?php echo (isset($title) ? $title:$info['title']); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo HOST; ?>bootstrap-3.1.1-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo HOST; ?>bootstrap-3.1.1-dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo HOST; ?>css/main.css">
<script>
	var redurl="<?php if(isset($_GET["url"]))  echo $_GET["url"]; ?>";
	var cururl=window.location.href;
	var tprofile="<?php echo BASE.'tprofile'; ?>";
</script>
</head>
<body style="overflow-y:scroll;padding:0px;margin:0px;background-color:white;" >
	<script>
		var HOST="<?php echo HOST; ?>";
		var BASE="<?php echo BASE; ?>";
	</script>