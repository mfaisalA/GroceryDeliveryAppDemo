<?php require_once 'includes/header.php'; ?>
<?php 
	$edit = null;
	$edit_id = null;
	if($_GET['edit_id']){
		$edit_id = $_GET['edit_id'];
		$selSql = "SELECT * FROM customers 
		WHERE id = $edit_id";
		$rs = mysqli_query($con, $selSql);
		$edit = mysqli_fetch_assoc($rs);
	}else{
		header('location: users.php?success=false&msg=Requested record not found !');
	}

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$sql = "UPDATE customers 
		SET password = '$password', email = '$email',  fullname = '$name', 
		 contact = '$contact',  address = '$address', is_active = '$status', credit = '$credit'
		WHERE id = $edit_id ";
		if(mysqli_query($con, $sql)){
			$valid = true;
			$msg = "Record edit successfully";
		}

		header('location: users.php?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="users.php"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Employees</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-user"></span> Edit Employee</h3>
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
                        <div class="col-sm-4"><label>Username</label>
                       </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="emp_id" name="emp_id" value="<?=$edit['employee_id'] ?>" disabled>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="name">Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="password" id="password" name="password" value="<?=$edit['password'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="name">Full Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="name" name="name" value="<?=$edit['fullname'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" id="email" name="email" value="<?=$edit['email'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="contact">Contact</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="tel" id="contact" name="contact" value="<?=$edit['contact'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address" name="address" required><?=$edit['address'] ?></textarea>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->


                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="contact">Credit</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.01" id="credit" name="credit" value="<?=$edit['credit'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="address">Status</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" required="">
                                <option  value=""> -- Select Status -- </option>
                                <option value="1" <?php echo ($edit['is_active'] == 1)? 'selected': '' ?> >Active</option>
                                <option value="0" <?php echo ($edit['is_active'] == 0)? 'selected': '' ?> >In-Active</option>
                            </select>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

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
			$('#navUsers').addClass('active');
		});
	</script>
</body>

</html>
