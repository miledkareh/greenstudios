<?php
                          	
                             	 include('configdb.php');
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
									 <?php if( $_SESSION['pencv']==1){ ?>
                                <li>
                                    <a href="../pendingvisits/" class="fa fa-legal">Pending Visits</a>
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
									 <?php if( $_SESSION['pestcv']==1){ ?>
								   <li>
                                    <a href="../pesticide/" class="fa fa-share" >Pesticide</a>
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
							<?php if($_SESSION['vrepcv']==1){ ?>
					 <li>
                            <a href="../Visitreport/"><i class="fa fa-calendar fa-fw"></i> Visit Report Log</a>
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
						
							<?php if($_SESSION['icv']==1 || $_SESSION['igcv']==1 || $_SESSION['iccv']==1 ){ ?>
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

								<?php  if($_SESSION['iccv']==1){ ?>
					 <li>
                            <a href="../Itemscategory/"><i class="fa fa-gears"></i> Items Category</a>
                        </li>
							<?php } ?>
									
									  
								</ul>
                        </li>
						<?php } ?>
						
								<?php if($_SESSION['plcv']==1){ ?>
					 <li>
					 <a href="#"><i class="fa fa-legal fa-fw"></i> Plants<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							<li>
                            		<a href="../Plants/size.php"><i class="fa fa-tree"></i> Plants Size</a>
								</li>
								<li>
                            		<a href="../Plants/"><i class="fa fa-tree"></i> Plants</a>
								</li>
							</ul>
                        </li>
							<?php } ?>

								<?php if($_SESSION['pallcv']==1){ ?>
					 <li>
                            <a href="../palette/"><i class="fa fa-tree"></i> Palette</a>
                        </li>
							<?php } ?>
						
								 <?php if($_SESSION['ccv']==1 || $_SESSION['cccv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-users fa-fw"></i> Contacts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <?php if( $_SESSION['ccv']==1){ ?>
                                <li>
                                    <a href="../Clients/" class="fa fa-users">Contacts</a>
                                </li>
									<?php } ?>
									 <?php if( $_SESSION['cccv']==1){ ?>
								   <li>
                                    <a href="../CClients/" class="fa fa-pencil" >Contacts Colors</a>
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
								<?php  if( $_SESSION['scv']==1){ ?>
								  <li>
                                    <a href="../Services/" ><i class="fa fa-list fa-fw"></i>Services</a>
                                </li>
								<?php }?>
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