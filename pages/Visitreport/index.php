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

    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../../Datatables/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet">

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
									if($_SESSION['vrepcv']!=1){
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
                
                    <h1 class="page-header">Visit Report</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <form method="GET">
                        <div class="panel-heading" align="right">
					<div class="row">
                        <div style="text-align:left;" class="col-lg-3">
                            <label>From</label>
                            <input type="date" name="myfrom" value="<?php if(isset($_GET['myfrom']))echo $_GET['myfrom'];//else  echo date('Y-m-01'); ?>"    class="form-control">
                        </div>
                        <div style="text-align:left;" class="col-lg-3">
    <label>To</label>    
                            <input class="form-control" value="<?php if(isset($_GET['sel'])){ echo $_GET['myto'];} ?>" on  type="date" name="myto">
                        </div>
                          <div style="text-align:left;" class="col-lg-3">
                            <label>Status</label>
                            <select class="form-control"      name="sel">
                                <option <?php if(isset($_GET['sel'])){if($_GET['sel']==0)echo "selected";} ?> value="0">all</option>
                                <option <?php if(isset($_GET['sel'])){if($_GET['sel']==1)echo "selected";} ?> value="1">Accepted</option>
                                 
                             </select>

                        </div>
                          <div style="text-align:left;" class="col-lg-3">
                            <label>&nbsp;</label>
                          <input type="submit" name="sub" value="Search" class="form-control">
                             
                        </div>
                    </div>
							   
			<?php 
            $myfrom='';
            $myto='';
            $sel='';

            if(isset($_GET['myfrom'])){
                if($_GET['myfrom']!='')
                $myfrom=" and checkindate>='".$_GET['myfrom']."' ";

            }
             if(isset($_GET['myto'])){
                if($_GET['myto']!='')
                $myto=" and checkindate<='".$_GET['myto']."' ";
                
            }


                 if(isset($_GET['sel'])){
                if($_GET['sel']==1)
                $sel=" and maintenancedetails.accepted=1";
             
              if($_GET['sel']==0)
                $sel="";   
            }
               ?>
						
                        </div>
                        </form>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                          <th>Checkin Date</th>
                                           <th>Checkout Date</th>
                                           <th>Rate</th>
                                              <th>User</th>
                                              <th>Status</th>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
// maintenancedetails.accepted=0 and 
  $query = "
select *,maintenances.serial as SERIAL,
(select serial from offers where serial=maintenances.offerId) as OFFERSERIAL,
(select FullName from users where serial = maintenancedetails.userid ) as User,
(select ProjectName from offers where serial=maintenances.offerId) as Pname from  
maintenances,checkin,maintenancedetails 
where checkin.checkout=1
 
and checkin.visit=maintenancedetails.Serial
and maintenances.Serial=maintenancedetails.maintenanceid".$myfrom.$myto.$sel." order by  checkoutdate desc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >                                   	
                                        <td><?php echo($x["Pname"]);?></td>
                                        <td><?php echo($x["checkindate"]);?></td>                                       
                                         <td><?php echo($x["checkoutdate"]);?></td>  
                                           <td><?php 
                                        $i=0;
                                        for($i=0;$i<5;$i++)
                                        {   if($i<$x['rate'])
                                        {?>
                                            <span style="color: yellow;" class='glyphicon glyphicon-star'></span>&nbsp;
                                            <?php } else { ?>
                                                <span class='glyphicon glyphicon-star-empty'></span>&nbsp;
                                            <?php }}
                                        ?></td> 
                                        <td><?php echo($x["User"]);?></td>
                                          <td><?php if($x["accepted"]) echo("Accepted");else echo "Pending";?></td>
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
   <!--  <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script> -->

      <script src="../../vendor/jquery/jquery.min.js"></script>
 <script type="text/javascript" src="../../Datatables/pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="../../Datatables/pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="../../Datatables/datatables.min.js"></script>
<script type="text/javascript" src="../../Datatables/FixedHeader-3.1.3/js/datatables.fixedHeader.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    
     $(document).ready(function() {
        $('#dataTables-example').DataTable({
            
             
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    dom: 'Blfrtip',
            responsive: true,
                 "aaSorting" : [],
                 
                 fixedHeader: {
            header: true,
            footer: true
       },
                
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
	<label>Description</label><input class="form-control" type="text"   name="description"  id="description" style="width:100%;" required>
    <label>Icon</label><input class="form-control" type="file"   name="file"  id="file" style="width:100%;" required>
    <span id="uploaded_image"></span>
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

 </div> 
<script src="../../js/pwodwewfwrk.js"></script>
<script>
 

</script>
</body>

</html>
