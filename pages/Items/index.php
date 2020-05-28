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
                
                    <h1 class="page-header">Items</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					<form method="post">
						<div class="row">
							<div class="col-lg-2">
                <label>Group</label>
                <select name="group" class="form-control" onchange="this.form.submit();" >
          <option value="0">All</option>
           <?php include('configdb.php');
            $sql="select * from itemsgroups  ";
            $results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
            ?>
 <option value="<?php echo $x['serial']; ?>" <?php if(isset($_POST['group'])){if($_POST['group']==$x['serial']){echo "selected";}} ?>>


  <?php echo $x['description'];   ?></option>
          <?php } ?>
         </select>
								</div>
						 <div class="col-lg-2">
                               <label>Idle</label>
                                   
                                     
                                     	
                                     	
                                      <select class="form-control" id="fstatus" name="fstatus" style="width: 100%; " onchange="this.form.submit();">
      <option value="All" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'All') echo("selected");} ?>>All</option>
     <option value="1" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == '1') echo("selected");} ?>>Idle</option>
	 <option value="0" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == '0') echo("selected");} ?>>Not Idle</option>
	 
		</select> 
                                   
                                
                             </div>
                            
                             <div style="text-align: center;" class="col-lg-2">
                           <label>  Filter</label><select class="form-control" id="radio" name="radio" style="width: 100%; " onchange="this.form.submit();">
      <option value="All" <?php if (isset($_POST['radio'])) {	if ($_POST['radio'] == 'All') echo("selected");} ?>>Original</option>
     <option value="code" <?php if (isset($_POST['radio'])) {	if ($_POST['radio'] == 'code') echo("selected");} ?>>Code</option>
	 <option value="description" <?php if (isset($_POST['radio'])) {	if ($_POST['radio'] == 'description') echo("selected");} ?>>Description</option>
	 
		</select> 
                             

                             </div>


                             <div style="text-align: center;" class="col-lg-4">
                          
                             </div>
                              <div class="col-lg-2">
                                   <label>&nbsp;</label><br>
            <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['ice']!=1){ echo('disabled'); }?>>Add Item</button>
                             </div>
                             </div>
					</form>
							 
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Image</th>
                                    	<th>Code</th>
                                        <th>Description</th>
                                           <th>Category</th>
                                        <th>Dimension</th>
                                        <th>Detailed Description</th>
                                        <th>Custom Code</th>
                                        <th>Unit</th>
                                        <?php if($_SESSION['hidevalues']!=1){?>
                                        <th>Price USD</th>
                                       <th>Price KD</th>
                                       <th>Price AED</th>
                                        <th>Cost</th>
                                         <th>Usual Supplier</th>
                                       <?php }?>
                                        <th>Group</th>
                                         <?php if($_SESSION['ice']==1){?>  <th>Duplicate</th>     <th>Edit</th> <?php }?>
									   <?php if($_SESSION['icd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
							$idol='';
                $group='';
                $radio='';
		if(isset($_POST['fstatus']) && $_POST['fstatus']!='All') 
{
	$idol=" and idol=".$_POST['fstatus'];
}	

if(isset($_POST['group'])){
   if($_POST['group']!='0')
  $group=" and group1='".$_POST['group']."' ";  
}




if(isset($_POST['radio'])){

   if($_POST['radio']=='code')
    $radio=" order by code asc "; 

  if($_POST['radio']=='description')
  $radio=" order by description asc ";
 
}





include('../configdb.php');
$query = "Select *,
(select url from itemattachment where itemid=items.serial limit 1) as url,
(select symbol from currencies where serial=items.currency)as currencyS,
(select description from itemscategory where serial=items.cat)as cat,
(select color from itemsgroups where serial=items.group1)as color,
(select description from itemsgroups where serial=items.group1)as groupN From items where serial <> 0".$idol.$group	;
if($radio=='')
$query=$query." order by (select group1 from itemsgroups where serial=items.group1) asc,code asc";
 
 else
  $query=$query.$radio;


 
 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" style="background-color:<?php echo $x['color']; ?>; ">   
                                    	 <td><img style="width:130px;" src="<?php echo($x["url"]);?>" /></td>  
                                    	 <td><?php echo($x["code"]);?></td>                                	
                                        <td><?php echo($x["description"]);?></td>
                                       <td><?php echo($x["cat"]);?></td>
                                         <td><?php echo($x["dimension"]);?></td>
                                          <td><?php echo($x["ddescription"]);?></td>
                                           <td><?php echo($x["ccode"]);?></td>
                                        
                                        <td><?php echo($x["unit"]);?></td>
                 						<?php if($_SESSION['hidevalues']!=1){?>
                 						<td><?php echo($x["priceusd"]);?></td>
                 					<td><?php echo($x["pricekd"]);?></td>
                 					<td><?php echo($x["priceaed"]);?></td>
                 					<td><?php echo($x["cost"]);?></td>
                 					<td><?php echo($x["usupplier"]);?></td>
                 					<?php }?>
                 						<td><?php echo($x["groupN"]);?></td>
                                       <?php if($_SESSION['ice']==1){?>
                                        <td class="center">
<a  id="Dup_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-copy"></p> Duplicate</a>
</td>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['icd']==1){?>
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
            "aaSorting" : [],
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
        	<label>Code</label><input class="form-control" type="text"   name="code"  id="code" style="width:100%;" required>
        	
	<label>Description</label><input class="form-control" type="text"   name="description"  id="description" style="width:100%;" required>
	<label>Dimension</label><input class="form-control" type="text"   name="dimension"  id="dimension" style="width:100%;" required>
	<label>Detailed Description</label><input class="form-control" type="text"   name="ddescription"  id="ddescription" style="width:100%;" required>
	<label>Custom Code</label><input class="form-control" type="text"   name="ccode"  id="ccode" style="width:100%;" required>
	<label>Unit</label><input class="form-control" type="text"   name="unit"  id="unit" style="width:100%;" required>
	<label>Price USD</label><input class="form-control" type="number"   name="priceusd"  id="priceusd" style="width:100%;" required>
	<label>Price KD</label><input class="form-control" type="number"   name="pricekd"  id="pricekd" style="width:100%;" required>
	<label>Price AED</label><input class="form-control" type="number"   name="priceaed"  id="priceaed" style="width:100%;" required>
	<label>Cost</label><input class="form-control" type="number"   name="cost"  id="cost" style="width:100%;" required>
	<label>Usual Supplier</label><input class="form-control" type="text"   name="usupplier"  id="usupplier" style="width:100%;" required>
	<?php	$query = "Select * From currencies";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
			 	 			<select class="form-control" id="currency1" style="width: 100%; display: none;">
	 
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['SERIAL']); ?>" ><?php echo($x['Symbol']); ?></option>
 <?php 
}?>
		</select> 
	<label>Group</label><select class="form-control" id="group" style="width: 100%; ">
		<?php
	$query = "Select * From itemsgroups order by description asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['serial']); ?>" ><?php echo($x['description']); ?></option>
 <?php 
}?>
		</select>



    <label>Category</label><select class="form-control" id="cat" style="width: 100%; ">
  <option value=""></option>
    <?php
  $query = "Select * From itemscategory order by description asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
