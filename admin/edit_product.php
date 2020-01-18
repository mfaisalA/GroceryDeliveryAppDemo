<?php require_once 'includes/header.php'; ?>
<?php 
	$edit = null;
	$edit_id = null;
    $menu_id = 0;
	if(isset($_GET['edit_id'])){
		$edit_id = $_GET['edit_id'];
		$selSql = "SELECT * FROM products 
		WHERE id = $edit_id";
		$rs = mysqli_query($con, $selSql);
		$edit = mysqli_fetch_assoc($rs);
	}else{
		header('location: errorPage.php');
	}

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		
        //check if image is changed
    $isQueryValid = false;
    $query ="";
    if(isset($_FILES['uploadImage']) && !empty($_FILES['uploadImage']['name'])){
        //uploading image to server
        $uniqueId = getMaxProductId($con);
        $directory = '../uploads/itemImage/';
        $response = uploadImage($_FILES['uploadImage'], $uniqueId, $directory);
        if($response['success'] == true){
            $imagePath = $response['path'];
            $query = "UPDATE products 
            SET subcategory_id = $subcategory_id, category_id = $category_id, product_name = '$name', product_code = '$code', product_price = '$price', qty = '$qty', product_desc = '$descNicEdit', image_1 = '$imagePath', product_status = $status
            WHERE id = $edit_id ";
            $isQueryValid = true;
        }
    }else{//if not updating 
            $query = "UPDATE products 
            SET subcategory_id = $subcategory_id, category_id = $category_id, product_name = '$name', product_code = '$code', product_price = '$price', qty = '$qty', product_desc = '$descNicEdit', product_status = $status
            WHERE id = $edit_id ";
            $isQueryValid = true;
    }

    if($isQueryValid == true){
        if(mysqli_query($con, $query)){
            $valid = 1;
            $msg = "Item edit successfully";
        }
    }else{
        $msg = $response['msg'];
    }

        header('location: products.php?success='.$valid.'&msg='.$msg);
        
	}
 ?>


  <!-- CODE FOR NICE TEXT EDITOR STARTS -->
  <script src="js/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
  
  new nicEditor({maxHeight : 200 ,fullpanel : true}).panelInstance('descNicEdit');
  //new nicEditor({minHeight : 400}).panelInstance('composeMsg');
});
</script>
<!-- CODE FOR NICE TEXT EDITOR ENDS -->		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="products.php"><span class="glyphicon glyphicon-tags"></span> </a></li>
				<li class="active">Manage Products</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-edit"></span> Edit Product</h3>
	  		<div id="errorDiv" class="col-sm-8 col-sm-offset-2">
  	<?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 1){
                        echo '
                            <div class="alert alert-success text-center">'.$_GET['msg'].'
            </div>';
                    }else{
                        echo '
            <div class="alert alert-danger text-center">'.$_GET['msg'].'
            </div>';
                    } 
                }
    ?>
      </div>
      <div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<br>
	  		<div class="col-sm-8"  style="padding: 10px; border-right: 1px solid #ccc;border-bottom: 1px solid #ccc">
	  			<form action="" method="post" enctype="multipart/form-data">
	  				<div class="form-group row">
                        <div class="col-sm-4"><label>ID</label>
                       </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="id" name="id" value="<?=$edit['id'] ?>" disabled>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="category_id">Category</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="category_id" id="category_dropdown" required>
                                <option value="">--select--</option>
                                <?php 
                                $sql = "SELECT * FROM product_categories 
                                WHERE status = 1 AND is_active = 1";
                                $rs = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_assoc($rs)){
                                    if($row['id'] == $edit['category_id']){
                                        echo '<option selected value="'.$row['id'].'">'.ucfirst($row['category_name']).'</option>';
                                    }else{
                                        echo '<option value="'.$row['id'].'">'.ucfirst($row['category_name']).'</option>';
                                    }
                                    
                                }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                     <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="category_id">Sub-Category</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="subcategory_id" id="subcategory_dropdown" required>
                                <option value="">--select--</option>
                            </select>
                            <!-- hidden field for selecting the subcategory field -->
                            <input type="hidden" id="subcat_old" value="<?php echo $edit['subcategory_id'] ?>">
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="name">Product Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="name" name="name" value="<?=$edit['product_name'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="code">Product Code</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="code" name="code" value="<?=$edit['product_code'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="price">Price</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="price" name="price" value="<?=$edit['product_price'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="qty">Qty</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" id="qty" name="qty" value="<?=$edit['qty'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->


                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="code">Description</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea name="descNicEdit" id="descNicEdit" style="width: 100%;height: 300px;" ><?=$edit['product_desc'] ?></textarea>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="brand_logo">Display Picture</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                            <div class="col-sm-10">
                            <label class="form-control" for="upload">
                              <span class="fa fa-upload"></span> choose file... 
                              <input name="uploadImage" type="file" id="upload" style="display:none">
                            </label>
                            </div>
                            <div class="col-sm-2">
                                <img  class="small_img" src="../uploads/itemImage/<?=$edit['image_1'] ?>" alt="">
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
	  				

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="status">Status</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" id="" required>
                            	<option value="">--select status--</option>
                            	<option value="1" <?=$edit['product_status'] ? 'selected' : '' ?>>Active</option>
                            	<option value="0" <?=$edit['product_status'] ? '' : 'selected' ?>>In-Active</option>
                            </select>
                        </div>
                    </div>
                   

                    <div class="pull-right">
                    <button class="btn btn-primary">Submit</button>
                	</div>
	  			</form>
	  			<br>
	  		</div>
	  	</div>
	  </div>	
								
	</div>	<!--/.main-->

    <input type="hidden" id="nav" value="<?php echo $menu_id ?>">    

    <?php require_once 'includes/import_scripts.php'; ?>
    <script>
        $(document).ready(function(){
            $('#navProducts').addClass('active');
            var catId = $('#category_dropdown').val();
            $.get('../get_all_sub_categories.php?cat_id='+catId, function(data){
                var result = $.parseJSON(data);
                var $dropdown = $("#subcategory_dropdown");
                $.each(result.data_list, function() {
                    $dropdown.append($("<option />").val(this.id).text(this.name));
                });

                var subCatOldVal = $('#subcat_old').val();
                $dropdown.val(subCatOldVal);

            });
        });
        $('#category_dropdown').on('change', function(){
            var catId = $('#category_dropdown').val();
            $.get('../get_all_sub_categories.php?cat_id='+catId, function(data){
                var result = $.parseJSON(data);
                var $dropdown = $("#subcategory_dropdown");
                $dropdown.empty();
                $.each(result.data_list, function() {
                    $dropdown.append($("<option />").val(this.id).text(this.name));
                });
            });
        });
    </script> 
</body>

</html>
