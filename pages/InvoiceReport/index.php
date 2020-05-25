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
	.modal-fullscreen .modal-dialog {
  margin: 0;
  width: 100%;
  animation-duration:0.6s;
}
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
                
                    <h1 class="page-header">Offer Printout</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
							   <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['irce']!=1){ echo('disabled'); }?>>Add </button>
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Client</th>
                                      <th>Project Reff</th>
                                        <th>Subject</th>
                                        <th>Print</th>
                                     
                                         <?php if($_SESSION['irce']==1){?>   <th>Duplicate</th>   <th>Edit</th> <?php }?>
									   <?php if($_SESSION['ircd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
$offer='';
if(isset($_GET['x']))
$offer=" and project=".$_GET['x'];
$query = "Select *,
(select company from customers where Serial=invoicereport.clientid)as COMP,
(select offerref from offers where serial=invoicereport.project)as offerref,
(select symbol from currencies where serial in(select currency from offers where serial=invoicereport.project))as currencyS,
(select currency from offers where serial=invoicereport.project)as currency,
(select ProjectName from offers where serial=invoicereport.project)as ProjectN 
From invoicereport where serial >0 and isnew=0";
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query=$query.$offer." order by serial desc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >                                   	
                                        <td><?php echo($x["ProjectN"]);?></td>
                                        <td><?php echo($x["COMP"]);?></td>
                                    <td><?php echo($x["proposal"]);?></td>
                                        <td><?php echo($x["subject"]);?></td>
                 <td><a target="blank" href="./Transaction.php?x=<?php echo($x["project"]);?>&y=<?php echo($x["serial"]);?>&c=<?php echo($x["companyid"]);?>" ><p class="fa fa-print"></p> Print</a></td> 

                                       <?php if($_SESSION['irce']==1){?>
                                       	<td class="center">
<a  id="Dup_<?php echo($x["serial"]);?>"  ><p class="fa fa-clone"></p> Duplicate</a>
</td>
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
            responsive: true,
				"aaSorting" : [],
        "stateSave": true
        });
       
    });
    </script>

	  <div class="modal fade modal-fullscreen" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog " width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="center">		
	<label>Company</label><select class="form-control" id="company" style="width: 100%; text-align: right;" required>
			<option value=""></option>
			<?php
								
include('../configdb.php');
$query = "Select * From genpar";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["serial"];?>"><?php echo ($x["company"]); ?></option>
	<?php }?>
		</select>
	<label>Subject</label>
<input class="form-control" type="text" id="subject" name="subject" list="subjectt" />
<datalist id="subjectt">
<?php	$query = "Select distinct(subject) From invoicereport where subject <> ''";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option><?php echo $x['subject']; ?></option>
	<?php }?>
	</datalist>
	<label>Project</label><select class="form-control" id="offer" style="width: 100%; text-align: right;" required>
			
			<option value=""></option>
			<?php
								
include('../configdb.php');
$query = "Select * From offers order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["Serial"];?>"><?php echo ($x["ProjectName"]); ?></option>
	<?php }?>
		</select>
		<label>Project Name</label><input class="form-control" type="text"   name="offerdesc"  id="offerdesc" style="width:100%;" required>
		<label>Client</label><select class="form-control" id="client" style="width: 100%; text-align: right;" required>
			<?php
								
include('../configdb.php');
$query = "Select * From customers where company <> ''";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["Serial"];?>"><?php echo ($x["company"]." / ".$x['fname']." ".$x['lname']); ?></option>
	<?php }?>
		</select>
		<label>Proposal #</label><input class="form-control" type="text"   name="proposal"  id="proposal" style="width:100%;" required> 
<!--<label>Address</label><input class="form-control" type="text"   name="address"  id="address" style="width:100%;" required> -->
<label>Introduction</label><textarea class="form-control" id="body1" style="width: 100%; " rows="7"></textarea>
<label>Requirements</label><select class="form-control" id="requirement" style="width: 100%; height:250px; text-align: left;" required multiple>
			<?php
								
//include('../configdb.php');
//$query = "Select * From requirements";
//$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//while($x = mysqli_fetch_array($results)){?>
	<!-- <option value="<?php //echo $x["serial"];?>"><?php //echo ($x["description"]); ?></option> -->
  <?php// }?>
		</select>
