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
<link rel="stylesheet" href="../../select2/dist/css/select2.css">
<link href="../../dist/css/bootstrap-editable.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
	.nopadding{
		padding:1px !important;
		margin:0 !important;
	}

tr.row_selected td{color:lightblue !important;}
</style>
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

                 
  <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    	<?php include('../configdb.php'); ?>
					<?php if($_SESSION['dcv']==1){ ?>
					 <li>
                            <a href="../Dashboard/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
							<?php } ?>
								<?php  if( $_SESSION['curcv']==1){ ?>
								  <li>
                                    <a href="../Currencies/" ><i class="fa fa-usd fa-fw"></i>Currencies</a>
                                </li>
								 <li>
                                    <a href="../CurrencyExchange/" ><i class="fa fa-exchange fa-fw"></i>Currency Exchange</a>
                                </li>
									
										<?php } ?>
							<?php if($_SESSION['cocv']==1){ ?>
					 <li>
                            <a href="../Configuration/"><i class="fa fa-gears"></i> Configuration</a>
                        </li>
							<?php } ?>
							<?php if($_SESSION['icv']==1){ ?>
					 <li>
                            <a href="../Items/"><i class="fa fa-gears"></i> Items</a>
                        </li>
							<?php } ?>
							 <?php if($_SESSION['ccv']==1 || $_SESSION['cccv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-users fa-fw"></i> Clients<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <?php if( $_SESSION['ccv']==1){ ?>
                                <li>
                                    <a href="../Clients/" class="fa fa-users">Clients</a>
                                </li>
									<?php } ?>
									 <?php if( $_SESSION['cccv']==1){ ?>
								   <li>
                                    <a href="../CClients/" class="fa fa-pencil" >Clients Colors</a>
                                </li>
									<?php } ?>
								</ul>
                        </li>
						<?php } ?>
							<?php if($_SESSION['ocv']==1 || $_SESSION['fucv']==1){ ?>
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
								</ul>
                        </li>
						<?php } ?>
						<?php if($_SESSION['mcv']==1 || $_SESSION['pcv']==1){ ?>
					 <li>
                           <a href="#"><i class="fa fa-legal fa-fw"></i> Maintenance<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <?php if( $_SESSION['mcv']==1){ ?>
                                <li>
                                    <a href="../Maintenances/" class="fa fa-legal">Maintenances</a>
                                </li>
									<?php } ?>
									 <?php if( $_SESSION['pcv']==1){ ?>
								   <li>
                                    <a href="../PWork/" class="fa fa-share" >Predefined Work</a>
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
								
                         
                         <?php if($_SESSION['rncv']==1){ ?>
					 <li>
                             <a href="../RefferalNotes/"><i class="fa fa-pencil-square-o"></i> Refferal Notes</a>
                        </li>
							<?php } ?>
							 <?php if($_SESSION['tscv']==1){ ?>
					 <li>
                             <a href="../TimeSheet/"><i class="fa fa-clock-o"></i> Time Sheet</a>
                        </li>
                        <?php if($_SESSION['IsAdmin']==1){ ?>
                        <li>
                             <a href="../TimeSheetReport/"><i class="fa fa-clock-o"></i> Time Sheet Report</a>
                        </li>
							<?php }} ?>
									  <?php if($_SESSION['ircv']==1){ ?>
					 <li>
                             <a href="../InvoiceReport/"><i class="fa fa-file-text-o"></i> Offer Printout</a>
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
	$notification= $x["cnotification"]+ $y["creminders"]; 
	if($notification) echo("(".$notification.")");}?>
                             	</a>
                        </li>
							<?php } ?>
								
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                
                    <h1 class="page-header">Invoice</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
							   <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal1" <?php if($_SESSION['irce']!=1){ echo('disabled'); }?>>Add Invoice</button>
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                         <?php if($_SESSION['irce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['ircd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
							

										

include('../configdb.php');
$query = "Select *,(select description from items where serial=invoicedetail.item) as description,(select unit from items where serial=invoicedetail.item) as unit,(select priceusd from items where serial=invoicedetail.item) as priceusd,(select pricekd from items where serial=invoicedetail.item) as pricekd,(select priceaed from items where serial=invoicedetail.item) as priceaed From invoicedetail where invoice=".$_GET['y'];
 if($_SESSION['IsAdmin']!=1){$query =$query." and ".$_SESSION['UserSerial']."=(select userid from invoicereport where serial=".$_GET['y'].") ";}
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX">                                   	
                                        <td><?php echo($x["description"]);?></td>
                                        <td><?php echo($x["unit"]);?></td>
                 						<td><?php echo($x["quantity"]);?></td>
                 						<?php if($_GET['s']=='' || $_GET['s']=='LBP' || $_GET['s']=='USD'){?>
                 						<td><?php echo($x["price"]." USD");?></td> <?php }?>
             						<?php if($_GET['s']=='KD'){ ?>
                 						<td><?php echo($x["price"]." KD");?></td> <?php }?>
                 						<?php if($_GET['s']=='AED'){ ?>
                 						<td><?php echo($x["price"]." AED");?></td> <?php }?>
                 						<td><?php echo($x["total"]);?></td>
                                       <?php if($_SESSION['irce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['ircd']==1){?>
<td class="center"><a  id="del_<?php echo($x["serial"]);?>" ><p class="fa fa-trash-o"></p> Delete</a></td>
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
  <script src="../../select2/dist/js/select2.js"></script>
<script src="../../select2/dist/js/i18n/it.js"></script>
<script src="../../select2/dist/js/i18n/nl.js"></script>
<script src="../../js/bootstrap-editable.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
          $('#dataTables-example1').DataTable({
            responsive: true,
            "lengthMenu": [-1]
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
	<?php	$query = "Select * From items where description <> '' order by description asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		
		Item<select class="form-control" id="item" style="width: 100%; " >
	 
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['serial']); ?>" ><?php echo($x['description']); ?></option>
 <?php 
}?>
		</select>
		
		
		<label>Price</label><input class="form-control" type="number"   name="price"  id="price" style="width:100%;" required>
	
	<label>Quantity</label><input class="form-control" type="number"   name="quantity"  id="quantity" style="width:100%;" required>
	
	
	<label>Total</label><input class="form-control" type="number"   name="total"  id="total" style="width:100%;" readonly required>
      
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Description</label>
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
    <div class="modal-dialog modal-lg" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title">Add Items</h4>
        </div>

        <div class="modal-body" align="center">	
        	
        	  <div class="row">
        	  	
                <div class="col-lg-12">
                	
                    <div class="panel panel-default">
        		   <div class="panel-body" >
        		   	<div align="center"> <button type="button" id="add2"class="btn btn-outline btn-primary" >Save</button></div>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                              
                                <thead>
                                    <tr>
                                    	<th></th>
                                        <th>Description</th>
                                        
                                        <th>Dimension</th>
                                        <th>Detailed Description</th>
                                        <th>Unit</th>
                                        <th>Price <?php if($_GET['s']=='') echo "USD"; else if($_GET['s']=='KD') echo "KD"; else if($_GET['s']=='USD') echo "USD";else if($_GET['s']=='AED') echo "AED"; ?> </th>
                                      <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
							

										

include('../configdb.php');
$query = "Select * From items order by description asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
$i=0;
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX">   
                                    	<td><input type="checkbox" class="chcktbl_" name="Cedit_<?php echo $i; ?>" value="checked" id="Cedit_<?php echo($x["serial"]); ?>"/></td>                                	
                                         <td><?php echo($x["description"]);?></td>
                                       <td><?php echo($x["ddescription"]);?></td>
                 						<td><?php echo($x["dimension"]);?></td>
                 					 <td><?php echo($x["unit"]);?></td>
                 					 
                 					 <td class="tdprice"><a href="#" class="editor123" data-type="text" data-placement="right" data-title="Enter price"><?php if($_GET['s']=='') echo $x['priceusd']; else if($_GET['s']=='KD') echo($x["pricekd"]); else if($_GET['s']=='USD') echo($x["priceusd"]);else if($_GET['s']=='AED') echo($x["priceaed"]); ?></a></td>
             			
             			<td class="tdquantity"><a href="#" class="editor123" data-type="text" data-placement="right" data-title="Enter price">1</a></td>
                                    </tr>
									<?php 
									$i++;
}?>
                                </tbody>
                            </table>
                           
                 
                    </div>
                    </div>
                    </div>
                    </div>
	  </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Description</label>
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
  <script>
  $(document).ready(function() {
 	$("#item").select2();
 	$.fn.editable.defaults.mode = 'inline'; 
 $('.editor123').editable();
 });
 </script>
<script src="../../js/invoicedetail.js"></script>
</body>

</html>
