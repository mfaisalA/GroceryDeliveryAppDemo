<?php require_once 'includes/header.php'; ?>
<?php 
    $edit = null;
    $edit_id = null;
    if($_GET['edit_id']){
        $edit_id = $_GET['edit_id'];
        $selSql = "SELECT * FROM orders 
        WHERE order_id = $edit_id";
        $rs = mysqli_query($con, $selSql);
        $edit = mysqli_fetch_assoc($rs);
    }else{
        header('location: orders.php?success=false&msg=Requested record not found !');
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $sql = "UPDATE orders 
        SET process_status = $status
        WHERE order_id = $edit_id ";
        if(mysqli_query($con, $sql)){
            if($status == 2){// status == completed
                updateQtyAfterOrderCompleted($con, $edit_id);
            }
            $valid = true;
            $msg = "Order status changed successfully";
        }

        header('location: orders.php?success='.$valid.'&msg='.$msg);
    }
 ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
        <div class="row">
            <ol class="breadcrumb top-bar-margin">
                <li><a href="orders.php"><span class="glyphicon glyphicon-shopping-cart"></span> </a></li>
                <li class="active">Manage Orders</li>
            </ol>
        </div><!--/.row-->
        <br>
        <div class="panel panel-warning">
        <div class="panel-heading">
            <h3><span class="glyphicon glyphicon-shopping-cart"></span> Order Details</h3>
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
                <div id="printableArea">
                <table class="table table-bordered">
                    <tbody >
                        <tr>
                            <th>
                             Customer Name    
                            </th>
                            <td>
                                <?= $edit['customer_name']?>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 25%">
                             Customer Type   
                            </th>
                            <td>
                                <?php echo ($edit['customer_id'] == -1) ? 'Guest' : 'Customer'?>
                            </td>
                        </tr>
                        <?php 
                        if($edit['customer_id'] != -1){
                         ?>
                        <tr>
                            <th>
                             Username    
                            </th>
                            <td>
                                <?php echo getEmployeeIDFromId($con, $edit['customer_id']) ?>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <tr>
                            <th>
                             Customer Email    
                            </th>
                            <td>
                                <?= $edit['customer_email']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Customer Contact    
                            </th>
                            <td>
                                <?= $edit['customer_contact']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Shipping Address    
                            </th>
                            <td>
                                <?= $edit['customer_ship_address']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Total Qty    
                            </th>
                            <td>
                                <?=getOrderItemQty($con, $edit['order_id']) ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Total Amount(BD)   
                            </th>
                            <td>
                                <?= number_format($edit['grand_total'], 3)?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Order Date    
                            </th>
                            <td>
                                <?=date('d/M/Y', strtotime($edit['order_date'])) ?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Items    
                            </th>
                            <td>
                                <table class="table">
                                    <tr>
                                        <td>Item Name</td>
                                        <td>Price</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                    </tr>
                                    <?php
                                        $sql = "SELECT * FROM order_item 
                                        WHERE order_id = {$edit['order_id']}";
                                        $rs = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($rs)) {
                                             echo '<tr>
                                        <td>'.ucfirst(getProductNameFromId($con,$row['product_id'])).'</td>
                                        <td>'.number_format($row['rate'], 2).'</td>
                                        <td>'.$row['quantity'].'</td>
                                        <td>'.number_format($row['total'], 2).'</td>
                                    </tr>';
                                         } 
                                     ?>
                                    
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 25%">
                             Payment Type   
                            </th>
                            <td>
                                <?php echo ($edit['payment_type'] == 1) ? 'Cash' :'Credit'?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <th style="vertical-align: middle;">Update Order Status</th>
                            <td>
                            <select class="form-control" name="status" id="" required>
                                <option value="">--select status--</option>
                                <option value="1" <?=($edit['process_status'] == 1) ? 'selected' : '' ?>>Pending</option>
                                <option value="2" <?=($edit['process_status'] == 2) ? 'selected' : '' ?>>Completed</option>
                                <option value="3" <?=($edit['process_status'] == 3) ? 'selected' : '' ?>>Canceled</option>
                            </select>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <button id="printBtn" type="button"  class="btn btn-default"> <span class="glyphicon glyphicon-print"></span> Print</button>
                <div class="pull-right">
                    <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
                
                <br>
            </div>
        </div>
      </div>    
                                
    </div>  <!--/.main-->

    <?php require_once 'includes/import_scripts.php'; ?>

    <script src="../assets/jquery-printarea/jquery.PrintArea.js"></script>
    <script>
        $(document).ready(function(){
            $('#navOrders').addClass('active');

            $('#printBtn').on('click', function(){
                
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("#printableArea").printArea( options );
            });
        });
    </script>
</body>

</html>
