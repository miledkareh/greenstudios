<?php
ini_set('memory_limit', '-1');
require_once('../../calendar/bdd.php');


$sql = "SELECT id,offer,title,start,end, color,clientid,notes,(select company from customers where serial=appointments.clientid) as clientname,(select projectname from offers where serial=appointments.offer) as projectname,sent FROM appointments where deleted='0000-00-00'";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
   <link href='fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='scheduler.min.css' rel='stylesheet' />

<script src='moment.min.js'></script>
<script src='jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script src='scheduler.min.js'></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Courts Management</title>

    <!-- Bootstrap Core CSS -->
 
    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="../../select2/dist/css/select2.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    body {
        padding-top: 0px;
        padding-right:0px; 
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
	#calendar {
		max-width: 100%;
		
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
.navbar-default {
background-color:white;
}

.fc-time-grid .fc-slats td {
    height: 4em;
}

    </style>
    
</head>

<body >
 <?php
  session_start();
				
  ?>
    <div id="wrapper" style="background-color:white;">

        <!-- Navigation -->
                         <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" >
            <div class="navbar-header" style="background-color:white;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<table width="100%" height="100%" align="center" style="background-color:white;"><tr>
			
							<td>
							<h3> &nbsp;&nbsp;Maintenance Schedule </h3>
							</td>
							<td >
							&nbsp;
							</td>
							</tr>
							</table>
            </div>
            <!-- /.navbar-header -->
                          <ul class="nav navbar-top-links navbar-right" style="background-color:white;">
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
<?php
                          	
                             	 include('../configdb.php');
								 $query = "Select * from offers where (status = 'OFFER' or status = 'INQUIRIES') and kickoff <= CURRENT_DATE() and msgsent=0";  

								 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
$dat= date('Y-m-d');

while($x = mysqli_fetch_array($results)){
	if($x['userid']=='')
	$x['userid']=$_SESSION['UserSerial'];
	
		$query1="Insert into notification (update1,description,subject,dat,duedate,userid,offerid,employee,done,isnotification,seen,confirm) values (1,'Expected kick off date passed','Passed kick off date','$dat','$dat',".$_SESSION['UserSerial'].",".$x['Serial'].",".$x['userid'].",0,0,0,0)"; 

		$resultss = mysqli_query($dbhandle,$query1)  or die(mysqli_error());

$kickoff = date('Y-m-d', strtotime("+3 months", strtotime($x['kickoff'])));

$query1 = "Update offers set msgsent=1,kickoff='$kickoff' where serial=".$x['Serial'];  
$resultss = mysqli_query($dbhandle,$query1)  or die(mysqli_error());
	
}
								 
							 
								 
