 <?php
  session_start();
  ?>
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
<link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
<link href="../../vendor/morrisjs/morris.css" rel="stylesheet">	
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
<link rel="stylesheet" href="../date/themes/base/jquery.ui.all.css">

	<script src="../date/jquery-1.9.1.js"></script>
	<script src="../../vendor/jquery/jquery.min.js"></script>
	<script src="../date/ui/jquery.ui.core.js"></script>
	
	<script src="../date/ui/jquery.ui.widget.js"></script>
	
	<script src="../date/ui/jquery.ui.datepicker.js"></script>
	
	<script>
	$(function() {
		if ( $('[type="date"]').prop('type') != 'date' ) {
    $('[type="date"]').datepicker();
}
		
	});
	</script>
</head>

<body>
	 <?php
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
									echo "<script>location='../Login'</script>";
								}
								if($_SESSION['dcv']!=1){
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
                
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
               <table>
                	<tr>
                		<td><select class="form-control" id="year1" style="width: 100%;"></select></td>
                		<td>&nbsp;</td>
                		<td><select class="form-control" id="sum" style="width: 100%;">
                			<option>Sum</option>
                			<option>Count</option>
                		</select></td>
                		<td>&nbsp;<label>Country</label></td><td><select  class="form-control" id="country1" name="country1" style="width: 100%;">
                			<option selected value="All">All</option>
                			</select>
                		</td>
                		<td>&nbsp;<label>From Date</label></td><td><input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "fromdate1" name="fromdate1"/></td>
											
											<td>&nbsp;<label>To Date</label></td><td><input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "todate1" name="todate1" /></td>
										<td> <input type="submit" id="search1" class="btn btn-outline btn-primary" value="Search"></td>
                	</tr>
                </table>
            <div class="row">
            	 <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <i class="fa fa-bar-chart-o fa-fw" ></i> Monthly Chart
                            <div class="pull-right">
                                <div class="btn-group">
                                
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="width: 100%">
                            <div id="morris-area-chart"  style="position: absolute;width: 91%" ></div>
                            
                                    <div id="morris-bar-chart"  style="width: 100%;" ></div>
                                
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <!-- /.panel -->
                   
                    <!-- /.panel -->
                </div>
                 <div class="col-lg-4">
                  
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Yearly Chart
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <!-- /.panel .chat-panel -->
                </div>
               
            	

<br />
                <div class="col-lg-12">
                	
                    <div class="panel panel-default">
             
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	
                      				 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>User</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

								<?php
							

										

include('../configdb.php');
$query = "Select *,(select fullname from users where serial=audit.userid) as userN from audit  order by dat desc limit 10";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >  
                                    	<?php 
                                    	
										 if($x['tablename']=='customers'){
												$query = "Select concat(company,'/',fname,' ', lname) as description1 from customers where serial=".$x['tableserial'];
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if($x['tablename']=='offerfollowup'){
												$query = "Select (select projectname from offers where serial in(select offerid from offerfollowup where serial=offerfollowup.serial)) as description1 from offerfollowup where serial=".$x['tableserial'];
											
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if ($x['tablename']=='offers'){
                                    		$query = "Select projectname as description1 from offers where serial=".$x['tableserial'];
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											
											?>
                                    
                                    		
                                    	 <td><?php echo($x["dat"]);?></td>                                	
                                        <td><?php echo($x["description"]);?></td>
                                         <td><?php echo($z["description1"]);?></td>
                                          <td><?php echo($x["userN"]);?></td>
          

                                    </tr>
									<?php 
}?>
                                </tbody>
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
    
 
    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
    
    <script src="../../vendor/raphael/raphael.min.js"></script>
 <script src="../../vendor/morrisjs/morris.min.js"></script>
 <script src="../../data/morris-data.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
			"aaSorting": []
        });
    });
    </script>

	    <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

 </div> 


</body>

</html>
