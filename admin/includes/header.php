<?php require_once '../config.php'; ?>
<?php require_once 'includes/session.php'; ?>
<?php require_once '../functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - <?=constant("SYSTEM_NAME") ?></title>


<link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar  navbar-fixed-top" role="navigation" style="background: #880E4F">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="../assets/images/ajyad_logo.jpg" style="width: 40px;margin-right: 8px"><?=constant("SYSTEM_NAME") ?></a>
				<ul class="user-menu">
							<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			
			<li id="navDashboard"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li id="navCategories" ><a href="categories.php"><span style="margin-right: 8px" class="fa fa-cube"></span> Manage Categories</a></li>
			<li id="navSubCategories" ><a href="sub_categories.php"><span style="margin-right: 8px" class="fa fa-square"></span> Manage Sub Categories</a></li>

			<li id="navProducts" ><a href="products.php"><span class="glyphicon glyphicon-tags"></span> Manage Products</a></li>
			<li id="navOrders" ><a href="orders.php"><span class="glyphicon glyphicon-shopping-cart"></span> Manage Orders</a></li>

			<li id="navUsers" ><a href="users.php"><span class="glyphicon glyphicon-user"></span> Manage Customers</a></li>
			
			<li id="navInventoryStatus" ><a href="inventory_status.php"><span class="glyphicon glyphicon-refresh"></span> Inventory Status Report</a></li>
			<li id="navReport" ><a href="report.php"><span class="glyphicon glyphicon-check"></span> Report</a></li>
		</ul>
	</div><!--/.sidebar-->