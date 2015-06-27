<?php
include "includes/app.php";



?>
<html><head>

</head>
<body>

<?php 



$temp=Sql::getArray("show tables");
$need=array("users","review","cartype","city","cardata","car", "company");

// for($i=0;$i<count($temp);$i++){
// 	$table_name=$temp[$i]["Tables_in_".$db_data["db"]];
for($i=0;$i<count($need);$i++){
	$table_name=$need[$i];
	if(in_array($table_name,$need)){
		?>
			<div>
				<a><?php echo $table_name; ?></a><br>
		<?php
//		Disp::disp_table(Sql::getArray("show columns from ".$table_name ));
		Disp::disp_table( Sqle::selectVal( $table_name , "*" , array() , 300) );
		echo "<br><br>";
		?>
			</div>
		<?php
	}
}



closedb();
?>



</body> </html>
