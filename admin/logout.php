<?php 
session_start();
$_SESSION['admin_id'] = NULL;
header('location: login.php');
 ?>