$query = "Select * from maintenances where DATEDIFF(ExpDate,CURRENT_DATE) <= 90 and status <> 'canceled' and msgsent=0";  
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
$dat= date('Y-m-d');
while($x = mysqli_fetch_array($results)){
	
		$query1="Insert into notification (update1,description,subject,dat,duedate,userid,offerid,employee,done,isnotification,seen,confirm) values (1,'Maintenance needs renewal','Maintenance expiry','$dat','$dat',".$_SESSION['UserSerial'].",".$x['offerId'].",2,0,0,0,0)"; 
$resultss = mysqli_query($dbhandle,$query1)  or die(mysqli_error());
$query1 = "Update maintenances set msgsent=1 where serial=".$x['Serial'];  
$resultss = mysqli_query($dbhandle,$query1)  or die(mysqli_error());
	
}?>
  <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    	<li>
                          <div id="datepicker"></div>
                        </li>
                    	<?php if($_SESSION['IsAdmin']==1){?>
    					 <li>
                            <a href="../../ws/ws_ExportDatabase.php"><i class="fa fa-download"></i> Backup Database</a>
                        </li>
                        <?php }?>
                    	<?php include('../configdb.php'); ?>
					<?php if($_SESSION['dcv']==1){ ?>
					 <li>
                            <a href="../Dashboard/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
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
							
							<?php if($_SESSION['ocv']==1 || $_SESSION['fucv']==1 || $_SESSION['ircv']==1){ ?>
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
									 <?php if($_SESSION['ircv']==1){ ?>
					 <li>
                             <a href="../InvoiceReport/"><i class="fa fa-file-text-o"></i> Offer Printout</a>
                        </li>
							<?php } ?>
								</ul>
                        </li>
						<?php } ?>
						<?php if($_SESSION['mcv']==1 || $_SESSION['pcv']==1 || $_SESSION['vacv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-legal fa-fw"></i> Maintenances<span class="fa arrow"></span></a>
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
									 <?php if( $_SESSION['pcv']==1){ ?>
								   <li>
                                    <a href="../PText/" class="fa fa-share" >Predefined Text</a>
                                </li>
									<?php } ?>
									  <?php if($_SESSION['vacv']==1){ ?>
					 <li>
                             <a href="../VisitsAtt/"><i class="fa fa-file-text-o"></i> Maintenance Attachments</a>
                        </li>
							<?php } ?>
							<?php if($_SESSION['acv']==1){ ?>
					 <li>
                            <a href="../Bookings/"><i class="fa fa-calendar fa-fw"></i> Maintenance Schedule</a>
                        </li>
							<?php } ?>
								</ul>
                        </li>
						<?php } ?>
						
							<?php if($_SESSION['tscv']==1 || $_SESSION['ncv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-legal fa-fw"></i> Regroup Workflow<span class="fa arrow"></span>
                           	<?php
                             	 
$query = "Select count(serial) as cnotification from notification where (employee=".$_SESSION['UserSerial']." or viewer=".$_SESSION['UserSerial']." or viewer like '".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial']."') and seen=0 and done=0 and isnotification=1";  
if ($_SESSION['comcv']==1)
$query= $query . " or  (complaint=1 and seen=0 and done=0)";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){ }?>
<?php                             	
$query = "Select count(serial) as creminders from notification where seen=0 and done=0 and (employee=".$_SESSION['UserSerial']." or userid=".$_SESSION['UserSerial']." or viewer=".$_SESSION['UserSerial']." or viewer like '".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial']."') and isnotification=0 and complaint=0 and duedate <= NOW()";  

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($y = mysqli_fetch_array($results)){
	$notification= $x["cnotification"]; 
	echo("(".$notification.")"); if($y["creminders"]>0) echo ("(".$y["creminders"]).")";}?>
                           </a>
                            <ul class="nav nav-second-level">
							<?php if($_SESSION['tscv']==1){ ?>
					 <li>
                             <a href="../TimeSheet/"><i class="fa fa-clock-o"></i> Time Sheet</a>
                        </li>
                        <?php if($_SESSION['IsAdmin']==1){ ?>
                        <li>
                             <a href="../TimeSheetReport/"><i class="fa fa-clock-o"></i> Time Sheet Report</a>
                        </li>
							<?php }} ?>
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
	
	$notification= $x["cnotification"]; 
	 echo("(".$notification.")"); if($y["creminders"]>0) echo ("(".$y["creminders"]).")";}?>
                             	</a>
                        </li>
							<?php } ?>
								</ul>
                        </li>
						<?php } ?>
						
							<?php if($_SESSION['icv']==1 || $_SESSION['igcv']==1 ){ ?>
					 <li>
                           <a href="#"><i class="fa fa-gears fa-fw"></i> Items<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							<?php if($_SESSION['icv']==1){ ?>
					 <li>
                            <a href="../Items/"><i class="fa fa-gears"></i> Items</a>
                        </li>
							<?php } ?>
									<?php if($_SESSION['igcv']==1){ ?>
					 <li>
                            <a href="../ItemsGroup/"><i class="fa fa-gears"></i> Items Group</a>
                        </li>
							<?php } ?>
									
									  
								</ul>
                        </li>
						<?php } ?>
						
								<?php if($_SESSION['plcv']==1){ ?>
					 <li>
                            <a href="../Plants/"><i class="fa fa-tree"></i> Plants</a>
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
								<?php  if( $_SESSION['curcv']==1){ ?>
								  <li>
                                    <a href="../Currencies/" ><i class="fa fa-usd fa-fw"></i>Currencies</a>
                                </li>
								 <li>
                                    <a href="../CurrencyExchange/" ><i class="fa fa-exchange fa-fw"></i>Currency Exchange</a>
                                </li>
									
										<?php } ?>
										 <?php if($_SESSION['tcv']==1){ ?>
					 <li>
                             <a href="../Tasks/"><i class="fa fa-pencil-square-o"></i> Tasks</a>
                        </li>
							<?php } ?>
							<?php if($_SESSION['cocv']==1){ ?>
					 <li>
                            <a href="../Configuration/"><i class="fa fa-gears"></i> Configuration</a>
                        </li>
							<?php } ?>
							
						
							
						
						
								
                         
                         <?php if($_SESSION['rncv']==1){ ?>
					 <li>
                             <a href="../RefferalNotes/"><i class="fa fa-pencil-square-o"></i> Refferal Notes</a>
                        </li>
							<?php } ?>
							 
									 
							
                        
								
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
         
            <!-- /.navbar-static-side -->
        </nav>

          <div id="page-wrapper"  align=" left" >
		  <br>
        <div class="row" >
        	 <div class="col-lg-12" >
         <div style="width: 100%;" id="calendar" class="col-centered" style="background-color:white;">
         </div>
               </div>
            </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Event</h4>
			  </div>
			  <div class="modal-body">
			  	<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Project</label>
					<div class="col-sm-10">
<select name="eplayer1" class="form-control" id="offer" style="width: 100%">
							<?php
								
include('../configdb.php');
$query = "Select * From offers where projectname <> '' and serial in (select offerid from maintenances) order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['Serial']); ?>"><?php echo ($x['ProjectName']);?></option>
						  <?php } ?>
						</select>
					  	</div>
						
				  </div>
				  <div>&nbsp;</div>
				<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Client</label>
					<div class="col-sm-10">
