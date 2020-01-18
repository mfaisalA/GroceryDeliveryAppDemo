<?php 
	$localhost = "localhost";
	$username = "root";
	$password = "";
	$database = "ajyad_db";
	$con=mysqli_connect($localhost,$username,$password) or die('Database not connected');
	mysqli_select_db($con,$database) or die('Database not selected');


	define("SYSTEM_NAME", "Ajyad Coldstore Delivery System");
	define("COMPANY_NAME", "Ajyad Coldstore");
?>
