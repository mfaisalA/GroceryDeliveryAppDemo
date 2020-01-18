<?php require_once 'includes/header.php'; ?>
<?php 
	$edit = null;
	$edit_id = null;
	if($_GET['edit_id']){
		$edit_id = $_GET['edit_id'];
		$selSql = "SELECT * FROM product_categories 
		WHERE id = $edit_id";
		$rs = mysqli_query($con, $selSql);
		$edit = mysqli_fetch_assoc($rs);
	}else{
		header('location: categories.php?success=false&msg=Requested record not found !');
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
        $directory = '../uploads/categoryImage/';
        $response = uploadImage($_FILES['uploadImage'], 'CAT-', $directory);
        if($response['success'] == true){
            $imagePath = $response['path'];
            $query = "UPDATE product_categories 
        SET category_name = '$cat_title', category_code = '$cat_code', image= '$imagePath', is_active = '$is_active'
        WHERE id = $edit_id ";
            $isQueryValid = true;
        }
    }else{//if not updating 
            $query = "UPDATE product_categories 
        SET category_name = '$cat_title', category_code = '$cat_code', is_active = '$is_active'
        WHERE id = $edit_id ";
            $isQueryValid = true;
    }

    if($isQueryValid == true){
        if(mysqli_query($con, $query)){
            $valid = 1;
            $msg = "Category edit successfully";
        }
    }else{
        $msg = $response['msg'];
    }

        header('location: categories.php?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="categories.php"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Pet Categories</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-th"></span> Edit Category</h3>
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
                        <div class="col-sm-4"><label>Category ID</label>
                       </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="cat_id" name="cat_id" value="<?=$edit['id'] ?>" disabled>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="cat_title">Category Title</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="cat_title" name="cat_title" value="<?=$edit['category_name'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="cat_code">Category Code</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="cat_code" name="cat_code" value="<?=$edit['category_code'] ?>" required>
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
                                <img  class="small_img" src="../uploads/categoryImage/<?=$edit['image'] ?>" alt="">
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS --> 

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="is_active">Category Status</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="is_active" id="" required>
                            	<option value="">--select status--</option>
                            	<option value="1" <?=$edit['is_active'] ? 'selected' : '' ?>>Active</option>
                            	<option value="0" <?=$edit['is_active'] ? '' : 'selected' ?>>In-Active</option>
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

	<?php require_once 'includes/import_scripts.php'; ?>
	<script>
		$(document).ready(function(){
			$('#navCategories').addClass('active');
		});
	</script>
</body>

</html>
