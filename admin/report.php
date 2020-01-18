<?php require_once 'includes/header.php'; ?>

		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Report</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-check"></span> Report</h3>
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
	  	<br>
            <div class="panel-body">
                <div class="col-sm-6">
                 <form class="form-horizontal" action="printReport.php" method="post" id="getReportForm">
                  <div class="form-group">
                    <label for="startDate" class="col-sm-3 control-label">Start Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="endDate" class="col-sm-3 control-label">End Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-warning" id="printReportBtn"> <i class="glyphicon glyphicon-print"></i> Print Report</button>
                    </div>
                  </div>
                </form>
            </div>
            </div>
	  </div>	
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>
	<script>
       $(document).ready(function() {

	$('#navReport').addClass('active');
    // order date picker
    $("#startDate").datepicker();
    // order date picker
    $("#endDate").datepicker();

    $("#getReportForm").unbind('submit').bind('submit', function() {

        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'text',
            success:function(response) {
                var mywindow = window.open('', 'Auto Garage Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Appointments Report</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
            } // /success
        }); // /ajax

        return false;
    });

});
    </script>
</body>

</html>