<label>Including</label><select class="form-control" id="including" style="width: 100%;height:250px; text-align: left;" required multiple>
			<?php
								
include('../configdb.php');
$query = "Select * From including";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x["serial"];?>"><?php echo ($x["description"]); ?></option>
	<?php }?>
		</select>
		<label>Excluding</label><textarea class="form-control" id="excluding" rows="3" style="width: 100%; "></textarea>
		
 <label>Time Delivery</label><input class="form-control" type="text" id="delivery" name="delivery" list="deliveryy" />
<datalist id="deliveryy">
<?php	$query = "Select distinct(delivery) From invoicereport where delivery <> ''";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option><?php echo $x['delivery']; ?></option>
	<?php }?>
	</datalist>   
 <label>Warranty</label><input class="form-control" type="text" id="warranty" name="warranty" list="warrantyy" />
<datalist id="warrantyy">
<?php	$query = "Select distinct(warranty) From invoicereport where delivery <> ''";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option><?php echo $x['warranty']; ?></option>
	<?php }?>
	</datalist>  
    <label>Payment Schedule</label><input class="form-control" type="text" id="payment" name="payment" list="paymentt" />
<datalist id="paymentt">
<?php	$query = "Select distinct(payment) From invoicereport where delivery <> ''";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option><?php echo $x['payment']; ?></option>
	<?php }?>
	</datalist>      
   <label>Payment Details</label><textarea class="form-control" id="paymentd" rows="4" style="width: 100%; "></textarea>
  <label>Offer validity</label><input class="form-control" type="text" id="validity" name="validity" list="validityy" />
<datalist id="validityy">
<?php	$query = "Select distinct(validity) From invoicereport where delivery <> ''";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option><?php echo $x['validity']; ?></option>
	<?php }?>
	</datalist>     
        <label>Remark</label><textarea class="form-control" id="body2" rows="7" style="width: 100%; "></textarea>
         <label>Body3</label><textarea class="form-control" id="body3" rows="7" style="width: 100%; "></textarea>
       <label>Notes</label><textarea class="form-control" id="notes" rows="7" style="width: 100%; "></textarea>
       
       <table width="100%">
       	<tr>
       		<td>
       			<label>Discount</label><input class="form-control" type="number"   name="discount"  id="discount" style="width:100%;" required>
       		</td>
       		<td> <div class="checkbox">
        <label>
        <input type="checkbox" id="ispercentage" value="ispercentage">Is Percentage &nbsp;
        </label>
        </div> </td>
       	</tr>
       </table>
       <div align="left">
 <input type="radio" name="type" value="rarea" id="rarea" checked> Area
  <input type="radio" name="type" value="ritem" id="ritem"> Element
  </div>
       <legend>AREAS</legend>
             <div class="row">
             <div class='col-lg-6 '>
		<label id ="lblalert2" style="visibility: hidden; color: red;">Please Save the Offer before adding an Area !</label>
	</div>
	<div class='col-lg-6 ' align="right">
		<button type="button" id="Addarea" class="btn btn-outline btn-primary" >Add Area</button>
	</div>
	</div>
		
			<table align="left" style="width: 100%;" border="1">
				<thead>
					
					<th>Description</th>
					<th>Total</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody id="tblarea"></tbody>
			</table>
<br>
 <legend>INVOICES</legend>
             <div class="row">
             <div class='col-lg-6 '>
		<label id ="lblalert3" style="visibility: hidden; color: red;">Please Save the Offer before adding an item !</label>
	</div>
	<div class='col-lg-6 ' align="right">
		<button type="button" id="AddInv" class="btn btn-outline btn-primary" >Add Item</button>
	</div>
	</div>
		
			<table align="left" style="width: 100%;" border="1">
				<thead>
					
					<th>Item</th>
            <th>View Prices</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody id="tblinv"></tbody>
			</table>
			<br>
 <legend>Maintenances</legend>
             <div class="row">
             <div class='col-lg-6 '>
		<label id ="mlblalert3" style="visibility: hidden; color: red;">Please Save the Offer before adding a Maintenance !</label>
	</div>
	<div class='col-lg-6 ' align="right">
		<button type="button" id="AddMain" class="btn btn-outline btn-primary" >Add Maintenance</button>
	</div>
	</div>
		
			<table align="left" style="width: 100%;" border="1">
				<thead>
					
					 <th>Project</th>
                     <th>Agreement</th>
                     <th>Currency</th>
                     <th>Total</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody id="tblmain"></tbody>
			</table>