<select name="player1" class="form-control" id="client" style="width: 100%">
							<?php
								
include('../configdb.php');
$query = "Select * From customers where company <> '' and serial in (select customerid from offers where serial in (select offerid from maintenances)) order by company asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['Serial']); ?>"><?php echo ($x['company']);?></option>
						  <?php } ?>
						</select>
						
					  	</div>
					
				  </div>
				  			<div>&nbsp;</div>	
				  		<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
						  <option style="color:#000;" value="#000">&#9724; Black</option>
						  
						</select>
					</div>
				  </div>
				  	
				  			
				  		<div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title">
					</div>
				  </div>
				 
				  
					<div class="col-sm-12 " style="margin-top: 5px;" >
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-5">
						<input type="date" name="start" class="form-control" id="start" >
						</div>
						<div class="col-sm-5">
							<input type="time" name="starttime" class="form-control" id="starttime" >
					</div>
	
				  </div>
				 
				 <div class="col-sm-12 " style="display:none;">
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-5">
					 <input type="date" name="end" class="form-control" id="end" >
					 </div>
						<div class="col-sm-5">
					 <input type="time" name="endtime" class="form-control" id="endtime" >
					</div>
				  </div>
				  <div>&nbsp;</div>
				    <div class="col-sm-12 "  >
					<label for="title" class="col-sm-2">Repeat Till</label>
					<div class="col-sm-10">
					  <input type="date" name="repeat" class="form-control" id="repeat">
					</div>
				  </div>
				 
					<div>&nbsp;</div>
					<div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2 control-label">Notes</label>
					<div class="col-sm-10">
					  <textarea type="text" name="notes" class="form-control" id="notes" rows="3"></textarea>
					</div>
				  </div>
				  <div>&nbsp;</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="Save" class="btn btn-primary">Save changes</button>
			  </div>
			
			</div>
		  </div>
		</div>
		

		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
			  </div>
			  <div class="modal-body">
			  	<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Project</label>
					<div class="col-sm-10">
<select name="eplayer1" class="form-control" id="eoffer" style="width: 100%">
							<?php
								
include('../configdb.php');
$query = "Select * From offers where projectname <> '' and serial in (select offerid from maintenances) order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['Serial']); ?>"><?php echo ($x['ProjectName']);?></option>
						  <?php } ?>
						</select>
					  	</div>
						
				  </div>
				  <div>&nbsp;</div>
			<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Client</label>
					<div class="col-sm-10">
<select name="eplayer1" class="form-control" id="eclient" style="width: 100%">
							<?php
								
