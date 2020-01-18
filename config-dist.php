<?php 
	$localhost = "localhost";
	$username = "adminmysql";
	$password = "admin@123";
	$database = "creativee_m_insurance";
	$con=mysqli_connect($localhost,$username,$password) or die('Database not connected');
	mysqli_select_db($con,$database) or die('Database not selected');



	define("APP_NAME", "Mobile Insurance Mangement System");
	define("COMPANY_NAME", "New Indian Assurance Co. Ltd");

?>
