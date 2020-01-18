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
	  		<!-- menu_id = 1 for breakfast menu -->
	  		<a href="add_product.php?menu_id=1" class="btn btn-primary pull-right" style="margin: 10px"><span class="fa fa-tags"> Add Product</span></a>
	  		<h3><span class="glyphicon glyphicon-tags"  style="margin-right: 10px"></span>Manage Products</h3>
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
	  					<th>Qty</th>
	  					<th>
	  						Description
	  					</th>
	  					<th>
	  						Image
	  					</th>
	  					<th>
	  						Sub-Category
	  					</th>
	  					<th>
	  						Category
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
  					$sql = "SELECT * FROM products 
  					WHERE status = 1  
					ORDER BY created_date DESC";
  					$rs = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_assoc($rs)){?>

		  			<tr>
						<td><?=$row['id'] ?></td>
						<td><?=ucwords($row['product_name']) ?></td>
						<td><?=$row['product_code'] ?></td>

						<td><?=$row['product_price'] ?></td>
						<td><?=$row['qty'] ?></td>
						<td><?=create_summary($row['product_desc'], 50) ?></td>

						<td><img class="small_img" src="../uploads/itemImage/<?=$row['image_1'] ?>" alt=""></td>

						<td><?php echo ucfirst(getSubCategoryNameFromId($con, $row['subcategory_id'])) ?></td>
						<td><?php echo ucfirst(getCategoryNameFromId($con, $row['category_id'])) ?></td>
						<td><?=$row['product_status'] ? 'Active' : 'In-Active' ?></td>
						<td>
						<ul class="list-inline">
							<li>
	  							<!-- menu_id = 1 for breakfast menu -->
								<a href="edit_product.php?edit_id=<?php echo $row['id'] ?>&menu_id=1" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
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
			$('#navProducts').addClass('active');
		});
	</script>
</body>

</html>
