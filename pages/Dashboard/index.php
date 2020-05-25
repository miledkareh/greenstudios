<?php   session_start(['cookie_lifetime' => 86400]);?>
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

<style>
	.nopadding{
		padding:1px !important;
		margin:0 !important;
	}

tr.row_selected td{color:lightblue !important;}
</style>
	
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

                                          <ul class="nav navbar-top-links navbar-right" >
        <li class="dropdown">
   Logged In By <?php echo($_SESSION['User']);?>
                    <!-- /.dropdown-user -->
                </li>
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
            <div class="col-lg-1 nopadding">&nbsp;<select class="form-control" id="year1" style="width: 100%;"></select></div>
            <div class="col-lg-1 nopadding">&nbsp;<select class="form-control" id="sum" style="width: 100%;">
                			<option>Sum</option>
                			<option>Count</option>
                		</select>
           	</div>
           	<div class="col-lg-1 nopadding">Country<select  class="form-control" id="country1" name="country1" style="width: 100%;">
                			<option selected value="All">All</option>
                			</select>
           	</div>
           	<div class="col-lg-2 nopadding">From Date<input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "fromdate1" name="fromdate1"/>
           	</div>
           	<div class="col-lg-2 nopadding">To Date<input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "todate1" name="todate1"/>
           	</div>
           	<div  class="col-lg-1 nopadding" >&nbsp;<input style="width: 100%" type="submit" id="search1" class="btn btn-outline btn-primary" value="Search">
           	</div>
                  
            <div class="row">
            	 <div class="col-lg-8 nopadding">
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
                 <div class="col-lg-4 nopadding">
                  
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
	<h3> &nbsp;Offer / Maintenance Values</h3>  
<div class="panel-body">
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <thead>
                                                <tr>
                                                	<th></th>
                                        <th>Offer</th>
                                       
                                        <th>Maintenance</th>
                                        <th>Percentage</th>
                                
                                   

                                    </tr>
                                            </thead>
                     <tbody>
                        	
									 <tr class="odd gradeX">
                                    	
                                    <td >Totals</td>
                                    <td id="tdoffer"></td>
                                       <td id="tdmaintenance"></td>
                                        <td id="tdperc"></td>
                                       
                                      </tr>
									<tr class="odd gradeX">
                                    	
                                    <td >RG</td>
                                    <td id="tdrgoffer"></td>
                                       <td id="tdrgmaintenance"></td>
                                        <td id="tdrgperc"></td>
                                       
                                      </tr>
                                   
                                      <tr class="odd gradeX">
                                      	<td >GW</td>
                                         <td id="tdgwoffer"></td>
                                         <td id="tdgwmaintenance"></td>
                                         <td id="tdgwperc"></td>
                                        
                                        </tr>
                                         <tr class="odd gradeX">
                                      	<td >Canceled</td>
                                         <td id="tdcoffer"></td>
                                         <td id="tdcmaintenance"></td>
                                         <td id="tdcperc"></td>
                                        
                                        </tr>
                                        				
                                            </tbody>
                            </table>
</div>
</div>
</div>
                <div class="col-lg-12">
                	
                    <div class="panel panel-default">
           <h3> &nbsp;History</h3>  
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                             <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Project</th>
                                        <th>User</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

								<?php

$query = "Select *,(select fullname from users where serial=audit.userid) as userN from audit where serial <> 0  order by dat desc,seen desc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                      
                                    	<?php 
                                    	
										 if($x['tablename']=='customers'){
												$query = "Select concat(company,'/',fname,' ', lname) as description1,'' as projectname from customers where serial=".$x['tableserial'];
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if($x['tablename']=='offerfollowup'){
												$query = "Select description as description1,(select projectname from offers where serial=offerfollowup.offerid) as projectname from offerfollowup where serial=".$x['tableserial'];
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if($x['tablename']=='mfollowup'){
												$query = "Select description as description1,(select projectname from offers where serial =maintenances.offerid) as projectname from maintenances where serial=".$x['tableserial'];
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if ($x['tablename']=='offers'){
                                    		$query = "Select projectname as description1,projectname from offers where serial=".$x['tableserial'];
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											
											?>
                                    <tr class="odd gradeX" style="background-color: <?php if($x['description']=='New followup added') echo "lightblue";else if($x['description']=='New maintenance followup added') echo "salmon"; else if ($x['description']=='Client Updated') echo "yellow"; else if ($x['description']=='Followup updated') echo "#9FB5D1"; else if ($x['description']=='New Client added') echo "#F9F9B4"; else if ($x['description']=='New Offer added') echo "#98FD32"; else if ($x['description']=='Offer Updated') echo "#C4FD8B";?>">
                                    		
                                    	 <td ><?php echo($x["dat"]);?></td>                                	
                                        <td><?php echo($x["description"]);?></td>
                                         <td><?php echo($z["description1"]);?></td>
                                         <td><?php echo($z["projectname"]);?></td>
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
    
<script src="../../vendor/jquery/jquery.min.js"></script>
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
