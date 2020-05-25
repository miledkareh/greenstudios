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
   <link rel="stylesheet" type="text/css" href="../../Datatables/datatables.min.css"/>
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
 <style>
myModal.modal-open {
   overflow: scroll;
  }
myModall.modal-open {
   overflow: scroll;
  }
  .nopadding{
		padding:1px !important;
		margin:0 !important;
	}

</style>
</head>

<body>
	  <?php
  session_start(['cookie_lifetime' => 86400]);
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
								if($_SESSION['ccv']!=1){
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
                
                    <h1 class="page-header">Contacts</h1>
                    <?php         $sql="select count(distinct company) from customers where 1";
                    $results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
$x = mysqli_fetch_array($results);?>
 
                    <b>Count:<?php echo $x[0]; ?></b>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="left">
                        	<form method="post">
                        	<div class="row">
                        		<div class="col-lg-2 nopadding">
                        			Specialty
                        			<select name="fspecialty" class="form-control" id="fspecialty"  >
                        				<option selected value="All">All</option>
							<?php
								
include('../configdb.php');
$query = "Select * From cclients order by Specialty asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['Specialty']); ?>" <?php if (isset($_POST['fspecialty'])) {if ($_POST['fspecialty'] == $x['Specialty'])echo("selected");}?>><?php echo ($x['Specialty']); ?></option>
						  <?php } ?>
						</select>
                        		</div>
                        		<div class="col-lg-1 nopadding">
                        			Country
                        			 <select  class="form-control" id="fcountry" name="fcountry" style="width: 100%;" >
											<option selected value="All">All</option>
											<?php 
											include('../configdb.php');
										$query="select distinct(Country) as country from customers ";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["country"]); ?>" <?php if(isset($_POST['fcountry'])) {if($_POST['fcountry'] == $x['country'])echo("selected");}?>><?php echo($x["country"]); ?></option>
											<?php } ?>
											</select>
                        		</div>
                        		<div class="col-lg-1 nopadding">
                        			City <select name="fcity" class="form-control" id="fcity"  >
                        				<option selected value="All">All</option>
							<?php
								
include('../configdb.php');
$query = "Select distinct(city) as city From customers where city<>'' order by city asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['city']); ?>" <?php if (isset($_POST['fcity'])) {	if ($_POST['fcity'] == $x['city']) echo("selected");} ?>><?php echo ($x['city']); ?></option>
						  <?php } ?>
						</select>
                        		</div>
                        	 <div class="col-lg-2">
						<label>From Date</label><input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "fromdate" name="fromdate"  value="<?php if (isset($_POST['fromdate'])) {echo($_POST['fromdate']);} ?>"/>
					</div>
					<div class="col-lg-2">
						<label>To Date</label><input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "todate" name="todate"  value="<?php if (isset($_POST['todate'])) {echo($_POST['todate']);} ?>"/>
					</div>
                        	<div class="col-lg-1 nopadding"> <br><button type="button" id="search" class="btn btn-outline btn-primary" onclick="this.form.submit();">Search</button></div>
                        	<div class="col-lg-2 nopadding">
                        		<br>
                        		<a href="./fullscreen.php" class="btn btn-outline btn-primary" target="_blank">View Full Screen</a>
                        	</div>
                        	<div class="col-lg-1 nopadding">
                        		&nbsp;
                        		<button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['cce']!=1){ echo('disabled'); }?> >Add Client</button>
                        	</div>
                        	</div>
                        	</form>
					  
							   
			</div>
						
                      
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                    	 <th>Company </th>
                                    	<th>Name</th>
                                       
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Specialty</th>
										<th>Telephone</th>
										<th>Mobile</th>
										<th>Fax</th>
										<th>Email</th>
										<th>Date</th>	
										<th>Title</th>	
										<th>Referral</th>	
										<th>Created By</th>								
										<th>Notes</th>
										
                                           <?php if($_SESSION['cce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['ccd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
if(isset($_POST['fcountry']) && $_POST['fcountry'] != 'All') {$country=" and country ='".$_POST['fcountry']."'";}
	else {
		$country='';
	}
	if(isset($_POST['fcity']) && $_POST['fcity'] != 'All') {$city=" and city ='".$_POST['fcity']."'";}
	else {
		$city='';
	}
	if(isset($_POST['fspecialty']) && $_POST['fspecialty'] != 'All') {$specialty=" and specialty ='".$_POST['fspecialty']."'";}
	else {
		$specialty='';
	}
	$fromdate='';
	$todate='';
	if(isset($_POST['fromdate']) && $_POST['fromdate']!='')
$fromdate=" and dat >= '".$_POST['fromdate']."'";
else {
	$fromdate='';
}
if(isset($_POST['todate']) && $_POST['todate']!='')
$todate=" and dat <= '".$_POST['todate']."'";
else {
	$todate='';
}
$query = "Select *,(select Fullname from users where serial=customers.userid) as userN,(select color from cclients where specialty=customers.specialty) as clr From customers where serial <> 0 ".$city.$country.$specialty.$fromdate.$todate;

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" style="background-color:<?php echo($x["clr"]);?>;">                                   	
                                        <td><?php echo($x["company"]);?></td>
                                       <td><?php echo($x["fname"]." ".$x["lname"]);?></td> 
                                      
                                        <td><?php echo($x["country"]);?></td>
										    <td><?php echo($x["city"]);?></td>
										  <td><?php echo($x["specialty"]);?></td>										   
											  <td><a href="tel:<?php echo($x["Telephone"]);?>"><?php echo($x["Telephone"]);?></a></td>
											    <td><?php echo($x["Mobile"]);?></td>
											    <td><?php echo($x["fax"]);?></td>
												  <td><a href="mailto:<?php echo($x["email"]); ?>"><?php echo($x["email"]); ?></a></td>
													<td><?php echo($x["dat"]);?></td>
													<td><?php echo($x["activity"]);?></td>
													<td><?php echo($x["referral"]);?></td>
														<td><?php echo($x["userN"]);?></td>
														   <td><?php echo($x["notes"]);?></td>
														   
                                      <?php if($_SESSION['cce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['ccd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["Serial"]);?>"   <?php if($_SESSION['ccd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
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
  <script type="text/javascript" src="../../Datatables/pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="../../Datatables/pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="../../Datatables/datatables.min.js"></script>
<script type="text/javascript" src="../../Datatables/FixedHeader-3.1.3/js/datatables.fixedHeader.min.js"></script> 
    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
  

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <?php if($_SESSION['IsAdmin']==1){?>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
        	
        	 
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
   dom: 'Blfrtip',
            responsive: true,
				"stateSave": true,
				 fixedHeader: {
            header: true,
            footer: true
       },
				
        });
    });
    </script>
