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
	<link rel="stylesheet" href="../../dist/css/jquery.ui.all.css">
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
  session_start();
  
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
									echo "<script>location='../Login'</script>";
								}
								if($_SESSION['tcv']!=1){
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
                	
                    <h1 class="page-header">Tasks</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="center">
							<table><tr>
								
						<form method="post">
							
						
								<td>&nbsp;<label>Status</label></td><td> &nbsp;</td><td><select  class="form-control" id="status1" name="status1" style="width: 100%;" onchange="this.form.submit()">
											<option value="0">All</option>
											<?php 
											include('../configdb.php');
											$status1="";
										$query="select * from taskstatus";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["serial"]); ?>" <?php if(isset ($_POST['status1'])){if ($_POST['status1']==$x['serial']) echo ("selected");}else if($x['default1']==1){$status1=$x['serial']; echo("selected"); }?>><?php echo($x["description"]); ?></option>
											<?php } ?>
											</select>
										</td><td> &nbsp;</td>
											<td> &nbsp;</td>
						<td>
						From Date
						</td>
							<td> &nbsp;</td>
						<td><input class="form-control" type="date"   name="fromdate"  id="fromdate" onchange="this.form.submit()" value="<?php if(isset($_POST['fromdate'])) {echo($_POST['fromdate']);}?>" ></td>
							<td> &nbsp;</td>
						<td>To Date </td><td><input class="form-control" type="date"   name="todate"  id="todate"  onchange="this.form.submit()" value="<?php if(isset($_POST['todate'])) {echo($_POST['todate']);}?>"> </td>
						</form>
						<td><button type="button" id="ADD" class="btn btn-outline btn-primary"   data-toggle="modal" data-target="#myModal1" <?php if($_SESSION['tce']!=1){ echo('disabled'); }?> >Add Task</button></td>
						</tr>
						</table>
							<!--   <button type="button" id="Add_<?php echo($_SESSION['UserSerial']); ?>" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['uce']!=1){ echo('disabled'); }?> >Add</button>-->
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" data-page-length='50' id="dataTables-example">
                                <thead>
                                    <tr>
                                    	 <th>Client</th>
                                    	 <th>Offer</th>
                                    	 
                                    	
                                    	  <th>Task Status</th>
                                        <th>Date</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Description</th>
                                        
										     <th>Attachments</th>
										    
                                       <?php if($_SESSION['tce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['tcd']==1){?>      <th>Delete</th> <?php }?>
									   <th>Seen</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
$status=$status1;								
include('../configdb.php');

if(isset($_POST['fromdate']))
$fromdate=$_POST['fromdate'];
else {
	$fromdate='';
}
if(isset($_POST['todate']))
$todate=$_POST['todate'];
else {
	$todate='';
}
if(isset($_POST['status1'])){
if($_POST['status1']!=0){
$status=" and taskstatus=".$_POST['status1']." ";}
else {
	$status=$status1;
	echo $status;
}
}
else{
	$status=" and taskstatus=".$status1." ";
}
if(isset($_POST['department1']))
{
	if($_POST['department1']!=0)
$department=" and department =".$_POST['department1']." ";
else {
	$department='';
}
}
else {
	$department='';
}
if($_SESSION['IsAdmin']==0)
	$query1="and (userid=".$_SESSION['UserSerial']." or toemployee=".$_SESSION['UserSerial']." or viewer like '%".$_SESSION['UserSerial']."%') order by seen asc";
else {
	$query1=" order by seen asc";
}
$query = "Select *,(select ProjectName from offers where Serial=tasks.offerid) as ProjectName,
(select status from offers where Serial=tasks.offerid) as Status, 
(select Fullname from users where serial=tasks.userid) as fromemployee,
(select count(*) from taskattachments where taskid=tasks.serial and save=1) as attcnt,
(select count(*) from taskfollowup where taskid=tasks.serial) as followup,
(select description from taskstatus where serial=tasks.taskstatus) as taskstatusN,
(select color from taskstatus where serial=tasks.taskstatus) as taskstausC,
(select company from customers where serial in (select customerid from offers where serial=tasks.offerid)) as client,
(select Fullname from users where serial=tasks.toemployee) as tooemployee   
From tasks where serial<> 0 ";
if($fromdate!=''){ $query =$query." and dat>='$fromdate'"; }
  if($todate!=''){ $query =$query." and dat<='$todate'"; }
  if($status!=''){$query =$query.$status;}
   if($department!=''){$query =$query.$department;}
  if(isset($_GET['z']))
$query=$query." and offerid=".$_GET['z'];
$query=$query.$query1;

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
                             
											
                                    		<tr id="TR_<?php echo $x['serial'];?>" class="odd gradeX"  style="background-color: <?php echo ($x['taskstausC']); ?>">
                                    			
                         
                                    
                                   <td><?php echo($x["client"]);?></td>
                                    	<td><?php echo($x["ProjectName"]);?></td>
                                    	
                                    	
                                    	<td id="tdstatus_<?php echo $x['serial'];?>"><?php echo($x["taskstatusN"]);?></td>
                                        <td><?php echo date("d-m-Y", strtotime($x["dat"]));?></td>
										 <td><?php echo($x["fromemployee"]);?></td>
										 <td><?php echo($x["tooemployee"]);?></td>
										   <td><?php echo($x["description"]);?></td>
										  
        	<td> <a  href ="attachments.php?x=<?php echo($x["serial"]);?>" target="_blank"  ><?php echo($x["attcnt"]);?> </a></td>
                                <!--  <td> <a  href ="followup.php?x=<?php echo($x["serial"]);?>" target="_blank"  ><?php echo($x["followup"]);?> </a></td> -->
                              
                                                                      <?php if($_SESSION['tce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>,<?php echo($x['offerid']); if($x['userid']==$_SESSION['UserSerial']){ echo(",1");} else if($x['toemployee']==$_SESSION['UserSerial']){echo (",0");} else if($_SESSION['IsAdmin']==1) echo(",0");?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['tcd']==1){?>
	<?php if($_SESSION['UserSerial']==$x['userid']){?>
<td class="center"><a  id="del_<?php echo($x["serial"]);?>"   <?php if($_SESSION['tcd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php } else {?>
<td class="center"><p class="fa fa-trash-o"></p> Delete</td>
<?php }}  ?>

	<?php  if ($x["done"]==1){
										?>
										<td class="center" data-toggle="tooltip" data-placement="top" title="<?php echo("Sent to : ");
                                    $str=explode(",",$x["viewer"]);
											if (count($str) >=1)
											{
												
												for($i=0;$i<count($str);$i++)
												{
														$query = "Select fullname from users where serial=".$str[$i];
														$result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
													while($y = mysqli_fetch_array($result)){
													echo($y["fullname"]." - ");
													}
												}
											}
                                    ?>"><p style="color: blue;" class="fa fa-check"></p><p style="color: blue;" class="fa fa-check"></p></td>
									<?php }
									else if($x["seen"]==0){ ?>
									<td class="center" data-toggle="tooltip" data-placement="top" title="<?php echo("Sent to : ");
                                    $str=explode(",",$x["viewer"]);
											if (count($str) >=1)
											{
												
												for($i=0;$i<count($str);$i++)
												{
														$query = "Select Fullname from users where serial=".$str[$i];
														$result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
													while($y = mysqli_fetch_array($result)){
													echo($y["Fullname"]." - ");
													}
												}
											}
                                    ?>"><p class="fa fa-check" <?php if($x['toemployee']==$_SESSION['UserSerial']){?> id="Col_<?php echo($x["serial"]);?> <?php }?>"></p></td>
									<?php } else{ ?>
										<td class="center" data-toggle="tooltip" data-placement="top" title="<?php echo("Sent to : ");
                                    $str=explode(",",$x["viewer"]);
											if (count($str) >=1)
											{
												
												for($i=0;$i<count($str);$i++)
												{
														$query = "Select fullname from users where serial=".$str[$i];
														$result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
													while($y = mysqli_fetch_array($result)){
													echo($y["fullname"]." - ");
													}
												}
											}
                                    ?>"><p class="fa fa-check"></p><p class="fa fa-check"></p></td>
										<?php }	?>
									
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

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
    
	
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
				"stateSave": true
        });
    });
    </script>

	  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" >
   
      <!-- Modal content-->
      <div class="modal-content"  >
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="center">		
		 
		<label>Subject</label><input class="form-control" type="text"   name="subject"  id="subject" style="width:100%;" />
	


