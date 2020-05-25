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
									if($_SESSION['mcv']!=1 && $_SESSION['IsAdmin']==1){
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

                 <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    	<?php include('../configdb.php'); ?>
					<?php if($_SESSION['dcv']==1){ ?>
					 <li>
                            <a href="../Dashboard/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
							<?php } ?>
								<?php  if( $_SESSION['curcv']==1){ ?>
								  <li>
                                    <a href="../Currencies/" ><i class="fa fa-usd fa-fw"></i>Currencies</a>
                                </li>
								 <li>
                                    <a href="../CurrencyExchange/" ><i class="fa fa-exchange fa-fw"></i>Currency Exchange</a>
                                </li>
									
										<?php } ?>
							<?php if($_SESSION['cocv']==1){ ?>
					 <li>
                            <a href="../Configuration/"><i class="fa fa-gears"></i> Configuration</a>
                        </li>
							<?php } ?>
							<?php if($_SESSION['icv']==1){ ?>
					 <li>
                            <a href="../Items/"><i class="fa fa-gears"></i> Items</a>
                        </li>
							<?php } ?>
							 <?php if($_SESSION['ccv']==1 || $_SESSION['cccv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-users fa-fw"></i> Clients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <?php if( $_SESSION['ccv']==1){ ?>
                                <li>
                                    <a href="../Clients/" class="fa fa-users">Clients</a>
                                </li>
									<?php } ?>
									 <?php if( $_SESSION['cccv']==1){ ?>
								   <li>
                                    <a href="../CClients/" class="fa fa-pencil" >Clients Colors</a>
                                </li>
									<?php } ?>
								</ul>
                        </li>
						<?php } ?>
							<?php if($_SESSION['ocv']==1 || $_SESSION['fucv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-legal fa-fw"></i> Projects<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
						
						<?php if($_SESSION['ocv']==1){ ?>
					 <li>
                             <a href="../Offers/"><i class="fa fa-table fa-fw"></i>Projects</a>
                        </li>
							<?php } ?>
									 <?php if( $_SESSION['fucv']==1){ ?>
								   <li>
                                    <a href="../FollowUp/" class="fa fa-share" >Follow Up</a>
                                </li>
									<?php } ?>
								</ul>
                        </li>
						<?php } ?>
						<?php if($_SESSION['mcv']==1 || $_SESSION['pcv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-legal fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <?php if( $_SESSION['mcv']==1){ ?>
                                <li>
                                    <a href="../Maintenances/" class="fa fa-legal">Maintenances</a>
                                </li>
									<?php } ?>
									 <?php if( $_SESSION['pcv']==1){ ?>
								   <li>
                                    <a href="../PWork/" class="fa fa-share" >Predefined Work</a>
                                </li>
									<?php } ?>
								</ul>
                        </li>
						<?php } ?>
							 <?php if($_SESSION['ucv']==1 || $_SESSION['upcv']==1){ ?>
						 <li>
						    <a href="#"><i class="fa fa-user-md fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <?php if( $_SESSION['ucv']==1){ ?>
                                <li >
                                    <a href="../Users/" class="fa fa-user-md">Users</a>
                                </li>
								<?php } ?>
								 <?php if( $_SESSION['upcv']==1){ ?>
								   <li>
                                    <a href="../UserProfile/" class="fa fa-key">User Profile</a>
                                </li>
                                
									<?php } ?>
									</ul>
									</li>
								<?php } ?>
								
                         
                         <?php if($_SESSION['rncv']==1){ ?>
					 <li>
                             <a href="../RefferalNotes/"><i class="fa fa-pencil-square-o"></i> Refferal Notes</a>
                        </li>
							<?php } ?>
							 <?php if($_SESSION['tscv']==1){ ?>
					 <li>
                             <a href="../TimeSheet/"><i class="fa fa-clock-o"></i> Time Sheet</a>
                        </li>
                        <?php if($_SESSION['IsAdmin']==1){ ?>
                        <li>
                             <a href="../TimeSheetReport/"><i class="fa fa-clock-o"></i> Time Sheet Report</a>
                        </li>
							<?php }} ?>
									  <?php if($_SESSION['ircv']==1){ ?>
					 <li>
                             <a href="../InvoiceReport/"><i class="fa fa-file-text-o"></i> Offer Printout</a>
                        </li>
							<?php } ?>
								  <?php if($_SESSION['atcv']==1){ ?>
					 <li>
                             <a href="../AuditTrail/"><i class="fa fa-file-text-o"></i> Audit Trail
                             	<?php
                             	 
$query = "Select count(serial) as cserial from audit where seen=0";  
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){ if($x['cserial'] > 0)echo ("(".$x['cserial'].")");}?>
                             	</a>
                        </li>
							<?php } ?>
                         <?php if($_SESSION['ncv']==1){?>
					 <li>
                             <a href="../Notification/"><i class="fa fa-comment-o"></i> Notification
                             	<?php
                             	 
$query = "Select count(serial) as cnotification from notification where (employee=".$_SESSION['UserSerial']." or viewer=".$_SESSION['UserSerial']." or viewer like '".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial']."') and seen=0 and done=0 and isnotification=1";  
if ($_SESSION['comcv']==1)
$query= $query . " or  (complaint=1 and seen=0 and done=0)";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){ }?>
<?php                             	
$query = "Select count(serial) as creminders from notification where seen=0 and done=0 and (employee=".$_SESSION['UserSerial']." or userid=".$_SESSION['UserSerial']." or viewer=".$_SESSION['UserSerial']." or viewer like '".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial']."') and isnotification=0 and duedate <= NOW()";  
if ($_SESSION['comcv']==0)
$query= $query . " and complaint=0 ";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($y = mysqli_fetch_array($results)){
	$notification= $x["cnotification"]+ $y["creminders"]; 
	if($notification) echo("(".$notification.")");}?>
                             	</a>
                        </li>
							<?php } ?>
								
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                
                    <h1 class="page-header">Visits Report</h1>
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
		        		<?php	$query = "Select *,(select projectname from offers where serial=maintenances.offerid) as offer From maintenances ";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		<label>Project</label><select class="form-control" id="project" style="width: 50%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['offer']." - ".$x['Description']); ?></option>
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
<script src="../../js/visitsreport.js"></script>
</body>

</html>
