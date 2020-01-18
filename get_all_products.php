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
         $categoryId = $_GET['cat_id'];

            if(isset($_GET['subcat_id'])){
               $subcategoryId = $_GET['subcat_id'];
               $sql = "SELECT * FROM products WHERE
               product_status = 1 AND status = 1 AND category_id = $categoryId AND subcategory_id = $subcategoryId
               ORDER BY created_date DESC";
            }else{
               $sql = "SELECT * FROM products WHERE
               product_status = 1 AND status = 1 AND category_id = $categoryId
               ORDER BY created_date DESC";
            }

            $result = mysqli_query($con,$sql);
           
            $count = mysqli_num_rows($result);
            
            if($count >= 1) {
               $productsList = array();
               while ($row = mysqli_fetch_assoc($result)) {
                  array_push($productsList, $row);
               }
               $response['product_list'] = $productsList;
               
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