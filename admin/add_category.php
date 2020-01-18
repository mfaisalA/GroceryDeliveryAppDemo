<?php require_once 'includes/header.php'; ?>
<?php 

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
            $query = "INSERT INTO product_categories (category_name, category_code, image, is_active, status, created_date) 
                VALUES('$cat_title', '$cat_code', '$imagePath', $is_active, 1, NOW())";
            $isQueryValid = true;
        }
    }

    if($isQueryValid == true){
        if(mysqli_query($con, $query)){
            $valid = 1;
            $msg = "Category added successfully";
        }
    }
    
    header('location: categories.php?success='.$valid.'&msg='.$msg);

    }
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="categories.php"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Categories</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-th"></span> Add Category</h3>
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
                        <div class="col-sm-4">
                            <label for="cat_title">Category Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="cat_title" name="cat_title"  required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="cat_code">Category Code</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="cat_code" name="cat_code" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="brand_logo">Display Picture</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                            <div class="col-sm-8">
                            <label class="form-control" for="upload">
                              <span class="fa fa-upload"></span> choose file... 
                              <input name="uploadImage" type="file" id="upload" style="display:none" required>
                            </label>
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
                            	<option value="1" >Active</option>
                            	<option value="0" >In-Active</option>
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
