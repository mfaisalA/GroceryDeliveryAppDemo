<?php
include("config.php");
include("functions.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      
      
         $sql = "SELECT * FROM product_categories WHERE
          status = 1 AND is_active = 1 
          ORDER BY category_name";
         $result = mysqli_query($con,$sql);
        
         $count = mysqli_num_rows($result);
         
         if($count >= 1) {
            $dataList = array();
            while ($row = mysqli_fetch_assoc($result)) {
               array_push($dataList, $row);
            }
            $response['data_list'] = $dataList;
            
            $response["success"] = 1;
            $response["message"] = "request successful";
         }else {
            $response["success"] = 0;
            $response["message"] = "no record found!";
         }
      
      echo json_encode($response);
   }
?>