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
									if($_SESSION['tscv']!=1){
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
                
                    <h1 class="page-header">Time Sheet</h1>
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Project</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Description</th>
                                        <th> Hours Working</th>
                                        <th>Cost</th>
                                        <th>Attachments</th>
                                         <?php if($_SESSION['tsce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['tscd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
$query1="";
if($_SESSION['IsAdmin']==0)
$query1=' where employee='.$_SESSION['UserSerial'];
$query = "Select *,(select count(*) from timesheetattachments where timesheetid=timesheet.serial) as attcnt,(select projectname from offers where serial=timesheet.project) as projectname,(select Fullname from users where Serial=timesheet.employee) as employeeN,(select cost from users where Serial=timesheet.employee) as cost From timesheet".$query1;
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
<?php $t1 = StrToTime ( $x["fromdate"] );
$t2 = StrToTime ( $x["todate"] );
$diff = $t2 - $t1;

$mns = $diff / ( 60);
$mns= ( $mns % 60);
$hours = $diff / ( 60 *60);
$cost= $hours * $x['cost'];

$hours=round($hours, 0, PHP_ROUND_HALF_DOWN);;
$cost= ($mns/60+$hours)*$x['cost'];
?>

                                    <tr id="tr_<?php echo $x['serial']; ?>">     
                                    	<td><?php echo($x["employeeN"]);?></td>   
                                    	<td>
                                    	
                                    		<table>
                                    			<tr>
                                    				<td id="tdproject_<?php echo $x['serial']; ?>"><?php echo($x["projectname"]);?></td>
                                    				<td style="display: none;" id="tdproject1_<?php echo $x['serial']; ?>">
                                    		<?php	$query = "Select * From offers order by projectname asc";
$result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		<select class="form-control" id="project_<?php echo $x['serial']; ?>" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($result, 0);
		while($t = mysqli_fetch_array($result)){?>
 <option value="<?php echo($t['Serial']); ?>" ><?php echo($t['ProjectName']); ?></option>
 <?php 
}?>
		</select>	
                                    	</td> 
                                    			</tr>
                                    		</table>
                                    	</td>     
                                    	                         	
                                        <td>
                                        	<table>
                                        		<tr>
                                        			<td id="tdfromdate_<?php echo $x['serial']; ?>"><?php echo(date('d/m/Y H:i',strtotime($x["fromdate"])));?></td>
                                        			<td style="display: none;" id="tdfromdate1_<?php echo $x['serial']; ?>"><input type="date" name="fromdate" class="form-control" id="fromdate_<?php echo $x['serial']; ?>">
			<input type="time" name="fromtime" class="form-control" id="fromtime_<?php echo $x['serial']; ?>" ></td>
                                        		</tr>
                                        	</table>
                                        </td>
                                        
                                        <td>
                                        	<table>
                                        		<tr>
                                        			<td id="tdtodate_<?php echo $x['serial']; ?>"><?php echo(date('d/m/Y H:i',strtotime($x["todate"])));?> </td>
                                        			 <td style="display: none;" id="tdtodate1_<?php echo $x['serial']; ?>"><input type="date" name="todate" class="form-control" id="todate_<?php echo $x['serial']; ?>" >
			<input type="time" name="totime" class="form-control" id="totime_<?php echo $x['serial']; ?>" ></td>
                                        		</tr>
                                        	</table>
                                        </td>
                                        <td>
                                        
                                        	<table>
                                        		<tr>
                                        			<td id="tddescription_<?php echo $x['serial']; ?>"><?php echo($x["description"]);?></td>
                                        			 <td style="display: none;" id="tddescription1_<?php echo $x['serial']; ?>"><input class="form-control" type="text"   name="description"  id="description_<?php echo $x['serial']; ?>" style="width:100%;" required></td>
                                        		</tr>
                                        	</table>
                                        </td>
                                       
                                         <td><?php echo($hours.":".$mns);?></td>
                                         <td><?php echo($cost);?></td>
                                         <td class="center">
<a class="btn btn-outline btn-primary" id="Att_<?php echo($x["serial"]);?>" data-toggle="modal" data-target="#myModal1" ><p class="fa fa-paperclip"></p> Attachment(<?php echo $x['attcnt'];?>)</a>
</td>
                                       <?php if($_SESSION['tsce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  ><p class="fa fa-edit"></p> Save</a>
</td>
<?php }  ?>
<?php if($_SESSION['tscd']==1){?>
<td class="center"><a  id="del_<?php echo($x["serial"]);?>" ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php }  ?>
                                    </tr>
									<?php 
}?>
<tr>
	<td><?php echo($_SESSION['User']);?>
</td>
<td><?php	$query = "Select * From offers order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		<select class="form-control" id="project" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['ProjectName']); ?></option>
 <?php 
}?>
		</select>	
</td>
		<td><input type="date" name="fromdate" class="form-control" id="fromdate">
			<input type="time" name="fromtime" class="form-control" id="fromtime" >
		</td>
		<td><input type="date" name="todate" class="form-control" id="todate" >
			<input type="time" name="totime" class="form-control" id="totime" >
		</td>
		<td>
			<input class="form-control" type="text"   name="description"  id="description" style="width:100%;" required>
		</td>
	<td>&nbsp;
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><button type="button" id="add1"class="btn btn-outline btn-primary" >Save</button></td>
	<td>Delete</td>
</tr>
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
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "aaSorting": []
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
        	<?php	$query = "Select * From users";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
        	<label>User</label><select class="form-control" id="employee" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['Fullname']); ?></option>
 <?php 
}?>
		</select>
		<?php	$query = "Select * From offers order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		<label>Project</label><select class="form-control" id="project" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['ProjectName']); ?></option>
 <?php 
}?>
		</select>		
	<label>Description</label><input class="form-control" type="text"   name="description"  id="description" style="width:100%;" required>
	
					<label>From date</label>
					
						<table style="width: 100%;"><tr>
							<td style="width: 80%"><input type="date" name="fromdate" class="form-control" id="fromdate"></td>
							<td>&nbsp;</td>
							<td style="width: 20%"><input type="time" name="fromtime" class="form-control" id="fromtime" ></td>
						</tr></table>
					  
					<label>To date</label>
					
						<table style="width: 100%;"><tr>
							<td style="width: 80%;"><input type="date" name="todate" class="form-control" id="todate" ></td>
							<td>&nbsp;</td>
							<td style="width: 20%;"><input type="time" name="totime" class="form-control" id="totime" ></td>
						</tr></table>  
				
				  
<!--	<label>Manager</label>
<select class="form-control" id="manager" style="width: 100%; text-align: right;" required>
			<?php
								
include('../configdb.php');
$query = "Select * From users";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["Serial"];?>"><?php echo $x["Fullname"]; ?></option>
	<?php }?>
		</select>
-->

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	<button type="button" id="add1"class="btn btn-outline btn-primary" >Save</button>
      <!--  <button type="button" id="add1"class="btn btn-outline btn-primary" >Save</button> -->
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
    <div class="modal-dialog modal-lg" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add/Edit Attachments</h4>
        </div>
		
        <div class="modal-body" align="center">
		
        <div class="row" id="taskattdiv">
    <div class="col-lg-12 nopadding" align="center">
    	
 		 <div class="file-loading">
          <input id="images" name="images[]" type="file" multiple>
    </div>
    </div>
</div>

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>

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
  <script src="../../bower_components/dist/sweetalert2.all.min.js"></script>
<script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
<script src="../../js/timesheet.js"></script>
</body>

</html>