Employee<select class="form-control" id="employee" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
		$query = "Select * From users";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?></select>
		
		
			Viewer <select class="form-control" id="viewer" style="width: 100%; " multiple="multiple">
		
				<?php mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
			
	</select>
			Status<select class="form-control" id="taskstatus" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
		$query = "Select * From taskstatus";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['serial']); ?>" ><?php echo($x['description']); ?></option>
 <?php 
}?></select>
		Notes<textarea class="form-control" name="description" id="description" style="width: 100%;"  rows="2"></textarea>
		
	 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="done" value="design">Done &nbsp;
                                    </label>
                               </div>
	<table style="width: 100%">
		<tr>
			<td align="right"> <button type="button" id="Ad" class="btn btn-outline btn-primary" >Add FollowUp</button></td>
		</tr>
	</table>
	<br>
	<table style="width: 100%;" border="1">
				<thead>
					<th>From Date</th>
					<th>Description</th>
					<th>Status</th>
					<th>Done By</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody id="followup"></tbody>
			</table>
			
        </div>
        <div class="modal-footer" >
		<table>
			<tr>
				<td>
					<label id ="lblalert" style="visibility: hidden; color: red;">Please Choose an Employee</label>
				</td>
				<td>
					<label id ="lblalert1" style="visibility: hidden; color: red;">Must be done !</label>
				</td>
			</tr>
		</table>
        	
		<table align="center"  >
			
		<tr>
			<td width="10">
		</td>
			<td width="10">
		</td>
	
		<td>
	
        <button type="button" id="add1"class="btn btn-outline btn-primary" >Save & Reassign</button>
		</td>
		<td width="10">
		</td>
		<td>
	
        <button type="button" id="add2"class="btn btn-outline btn-primary" >Save</button>
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
   <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog" >
   
      <!-- Modal content-->
      <div class="modal-content"  >
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title1"></h4>
        </div>

        <div class="modal-body" align="center">		
		 	<label>Subject</label><input class="form-control" type="text"   name="subject1"  id="subject1" style="width:100%;" />
		<?php	$query = "Select * From offers order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
	Project	<select class="form-control" id="project" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['ProjectName']); ?></option>
 <?php 
}?>
		</select>	
			<?php	$query = "Select * From maintenances where description <> '' order by description asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
	Maintenance	<select class="form-control" id="maintenance" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Description']); ?></option>
 <?php 
}?>
		</select>	