include('../configdb.php');
$query = "Select * From customers where company <> '' and serial in (select customerid from offers where serial in (select offerid from maintenances)) order by company asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['Serial']); ?>"><?php echo ($x['company']);?></option>
						  <?php } ?>
						</select>
					  	</div>
						
				  </div>
				  <div>&nbsp;</div>
				  				<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="ecolor">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
						  <option style="color:#000;" value="#000">&#9724; Black</option>
						  
						</select>
					</div>
				  </div>
				  	
				  			
				  		<div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
					  <input type="text" name="etitle" class="form-control" id="etitle">
					</div>
				  </div>
				 
				  
					<div class="col-sm-12 " style="margin-top: 5px;" >
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-5">
						<input type="date" name="estart" class="form-control" id="estart" >
						</div>
						<div class="col-sm-5">
							<input type="time" name="estarttime" class="form-control" id="estarttime" >
					</div>
	
				  </div>
				 
				 <div class="col-sm-12 " style="display:none">
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-5">
					 <input type="date" name="eend" class="form-control" id="eend" >
					 </div>
						<div class="col-sm-5">
					 <input type="time" name="eendtime" class="form-control" id="eendtime" >
					</div>
				  </div>
				    <div>&nbsp;</div>
	<div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2 control-label">Notes</label>
					<div class="col-sm-10">
					  <textarea type="text" name="enotes" class="form-control" id="enotes" rows="3"></textarea>
					</div>
				  </div>
				  <div>&nbsp;</div>
				    <div class="col-sm-12"> 
						<div class="col-sm-4">
						  <div class="checkbox" >
							<label class="text-danger" disabled><input type="checkbox" id="deletee" name="delete"   > Delete event</label>
						  </div>
						</div>
						<div class="col-sm-4">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox" id="sent" name="sent">Send Email</label>
						  </div>
						  </div>
						<div class="col-sm-4">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox" id="all" name="all">Update All</label>
						  </div>
					</div>
				  	</div>
<div>&nbsp;</div>					
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="savee" class="btn btn-primary">Save changes</button>
			  </div>
			
			</div>
		  </div>
		</div>
		
		  <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
    
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="ctitle"></h4>
        </div>
        <div class="modal-body" align="center">
		<label>Name</label><input class="form-control" type="text"   name="name"  id="name" style="width:100%;" required>
		<label>Phone</label><input class="form-control" type="text"   name="phone"  id="phone" style="width:100%;" >
		<label  style="display: none;">Address</label><input  style="display: none;" class="form-control" type="text"   name="address"  id="address" style="width:100%;" > </div>
        <div class="modal-footer">
        <label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
		<tr>
		<td>
        <button type="button" id="add1" class="btn btn-outline btn-primary" >Save</button>
		</td>
		<td width="10">
		</td>
		<td>
          <button type="button" id="exit1"class="btn btn-outline btn-primary" data-dismiss="modal">Exit</button>
          </td>
		</tr>
		</table>
        </div>
      </div>
      
    </div>
  </div>
    </div>
    <!-- /#wrapper -->
	<div class="modal fade" id="myModal1" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Send by Email</h4>
        </div>

        <div class="modal-body" align="center">		
        <div class="row"> 
        <div class="col-lg-12">
        <label>Email</label><input type="text" class="form-control" id="email"  style="width: 100%; " placeholder="Enter Email ...">
</div>

