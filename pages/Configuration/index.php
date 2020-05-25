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
									if($_SESSION['cocv']!=1){
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
                
                    <h1 class="page-header">Configuration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
							   
			<td><button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['coce']!=1){ echo('disabled'); }?> >Add</button></td>
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Website</th>
                                        <th>Bank</th>
                                        <th>Account</th>
                                        <th>Account #</th>
                                         <?php if($_SESSION['coce']==1){?>      <th>Edit</th> <?php }?>
									  <?php if($_SESSION['cocd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
											
include('../configdb.php');
$query = "Select * From genpar";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >                                   	
                                        <td><?php echo($x["company"]);?></td>
                                        <td><?php echo($x["address"]." - ".$x['street']." - ".$x['building']." - ".$x['floor']);?></td>
                                        <td><?php echo($x["phone"]);?></td>
                                        <td><?php echo($x["website"]);?></td>
                                        <td><?php echo($x["bank"]);?></td>
                                        <td><?php echo($x["accountname"]);?></td>
                                        <td><?php echo($x["accountnumber"]);?></td>
                                        
                                       <?php if($_SESSION['coce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['cocd']==1){?>
<td class="center"><a  id="del_<?php echo($x["serial"]);?>"   <?php if($_SESSION['cocd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
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
	<label>Company</label><input class="form-control" type="text"   name="company"  id="company" style="width:100%;" required>
	<label>Address</label>
<input class="form-control" type="text"   name="address"  id="address" style="width:100%;" required>
<label>City</label><input class="form-control" type="text"   name="city"  id="city" style="width:100%;" required> 
		<label>Street</label><input class="form-control" type="text"   name="street"  id="street" style="width:100%;" required> 
<label>Building</label><input class="form-control" type="text"   name="building"  id="building" style="width:100%;" required> 
 <label>Floor</label><input class="form-control" type="text"   name="floor"  id="floor" style="width:100%;" required>   
 <label>Phone</label><input class="form-control" type="text"   name="phone"  id="phone" style="width:100%;" required>   
    <label>Website</label><input class="form-control" type="text"   name="website"  id="website" style="width:100%;" required>      
  <label>VAT #</label><input class="form-control" type="text"   name="vat"  id="vat" style="width:100%;" required>
   <label>Commercial #</label><input class="form-control" type="text"   name="commercial"  id="commercial" style="width:100%;" required>
   <label>Bank</label><input class="form-control" type="text"   name="bank"  id="bank" style="width:100%;" required>
   <label>Bank Name</label><input class="form-control" type="text"   name="bankname"  id="bankname" style="width:100%;" required>
 <label>Bank</label><input class="form-control" type="text"   name="bankaddress"  id="bankaddress" style="width:100%;" required>
  <label>Account</label><input class="form-control" type="text"   name="account"  id="account" style="width:100%;" required>     
        <label>Account #</label><input class="form-control" type="text"   name="accountNum"  id="accountNum" style="width:100%;" required> 
         <label>Iban KD</label><input class="form-control" type="text"   name="ibanusd"  id="ibanusd" style="width:100%;" required>
        <input class="form-control" type="text"   name="ibanlbp"  id="ibanlbp" style="width:100%;display: none;" required>
        <input class="form-control" type="text"   name="ibaneuro"  id="ibaneuro" style="width:100%;display: none;" required>
         <label>Swift</label><input class="form-control" type="text"   name="swift"  id="swift" style="width:100%;" required>
         <label>Warranty</label><input class="form-control" type="text"   name="warranty"  id="warranty" style="width:100%;" required>
         <label>Offer Validity</label><input class="form-control" type="text"   name="offerV"  id="offerV" style="width:100%;" required>
        <label>Body 1</label><textarea class="form-control" id="body1" rows="7" style="width: 100%; "></textarea>
        <label>Body 2</label><textarea class="form-control" id="body2" rows="7" style="width: 100%; "></textarea>
       <legend  style="font-size: 15px;" >Requirements</legend>
       
       <br />
<table style="width: 100%;">
	<tr>
		<td><label id ="lblalert4" style="visibility: hidden; color: red;">Please save before adding requirement !</label></td>
		<td align="right"> <button type="button" id="Adrequirement" class="btn btn-outline btn-primary" >Add Requirement</button></td>
	</tr>
</table>
<br />
	<table style="width: 100%;" border="1">
				<thead>
					<th>Description</th>
            <th>RG</th>
              <th>GW</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody id="tblrequirement"></tbody>
			</table>
       <br>
        <legend  style="font-size: 15px;" >Including</legend>
       <table style="width: 100%;">
	<tr>
		<td><label id ="lblalert1" style="visibility: hidden; color: red;">Please save before adding including !</label></td>
		<td align="right"> <button type="button" id="Adincluding" class="btn btn-outline btn-primary" >Add Including</button></td>
	</tr>
</table>
<br />
	<table style="width: 100%;" border="1">
				<thead>
					<th>Description</th>
          <th>RG</th>
              <th>GW</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody id="tblincluding"></tbody>
			</table>
      
        </div>
       <!--  <div class="modal-body" align="left">
         	<label>Areas</label>
         	<table border="1" id="tableareas">
         	
         	</table>	
       </div> -->
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Company !</label>
		<table align="center"  >
			
		<tr>
			<td >
			<label id ="lblalert5" style="color: red;">Configuration Saved !</label>
		</td>
		<td>
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
  
  <div class="modal fade" id="myModal2" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title2"></h4>
        </div>

        <div class="modal-body" align="center">		
	
	<label>Description</label><input class="form-control" type="text"   name="requirementdesc"  id="requirementdesc" style="width:100%;" >
<br>
  <div>
    <label><input type="checkbox" id="rg_checkbox">RG</label>&nbsp;&nbsp;
     <label><input type="checkbox" id="gw_checkbox">GW</label>
  </div>
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert2" style="visibility: hidden; color: red;">Please Fill Description!</label>
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

 <div class="modal fade" id="myModal3" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title3"></h4>
        </div>

        <div class="modal-body" align="center">		
	
	<label>Description</label><input class="form-control" type="text"   name="includingdesc"  id="includingdesc" style="width:100%;" >
      
  <br>
  <div>
    <label><input type="checkbox" id="rg_checkbox1">RG</label>&nbsp;&nbsp;
     <label><input type="checkbox" id="gw_checkbox1">GW</label>
  </div>
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert3" style="visibility: hidden; color: red;">Please Fill Description!</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add3"class="btn btn-outline btn-primary" >Save</button>
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
<script src="../../js/configuration.js"></script>
</body>

</html>
