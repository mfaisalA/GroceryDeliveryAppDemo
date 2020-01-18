<?php
include("config.php");
include("functions.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      
      if(!isset($_GET['user_id'])){
         $response["success"] = 0;
         $response["message"] = "invalid request!";
      }else{
         $userId = $_GET['user_id'];
      
         $sql = "SELECT * FROM customers WHERE
          added_by = $userId AND status = 1
          ORDER BY created_date DESC";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);
         
         if($count >= 1) {
            $customerList = array();
            while ($row = mysqli_fetch_assoc($result)) {
               array_push($customerList, $row);
            }
            $response['customer_list'] = $customerList;
            
            $response["success"] = 1;
            $response["message"] = "request successful";
         }else {
            $response["success"] = 0;
            $response["message"] = "no record found!";
         }
      }
      
      echo json_encode($response);
   }
?>