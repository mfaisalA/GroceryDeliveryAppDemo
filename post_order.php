<?php
include("config.php");
include("functions.php");
   session_start();
   


   $response = array();

   if($_SERVER["REQUEST_METHOD"] == "POST") {

         $json = file_get_contents('php://input');
         $obj = json_decode($json);
         $customerId = $obj->{'customer_id'}; 
         $grandTotal = $obj->{'grand_total'};
         $totalQty = $obj->{'total_qty'};
         $paymentType = $obj->{'payment_type'};
         $orderType = $obj->{'order_type'};
         $customerName = $obj->{'customer_name'};
         $customerEmail = $obj->{'customer_email'};
         $contact = $obj->{'contact'};
         $shipAddress = $obj->{'shipping_address'}; 
         $orderItemList = $obj->{'order_item_list'};

         if($paymentType == 2){
            incrementCustomerCredit($con, $customerId,  $grandTotal);
         }

         $sql = "INSERT INTO orders (order_date, customer_id,  grand_total, total_qty, payment_type, order_type, process_status, customer_name, customer_email, customer_contact, customer_ship_address, order_status) VALUES (now(), $customerId, '$grandTotal', $totalQty, $paymentType, $orderType, 1, '$customerName', '$customerEmail', '$contact', '$shipAddress',  1)";

            $order_id;
            $orderPosted = false;
            if(mysqli_query($con, $sql) === true) {
               $order_id = $con->insert_id;
               $response['order_id'] = $order_id;  

               $orderPosted = true;
            }

            if($orderPosted == true){
               foreach ($orderItemList as $key => $item) { 
                  $total = $item->qty*$item->price;
               // add into order_item
               $orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
               VALUES ($order_id, $item->id, '$item->qty', '$item->price', '$total', 1)";

               $con->query($orderItemSql);      
      
               } // /foreach

         $response["success"] = 1;
         $response["message"] = "Your order has been taken successfully";
         echo json_encode($response); 
      }// if
      else{
         $response["success"] = 0;
         $response["message"] = "Some error occurred while taking your order";
         echo json_encode($response);
      }

   }
?>