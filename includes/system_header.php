<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=constant("APP_NAME") ?></title>

<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="../assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="../assets/plugins/datatables/jquery.dataTables.min.css">

<link href="../assets/plugins/admin-theme.css" rel="stylesheet">

<link href="../custom/css/custom-system.css" rel="stylesheet">

<!--Icons-->
<script src="../assets/plugins/admin.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><p> <span>Admin</span> <?=constant("APP_NAME") ?></p></a>
				<ul class="user-menu">
					<li >
						<a class="btn btn-info" href="logout.php">Logout</a>
					</li>
					
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<!-- <li id="navDashboard"><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li> -->
			<li id="navApproveDeals"><a href="approve_deals.php"><span class="glyphicon glyphicon-list"></span> Approve Deals</a></li>
			<li id="navAllDeals"><a href="all_deals.php"><span class="glyphicon glyphicon-list"></span> All Deals</a></li>
			<li id="navSalesperson"><a href="salesperson.php"><span class="glyphicon glyphicon-user"></span> Sales Person </a></li>
			<li id="navCustomers"><a href="customers.php"><span class="glyphicon glyphicon-user"></span> Customers </a></li>
			<li id="navReports"><a href="reports.php"><span class="glyphicon glyphicon-check"></span> Report</a></li>
		</ul>
	</div><!--/.sidebar-->