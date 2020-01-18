<?php
include("config.php");
include("functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   	extract($post);      

      $sql = "INSERT INTO customers (fullname, email, contact, address, employee_id, password) 
      VALUES( '$fullname', '$email', '$contact', '$address', '$employee_id', '$password')";
		
      if(mysqli_query($con,$sql)) {
         $response["success"] = 1;
         $response["message"] = "customer registered sucessfully";
         echo json_encode($response);  
      }else {
         $response["success"] = 0;
         $response["message"] = "failed to insert record!";
         echo json_encode($response);
      }
   }
?>