mysqli_data_seek($results, 0);
    while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['serial']); ?>" ><?php echo($x['description']); ?></option>
 <?php } ?>
    </select>



    <br>
		 <div class="row">

      <div class="col-lg-2">
        <label>
        <input type="checkbox" id="idol" value="1">Idle
        </label>
        </div>


        <div class="col-lg-2">
        <label>
        <input type="checkbox" id="default1" value="1">Default
        </label>
        </div>

</div>
        <div class="row nopadding">
        	<div class='col-lg-6 nopadding'>
		<label id ="lblalert2" style="visibility: hidden; color: red;">Please Save the Item before adding quantity !</label>
	</div>
	<div class='col-lg-6 nopadding' align="right">
		<button type="button" id="Ad1" class="btn btn-outline btn-primary" >Add Quantity</button>
	</div>
	</div>
		
						 <br>
			 <div class="row">
			<table align="left" style="width: 100%;" border="1">
				<thead>
                <th>Date</th>
					<th>Size</th>
					<th>Quantity</th>
          <th>Difference</th>
                    <?php if ($_SESSION['ViewQuantity']==1){?>
					<th>Action</th>
                    <?php }?>
				</thead>
				<tbody id="followup"></tbody>
			</table>	
			</div>
			<div class="col-lg-12 nopadding" align="center">
		<label>Image</label>
 		 <div class="file-loading">
            <input id="images" name="images[]" type="file" multiple>
    </div>
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