<?php } else{?>
 <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
        	
        	 
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
   
            responsive: true,
				"stateSave": true,
				 fixedHeader: {
            header: true,
            footer: true
       },
				
        });
    });
    </script>
    <?php }?>
	  <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="center">		
		
	
	Company<input class="form-control" type="text"   name="company"  id="company" style="width:100%;" required>
	



Specialty<select name="specialty" class="form-control" id="specialty"  >
							<?php
								
include('../configdb.php');
$query = "Select * From cclients order by Specialty asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['Specialty']); ?>"><?php echo ($x['Specialty']); ?></option>
						  <?php } ?>
						</select>
Website<input class="form-control" type="text"   name="website"  id="website" style="width:100%;" >

	Country <input class="form-control" type="text" id="country" name="country" list="countryy" />
<datalist id="countryy">
  <?php
								
include('../configdb.php');
$query = "Select distinct(country) as country From customers where country<>'' order by country asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo ($x['country']); ?></option>
						  <?php } ?>
</datalist>
City<input class="form-control" type="text"   name="city"  id="city" style="width:100%;" list="cityy">
<datalist id="cityy">
  <?php
								
include('../configdb.php');
$query = "Select distinct(city) as city From customers where city<>'' order by city asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo ($x['city']); ?></option>
						  <?php } ?>
</datalist>
Tel<input class="form-control" type="text"   name="tel"  id="tel" style="width:100%;" >
Fax<input class="form-control" type="text"   name="fax"  id="fax" style="width:100%;" >

First Name<input class="form-control" type="text"   name="fname"  id="fname" style="width:100%;" required>
	Last Name<input class="form-control" type="text"   name="lname"  id="lname" style="width:100%;" >
Title <input class="form-control" type="text"   name="titlee"  id="titlee" style="width:100%;" list="t1">
<datalist id="t1">
  <?php
								
include('../configdb.php');
$query = "Select distinct(activity) as activity From customers where activity <> '' order by activity asc ";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo ($x['activity']); ?></option>
						  <?php } ?>
</datalist>
Email<input class="form-control" type="text"   name="email"  id="email" style="width:100%;" >

	Mobile<input class="form-control" type="text"   name="mobile"  id="mobile" style="width:100%;" >
	Referred By<input class="form-control" type="text"   name="referral"  id="referral" style="width:100%;" >
	 Creation Date<input class="form-control" type="date"   name="dat"  id="dat"  >
	<input class="form-control" type="text"   name="phours"  id="phours"  style="display: none;">
<select name="category" class="form-control" id="category" style=" display:none; visibility:hidden;" >
							<?php
								
include('../configdb.php');
$query = "Select * From category";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['serial']); ?>"><?php echo ($x['description']); ?></option>
						  <?php } ?>
						</select>
Notes<textarea class="form-control" type="text"   name="notes"  id="notes" size="4" style="width:100%;" > </textarea>

   	  	 

  <!--<input type="checkbox" id="admin"  name="Admin" value="admin"> Admin -->

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Company and Specialty must be filled !</label>
		<table align="center"  >
			
		<tr>
			<td>
	
        <button type="button" id="add2"class="btn btn-outline btn-primary" >Save & Reassign</button>
		</td>
		<td width="10">
		</td>
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
<script src="../../js/clients.js"></script>
</body>

</html>
