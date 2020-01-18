<?php 

include("../config.php");
include("../functions.php");

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM orders  
	WHERE order_date >= '$start_date' AND order_date <= '$end_date' and order_status = 1";
	$query = $con->query($sql);

	$totalNumOrders = 0;
	$totalAmount = 0;
	$totalQty = 0;
	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Customer Type</th>
			<th>Customer Name</th>
			<th>Total Quantity</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		while ($result = $query->fetch_assoc()) {
			//Query for getting Total Item from Items Table
			$qty = getOrderItemQty($con, $result['order_id']);

			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.(($result['customer_id'] == -1) ? 'Student' :'Employee').'</center></td>
				<td><center>'.$result['customer_name'].'</center></td>
				<td><center>'.$qty.'</center></td>
				<td><center>'.$result['grand_total'].'</center></td>
			</tr>';	
			$totalAmount += $result['grand_total'];
			$totalQty += $qty;
			$totalNumOrders++;
		}
		$table .= '
		</tr>

		<tr>
			<th colspan="3"><center>Number of Orders</center></th>
			<th colspan="2"><center>'.$totalNumOrders.'</center></th>
		</tr>
		<tr>
			<th colspan="3"><center>Number of Items Sold</center></th>
			<th colspan="2"><center>'.$totalQty.'</center></th>
		</tr>
		<tr>
			<th colspan="3"><center>Total Value of Orders</center></th>
			<th colspan="2"><center>'.$totalAmount.'</center></th>
		</tr>
	</table>
	';	

	echo $table;

}

?>