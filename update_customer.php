<?php
include("config.php");
include("functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      if(isset($_POST['customer_id'])){
         $customerId = $_POST['customer_id'];

         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         extract($post); 

         $sql = "UPDATE customers 
         SET fullname = '$fullname', email = '$email', contact = '$contact', address = '$address' 
         WHERE id = $customerId";
      
         if(mysqli_query($con,$sql)) {

               $response["success"] = 1;
               $response["message"] = "updated sucessfully";
         }else {
            $response["success"] = 0;
            $response["message"] = "failed to update customer";
         }

         echo json_encode($response);
      }


      
   }
?>