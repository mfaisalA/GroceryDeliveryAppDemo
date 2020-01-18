<?php
include("config.php");
include("functions.php");
   session_start();

   $response = array();


   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      
      if(!isset($_GET['cat_id'])){
         $response["success"] = 0;
         $response["message"] = "invalid request!";
      }else{
         $catId = $_GET['cat_id'];
      
         $sql = "SELECT * FROM product_subcategories WHERE
          status = 1 AND is_active = 1 AND category_id = $catId
          ORDER BY name DESC";
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
      }
      
      echo json_encode($response);
   }
?>