</div>
        	<label>Subject</label><input type="text" class="form-control" id="subject"  style="width: 100%; " value="Maintenance Visit">
	
           
	<label>Description</label><textarea class="form-control" id="description" rows="7" style="width: 100%; " ></textarea>

        </div>
        <div class="modal-footer" >
		
        	<label id ="elblalert1" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add3"class="btn btn-outline btn-primary" ><span class="fa fa-send"></span> Send</button>
		</td>
		<td width="10">
		</td>
		<td>
          <button type="button" id="exit1"class="btn btn-outline btn-primary" data-dismiss="modal">Exit</button>
          </td>
		</tr>
		</table>
		
        </div>
	
      </div>
    
    </div>
  </div>
    <!-- jQuery -->
    <div class="modal fade" id="myModal3" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Emails</h4>
        </div>

        <div class="modal-body" align="center">		
        	
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2" style="font-size: 85%;">
                                <thead>
                                  
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
        </div>
        <div class="modal-footer" >
		
        	<label id ="elblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add4"class="btn btn-outline btn-primary" > Select</button>
		</td>
		<td width="10">
		</td>
		<td>
          <button type="button" id="exit1"class="btn btn-outline btn-primary" data-dismiss="modal">Exit</button>
          </td>
		</tr>
		</table>
		
        </div>
	
      </div>
    
    </div>
  </div>
 </div> 

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
	<script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Bootstrap Core JavaScript -->
	
	<!-- FullCalendar -->
	
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script src="../../dist/js/sb-admin-2.js"></script>
<script src="../../select2/dist/js/select2.js"></script>
<script src="../../select2/dist/js/i18n/it.js"></script>
<script src="../../select2/dist/js/i18n/nl.js"></script>
<script>
var ID=0;
$("#add3").click(function(){
	ID=$('#id').val();
	subject=$('#subject').val();
		description=$('#description').val();
		email=$('#email').val();
		if(subject=='' || description=='' || email=='')
		document.getElementById("elblalert1").style.visibility='visible';
		else{
			
		 $.ajax({
		  type: 'POST',
		  url: "../../ws/ws_sendscheduleemail.php",
		  data: ({id:ID,subject:subject,description:description,email:email}),
		  
		  dataType: 'json',
		  timeout: 5000,
		  success: function(data, textStatus, xhr) 
		  {
			 
					if(data==1)
					alert("Client doesn't have any email !");
				else if(data==0)
				alert("Error while sending please try again !");
				else if(data==2){
				alert("Email Sent !");
				 $('#myModal1').modal('hide');

			}
				
			
		  },
		  error: function(xhr, status, errorThrown) 
		  {
			alert("Error !");
			$('#myModal1').modal('hide');
		  }
	  });
	 }
});
	
	$(document).on('click',"[id='sent']",function(){
	
if(document.getElementById('sent').checked==true)
$('#myModal1').modal('show');
});
$("#myModal1").on('shown.bs.modal', function () {
	
document.getElementById("elblalert1").style.visibility='hidden';
$.ajax({
		 type: 'GET',
		 url: "../../ws/ws_ptext.php",
		 data: ({project:$('#eoffer').val(),client:$('#eclient').val()}),			  
		 dataType: 'json',
		 timeout: 5000,
		 success: function(data, textStatus, xhr) 
		
		 {
			 descrption=data[0]['Description'].replace('#date#',$('#estart').val()+' '+$('#estarttime').val());
		 document.getElementById("description").value =descrption;
		 document.getElementById('email').value=data[0]['email'];

		 },
		 
		 error: function(xhr, status, errorThrown) 
		 {
		 
			 //  $("#LoaDingImage").hide();
			alert(status + errorThrown);
			 
		 }
	 }); 
	 ID=$('#id').val();
 checkcheckbox(ID);
});
function checkcheckbox(serial) {
	
	$.ajax({
		 type: 'GET',
		 url: "../../ws/ws_getemailstocheck.php",
		 data: ({schedule:serial}),			  
		 dataType: 'json',
		 timeout: 5000,
		 success: function(data, textStatus, xhr) 
		
		 {
		 document.getElementById("email").value = data[0]["emails"];
			  
		 },
		 
		 error: function(xhr, status, errorThrown) 
		 {
		 
			 //  $("#LoadingImage").hide();
			alert(status + errorThrown);
			 
		 }
	 }); 
   


}
$("#ModalAdd").on('hidden.bs.modal', function (e) {
	
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
$("#ModalAdd").on('shown.bs.modal', function () {
document.getElementById("title").value='Regular Maintenance visit';

});
$("#offer").change(function(){
	$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offers.php",
			  data: ({id:$("#offer").val()}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			 
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  document.getElementById('client').value=data[0]['CustomerID'];
							  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
});
$("#ModalEdit").on('hidden.bs.modal', function (e) {

  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
	$(document).ready(function() {
		var error=false;
		var status=0;

$(document).on('click',"[id='savee']",function(){
	//alert("hi");

	var answer =true;
			if(document.getElementById('deletee').checked==true)
				{	del=1;
				
    				if (answer)
					{$('#calendar').fullCalendar('removeEvents',$('#ModalEdit #id').val());}
				}
				else
				{del=0;}
				if(answer){
			ID=	$('#ModalEdit #id').val();
			start1=$('#ModalEdit #estart').val();
			end1=$('#ModalEdit #estart').val();
		
			title1=$('#ModalEdit #etitle').val();
			color1=$('#ModalEdit #ecolor').val();
			starttime1=$('#ModalEdit #estarttime').val();
		
			endtime1=addTimes(starttime1,'00:30:00');
			client=$('#ModalEdit #eclient').val();
			notes=$('#ModalEdit #enotes').val();
			offer=$('#ModalEdit #eoffer').val();
			if(document.getElementById('sent').checked==true)
			sent=1;
			else
			sent=0;
			if(document.getElementById('all').checked==true)
				{	all=1;
			}
			else{all=0;}
			
		/*	if((start1==end1 && starttime1.substring(0,5)>=endtime1.substring(0,5)) || start1>end1 )
			{
				alert("Start and End date must be different");
			}*/
		
				//alert("del "+del+"ID "+ID+"start "+start1+"end "+end1+"title "+title+"color "+color+"starttime "+starttime1+"endtime "+endtime1+"client "+client);
				 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tappointment.php",
			  data: ({action:3,serial :ID,offer:offer,notes:notes,all:all,del:del,start:start1,end:end1,title:title1,color:color1,starttime:starttime1,endtime:endtime1,client:client}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			  	
				  if(data==-1)
				  	alert("There is a Booking at the same time");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	if(del==0){
  				  	$('#calendar').fullCalendar('removeEvents',$('#ModalEdit #id').val());
  				  	start1=$('#ModalEdit #estart').val()+" "+$('#ModalEdit #estarttime').val();
  				  	end1=$('#ModalEdit #estart').val()+" "+endtime1;
						
						ttl="";
					ttl+=$("#ModalEdit #eoffer option:selected").text() ;
					ttl+=" - "+title1 +" - "+notes;
					
		var events={id:ID ,title:ttl,titlee:title1,start:start1,color:color1,end:end1,client:client,notes:notes,offer:offer};
  				  	$('#calendar').fullCalendar('renderEvent',events,true);
}
  				  	$('#ModalEdit').modal('hide');
  				  	if(all==1){location.reload();}
  				  //	alert("Update");	
				  }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {

			  }
			  
		  }); }	
			
		});
		function addTimes (startTime, endTime) {
  var times = [ 0, 0, 0 ]
  var max = times.length

  var a = (startTime || '').split(':')
  var b = (endTime || '').split(':')

  // normalize time values
  for (var i = 0; i < max; i++) {
    a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
    b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
  }

  // store time values
  for (var i = 0; i < max; i++) {
    times[i] = a[i] + b[i]
  }

  var hours = times[0]
  var minutes = times[1]
  var seconds = times[2]

  if (seconds >= 60) {
    var m = (seconds / 60) << 0
    minutes += m
    seconds -= 60 * m
  }

  if (minutes >= 60) {
    var h = (minutes / 60) << 0
    hours += h
    minutes -= 60 * h
  }

  return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2)
}
//=================================================================================================
$(document).on('click',"[id^='Save']",function(){
			start1=$('#ModalAdd #start').val();
			end1=$('#ModalAdd #start').val();
			title1=$('#title').val();
			color1=$('#color').val();
			starttime1=$('#ModalAdd #starttime').val();
		
			endtime1=addTimes(starttime1,'00:30:00');
			client=$('#ModalAdd #client').val();
			notes=$('#ModalAdd #notes').val();
			offer=$('#ModalAdd #offer').val();
			
			repeat=$('#ModalAdd #repeat').val();
	/*		if((start1==end1 && starttime1.substring(0,5)>=endtime1.substring(0,5)) || start1>end1)
			{
				alert("Start and End date must be different");
			}*/
				
				
					//alert("start "+start1+"end "+end1+"title "+title1+"color "+color1+"starttime "+starttime1+"endtime "+endtime1+"client "+client);
				 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tappointment.php",
			  data: ({action:1,offer:offer,notes:notes,start:start1,end:end1,title:title1,color:color1,starttime:starttime1,endtime:endtime1,client:client,repeat:repeat}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			  
				  if(data==-1)
				  		alert("There is a Booking at the same time");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	start1=$('#ModalAdd #start').val()+" "+$('#ModalAdd #starttime').val();
  				  	end1=$('#ModalAdd #start').val()+" "+endtime1;
  				  	color=$('#ModalAdd #color').val();
  				  	offer=$('#ModalAdd #offer').val();
					ttl="";
					ttl+=$("#ModalAdd #offer option:selected").text() ;
				ttl+=" - "+title1 +" - "+notes;
				
					
  				  	var events={id:data ,title:ttl,titlee: title1,start:start1,end:end1,client:client,color:color,notes:notes,offer:offer};
  				  	$('#calendar').fullCalendar('renderEvent',events,true);

  				  	$('#ModalAdd').modal('hide');
  				  	if(repeat!=''){location.reload();}
  				  //	alert("Update");	
				  }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {

			  }
			  
		  }); 
			
		});



////////////////////////////////////////////////////////////
var start;
		$('#calendar').fullCalendar({
			defaultView: 'month',
			defaultDate: Date.now(),
			editable: true,
			selectable: true,
			eventLimit: true,
            allDaySlot: false,	
minTime: "07:00:00",
maxTime: "24:00:00",
slotDuration: '01:00:00',			// allow "more" link when too many events
			schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaDay,agendaTwoDay,agendaWeek,month,listWeek'
			},
			views: {
				agendaTwoDay: {
					type: 'agenda',
					duration: { days: 2},

					// views that are more than a day will NOT do this behavior by default
					// so, we need to explicitly enable it
					groupByResource: true

					//// uncomment this line to group by day FIRST with resources underneath
					//groupByDateAndResource: true
				},
				day: { // name of view
            titleFormat: 'dddd,MMMM D,YYYY'
            // other view-specific options here
        }
			},

			//// uncomment this line to hide the all-day slot
			//allDaySlot: false,

		
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
				$title="";
				$title=$title.$event['projectname'];
				$title=$title." - ".$event['title'];
			?>
				{
					id: <?php echo $event['id']; ?>,
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					title: '<?php echo $title;?>',
					titlee: '<?php echo $event['title'];?>',
					client: '<?php echo $event['clientid'];?>',
					color: '<?php echo $event['color'];?>',
					notes: '<?php echo $event['notes'];?>',
					offer: '<?php echo $event['offer'];?>',
					allDay: false,
					
					
				},
			<?php endforeach; ?>
			],	

			select: function(start, end, jsEvent, view, resource) {
					$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
				$('#ModalAdd #endtime').val(moment(end).format('HH:mm:ss'));
				$('#ModalAdd #starttime').val(moment(start).format('HH:mm:ss'));
				
				ace=<?php echo($_SESSION['ace']); ?>;
				if (ace==1){
				$('#ModalAdd').modal('show');}
			},
			dayClick: function(date, jsEvent, view, resource) {
			$('#ModalAdd #start').val(moment(date).format('YYYY-MM-DD'));
				$('#ModalAdd #end').val(moment(date).format('YYYY-MM-DD'));
				$('#ModalAdd #endtime').val(moment(date).format('HH:mm:ss'));
				$('#ModalAdd #starttime').val(moment(date).format('HH:mm:ss'));
				//$('#ModalAdd #resource').val(resource.id);
					
				ace=<?php echo($_SESSION['ace']); ?>;
				if (ace==1){
				$('#ModalAdd').modal('show');}
				
			},
			 eventDragStart: function(event) {
     	start=new Date(event.start.format('YYYY-MM-DD HH:mm:ss'));
   },
			eventDrop: function(event, delta, revertFunc) {
			isadmin=<?php echo($_SESSION['IsAdmin']); ?>;
					ace=<?php echo($_SESSION['ace']); ?>;
				var today = new Date();
				if(isadmin==1 || (today.getTime()<=start.getTime() && ace==1)){
						start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: '../../calendar/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						
						
					}else if(rep == 'Double'){
							revertFunc();	
					}else{
						
					alert('error'); 
				
					}
				}
			});
			}
				else{
				revertFunc();}
},
			eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) { // si changement de longueur
	            isadmin=<?php echo($_SESSION['IsAdmin']); ?>;
		        ace=<?php echo($_SESSION['ace']); ?>;
				var today = new Date();
				var startt=new Date(event.start.format('YYYY-MM-DD HH:mm:ss'));
				if(isadmin==1 || (today.getTime()<=startt.getTime() && ace==1)){
							start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: '../calendar/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						
						
					}else if(rep == 'Double'){
							revertFunc();	
					}else{
						
					alert('error'); 
				
					}
				}
			});
				}
				else{
				revertFunc();
				}
			},
			viewRender: function(view, element){
        var currentdate = view.intervalStart;
        $('#datepicker').datepicker().datepicker('setDate', new Date(currentdate));
		
		
    },
			eventRender: function(event, element) {
				
				element.bind('click', function() {
				
				$('#ModalEdit #id').val(event.id);
				$('#ModalEdit #etitle').val(event.titlee);
				$('#ModalEdit #estart').val(event.start.format('YYYY-MM-DD'));
				$('#ModalEdit #estarttime').val(event.start.format('HH:mm:ss'));
				$('#ModalEdit #eend').val(event.end.format('YYYY-MM-DD'));
				$('#ModalEdit #eendtime').val(event.end.format('HH:mm:ss'));
				$('#ModalEdit #eclient').val(event.client);
				$("#eclient").val(event.client).trigger("change");
				$('#ModalEdit #ecolor').val(event.color);
				if(event.sent==1)
				document.getElementById('sent').checked=true;
				else
				document.getElementById('sent').checked=false;
				$('#ModalEdit #enotes').val(event.notes);
				$("#ModalEdit #eoffer").val(event.offer).trigger("change");
				$('#ModalEdit #eoffer').val(event.offer);
					isadmin=<?php echo($_SESSION['IsAdmin']); ?>;
					ace=<?php echo($_SESSION['ace']); ?>;
					acd=<?php echo($_SESSION['acd']); ?>;
				
					$('#ModalEdit').modal('show');
				});
			}
		});
				function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: '../calendar/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
					
						
					}else if(rep == 'Double'){
								
					}else{
						
					alert('error'); 
				
					}
				}
			});
			
		}
