<?php error_reporting(0); ?>
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
    <link rel="stylesheet" href="../../select2/dist/css/select2.css">

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
								}
								if($_SESSION['ncv']!=1){
									header("Location: ../Blank");
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

                 <?php include("../menu.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                	
                    <h1 class="page-header">Notifications</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					<form method="post">
						<div class="row">
							 <div class="col-lg-2">
					<label>Type</label><select  class="form-control" id="type" name="type" style="width: 100%;" >
											
											<option value="All" <?php if(isset ($_POST['type'])){if ($_POST['type']=='All') echo ("selected");}?>>All</option>
											<option value="Reminder" <?php if(isset ($_POST['type'])){if ($_POST['type']=='Reminder') echo ("selected");}?>>Reminder</option>
											<option value="Notification" <?php if(isset ($_POST['type'])){if ($_POST['type']=='Notification') echo ("selected");}?>>Notification</option>
											<?php if($_SESSION['comcv']==1){ ?>
											<option value="Complaint" <?php if(isset ($_POST['type'])){if ($_POST['type']=='Complaint') echo ("selected");}?>>Complaint</option>
											<?php }?>
											</select>
										</div>
						 <div class="col-lg-2">
					<label>Status</label><select  class="form-control" id="status" name="status" style="width: 100%;" >
											
											<option value="Pending" <?php if(isset ($_POST['status'])){if ($_POST['status']=='Pending') echo ("selected");}?>>Pending</option>
											<option value="Confirmed" <?php if(isset ($_POST['status'])){if ($_POST['status']=='Confirmed') echo ("selected");}?>>Confirmed</option>
											<option value="Done" <?php if(isset ($_POST['status'])){if ($_POST['status']=='Done') echo ("selected");}?>>Done</option>
											<option value="All" <?php if(isset ($_POST['status'])){if ($_POST['status']=='All') echo ("selected");}?>>All</option>
											</select>
										</div>
										 <div class="col-lg-3">
                               <label>From Date</label>
						<input class="form-control" type="date"   name="fromdate"  id="fromdate"  value="<?php
								if (isset($_POST['fromdate'])) {echo($_POST['fromdate']);
								}
							?>" >
						</div>
					
						<div class="col-lg-3" >
							<label>To Date</label><input class="form-control" type="date"   name="todate"  id="todate"   value="<?php
								if (isset($_POST['todate'])) {echo($_POST['todate']);
								}
							?>">
							
                              </div>
                              <div class="col-lg-1">
										 <br>
											<button type="button" id="search" class="btn btn-outline btn-primary" onclick="this.form.submit()">Search</button>
										</div>
										 <div class="col-lg-1">
										 <br>
											<button type="button" id="Add_<?php echo($_SESSION['UserSerial']); ?>" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['nce']!=1){ echo('disabled'); }?> >Add</button>
										</div>
										
						
					 </div>
						</form>	   
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Type</th>
										  <th>Subject</th>
                                          <th>Project</th>
										    <th>Description</th>
										    
                                       <?php if($_SESSION['nce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['ncd']==1){?>      <th>Delete</th> <?php }?>
									   <th>Seen</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								
include('../configdb.php');
$status="";
if(isset($_POST['status'])){
if($_POST['status']=='Confirmed'){
$status=" and confirm=1 ";}
else if($_POST['status']=='Done'){
	$status=" and done=1 ";
}
else if($_POST['status']=='Pending'){
	$status=" and confirm=0 ";
}
}
else {
	$status=" and confirm=0 ";
}
if(isset($_POST['fromdate']) && $_POST['fromdate']!='')
$fromdate=" and duedate >='".$_POST['fromdate']."'";
else {
	$fromdate='';
}
if(isset($_POST['todate']) && $_POST['todate']!='')
$todate=" and duedate <='".$_POST['todate']."'";
else {
	$todate='';
}

if(isset($_POST['type']) && $_POST['type']!='All'){
	if($_POST['type']=='Complaint')
	$type=" and complaint =1 and isnotification=1";
	else if($_POST['type']=='Notification')
	$type=" and isnotification =1 and complaint =0";
	else 
	$type=" and isnotification =0";	
}
else {
	$type='';
}
 date_default_timezone_set('Asia/Beirut');
 $date= date('Y-m-d') ;
if($_SESSION['comcv']==1){
	$query = "Select *,(select fullname from users where serial=notification.employee) as toemployee,
                       (select fullname from users where serial=notification.userid) as fromemployee, 
                       (select ProjectName from offers where serial=notification.offerid)as projectname    
From notification where  ((userid=".$_SESSION['UserSerial']." or employee=".$_SESSION['UserSerial']." or viewer=".$_SESSION['UserSerial']." or viewer like '".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial']."') ".$status."$fromdate $todate) $type order by duedate asc,seen asc";

}
else{
$query = "Select *,(select fullname from users where serial=notification.employee) as toemployee,
                   (select fullname from users where serial=notification.userid) as fromemployee,
                   (select ProjectName from offers where serial=notification.offerid)as projectname    
From notification where ((userid=".$_SESSION['UserSerial']." or employee=".$_SESSION['UserSerial']."  or viewer=".$_SESSION['UserSerial']." or viewer like '".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial'].",%' or viewer like '%,".$_SESSION['UserSerial']."')".$status." $fromdate $todate) and complaint=0 $type order by duedate asc,seen asc";
}
 
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
                                    <tr class="odd gradeX"  <?php if($_SESSION['comcv']==1){ if($x['complaint']==1 && $x['seen']==0){ ?>style="background-color: lightgreen;" <?php }} else if($x['employee']==$_SESSION['UserSerial'] && $x['seen']==0 && $x['isnotification']==1){?> style="background-color: lightgreen;" <?php } else if($x['employee']==$_SESSION['UserSerial'] && $x['seen']==0 && $x['isnotification']==0){?>
                                    	style="background-color: #ff6666;"<?php } else if(strpos($_SESSION['UserSerial'], $x['viewer']) != false){?>
                                    		style="background-color: lightblue;"<?php }?>>
                                        <td><?php echo date("d-m-Y", strtotime($x["dat"]));?></td>
										 <td <?php if($x['duedate'] < $date){?> style="color: red" <?php }?> ><?php if($x['duedate'] < $date){?> <span class="fa fa-star"></span> <?php }?> <?php echo date("d-m-Y", strtotime($x["duedate"]));?></td>
                                         
										 <td><?php echo($x["fromemployee"]);?></td>
										 <td><?php echo($x["toemployee"]);?></td>
										 <td><?php if($_SESSION['comcv']==1){ if($x['complaint']==1){echo("Complaint");}else{ if($x['isnotification']==1 && $x['complaint']==0){echo("Notification");} else {echo("Reminder");}}} else{ if($x['isnotification']==1 && $x['complaint']==0)echo("Notification"); else echo("Reminder");}?></td>
										  <?php if($_SESSION['comcv']==1){ 
										  		if($x['complaint']==1){?>
										  	<td><?php echo($x["subject"]. " ");?>
										  		<?php 
                                        $i=0;
										for($i=0;$i<5;$i++)
                                        {	if($i<$x['rate'])
										{?>
											<span style="color: yellow;" class='glyphicon glyphicon-star'></span>&nbsp;
                                        	<?php } else { ?>
                                        		<span class='glyphicon glyphicon-star-empty'></span>&nbsp;
                                        	<?php }}
                                        ?>
										  	</td>
										  	<?php }else{?>
										  		<td><?php echo($x["subject"]);?></td>
										  		<?php }} else {?>
										  <td><?php echo($x["subject"]);?></td>
										  <?php }?>
                                          <td><?php echo $x['projectname']; ?></td>
										   <td><?php echo($x["description"]);?></td>
        
                              
                                                                      <?php if($_SESSION['nce']==1){if($_SESSION['UserSerial']==$x['userid'] || $_SESSION['UserSerial']==$x['employee']){ 
?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>,<?php echo($_SESSION['UserSerial']);?>,<?php echo($x['serial']);?>,<?php echo($x['employee']);?>,<?php echo($x['seen']);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>

<?php } else {?>
<td class="center">
<p class="fa fa-edit"></p> Edit
</td>
<?php }}?>
<?php if($_SESSION['ncd']==1){if($_SESSION['UserSerial']==$x['userid'] || $_SESSION['UserSerial']==$x['employee']){?>
<td class="center"><a href="" id="del_<?php echo($x["serial"]);?>"   <?php if($_SESSION['ncd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php } else {?>
<td class="center">
<p class="fa fa-edit"></p> Delete
</td>
<?php }}?>
<?php if ($x['seen']==1 && $x['done']==1){?>
	<td class="center" <?php if($x['employee']==$_SESSION['UserSerial'] && $x['seen']==0){?> id="Col_<?php echo($x["serial"]);?> <?php }?>"><p style="color: blue;" class="fa fa-check"></p><p style="color: blue;" class="fa fa-check"></p></td>
	<?php } else if($x['done']==1) {?>
		<td class="center" <?php if($x['employee']==$_SESSION['UserSerial'] && $x['seen']==0){?> id="Col_<?php echo($x["serial"]);?> <?php }?>"><p style="color: blue;" class="fa fa-check"></p><p style="color: blue;" class="fa fa-check"></p></td>
	<?php } else if($x['seen']==1) {?>
		<td class="center" <?php if($x['employee']==$_SESSION['UserSerial'] && $x['seen']==0){?> id="Col_<?php echo($x["serial"]);?> <?php }?>"><p class="fa fa-check" ></p><p class="fa fa-check"></p></td>
		<?php } else{ ?>
			<td class="center" <?php if($_SESSION['comcv']==1){ if($x['complaint']==1){?>id="Col_<?php echo($x["serial"]);}}?><?php  if($x['employee']==$_SESSION['UserSerial'] && $x['seen']==0){?> id="Col_<?php echo($x["serial"]);?> <?php }?>"><p class="fa fa-check" id="asd"></p></td>
			<?php }?>
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
     <script src="../../select2/dist/js/select2.js"></script>
<script src="../../select2/dist/js/i18n/it.js"></script>
<script src="../../select2/dist/js/i18n/nl.js"></script>
	
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
				 "aaSorting":true,
        });
         $("#offer").select2();
    });
   
    </script>

	  <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
    
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>
        <div class="modal-body" align="center">
        	<table>
        		<tr>
        			<td>
        				<div> <input type="radio" name="type" id="notification" value="notification" checked> Notification</td></div>
        			<td> &nbsp;&nbsp;</td>
        			<td> <input type="radio" name="type" id="reminder" value="reminder"> Reminder</td>
        		</tr>
        	</table>
     	
 
		<label>Date</label><input class="form-control" type="date"   name="dat"  id="dat" style="width:100%;" >
		<label>Due Date</label><input class="form-control" type="date"   name="duedate"  id="duedate" style="width:100%;" required>
		<label>Offer</label><select class="form-control" id="offer" style="width: 100%; text-align: right;" required>
			<?php
								
include('../configdb.php');
$query = "Select * From offers order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["Serial"];?>"><?php echo $x["ProjectName"]; ?></option>
	<?php }?>
		</select>
			<label>Employee</label><?php	$query = "Select * From users";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
			 	 			<select class="form-control" id="employee" style="width: 100%; ">
	 
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
		</select>
		<label>Subject</label><input class="form-control" type="text"   name="subject"  id="subject" style="width:100%;" required>
		<label>Description</label><textarea class="form-control" type="text"   name="description"  id="description" style="width:100%;" rows="2"></textarea>
	
		<label>Viewer</label><?php	$query = "Select * From users";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
			 	 			<select class="form-control" id="viewer" style="width: 100%; " multiple>
	 
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
		</select>
        <label>
                                        <input type="checkbox" id="done" value="done">Done
                                    </label>
                                    &nbsp;
                                    <label>
                                        <input type="checkbox" id="confirm" value="done">Confirm
                                    </label>
        </div>
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

  
<script src="../../js/notification.js"></script>

</body>

</html>
