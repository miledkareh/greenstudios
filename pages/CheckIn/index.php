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

</style>

</head>

<body>
	
	 <?php
  session_start();
  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
									if($_SESSION['cicv']!=1){
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
                
                    <h1 class="page-header">Check in/out</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
							   <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['cice']!=1){ echo('disabled'); }?>>Check In</button>
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	 <th>Location</th>
                                        <th>Description</th>
                                        <th>Project</th>
                                        <th>Check in Date</th>
                                         <th>Check out Date</th>
                                         <th>Rate</th>
                                         <th>Check out</th>
                                         <?php if($_SESSION['cice']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['cicd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
if($_SESSION['IsAdmin']==1)
$query = "Select *,(select ProjectName from offers where serial=checkin.project)as projectN From checkin order by checkout asc";
else {
	$query = "Select *,(select ProjectName from offers where serial=checkin.project)as projectN From checkin where userid=".$_SESSION['UserSerial']." order by checkout asc";
}
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX">        
                                    	<td><?php echo($x["checkinlocation"]);?></td>                           	
                                        <td><?php echo($x["description"]);?></td>
                                        <td><?php echo($x["projectN"]);?></td>
                                         <td><?php if($x["checkindate"]!="0000-00-00"){echo($x["checkindate"]);} ?></td>
                                        <td><?php if($x["checkoutdate"]!="0000-00-00"){echo($x["checkoutdate"]);} ?></td>
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
                                        <?php if($x['checkout']==1) {?>
                                       <td class="center">	<label> Check Out</label> </td>
                                       	<?php } else { ?>
                                        <td class="center">
                                       
<a  id="check_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal1" > Check Out</a>
</td>
<?php }?>
                                       <?php if($_SESSION['cice']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['cicd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["serial"]);?>" ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php }  ?>
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
	
<label>Project</label><select class="form-control" id="project" style="width: 100%; text-align: right;" required>
			<?php
								
include('../configdb.php');
$query = "Select * From offers";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["Serial"];?>"><?php echo ($x["Serial"]." ".$x["ProjectName"]); ?></option>
	<?php }?>
		</select>
		<label>Location</label><input class="form-control" type="text"   name="location"  id="location" style="width:100%;" required>
	<label>Description</label><input class="form-control" type="text"   name="description"  id="description" style="width:100%;" required>
	
	
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add1"class="btn btn-outline btn-primary" >Save</button>
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
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="center">		
	<label>Location</label><input class="form-control" type="text"   name="location1"  id="location1" style="width:100%;" required>
	<label>Notes</label><textarea class="form-control" id="notes" size="7" style="width: 100%; "></textarea>
	<label>Rate</label>
	<div>
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span1"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span2"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span3"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span4"></span>&nbsp;
		<span style="width: 10%;" class='glyphicon glyphicon-star-empty' id="span5"></span>&nbsp;
	</div>
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
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
 </div> 
<script src="../../js/checkin.js"></script>
</body>

</html>
