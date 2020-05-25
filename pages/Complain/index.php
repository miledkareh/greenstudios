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
								}
								if($_SESSION['comcv']!=1){
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
                	
                    <h1 class="page-header">Complaints</h1>
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
                                        <th>Date</th>
                                        <th>Project</th>
                                        <th>Visit</th>
                                        <th>Employee</th>
                                        <th>Rate</th>                                   
										<th>Description</th>
									   <th>Seen</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								
include('../configdb.php');
$query = "Select *,(select ProjectName from offers where Serial in (select offerid from maintenances where Serial in(select maintenanceid from maintenancedetails where serial=complain.visit))) as Project,
(select Notes from maintenancedetails where serial=complain.visit) as notes,
(select Fullname from users where serial=complain.fromuser) as UserName 
From complain order by seen asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
                                    <tr   class="odd gradeX" <?php if( $x['seen']==0){?> style="background-color:#ff6666;" <?php } ?>>
                                        <td><?php echo date("d-m-Y", strtotime($x["dat"]));?></td>									
										 <td><?php echo($x["Project"]);?></td>
										 <td><?php echo($x["notes"]);?></td>
										  <td><?php echo($x["UserName"]);?></td>
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
										   <td><?php echo($x["description"]);?></td>


<?php if ($x['seen']==1){?>
	<td class="center" id="Col_<?php echo($x["serial"]);?> "><p style="color: blue;" class="fa fa-check"></p><p style="color: blue;" class="fa fa-check"></p></td>
		<?php } else{ ?>
			<td class="center"  id="Col_<?php echo($x["serial"]);?>"><p class="fa fa-check" id="asd"></p></td>
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
$query = "Select * From offers";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["Serial"];?>"><?php echo $x["ProjectName"]; ?></option>
	<?php }?>
		</select>
		<label>Subject</label><input class="form-control" type="text"   name="subject"  id="subject" style="width:100%;" required>
		<label>Description</label><textarea class="form-control" type="text"   name="description"  id="description" style="width:100%;" rows="2"></textarea>
		<label>Employee</label><select class="form-control" id="employee" style="width: 100%; text-align: right;" multiple="multiple"></select>
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

  
<script src="../../js/complain.js"></script>

</body>

</html>
