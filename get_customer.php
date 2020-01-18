<?php
include("config.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      
      if(!isset($_GET['customer_id'])){
         $response["success"] = 0;
         $response["message"] = "invalid request   !";
      }else{
         $customerId = $_GET['customer_id'];
      
         $sql = "SELECT * FROM customers WHERE id = $customerId";
         $result = mysqli_query($con,$sql);
         $row = mysqli_fetch_assoc($result);
        
         $count = mysqli_num_rows($result);
         
         if($count == 1) {
            $response['customer_info'] = $row;

            // $imagedata = file_get_contents($row['image']);
            //  // alternatively specify an URL, if PHP settings allow
            // $response['base64_image'] = base64_encode($imagedata);
            
            $response["success"] = 1;
            $response["message"] = "request successful";
         }else {
            $response["success"] = 0;
            $response["message"] = "unable to retrieve info!";
         }
      }
      
      echo json_encode($response);
   }
?>