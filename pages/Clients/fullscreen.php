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
									if($_SESSION['ccv']!=1){
									header("Location: ../Blank");
								}

  ?>
  

                        <div class="panel-heading" align="right">
			
							   <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['cce']!=1){ echo('disabled'); }?>>Add Client</button>
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Company </th>
                                        <th>Specialty</th>
										<th>Country</th>
										<th>City</th>
										<th>Telephone</th>
										<th>Fax</th>
										<th>Email</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Title</th>
										<th>Mobile</th>
										<th>Notes</th>
                                         <?php if($_SESSION['cce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['ccd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
$query = "Select *,(select color from cclients where specialty=customers.specialty) as clr From customers";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" style="background-color:<?php echo($x["clr"]);?>;">                                   	
                                        <td><?php echo($x["company"]);?></td>
										  <td><?php echo($x["specialty"]);?></td>
										   <td><?php echo($x["country"]);?></td>
										    <td><?php echo($x["city"]);?></td>
											  <td><?php echo($x["Telephone"]);?></td>
											    <td><?php echo($x["fax"]);?></td>
												  <td><?php echo($x["email"]);?></td>
												    <td><?php echo($x["fname"]);?></td>
													  <td><?php echo($x["lname"]);?></td>
													    <td><?php echo($x["activity"]);?></td>
														  <td><?php echo($x["Mobile"]);?></td>
														   <td><?php echo($x["notes"]);?></td>
                                     <?php if($_SESSION['cce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['ccd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["Serial"]);?>"   <?php if($_SESSION['ocd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php }  ?>
                                    </tr>
									<?php 
}?>
                                </tbody>
                            </table>
                           
                 
                    </div>
                    <!-- /.panel -->
               

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
		
	
	Company<input class="form-control" type="text"   name="company"  id="company" style="width:100%;" required>
Specialty<input class="form-control" type="text"   name="specialty"  id="specialty" style="width:100%;" >
Website<input class="form-control" type="text"   name="website"  id="website" style="width:100%;" >

	Country<input class="form-control" type="text"   name="country"  id="country" style="width:100%;" >
City<input class="form-control" type="text"   name="city"  id="city" style="width:100%;" >
Tel<input class="form-control" type="text"   name="tel"  id="tel" style="width:100%;" >
Fax<input class="form-control" type="text"   name="fax"  id="fax" style="width:100%;" >

First Name<input class="form-control" type="text"   name="fname"  id="fname" style="width:100%;" required>
	Last Name<input class="form-control" type="text"   name="lname"  id="lname" style="width:100%;" >
Title <input class="form-control" type="text"   name="titlee"  id="titlee" style="width:100%;" >
Email<input class="form-control" type="text"   name="email"  id="email" style="width:100%;" >

	Mobile<input class="form-control" type="text"   name="mobile"  id="mobile" style="width:100%;" >

Notes<textarea class="form-control" type="text"   name="notes"  id="notes" size="4" style="width:100%;" > </textarea>

   	  	 

  <!--<input type="checkbox" id="admin"  name="Admin" value="admin"> Admin -->

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
<script src="../../js/clients.js"></script>
</body>

</html>
