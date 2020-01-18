<?php require_once 'includes/header.php'; ?>
<?php 

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$sql = "INSERT INTO product_subcategories (name, category_id, is_active) 
		VALUES('$subcat_name', '$cat_id', $is_active)";
		if(mysqli_query($con, $sql)){
			$valid = true;
			$msg = "Record added successfully";
		}

		header('location: sub_categories.php?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="sub_categories.php"><span class="glyphicon glyphicon-home"></span> </a></li>
				<li class="active">Manage Sub-Categories</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-th"></span> Add Sub-Category</h3>
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
	  			<form action="" method="post">
	  				
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="cat_title">Sub-Category Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="subcat_name" name="subcat_name"  required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label >Category</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="cat_id" class="form-control" required="">
                                <option value="">Select Category</option>
                                <?php 
                                    $rs = mysqli_query($con, "SELECT id, category_name FROM product_categories 
                                        WHERE status =1 AND is_active = 1");
                                    while($row = mysqli_fetch_assoc($rs)){
                                        echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
                                    }
                                 ?>
                            </select>
                        </div>
                    </div>
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
			$('#navSubCategories').addClass('active');
		});
	</script>
</body>

</html>
