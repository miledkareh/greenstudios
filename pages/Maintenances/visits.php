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

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../vendor/fileupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
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
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
								if($_SESSION['mcv']!=1){
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
                
                    <h1 class="page-header"><?php echo $_GET['y'];?> - Visits</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
							   <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['mce']!=1){ echo('disabled'); }?> >Add Visit</button>
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                    	<th>Report Sent</th>
                                        <th>User</th>
                                        <th>Notes</th>
                                        <th>Check in Date</th>
										<th># Of Employees</th>
										<th>Attachs</th>
										<th>Rating</th>
										
										<?php if($_SESSION['mce']==1){?>      <th>Check Out</th> <?php }?>
									
                                           <?php if($_SESSION['mce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['mcd']==1){?>      <th>Delete</th> <?php }?>
                                       <th>Cost</th>
                                       <th>Print</th>
									   <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
echo $query = "select *,(select sum(cost) from visitcost where visitid=maintenancedetails.serial) as cost,(select sent from checkin where visit=maintenancedetails.Serial)as sent1,(select notes from checkin where visit=maintenancedetails.Serial)as Notes,(select checkindate from checkin where visit=maintenancedetails.Serial)as checkindate,(select serial from checkin where visit=maintenancedetails.Serial)as checkinid,(select rate from checkin where visit=maintenancedetails.Serial)as rate,(select checkout from checkin where visit=maintenancedetails.Serial)as checkout,(select checkin from checkin where visit=maintenancedetails.Serial)as checkin,(select FullName from users where serial = maintenancedetails.userid ) as User, (select count(serial) as cnt from maintenanceattachement where maintenancedetailid =maintenancedetails.serial) as Attachs,Employees From maintenancedetails  where maintenanceid=".$_GET['x']." and accepted=1 order by (select checkindate from checkin where visit=maintenancedetails.Serial) desc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >              
                                    	<td><?php if($x['sent1']==1) echo ('<span class="fa fa-check"'); else echo ('<span class="fa fa-times"');?></td>                     	
                                        <td><?php echo($x["User"]);?></td>
										  <td><?php echo($x["Notes"]);?></td>
										  <td><?php echo($x["checkindate"]);?></td>
										  <!--  <td><?php //if($x["Employees"]!=''){if($x["Employees"]!='1'){echo( count(split(',',$x["Employees"])));}else echo '1';} else{echo('0'); }?></td> -->
										  <td></td>
										    <td><a href="./attachments.php?x=<?php echo($x["Serial"]);?>&y=<?php echo($_GET['x']);?>&z=0" ><?php echo($x["Attachs"]);?></a></td>
                                        <td><?php 
                                        $i=0;
										for($i=0;$i<5;$i++)
                                        {	if($i<$x['rate'])
										{?>
											<span style="color: yellow;" class='glyphicon glyphicon-star'></span>&nbsp;
                                        	<?php } else { ?>
                                        		<span class='glyphicon glyphicon-star-empty'></span>&nbsp;
                                        	<?php }}
                                        ?></td>
                                      <?php if($_SESSION['mce']==1){?>
                                      	<?php if($x['checkout']==1){?>
                                      		
<td class="center">
<p class="fa fa-flag-o"></p> Check Out &nbsp; <a  href="#" id="Edit_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal2" ><p class="fa fa-edit"></p> </a>
</td>

<?php } else { ?>
<td class="center">
<a  id="Checkout_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal2" ><p class="fa fa-flag-o"></p> Check Out</a>
</td>
<?php }?>
<td class="center">
<a  id="Edit_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['mcd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["Serial"]);?>"   <?php if($_SESSION['ocd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php }  ?>
<td><a target="_blank" href="./view2.php?x=<?php echo($x['checkinid']);?>" ><span class="fa fa-print"></span> <?php echo round($x['cost'],2);?></a></td>
 <td><a target="_blank" href="./Transaction.php?x=<?php echo($x['checkinid']);?>"><span class="fa fa-print"></span> Print</a></td>
 <td><a target="_blank" id="Email_<?php echo($x['checkinid']);?>" data-toggle="modal" data-target="#myModal1"><span class="fa fa-envelope-o"></span> Email</a></td>
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

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 <script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
 <script src="../../bower_components/dist/sweetalert2.all.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
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
	
   	  	 <?php	$query = "Select *  From users where isemployee=1";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
	Supervisor<select class="form-control" id="supervisor" style="width: 100%; ">
		<?php
		while($x = mysqli_fetch_array($results)){?>
		<option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
		</select>
		Employees
			<select class="form-control" id="employees" name= "employees" style="width: 100%; " size="3" multiple="multiple">
			<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
</select>
Check in Date
					
						<table style="width: 100%;"><tr>
							<td style="width: 80%"><input type="date" name="checkindate" class="form-control" id="checkindate"></td>
							<td>&nbsp;</td>
							<td style="width: 20%"><input type="time" name="checkintime" class="form-control" id="checkintime" ></td>
						</tr></table>


<textarea class="form-control" id="notes" size="3" style="width: 100%; display: none;" ></textarea>
  <input class="form-control" type="text"   name="location"  id="location" style="width:100%; display: none;" required>

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add1"class="btn btn-outline btn-primary" >Check in</button>
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
        	<div class="row" id="taskattdiv">
	<div class="col-lg-12 nopadding" align="center">
		
 		 <div class="file-loading">
            <input id="images" name="images[]" type="file" multiple>
        </div>
    </div>
</div>
        	<label>Client Name</label><input type="text" class="form-control" id="client"  style="width: 100%; "></textarea>
	<label>Check out Date</label><table style="width: 100%;"><tr>
							<td style="width: 80%"><input type="date" name="checkoutdate" class="form-control" id="checkoutdate"></td>
							<td>&nbsp;</td>
							<td style="width: 20%"><input type="time" name="checkouttime" class="form-control" id="checkouttime" ></td>
						</tr></table>
						Worked
	<select class="form-control" id="work" name= "work" style="width: 100%; " size="10" multiple="multiple">
			<?php
$query = "Select *  From pwork";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['SERIAL']); ?>" ><?php echo($x['Description']); ?></option>
 <?php 
}?>
</select>
	<label>Client Feedback</label><textarea class="form-control" id="note" size="7" style="width: 100%; "></textarea>
	<label>GS Feedback</label><textarea class="form-control" id="gsnote" size="7" style="width: 100%; "></textarea>
	<div class="checkbox">
        <label>
        <input type="checkbox" id="sent" value="1">Report Sent
        </label>
        </div>
	<label>Rating</label>
	<div>
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span1"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span2"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span3"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span4"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span5"></span>&nbsp;
	</div>
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert1" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
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
        <div class="col-lg-10">
        <label>Email</label><input type="text" class="form-control" id="email"  style="width: 100%; " value="Maintenance Visit">
</div>
<div class="col-lg-2">
        <label>&nbsp;</label><button  class="btn btn-primary btn-block" id="btnemail" data-toggle="modal" data-target="#myModal3"  style="width: 100%; ">Emails</button>
</div>
</div>
        	<label>Subject</label><input type="text" class="form-control" id="subject"  style="width: 100%; " value="Maintenance Visit">
	
	<?php include('../configdb.php');
$query = "select description from ptext where location in (select country from offers where serial in (select offerid from maintenances where serial=".$_GET['x'].")) limit 1";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){}?>
	<label>Description</label><textarea class="form-control" id="description" rows="7" style="width: 100%; " ><?php echo $x['description'];?></textarea>

        </div>
        <div class="modal-footer" >
		
        	<label id ="elblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
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
<script src="../../js/visits.js"></script>
</body>

</html>
