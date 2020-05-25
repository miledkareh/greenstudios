<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Green Studios</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	 <?php
  session_start();
  include('../configdb.php');
    if(isset($_SESSION['UserSerial']))
	$UserSerial=$_SESSION['UserSerial'];
 if(!isset($_COOKIE['PHPSESSID'])) {
 	require_once('DAL.class.php');
	 $sql=" UPDATE users set online=0 where serial=".$UserSerial;
	 $db = new DAL();		
	$data=$db->ExecuteQuery($sql);
 	header("Location: ../Login");
	echo "<script>location='../Login'</script>";
   
} 									
  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
									echo "<script>location='../Login'</script>";
								}
									if($_SESSION['tscv']!=1 && $_SESSION['IsAdmin']==1){
									header("Location: ../Blank");
										echo "<script>location='../Blank'</script>";
								}
  ?>
  
    <div id="wrapper">

        <!-- Navigation -->
                      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Green Studios</a>
            </div>
            <!-- /.navbar-header -->

                          <ul class="nav navbar-top-links navbar-right">

        
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                   
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

                <?php include("../menu.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                
                    <h1 class="page-header">Time Sheet Report</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
							 
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <label>From date</label>
					
						<table style="width: 50%;"><tr>
							<td style="width: 80%"><input type="date" name="fromdate" class="form-control" id="fromdate"></td>
							
						</tr></table>
					  
					<label>To date</label>
					
						<table style="width: 50%;"><tr>
							<td style="width: 80%;"><input type="date" name="todate" class="form-control" id="todate" ></td>
							
						</tr></table>  
						
						<?php	$query = "Select * From users";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		
		<label>Employee</label><select class="form-control" id="employee" style="width: 50%; ">
	 <option value="0" ><?php echo('All'); ?></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
			 
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
		</select>
		        		<?php	$query = "Select * From offers ";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		<label>Project</label><select class="form-control" id="project" style="width: 50%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['ProjectName']); ?></option>
 <?php 
}?>
		</select>
		<br>
		<table style="width: 50%"> 
			<tr>
				<td align="right">  <button type="button" id="print" class="btn btn-outline btn-primary"  >Print</button></td>
			</tr>
			</table>
                 
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
 
    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

	 

 </div> 
<script src="../../js/timesheetreport.js"></script>
</body>

</html>
