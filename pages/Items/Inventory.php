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
    <link href="../../Datatables/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <link href="../../vendor/fileupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
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
									if($_SESSION['icv']!=1){
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
                
                    <h1 class="page-header">Inventory</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
				
			
							 
                        <div class="col-lg-12">
                                   <label>&nbsp;</label><br>
            <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['ice']!=1){ echo('disabled'); }?>>Add Item</button>
                             </div>
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                    	<th>Operator</th>
                                        <th>Type</th>
                                        <th>Plant</th>
                                        <th>Item</th>
                                       
                                      
                                       
                                         <?php if($_SESSION['invce']==1){?><th>Edit</th> <?php }?>
									   <?php if($_SESSION['invcd']==1){?><th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
							

include('../configdb.php');
$query = "Select * from inventory"	;

 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX">   
                                    	 <td><?php echo($x["dat"]);?></td>  
                                    	 <td><?php echo($x["userN"]);?></td>                                	
                                        <td><?php echo($x["type"]);?></td>
                                         <td><?php echo($x["plant"]);?></td>
                                          <td><?php echo($x["item"]);?></td>
                
                 			
                                       <?php if($_SESSION['invce']==1){?>
                                      
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['invcd']==1){?>
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
<script type="text/javascript" src="../../Datatables/pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="../../Datatables/pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="../../Datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../../Datatables/FixedHeader-3.1.3/js/datatables.fixedHeader.min.js"></script> <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
  <script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
<script src="../../bower_components/dist/sweetalert2.all.min.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
       <?php if($_SESSION['IsAdmin']==1){?>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
        	
        	 
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
   dom: 'Blfrtip',
            responsive: true,
            "aaSorting" : [],
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
        <div class="col-md-6">
        <label>Type</label>
            <select class="form-control" type="text"   name ="type"  id="type" style="width:100%;" required>
            <option value="Plant">Plant</option>
            <option value="Item">Item</option>
            </select>
        </div>
       <div class="col-md-6">
       <label>Date</label><input class="form-control" type="date"   name="dat"  id="dat" style="width:100%;" required>	
       </div>
       <div id="itemdiv">
       <label>Group</label>
                <select name="group" id="group" class="form-control"  >
        <option value=""></option>
           <?php include('configdb  .php');
            $sql="select * from itemsgroups  ";
            $results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
            ?>
 <option value="<?php echo $x['serial']; ?>" ><?php echo $x['description'];   ?></option>
          <?php } ?>
         </select>
         <label>Item</label>
                <select name="item" id="item" class="form-control" >
        <option value=""></option>
           <?php 
            $sql="select * from items  ";
            $results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
            ?>
 <option value="<?php echo $x['serial']; ?>"><?php echo $x['description'];   ?></option>
          <?php } ?>
         </select>
         <label for="quantity">Quantity</label>
         <input type="number" class="form-control" id="quantity" name="quantity">
         
       </div>
	<label>Notes</label><input class="form-control" type="text"   name="notes"  id="notes" style="width:100%;" required>
	

	
		
   
		
						 <br>
			 <div class="row">
			<table align="left" style="width: 100%;" border="1">
				<thead>
                <th>Item/Plant</th>
					<th>Quantity</th>
					<th>Action</th>
                  
				</thead>
				<tbody id="followup"></tbody>
			</table>	
			</div>
		
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Description and code</label>
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
 <div class="modal fade" id="myModal2" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title2"></h4>
        </div>

        <div class="modal-body" align="center">	
			
	<label>Size</label><input class="form-control" type="text"   name="size"  id="size" style="width:100%;" >
		<label>Quantity</label><input class="form-control" type="number"   name="qty"  id="qty" style="width:100%;" >

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert3" style="visibility: hidden; color: red;">Please Fill quantity!</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add4"class="btn btn-outline btn-primary" >Save</button>
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
 <script src="../../js/items.js"></script>
</body>

</html>