$('#datepicker').datepicker()
    .on("input change", function (e) {
		$('#calendar').fullCalendar( 'gotoDate',new Date(e.target.value) )
});
function filltotals() {
	$("#side-menu1").html("");
        var calendar = $('#calendar').fullCalendar('getCalendar');
        var view = calendar.view;
        var start = view.start._d;
        var end = view.end._d;
		start = start.getFullYear()+'-'+(start.getMonth() + 1) + '-' + start.getDate() ;
		end = end.getFullYear()+'-'+(end.getMonth() + 1) + '-' + end.getDate() ;
       		  $.ajax({
			  type: 'GET',
			  url: "../ws/ws_totals1.php",
			  data: ({start:start,end:end}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  h=0;
				  h1=0;
				  $.each(data, function(i, item) {
					  h+=Number(item.hours);
					   h1+=Number(item.hourss);
					   style='';
					   if (item.onn==1){style="style='background-color:lightgreen;'";}
					 var quotient = Math.floor( Number(item.hours)/60);
var remainder =  Number(item.hours)%60;
	 var quotientt = Math.floor( Number(item.hourss)/60);
var remainderr =  Number(item.hourss)%60;
					  $("#side-menu1").append("<li "+style+"><a >"+item.Name + "  </br> " +  Number(quotient) +" hrs "+remainder+" mins / " +Number(quotientt) +" hrs "+remainderr+" mins</a></li>");	
				  });
				   var quotient = Math.floor( Number(h)/60);
var remainder =  Number(h)%60;
	 var quotientt = Math.floor( Number(h1)/60);
var remainderr =  Number(h1)%60;
				   $("#side-menu1").append("<li><a >Total </br>" +  Number(quotient) +" hrs "+remainder+" mins / " +Number(quotientt) +" hrs "+remainderr+" mins</a></li>");	
				      var quotient = Math.floor( Number(data[0]["can"])/60);
var remainder =  Number(data[0]["can"])%60;
				   $("#side-menu1").append("<li><a >Cancelled : " +  Number(quotient) +" hrs "+remainder+" mins </a></li>");	
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
    }
	});
	
	
	$("#offer").select2({
    
    dropdownParent: $("#ModalAdd")
});
	$("#eoffer").select2({
    
    dropdownParent: $("#ModalEdit")
});
</script>
</div>	 
    <script src="../js/appointments.js"></script>
</body>

</html>
