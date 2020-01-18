<?php require_once 'includes/header.php'; ?>
<?php 
	if($_GET['del_id']){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "UPDATE customers 
		SET status = 0 
		WHERE id = $del_id";
		if(mysqli_query($con, $delSql)){
			$valid = true;
			$msg = "Record deleted successfully";
		}

		header('location: ?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Customers</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-user"></span> Customers List</h3>
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
	  		<table class="table table-bordered">
	  			<thead>
	  				<tr>
	  					<th>
	  						Username
	  					</th>
	  					<th>
	  						Full Name
	  					</th>
	  					<th>
	  						Email
	  					</th>
	  					<th>
	  						Contact
	  					</th>
	  					<th>
	  						Address
	  					</th>
	  					<!-- <th>
	  						Credit
	  					</th> -->
	  					<th>
	  						Registration Date
	  					</th>
	  					<th>
	  						Status
	  					</th>
	  					<th>
	  						Action
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT * FROM customers 
  					WHERE status = 1 
					ORDER BY created_date DESC";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?php echo $row['employee_id'] ?></td>
						<td><?php echo $row['fullname'] ?></td>
						<td><?php echo ucwords($row['email']) ?></td>
						<td><?php echo $row['contact'] ?></td>
						<td><?php echo $row['address'] ?></td>
						<!-- <td><?php echo $row['credit'] ?></td> -->
						<td><?php echo date('d/m/Y',strtotime($row['created_date'])) ?></td>
						<td><?php echo ($row['is_active'] == 1)? 'Active': 'In-Active' ?></td>
						<td>
						<ul class="list-inline">
							<li>
								<a href="edit_user.php?edit_id=<?=$row['id'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
							</li>
							<li>
								<a href="?del_id=<?=$row['id'] ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
							</li>
						</ul>
						</td>
						
		  			</tr>	
				<?php } ?>
	  			</tbody>
	  		</table>
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
