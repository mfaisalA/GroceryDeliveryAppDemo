<?php require_once 'includes/header.php'; ?>
<?php 
	if($_GET['del_id']){
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$del_id = $_GET['del_id'];
		$delSql = "UPDATE products 
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
				<li><a href="#"><span class="glyphicon glyphicon-home"></span> </a></li>
				<li class="active">Manage Products</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-refresh"  style="margin-right: 10px"></span>Invetory Status Report</h3>
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
	  						ID
	  					</th>
	  					<th>
	  						Product Name
	  					</th>
	  					<th>
	  						Product Code
	  					</th>
	  					<th>
	  						Price
	  					</th>
	  					<th>
	  						Qty
	  					</th>
	  					<th>
	  					  Total Value
	  					</th>
	  					<th>
	  						Sub-Category
	  					</th>
	  					<th>
	  						Category
	  					</th>
	  					<th>
	  						Inventory Status
	  					</th>
	  				</tr>
	  			</thead>
	  			<tbody>
  				<?php
  				$totalQty = 0;
  				$totalValue = 0;
  					$sql = "SELECT * FROM products 
  					WHERE status = 1  
					ORDER BY created_date DESC";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){
						$totalQty += $row['qty'];
						$totalValue += $row['qty']* $row['product_price'];

						$inventoryStatus = '';
						if($row['qty'] < 1){
							$inventoryStatus = '
		  				<label for="" class="label label-danger">out of stock</label>';
						}
						if($row['qty'] >= 1 && $row['qty'] <=5){
							$inventoryStatus = '
		  				<label for="" class="label label-warning">low stock</label>';
						}
						if($row['qty'] > 5){
							$inventoryStatus = '
		  				<label for="" class="label label-success">in stock</label>';
						}
						?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=ucwords($row['product_name']) ?></td>
						<td><?=$row['product_code'] ?></td>

						<td><?=$row['product_price'] ?> BD</td>
						<td><?=$row['qty'] ?></td>
						<td><?=$row['qty']* $row['product_price']?> BD</td>

						<td><?php echo ucfirst(getSubCategoryNameFromId($con, $row['subcategory_id'])) ?></td>
						<td><?php echo ucfirst(getCategoryNameFromId($con, $row['category_id'])) ?></td>
						<td><?=$inventoryStatus; ?></td>
						
		  			</tr>	
				<?php } ?>
	  			</tbody>
	  		</table>
	  		<table class="table table-bordered" style="width: 40%;float: right;">
	  			<thead>
	  				<tr>
	  					<th>Total Items</th>
	  					<th><?php echo $totalQty ?></th>
	  				</tr>
	  				<tr>
	  					<th>Total Items value</th>
	  					<th><?php echo $totalValue ?> BD</th>
	  				</tr>
	  			</thead>
	  			
	  		</table>
	  	</div>
	  </div>	
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>
	<script>
		$(document).ready(function(){
			$('#navInventoryStatus').addClass('active');
		});
	</script>
</body>

</html>