<br>
         </div>
         
         <br /><br /><br /><br /><br /><br />
        
          <div class="modal-footer" >
        	<label id ="lblalert" style="visibility: hidden; color: red;">Title and Project must be Filled !</label>
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
          <h4 class="modal-title" id="title1"></h4>
        </div>

        <div class="modal-body" align="center">		
	<label>Description</label><input class="form-control" type="text"   name="adescription"  id="adescription" style="width:100%;" required>
	<label>Total</label>
<input class="form-control" type="number"   name="atotal"  id="atotal" style="width:100%;" required>
        </div>
        <div class="modal-footer" >
		
        	<label id ="alblalert" style="visibility: hidden; color: red;">Description and Total must be Filled !</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="aadd1"class="btn btn-outline btn-primary" >Save</button>
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
 <div  class="modal fade  modal-fullscreen"  id="myModal2" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content "  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title">Add Items</h4>
           	<div class="col-lg-12">
        		   	<div align="right" class="col-lg-4"> <button  type="button" id="add3"class="btn btn-outline btn-primary" >Save</button></div>
                            <div align="right" class="col-lg-4">&nbsp;&nbsp; <select name="fgroup" class="form-control" id="fgroup"  >
							 <option value="0">All</option>
							<?php
								
include('../configdb.php');
$query = "Select * From itemsgroups order by description asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['serial']); ?>"><?php echo($x['description']); ?></option>
						  <?php } ?>
						</select></div>
						 <div align="right" class="col-lg-4"> 
						 	&nbsp;&nbsp;
                                    	Idle
                                     	
                                      <select class="form-control" id="fidol" name="fidol" style="width: 100%; " >
      <option value="All">All</option>
     <option value="1" >Idle</option>
	 <option value="0" >Not Idle</option>
	 
		</select> 
						</div>
        </div>

        <div class="modal-body" style=" height:650px; overflow:auto;" align="center">	
        	
        	  <div class="row">
        	  	
                <div class="col-lg-12">
                	
                    <div class="panel panel-default">
        		   <div class="panel-body" >
        		  
						
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                              
                                <thead>
                                  
                                </thead>
                                <tbody>

								
                                </tbody>
                            </table>
                           
                 
                    </div>
                    </div>
                    </div>
                    </div>
	  </div>
        <div class="modal-footer" >
		
        	<label id ="Ilblalert" style="visibility: hidden; color: red;">Please Fill Description</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="Invadd1"class="btn btn-outline btn-primary" >Save</button>
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
    <div class="modal fade" id="myModal3" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="ititle"></h4>
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
	
	
	<label>Total</label><input class="form-control" type="number"   name="total"  id="total" style="width:100%;"  required>
      
        </div>
        <div class="modal-footer" >
		
        	<label id ="ilblalert" style="visibility: hidden; color: red;">Please Fill Description</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="iadd1"class="btn btn-outline btn-primary" >Save</button>
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
    <div class="modal fade" id="myModal4" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="mtitle"></h4>
        </div>

        <div class="modal-body" align="center">		
	
	<label>Agreement</label><input class="form-control" type="text"   name="agreement"  id="agreement" style="width:100%;">
	<label>Fees</label><input class="form-control" type="text"   name="fees"  id="fees" style="width:100%;">
	<label>Spot Fees</label><input class="form-control" type="text"   name="spotfees"  id="spotfees" style="width:100%;">
<label>Visits</label><input class="form-control" type="number"   name="visits"  id="visits" style="width:100%;">
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
<label>Total</label><input class="form-control" type="text"   name="mtotal"  id="mtotal" style="width:100%;">
        </div>
        <div class="modal-footer" >
		
        	<label id ="mlblalert" style="visibility: hidden; color: red;">Please fill a agreement !</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="madd1"class="btn btn-outline btn-primary" >Save</button>
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
 	$("#offer").select2();
 	$("#client").select2();
 	$("#item").select2();
 	$.fn.editable.defaults.mode = 'inline'; 
 
 </script>
<script src="../../js/invoicereport.js"></script>
</body>

</html>
