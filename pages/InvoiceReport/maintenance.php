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
  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
									if($_SESSION['ircv']!=1){
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
                
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
							   <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['irce']!=1){ echo('disabled'); }?>>Add Maintenance</button>
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Agreement</th>
                                        <th>Currency</th>
                                        <th>Total</th>
                                         <?php if($_SESSION['irce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['ircd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
$query = "Select *,(select projectname from offers where serial in (select project from invoicereport where serial =offermaintenance.invoiceid)) as projectname,(select symbol from currencies where serial=offermaintenance.currency) as currencyS From offermaintenance where invoiceid=".$_GET['y'];
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX">                                   	
                                        <td><?php echo ($x['projectname']);?></td>
                                        <td><?php echo($x["agreement"]);?></td>
                                        <td><?php echo($x["currencyS"]);?></td>
                                        <td><?php echo($x["total"]);?></td>
                                       <?php if($_SESSION['irce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['ircd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["serial"]);?>"   <?php if($_SESSION['ircd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
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
	
	<label>Agreement</label><input class="form-control" type="text"   name="agreement"  id="agreement" style="width:100%;">
	<label>Fees</label><input class="form-control" type="text"   name="fees"  id="fees" style="width:100%;">
	<label>Spot Fees</label><input class="form-control" type="text"   name="spotfees"  id="spotfees" style="width:100%;">
<label>Visits</label><input class="form-control" type="text"   name="visits"  id="visits" style="width:100%;">
<label>Email</label><input class="form-control" type="text"   name="email"  id="email" style="width:100%;">
	<label>Phone</label><input class="form-control" type="text"   name="phone"  id="phone" style="width:100%;">
<?php	$query = "Select * From currencies";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
			 	 		<label>Currency</label>	<select class="form-control" id="currency1" style="width: 100%; ">
	 
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['SERIAL']); ?>" ><?php echo($x['Symbol']); ?></option>
 <?php 
}?>
		</select> 
<label>Total</label><input class="form-control" type="text"   name="total"  id="total" style="width:100%;">
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please fill a agreement !</label>
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

 </div> 
<script src="../../js/offermaintenance.js"></script>
</body>

</html>
