<?php require_once 'includes/header.php'; ?>
<?php 
	if($_GET['del_id']){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "UPDATE orders 
		SET order_status = 0 
		WHERE order_id = $del_id";
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
				<li class="active">Manage Orders</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-shopping-cart"></span> Orders List</h3>
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
	  						Order ID
	  					</th>
	  					<th>
	  						Customer Type
	  					</th>
	  					<th>
	  						Customer Name
	  					</th>
	  					<th>
	  						Total Qty
	  					</th>
	  					<th>
	  						Total Amount (BD)
	  					</th>
	  					<th>
	  						Payment Type
	  					</th>
	  					<th>
	  						Order Date
	  					</th>
	  					<th>
	  						Order Time
	  					</th>
	  					<th>
	  						Status
	  					</th>
	  					<th style="width: 8%">
	  						Action
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  					$sql = "SELECT * FROM orders 
  					WHERE order_status = 1 
					ORDER BY order_date DESC";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['order_id'] ?></td>
						<td><?php echo ($row['customer_id'] == -1) ? 'Guest' : 'Customer' ?></td>
						<td><?php echo $row['customer_name'] ?></td>
						<td><?=getOrderItemQty($con, $row['order_id']) ?></td>

						<td><?=number_format($row['grand_total'], 3) ?></td>

                        <td><?php echo ($row['payment_type'] == 1) ? 'Cash on Delivery' :'Credit Card'?></td>

						<td><?=date('d/M/Y', strtotime($row['order_date'])) ?></td>
						<td><?=date('h:i A', strtotime($row['order_date'])) ?></td>

						<?php 
						$status = null;
						if($row['process_status'] == 1){
							$status = '<span class="label label-warning">Pending</span>';
						}
						if($row['process_status'] == 2){
							$status = '<span class="label label-success">Completed</span>';
						}
						if($row['process_status'] == 3){
							$status = '<span class="label label-danger">Canceled</span>';
						}

						 ?>
						<td><?=$status ?></td>
						<td>
						<ul class="list-inline">
							<li>
								<a href="edit_order.php?edit_id=<?=$row['order_id'] ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
							</li>
							<li>
								<a href="?del_id=<?=$row['order_id'] ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
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
			$('#navOrders').addClass('active');
		});
	</script>
</body>

</html>
