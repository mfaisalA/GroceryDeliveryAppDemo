<?php
include("config.php");
include("functions.php");
   session_start();

   $response = array();
   

   if($_SERVER["REQUEST_METHOD"] == "GET") {
      
      if(isset($_GET['customer_id'])){
         $customerId = $_GET['customer_id'];

         $sql = "UPDATE customers 
         SET status = 0 
         WHERE id = $customerId";
      
         if(mysqli_query($con,$sql)) {

               $response["success"] = 1;
               $response["message"] = "deleted sucessfully";
         }else {
            $response["success"] = 0;
            $response["message"] = "failed delelete customer";
         }

         echo json_encode($response);
      }


      
   }
?>