Employee<select class="form-control" id="employee1" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
		$query = "Select * From users";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?></select>
		
		
			Viewer <select class="form-control" id="viewer1" style="width: 100%; " multiple="multiple">
		
				<?php mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
			
	</select>
			Status<select class="form-control" id="taskstatus1" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
		$query = "Select * From taskstatus";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['serial']); ?>" ><?php echo($x['description']); ?></option>
 <?php 
}?></select>
		Notes<textarea class="form-control" name="description2" id="description2" style="width: 100%;"  rows="2"></textarea>
		
	<table style="width: 100%">
		<tr>
			<td><label id ="lblalert4" style="visibility: hidden; color: red;">Please Save Task before adding follow ups</label></td>
			<td align="right"> <button type="button" id="ad1" class="btn btn-outline btn-primary" >Add FollowUp</button></td>
		</tr>
	</table>
	<br>
	<table style="width: 100%;" border="1">
				<thead>
					<th>Date</th>
					<th>Description</th>
					<th>Status</th>
					<th>Done By</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody id="followup1"></tbody>
			</table>
			
        </div>
        <div class="modal-footer" >
		<table>
			<tr>
				<td>
					<label id ="lblalert3" style="visibility: hidden; color: red;">Please Choose an Employee</label>
				</td>
			</tr>
		</table>
        	
		<table align="center"  >
			
		<tr>
<td>

					<label id ="lblalert5" style="visibility: hidden; color: red;">Task Saved !</label>
				</td>
				<td>&nbsp;</td>
		<td>
	
        <button type="button" id="add3"class="btn btn-outline btn-primary" >Save</button>
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
<div class="modal fade" id="myModal2" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title2"></h4>
        </div>

        <div class="modal-body" align="center">		
	
	<label>From date</label>
					
						<table style="width: 100%;"><tr>
							<td style="width: 80%"><input type="date" name="fromdate1" class="form-control" id="fromdate1"></td>
							<td>&nbsp;</td>
							<td style="width: 20%"><input type="time" name="fromtime1" class="form-control" id="fromtime1" ></td>
						</tr></table>
					  
					<label>To date</label>
					
						<table style="width: 100%;"><tr>
							<td style="width: 80%;"><input type="date" name="todate1" class="form-control" id="todate1" ></td>
							<td>&nbsp;</td>
							<td style="width: 20%;"><input type="time" name="totime1" class="form-control" id="totime1" ></td>
						</tr></table>  
	<label>Description</label><textarea class="form-control" type="text"   name="description1"  id="description1" style="width:100%;" rows="2"></textarea>
	
	
	Follow up Status <select class="form-control" id="status3" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
		$query = "Select * From taskstatus";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['serial']); ?>" ><?php echo($x['description']); ?></option>
 <?php 
}?></select>
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert2" style="visibility: hidden; color: red;">Please Fill Description!</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add4"class="btn btn-outline btn-primary" >Save</button>
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
  
<script src="../../js/tasks.js"></script>

</body>

</html>
