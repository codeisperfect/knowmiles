<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Signup Helper</title>
	</head>

	<body>
		<?php
			//print_r($_POST);
			if(isset($_POST['fName']) || isset($_POST['lName']) && isset($_POST['emailId']) && 
			isset($_POST['telephone']) && isset($_POST['passOne']) && isset($_POST['passTwo']))
			{
				echo "All Set";	
			}
			else
			{
				echo "NOT SET";
			}
			/*
			$name = ;
			$email = ;
			$tele = ;
			$pass1 = ;
			$pass2 = ;
			*/
		?>
	</body>
    
</html>