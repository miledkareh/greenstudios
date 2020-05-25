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
 <link href="../../vendor/fileupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
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
								if($_SESSION['pencv']!=1){
									header("Location: ../Blank");
								}

  ?>
  <?php
if (isset($_FILES["fileToUpload"])) {
	$target_dir = "../../att/".$_POST['statuss']."/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["fileToUpload"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i],$target_file)){
}
}
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
                
                    <h1 class="page-header">PendingVisits - Attachments</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
   <button type="button" id="Add" class="btn btn-outline btn-primary"  >Approve All  </button>
		 
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Attachment</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                      <?php if($_SESSION['pence']==1){?>      <th>approved</th> <?php }?>
									   <?php if($_SESSION['pencd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
$confidential="";

$query = "Select * From maintenanceattachement where maintenancedetailid=".$_GET['x']." and isnew=0 and approved=0 order by dat desc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" data-toggle="tooltip" data-placement="top" >                                   	
                                      
        <td><a href="../../att/visits/<?php echo($x["status"]."/".$x["maintenancedetailid"]."/".str_replace("#","%23",$x["description"]));?>" target="_blank">
            <img width="100px" src="../../att/visits/<?php echo($x["status"]."/".$x["maintenancedetailid"]."/".str_replace("#","%23",$x["description"]));?>"></a>
            </td>
                                        	 
                                        	 	<td><?php echo date("d-m-Y", strtotime($x["dat"]));?></td>
 <td><?php if($x['status']=='wip') echo "Work In Progress"; else if($x['status']=='regular') echo "Prices & Correspondance";?></td>
                                        
                                      <?php if($_SESSION['pence']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["Serial"]);?>"    >Approved</a>
</td>
<?php }  ?>
<?php if($_SESSION['pencd']==1){?>
<td class="center"><a href="#" id="del_<?php echo($x["Serial"]);?>"   <?php if($_SESSION['pencd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
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
<script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
<script src="../../bower_components/dist/sweetalert2.all.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
				"aaSorting" : []
        });
    });
    </script>
 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	  <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog modal-lg" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>
		
        <div class="modal-body" align="center">
		
        <div class="row" id="taskattdiv">
	<div class="col-lg-6 nopadding" align="center">
		<label>Work In Progress</label>
 		 <div class="file-loading">
            <input id="images" name="images[]" type="file" multiple>
    </div>
    </div>
    <div class="col-lg-6 nopadding" align="center">
    	<label>Prices & Correspondance</label>
 		 <div class="file-loading">
          <input id="images1" name="images[]" type="file" multiple>
    </div>
    </div>
</div>
		
   	  	  
  <!--<input type="checkbox" id="admin"  name="Admin" value="admin"> Admin -->

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please choose an Attachment !</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add1" class="btn btn-outline btn-primary"  >Save </button>
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
<script src="../../js/pendingvattachments.js"></script>
</body>

</html>
