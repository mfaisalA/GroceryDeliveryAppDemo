<?php 
function convert24Time($time24){
    // converting time from 24 hours to 12
	$pTime = DateTime::createFromFormat('H', $time24 );
	return $pTime->format('h A');
}

function uploadFile($file, $uniqueName, $directory){
	 $response = array();

      $file_name = $file['name'];
      $file_size =$file['size'];
      $file_tmp_path =$file['tmp_name'];
      $file_type=$file['type'];
      $file_ext=strtolower(end(explode('.',$file['name'])));
    
      $extensions= array("doc", "docx", "pdf", "ppt", "pptx");
    
      if(in_array($file_ext,$extensions)=== false){
        $errors[]="Invalid file type, please choose a DOC/PDF/PPT";
      }
    
       
      $MB = 1048576;  // 1048576 = 1MB
      // max size 2 MB
      if($file_size > 2*$MB || $file_size == 0){
        $errors[]='File size must be less than 2 MB';
      }

      if(empty($errors)){
	    $new_name = $uniqueName.rand(100,10000).'.'.$file_ext;
	    $path = $directory.$new_name;

	    if(move_uploaded_file($file_tmp_path, $path)){
	    	$response['success'] = true;
	    	$response['file_path'] = $new_name;
	    }else{
	    	$response['success'] = false;
	    	$response['msg'] = "Error uploading file!";
	    }

	    
	  }else{
	  	    $response['success'] = false;
	    	$response['msg'] = implode(' | ',$errors);
	  }

	  return $response;

}


function uploadImage($file, $uniqueName, $directory){
	 $response = array();

      $file_name = $file['name'];
      $file_size =$file['size'];
      $file_tmp_path =$file['tmp_name'];
      $file_type=$file['type'];
      $file_ext=strtolower(end(explode('.',$file['name'])));
    
      $extensions= array("png", "jpg", "jpeg");
    
      if(in_array($file_ext,$extensions)=== false){
        $errors[]="Invalid file type, please choose a PNG/JPG/JPEG.";
      }
    
       
      $MB = 1048576;  // 1048576 = 1MB
      // max size 2 MB
      if($file_size > 2*$MB || $file_size == 0){
        $errors[]='Image size must be less than 2 MB';
      }

      if(empty($errors)){
	    $new_name = $uniqueName.rand(100,10000).'.'.$file_ext;
	    $path = $directory.$new_name;

	    if(move_uploaded_file($file_tmp_path, $path)){
	    	$response['success'] = true;
	    	$response['path'] = $new_name;
	    }else{
	    	$response['success'] = false;
	    	$response['msg'] = "Error uploading file!";
	    }

	    
	  }else{
	  	    $response['success'] = false;
	    	$response['msg'] = implode(' | ',$errors);
	  }

	  return $response;

}

function getMaxId($con, $tableName){
	$sql = "SELECT MAX(id) FROM $tableName";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}


function getCustomerNameFromId($con, $customerId){
  $sql = "SELECT fullname FROM customers 
  WHERE id = $customerId";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];
}

function getEmployeeIDFromId($con, $customerId){
  $sql = "SELECT employee_id FROM customers 
  WHERE id = $customerId";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];
}

function getMaxOrderId($con){
  $sql = "SELECT MAX(order_id) FROM orders
              WHERE order_status = 1";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}

function getMaxProductId($con){
  $sql = "SELECT MAX(id) FROM products";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}

function getCategoryNameFromId($con, $cat_id){
  $sql = "SELECT category_name FROM product_categories 
  WHERE id = $cat_id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}
function getSubCategoryNameFromId($con, $subcat_id){
  $sql = "SELECT name FROM product_subcategories 
  WHERE id = $subcat_id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}


function getProductNameFromId($con, $product_id){
  $sql = "SELECT product_name FROM products 
  WHERE id = $product_id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];
}

function incrementCustomerCredit($con, $cusId,  $newAmount){
  $rs = mysqli_query($con, "SELECT credit FROM customers WHERE id = $cusId");
  $prevAmount = (double) mysqli_fetch_row($rs)[0];
  $updAmount = $prevAmount + $newAmount;

  mysqli_query($con, "UPDATE customers SET credit = '$updAmount' 
    WHERE id = $cusId");
}


function getOrderItemQty($con, $order_id){
  //Get username from user ID
    $sql = "SELECT SUM(quantity) FROM order_item WHERE order_id = $order_id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_row($result)[0];
}

function create_summary($cont,$num){
      $text = strip_tags($cont);

      if(strlen($text) > $num){
            $endpos = strpos($text,' ',$num);
      $dots = '...';
      if(!$endpos){
              $endpos = strlen($text);
              $dots = '';
          }
      }else{
          $endpos = strlen($text);
                      $dots ='';
      }                   
      return substr($text,0,$endpos).$dots;
  }



function updateQtyAfterOrderCompleted($con, $order_id){
  //Get username from user ID
    $sql = "SELECT product_id, quantity FROM order_item WHERE order_id = $order_id";
    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_assoc($result)){
      mysqli_query($con, "UPDATE products SET qty = qty - {$row['quantity']} WHERE id = {$row['product_id']}");
    }
}
?>	