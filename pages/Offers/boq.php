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
<link href="../../vendor/fileupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
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
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	  <link href="../../vendor/fileupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
	 <link href="../../vendor/bootstrap/css/bootstrap-multiselect.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shi

        v.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	<link rel="stylesheet" href="../Date/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="../../select2/dist/css/select2.css">
	<script src="../Date/jquery-1.9.1.js"></script>
	<script src="../../vendor/jquery/jquery.min.js"></script>
	<script src="../Date/ui/jquery.ui.core.js"></script>
	
	<script src="../Date/ui/jquery.ui.widget.js"></script>
	
	<script src="../Date/ui/jquery.ui.datepicker.js"></script>
	
	<script>
		$(function() {
			if ($('[type="date"]').prop('type') != 'date') {
				$('[type="date"]').datepicker();
			}

		});
	</script>
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
 
	if (!isset($_SESSION['Login']) || $_SESSION['Login'] != true) {
		header("Location: ../Login");
	}
	if ($_SESSION['ocv'] != 1) {
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
                <?php 

  $query="select * from offers where serial='".$_GET['offerid']."' ";//

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
$y = mysqli_fetch_array($results);?>
	
                    <h1 class="page-header">BOQ - <?php echo $y[1]; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" >
						 
					 
                  
						<div class="row">
               
          
                              <div class="col-lg-2" >
                              
<button type="button"  id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php
  if ($_SESSION['oce'] != 1) { echo('disabled'); }
?> >Add BOQ</button>
                             </div>
                             <div class="col-md-2">
                             <a class="btn btn-outline  btn-primary" href="boq_rpt_all.php?serial=<?php echo $_GET['offerid'];?>" target="_blank">Print</a>
                             </div>
                                 
            </div>
						
 
		 
					  
		 
       
      
    
						
              
                    
                           
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>	
        <!-- /#page-wrapper --> 
<div class="row">
	    
<br />

	 <div class="col-lg-12">
                	
                    <div class="panel panel-default">
             
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 100%;">
                                <thead>
                                                <tr>
                                          <th>Green Wall Area</th> 
                                           

                                           <th>Windows Area</th>
                                            <th>Doors Area</th>


                                             <th>Zones Qty</th>
                                              <th>PVC Qty</th>
                                               <th>Omega Qty</th>
                                                <th>Jambs Qty</th>
                                                 <th>Skin Qty</th>

                                          <th>Action</th>
                                               </tr>
                                            </thead>
                     <tbody>
                                              <?php
								
include('../configdb.php');
 
$query="select * from boq where offer_id='".$_GET['offerid']."' ";//

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	
									 <tr class="odd gradeX">
                                 
                                     <td><?php echo $x['gw_area'] ?></td>
                                     <td><?php echo $x['windows_area'] ?></td>
                                     <td><?php echo $x['doors_area'] ?></td>

                                      <td><?php echo $x['zonesqty'] ?></td>
                                       <td><?php echo $x['pvcqty'] ?></td>
                                        <td><?php echo $x['omegaqty'] ?></td>
                                         <td><?php echo $x['jambsqty'] ?></td>
                                          <td><?php echo $x['skinqty'] ?></td>
                                      <td class="center">


<a target="_blank" href="boq_rpt.php?serial=<?php echo $x["serial"]; ?>" ><p class="fa fa-print"></p></a>&nbsp;
 

<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p></a>&nbsp;
 
 
  <a href="" id="del_<?php echo($x["serial"]);?>"    ><p class="fa fa-trash-o"></p></a>
</td>
 
 
                                                                        
                                      </tr>
								 
									             <?php } ?>
                                            </tbody>
                            </table>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            
</div>
 
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

<script src="../../vendor/bootstrap/js/bootstrap-multiselect.js"></script>
    <!-- DataTables JavaScript -->
    
   
<script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
<script src="../../bower_components/dist/sweetalert2.all.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 <script src="../../select2/dist/js/select2.js"></script>
<script src="../../select2/dist/js/i18n/it.js"></script>
<script src="../../select2/dist/js/i18n/nl.js"></script>
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
	<div class="modal fade" id="ImageModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Offer Image</h4>
        </div>
        <div class="modal-body">
		<table width="100%" height="100%">
		<tr>
           <img src="" class="img-responsive" alt="" id="oimage">
		   </tr>

		   </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" >
   
      <!-- Modal content-->
      <div class="modal-content"  >
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="center">		
<fieldset  width="100%" height="100%">
		   <legend  style="font-size: 20px;background: #428bca;color: white;" >Green Wall</legend>
		
	
 


        <div class="row">
           <div class="col-lg-3">
 
        <label>
       Height
        </label>
          <input class="form-control" type="number"   name="height"  id="gwheight"  >
        
      </div>

      <div class="col-lg-3">
 
        <label>
       Width
        </label>
          <input class="form-control" type="number"   name="width"  id="gwwidth"  >
        
      </div>


      <div class="col-lg-3">
 
        <label>
       Area
        </label>
          <input class="form-control" type="number"   name="width"  id="gwarea" readonly  >
        
      </div>

 
        </div>
        <div class="row" style="padding-top: 20px">
        <div class="col-lg-12" style="text-align: left;">
          <ul>
            <a id="show_windows"><li>+ Windows</li></a>
            <a id="show_doors"> <li>+ Doors</li></a>
          </ul>
 

</div>
</div>
   <legend id="legend_windows" style="font-size: 20px;background: #428bca;color: white;margin-top: 20px;display: none;" >Windows</legend>

 
<div id="div_windows" class="row" style="display: none;">

 <div class="col-lg-3"> 
        <label>
          Quantity
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="windowsqty"  >
         
   </div>




   <div class="col-lg-3"> 
        <label>
          Width
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="windowswidth"  >
         
   </div>



   <div class="col-lg-3">
   
        <label>
           Height
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="windowsheight"  >
         
   </div>


   <div class="col-lg-3">
   
        <label>
           Area
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="windowsarea" readonly >
         
   </div>
</div>







   <legend id="legend_doors" style="font-size: 20px;background: #428bca;color: white;margin-top: 20px;display: none;" >Doors</legend>

 
<div class="row" id="div_doors" style="display: none;">

 <div class="col-lg-3"> 
        <label>
          Quantity
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="doorsqty"  >
         
   </div>




   <div class="col-lg-3"> 
        <label>
          Width
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="doorswidth"  >
         
   </div>



   <div class="col-lg-3">
   
        <label>
           Height
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="doorsheight"  >
         
   </div>


   <div class="col-lg-3">
   
        <label>
           Area
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="doorsarea" readonly >
         
   </div>
</div>


<legend  style="font-size: 20px;background: #428bca;color: white;margin-top: 20px" >Skin</legend>

<div class="row">
  <div class="col-lg-3">
   
        <label>
Choose Skin Type
           
        </label>
         <select class="form-control"  id="skintype"  >
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>

</select>         
   </div>
</div>

   <legend  style="font-size: 20px;background: #428bca;color: white;margin-top: 20px" >Zones</legend>

 
<div class="row">


  <div class="col-lg-3"> 
        <label>
           &nbsp;
        </label>
         <button type="button" id="calc"class="btn btn-success btn-block" >Calculate</button>
     
   </div>

 <div class="col-lg-3"> 
        <label style="display: none;">
          Quantity
        </label>
         <input style="display: none;" class="form-control" type="number"   name="windowwid"  id="zonesqty"  >
         
   </div>

   


 
        

  
</div>






   <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >PVC</legend>

 
<div class="row">

 <div class="col-lg-3"> 
        <label>
          Quantity
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="pvcqty"  >
         
   </div>




   <div class="col-lg-3"> 
        <label>&nbsp;
          Close End Rivets
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="pvcclose"  >
         
   </div>



   <div class="col-lg-3">
   
        <label>
           Water Proofing Tape
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="pvcwater"  >
         
   </div>
 
</div>

<div class="row">
  <div class="col-lg-3">
    
  </div>


  <div class="col-lg-3">
   <label>   Close End Rivets Type</label>


     <select class="form-control"     id="closetype"   >
          <?php 
          $sql="select * from items where cat='6' order by default1 desc  ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']; ?></option>
   <?php } ?>
          </select>
    
  </div>


 <div class="col-lg-3">
   <label>Water Proofing Tape Type</label>


     <select class="form-control"     id="watertype"   >
          <?php 
          $sql="select * from items where cat='7' order by default1 desc ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['dimension']; ?></option>
   <?php } ?>
          </select>
    
  </div>













</div>


   <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Omega</legend>

<div class="row">

 <div class="col-lg-3"> 
        <label>
          Quantity
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="omegaqty"  >
         
   </div>




   <div class="col-lg-3"> 
        <label>
          Screws
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="omegascrews"  >
         
   </div>



   <div class="col-lg-3">
   
        <label>
           Anchors
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="omegaanchors"  >
         
   </div>
 

   <div class="col-lg-3">
   
        <label>
           
 Water Sealant 
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="omegawater"  >
         
   </div>
 


</div>

<div class="row">
   <div class="col-lg-3">
   <label>Omega Type</label>


     <select class="form-control"     id="omegatype"   >
          <?php 
          $sql="select * from items where cat='10' order by default1 desc ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']; ?></option>
   <?php } ?>
          </select>
    
  </div>



   <div class="col-lg-3">
   <label>Screws Type</label>


     <select class="form-control"     id="screwstype"   >
          <?php 
          $sql="select * from items where cat='11' order by default1 desc  ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']; ?></option>
   <?php } ?>
          </select>
    
  </div>


   <div class="col-lg-3">
   <label>Anchors Type</label>


     <select class="form-control"     id="anchorstype"   >
          <?php 
          $sql="select * from items where cat='12' order by default1 desc ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']; ?></option>
   <?php } ?>
          </select>
    
  </div>



 <div class="col-lg-3">
   <label>Water Sealant Type</label>


     <select class="form-control"     id="watersealanttype"   >
          <?php 
          $sql="select * from items where cat='13' order by default1 desc ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']; ?></option>
   <?php } ?>
          </select>
    
  </div>



</div>  

   <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Jambs</legend>
<div class="row">

 <div class="col-lg-3"> 
        <label>
          Quantity
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="jambsqty"  >
         
   </div>




   <div class="col-lg-3"> 
        <label>
          Screws
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="jambsscrews"  >
         
   </div>



   <div class="col-lg-3">
   
        <label>
           Anchors
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="jambsanchors"  >
         
   </div>
 

   <div class="col-lg-3">
   
        <label>
           
 Water Sealant 

        </label>
         <input class="form-control" type="number"   name="windowhei"  id="jambswater"  >
         
   </div>
</div>
<div class="row">


   <div class="col-lg-3">
   <label>Jambs Type</label>


     <select class="form-control"     id="jambstype"   >
          <?php 
          $sql="select * from items where cat='9' order by default1 desc ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']." - ".$x['dimension']; ?></option>
   <?php } ?>
          </select>
    
  </div>

<div class="col-lg-3"></div>
<div class="col-lg-3"></div>



  <div class="col-lg-3">
   <label>Water Sealant Type</label>


     <select class="form-control"     id="watersealant2type"   >
          <?php 
          $sql="select * from items where cat='13' order by default1 desc ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']; ?></option>
   <?php } ?>
          </select>
    
  </div>
 
 


</div>
 
 <div class="row">
     <div class="col-lg-3">
   
        <label>
           
 Corners

        </label>
         <input class="form-control" type="number"   id="corners" value="2"  >
         
   </div>
 </div>


   <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Irrigation Pipes</legend>
<div class="row">

 <div class="col-lg-3"> 
        <label>
          Pipe Length
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="pipe"  >
         
   </div>


    <div class="col-lg-3"> 
        <label>
          Pipe Size
        </label>
         <select class="form-control" id="pipesize">
          <option value="16">16mm</option>
           <option value="20">20mm</option>
           <option value="25">25mm</option>
           <option value="32">32mm</option>
           <option value="40">40mm</option>
           <option value="50">50mm</option>
            <option value="63">63mm</option>
           
         </select>
         
   </div>




   <div class="col-lg-3"> 
        <label>
          GS Watering Mat (sqm)
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="gs"  >
         
   </div>



   <div class="col-lg-3">
   
        <label>
           Staples 
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="staples"  >
         
   </div>
 

   <div class="col-lg-3">
   
        <label>
           
Lock and Loop Sleeve

        </label>
         <input class="form-control" type="number"   name="windowhei"  id="lock"  >
         
   </div>
 

 <div class="col-lg-3">
   
        <label>
           

Skin to cover Flushing

        </label>
         <input class="form-control" type="number"   name="windowhei"  id="skin"  >
         
   </div>

    <div class="col-lg-3">
   
        <label>
Emitters           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="emitters"  >
         
   </div>


   <div class="col-lg-3">
   
        <label>
PC Emitters           
        </label>
         <select class="form-control"   id="pcemitters" >
          <option value="02">PC-02</option>
          <option value="05">PC-05</option>
          <option value="07">PC-07</option>
          <option value="10">PC-10</option>
          <option value="12">PC-12</option>
          <option value="18">PC-18</option>
          <option value="24">PC-24</option>

         
         </select>
   </div>
 
 <div class="row" style="padding-left:10px"> 

  <div class="col-lg-3"> 
        <label>
          PE Elbow
        </label>
         <select class="form-control" id="elbow">
          <option value="16">16mm</option>
           <option value="20">20mm</option>
           <option value="25">25mm</option>
           <option value="32">32mm</option>
           <option value="40">40mm</option>
           <option value="50">50mm</option>
           <option value="63">63mm</option>
           
         </select>
         
   </div>


   <div class="col-lg-3"> 
        <label>
           Elbow Quantity
        </label>
           <input class="form-control" type="number"     id="elbowqty"  >
         
         
   </div>

 <div class="col-lg-6"> 
 </div>

 </div>
 <div class="row" style="padding-left:10px">
    <div class="col-lg-3"> 
        <label>
          PE Ball Valve
        </label>
         <select class="form-control" id="ball">
          <option value="16">16mm</option>
           <option value="20">20mm</option>
           <option value="25">25mm</option>
           <option value="32">32mm</option>
           <option value="40">40mm</option>
           <option value="50">50mm</option>
           <option value="63">63mm</option>
         </select>
         
   </div>

<div class="col-lg-3"> 
        <label>
            Ball Valve Quantity
        </label>
         
          <input class="form-control" type="number"     id="ballqty"  >
         
   </div>

<div class="col-lg-6"> 
</div>

</div>
<div class="row" style="padding-left:10px"> 
    <div class="col-lg-3"> 
        <label>
          PE Adaptor
        </label>
         <select class="form-control" id="adapter">
          <option value="16">16mm</option>
           <option value="20">20mm</option>
           <option value="25">25mm</option>
           <option value="32">32mm</option>
           <option value="40">40mm</option>
           <option value="50">50mm</option>
           <option value="63">63mm</option>
           
         </select>
         
   </div>



   <div class="col-lg-3"> 
        <label>
          PE Adaptor
        </label>
         <input class="form-control" type="number"     id="adapterqty"  >
         
         
   </div>

   <div class="col-lg-6"> 
   </div>

</div>
</div>


  <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Skin</legend>
  <div class="row">


<div class="col-lg-3">
   
        <label>
Choose Skin Size
           
        </label>
         <select class="form-control"  id="skintype1"  >
<option value="1">60 cm Skin</option>
<option value="2">30 cm Skin</option>

</select>         
   </div>







      <div class="col-lg-3">
   
        <label>
Modulus           
        </label>
         <input class="form-control" type="number"  readonly name="windowhei"  id="modulus"  >
         
   </div>


     <div class="col-lg-3">
   
        <label>
Skin Quantity 60 cm           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="skinqty"  >
         
   </div>


     <div class="col-lg-3">
   
        <label>
Add Quantity 30 cm
           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="skinadd"  >
         
   </div>






     <div class="col-lg-3">
   
        <label>
Staples per sqm
           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="staplespersqm"  >
         
   </div>


    
  </div>





   <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Staples</legend>
  <div class="row">
 <div class="col-lg-3">
   
        <label>
Quantity           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="staplesqty"  >
         
   </div>





<div class="col-lg-3">
   <label>Staples Type</label>


     <select class="form-control"     id="staplestype"   >
          <?php 
          $sql="select * from items where cat='8' order by default1 desc  ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['description']; ?></option>
   <?php } ?>
          </select>
</div>



</div>
			



       <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Gutter Lengths (m)</legend>
  <div class="row">
 <div class="col-lg-3">
   
        <label>
Walls           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="gutterwalls"  >
         
   </div>


    <div class="col-lg-3">
   
        <label>
Windows           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="gutterwindows"  >
         
   </div>


    <div class="col-lg-3">
   
        <label>
Doors           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="gutterdoors"  >
         
   </div>
</div> 




       <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Sensors</legend>
  <div class="row">
 <div class="col-lg-3">
   
        <label>
SM150T           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="sensorssm150t"  >
         
   </div>


    <div class="col-lg-3">
   
        <label>
Flow Sensor           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="sensorsflow"  >
         
   </div>


   
</div> 



  <legend  style="font-size: 20px;background: #5cb85c;color: white;margin-top: 20px" >Irrigation controller Board</legend>
  <div class="row">
 <div class="col-lg-3">
   
        <label>
Type           
        </label>
         <select class="form-control"     id="microtype"   >
          <?php 
          $sql="select * from microcontrollers  ";//

$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
   
<option value="<?php echo $x['serial']; ?>"><?php echo $x['name']; ?></option>
   <?php } ?>
          </select>
         
   </div>


    <div class="col-lg-3">
   
        <label>
Quantity           
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="microqty"  >
         
   </div>



    <div class="col-lg-3">
   
        <label>
Plumbing System           
        </label>
         <select class="form-control"     id="plumbsys"   >
      
<option value="Single Station unit with electric injector">Single Station unit with electric injector</option>

<option value="Single Station unit with water driven injector">Single Station unit with water driven injector</option>
<option value="Double Station unit with electric Injector">Double Station unit with electric Injector</option>
<option value="Double Station unit with water driven injector">Double Station unit with water driven injector</option>
<option value="Multiple Station unit with electric Injector">Multiple Station unit with electric Injector</option>
<option value="Multiple Station unit with water driven injector">Multiple Station unit with water driven injector</option>
 <option value="None">None</option>
 
          </select>
         


   
</div>


    <div class="col-lg-3">
   
        <label>
Plumbing System Quantity        
        </label>
          
           <input class="form-control" type="number"   name="windowhei"  id="plumbsysqty"  >
          


   
</div> 

</div>

<div>&nbsp;</div>


  
    
        <div class="modal-footer"  >
			<label id ="lblalert1" style="visibility: hidden; color: red;">Please Choose Attachment !</label>
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Project Name !</label>



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
  <div class="modal fade" id="myModal2" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title2"></h4>
        </div>

        <div class="modal-body" align="center">		
	<label>Date</label><input class="form-control" type="date"   name="dat"  id="dat" style="width:100%;" >
	<label>Description</label><textarea class="form-control" type="text"   name="description1"  id="description1" style="width:100%;" rows="2"></textarea>
		
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert3" style="visibility: hidden; color: red;">Please Fill Description!</label>
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







 <div class="modal fade" id="myModala" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title22"></h4>
        </div>

        <div class="modal-body" align="center">   
  <label>Date</label><input class="form-control" type="date"   name="dato"  id="dato" style="width:100%;" >
  <label>Description</label><input class="form-control" type="text"   name="descriptiona"  id="descriptiona" style="width:100%;" >
    
        </div>
        <div class="modal-footer" >
    
          <label id ="alert1" style="visibility: hidden; color: red;">Please Fill Description!</label>
    <table align="center"  >
      
    <tr>
    <td>
  
        <button type="button" id="adddd"class="btn btn-outline btn-primary" >Save</button>
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
          <h4 class="modal-title" id="ctitle"></h4>
        </div>

        <div class="modal-body" align="center">		
		
	
	Company<input class="form-control" type="text"   name="company"  id="company" style="width:100%;" required>




Specialty<select name="specialty" class="form-control" id="specialty"  >
							<?php
								
include('../configdb.php');
$query = "Select * From cclients order by Specialty asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['Specialty']); ?>"><?php echo($x['Specialty']); ?></option>
						  <?php } ?>
						</select>
Website<input class="form-control" type="text"   name="website"  id="website" style="width:100%;" >

	Country <input class="form-control" type="text" id="ccountry" name="country" list="ccountryy" />
<datalist id="ccountryy">
  <?php
								
include('../configdb.php');
$query = "Select distinct(country) as country From customers order by country asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['country']); ?></option>
						  <?php } ?>
</datalist>
City<input class="form-control" type="text"   name="city"  id="ccity" style="width:100%;" >
Tel<input class="form-control" type="text"   name="tel"  id="tel" style="width:100%;" >
Fax<input class="form-control" type="text"   name="fax"  id="fax" style="width:100%;" >

First Name<input class="form-control" type="text"   name="fname"  id="fname" style="width:100%;" required>
	Last Name<input class="form-control" type="text"   name="lname"  id="lname" style="width:100%;" >
Title <input class="form-control" type="text"   name="titlee"  id="titlee" style="width:100%;" >
Email<input class="form-control" type="text"   name="email"  id="email" style="width:100%;" >

	Mobile<input class="form-control" type="text"   name="mobile"  id="mobile" style="width:100%;" >
	Referred By<input class="form-control" type="text"   name="referral"  id="referral" style="width:100%;" >
<select name="category" class="form-control" id="ccategory" style=" display:none; visibility:hidden;" >
							<?php
								
include('../configdb.php');
$query = "Select * From category";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['serial']); ?>"><?php echo($x['description']); ?></option>
						  <?php } ?>
						</select>
Notes<textarea class="form-control" type="text"   name="notes"  id="cnotes" size="4" style="width:100%;" > </textarea>

   	  	 

  <!--<input type="checkbox" id="admin"  name="Admin" value="admin"> Admin -->

        </div>
        <div class="modal-footer" >
		
        	<label id ="clblalert" style="visibility: hidden; color: red;">Company and Specialty must be filled !</label>
		<table align="center"  >
			
		<tr>
		
		<td width="10">
		</td>
		<td>
	
        <button type="button" id="add5"class="btn btn-outline btn-primary" >Save</button>
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
 <iframe id="my_iframe" style="display:none;"></iframe>


<?php if(isset($_POST['xls'])){   


$_SESSION['flag']=0;
 

  require_once '../../../PHPExcel/Classes/PHPExcel.php';

//   $objPHPExcel = new PHPExcel();
//   $objPHPExcel->setActiveSheetIndex(0);
//   $objPHPExcel->getActiveSheet()->SetCellValue('A1', "12");

//    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
//    header('Content-Type: application/vnd.ms-excel');
//    header('Content-Disposition: attachment;filename="excel.xls"');
//    header('Cache-Control: max-age=0');
//    $writer->save('php://output');
 


  // Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$last=0;

// Set properties
$objPHPExcel->getProperties()->setCreator("----- Web Server");
$objPHPExcel->getProperties()->setLastModifiedBy("-----Web Server");
$objPHPExcel->getProperties()->setTitle("Salesman report");
$objPHPExcel->getProperties()->setSubject("Salesman report");
 

// Create a first sheet, representing sales data
//$objPHPExcel->setActiveSheetIndex(0);  

   $objPHPExcel->setActiveSheetIndex(0);
   $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');

   $objPHPExcel->getActiveSheet()->SetCellValue('A1', "ProjectName");  
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', "Country"); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C1', "City"); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D1', "Client"); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E1', "Status");   
       $objPHPExcel->getActiveSheet()->SetCellValue('F1', "Status Date");   
       $objPHPExcel->getActiveSheet()->SetCellValue('G1', "GW");   
       $objPHPExcel->getActiveSheet()->SetCellValue('H1', "GW Area");  
         $objPHPExcel->getActiveSheet()->SetCellValue('I1', "RG");   
          $objPHPExcel->getActiveSheet()->SetCellValue('J1', "RG Area"); 
            $objPHPExcel->getActiveSheet()->SetCellValue('K1', "Offer Ref#"); 
            $objPHPExcel->getActiveSheet()->SetCellValue('L1', "Refferal"); 


            $objPHPExcel->getActiveSheet()->SetCellValue('M1', "Offer"); 
            $objPHPExcel->getActiveSheet()->SetCellValue('N1', "HP"); 
            $objPHPExcel->getActiveSheet()->SetCellValue('O1', "Offer value"); 
            // $objPHPExcel->getActiveSheet()->SetCellValue('P1', "Cost"); 


           //$objPHPExcel->getActiveSheet()->SetCellValue('Q1', "Gross Margin"); 
            //$objPHPExcel->getActiveSheet()->SetCellValue('R1', "Remaining"); 
           //  $objPHPExcel->getActiveSheet()->SetCellValue('S1', "Canceled"); 


            // $objPHPExcel->getActiveSheet()->SetCellValue('T1', "Kick-Off Day"); 
            //$objPHPExcel->getActiveSheet()->SetCellValue('U1', "Due date"); 
            // $objPHPExcel->getActiveSheet()->SetCellValue('V1', "Attach"); 

             // $objPHPExcel->getActiveSheet()->SetCellValue('W1', "Tasks"); 
            $objPHPExcel->getActiveSheet()->SetCellValue('P1', "Build up  "); 
           //  $objPHPExcel->getActiveSheet()->SetCellValue('Y1', "Printout"); 
             //$objPHPExcel->getActiveSheet()->SetCellValue('Z1', "Completed"); 
               //$objPHPExcel->getActiveSheet()->SetCellValue('Q1', "Completed"); 
             //  $objPHPExcel->getActiveSheet()->SetCellValue('AA1', "Notes"); 
$sql=$query1xls;
$i=3;

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }

$res2 = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($res2)){



               

 if ($x["status"] == 'CANCELED') {

     $objPHPExcel->getActiveSheet()
    ->getStyle('A'.$i.':P'.$i)->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FFFF0000');
    } 
    elseif ($x["status"] == 'COMPLETED') {  $objPHPExcel->getActiveSheet()
    ->getStyle('A'.$i.':P'.$i)
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('990099');
    } elseif ($x["status"] == 'POTENTIAL') {
       $objPHPExcel->getActiveSheet()
    ->getStyle('A'.$i.':P'.$i)
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FF00FF00');
    } elseif ($x["status"] == 'OFFER') { 
    } elseif ($x["status"] == 'IN HAND') {  
      $objPHPExcel->getActiveSheet()
    ->getStyle('A'.$i.':P'.$i)
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FFafeeee');
    } elseif ($x["status"] == 'INQUIRIES') { 
    $objPHPExcel->getActiveSheet()
    ->getStyle('A'.$i.':P'.$i)
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('F75A53');
    }elseif ($x["status"] == 'ARCHIVED') {
        $objPHPExcel->getActiveSheet()
    ->getStyle('A'.$i.':P'.$i)
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FFFFFF00');
    }
                 








 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $x['ProjectName']);  
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $x['Country']); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$x['city'] ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,$x['Client']); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $x['status']);   

       $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, date("Y-m-d", strtotime($x['statusdate'])));   
       if($x['GW']==0)
       $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, "No" ); 
     else
      $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, "Yes" );
  
       $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i,   $x['GWAREA']  ); 
       
 if($x['RG']==0)
       $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,  "No" ); 
       else
          $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,  "Yes" ); 
     
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i,    $x['RGAREA']  ); 
      

        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $x['OfferRef']);  
    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $x['Referral']); 


    if ($x["status"] != 'OFFER')
     $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i,"No"); 
   else
       $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i,"Yes" ); 

   if ($x["hp"] != 1)
      $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, "No"); 
    else
       $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i,"Yes"); 

  $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, round($x["OfferValue"], 2) );   
      // $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i,round($x["cost"], 2) );   
      // $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i,round($x["gross"], 2));   
       //$objPHPExcel->getActiveSheet()->SetCellValue('R'.$i,  round($x["remaining"], 2) ); 

     //   if ($x["status"] != 'Canceled')
     //   $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i,  "Yes" );  
     // else
     //   $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i,  "No" ); 


       //$objPHPExcel->getActiveSheet()->SetCellValue('T'.$i,   $x['kickoff']  );  
      //  $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i,  $x['duedate'] ); 

        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $x['buildup']);  
   // $objPHPExcel->getActiveSheet()->SetCellValue('W'.$i, $x['cnttask']); 
     //$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$i,$x['cprintout'] ); 

// if ($x["status"] != 'Completed')
//        $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$i,  "Yes" );  
//      else
//        $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$i,  "No" ); 


     
       //$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$i,   $x['notes']  ); 
       
 
 


       $i++;
       $last=$i;
  }
$last+=2;
  // $objPHPExcel->createSheet();
 

  //  $objPHPExcel->setActiveSheetIndex(1);
  //  $objPHPExcel->getActiveSheet()->setTitle('Sheet 2');
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.$last, "");  
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$last, "Total"); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.$last, "RG"); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.$last, "GW"); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.$last, "Remaining");   
       

   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+1), "Budget");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+2), "INQUIRY");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+3), "In HAND");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+4), "Offer not HP");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+5), "Potential");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+6), "Complete");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+7), "Cancelled");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+8), "High Prob");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+9), "Business Development");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+10), " Agent");  
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+11), " Archived");  
$sql=$query2xls;
$j=3;
$res2 = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
 $x = mysqli_fetch_array($res2);


//      $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray(
//     array(
//         'fill' => array(
//             'type' => PHPExcel_Style_Fill::FILL_SOLID,
//             'color' => array('rgb' => 'FF0000')
//         )
//     )
// );

    $objPHPExcel->getActiveSheet()
    ->getStyle('A'.($last+1).':E'.($last+1))
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('A9A9A9');

$objPHPExcel->getActiveSheet()
    ->getStyle('A'.($last+2).':E'.($last+2))
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setRGB('F75A53');
 

$objPHPExcel->getActiveSheet()
    ->getStyle('A'.($last+3).':E'.($last+3))
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FF0000FF');
 

  

 

 
 

      $objPHPExcel->getActiveSheet()
    ->getStyle('A'.($last+5).':E'.($last+5))
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FF00FF00');
  

    $objPHPExcel->getActiveSheet()
    ->getStyle('A'.($last+6).':E'.($last+6))
    ->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'EE82EE')
            )
        )
    );

     $objPHPExcel->getActiveSheet()
    ->getStyle('A'.($last+7).':E'.($last+7))
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FFFF0000');

 $objPHPExcel->getActiveSheet()
    ->getStyle('A'.($last+11).':E'.($last+11))
    ->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB('FFFFFF00');

     $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+1),round((float)$x["sOFFERINQBudget"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+1),round((float)$x["sRGAREA"], 2)  ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+1), round((float)$x["sGWAREA"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+1),"");   
        

$objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+2), round((float)$x["sINQ"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+2),round((float)$x["sRGINQ"], 2)  ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+2), round((float)$x["sGWINQ"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+2),"");  

 
$objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+3), round($x["sInHandBudget"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+3),round($x["sINHANDRGBudget"], 2)  ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+3), round($x["sINHANDGWBudget"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+3),round($x["sINHANDRemaining"], 2));  


 

$objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+4), round($x["sOFFERBudget"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+4),round($x["sRGOFFERBudget"], 2)  ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+4), round($x["sGWOFFERBudget"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+4),"");  

   
   $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+5), round($x["sPOT"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+5),round((float)$x["sRGPOT"], 2)  ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+5), round((float)$x["sGWPOT"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+5),"");  
 
                          

       $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+6), round($x["sCompletedBudget"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+6),round($x["sRGCompletedBudget"], 2)  ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+6), round($x["sGWCompletedBudget"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+6),round($x["sRemainingCompletedBudget"], 2));             
                                     

      $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+7), round($x["sCancelledBudget"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+7),round($x["sRGCancelledBudget"], 2) ); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+7), round($x["sGWCancelledBudget"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+7),"");    
                                    
                                  

      $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+8), round($x["sHPBudget"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+8),round($x["sRGHPBudget"], 2)); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+8),round($x["sGWHPBudget"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+8),"");    
                                        
                                    
      $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+9), round($x["sBusinessD"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+9),round($x["sRGBusinessD"], 2)); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+9),round($x["sGWBusinessD"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+9),"");    


       $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+10),round($x["sAgent"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+10),round($x["sRGAgent"], 2)); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+10),round($x["sGWAgent"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+10),"");    
           

               $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+11),round($x["sARCHIVED"], 2)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+11),round($x["sRGARCHIVED"], 2)); 
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+11),round($x["sGWARCHIVED"], 2)); 
       $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+11),round($x["sRemainingARCHIVED"], 2));                         
                                       


                                     


 

    include '../../../PHPExcel/Classes/PHPExcel/IOFactory.php';
    $file_name ='Offer';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save($file_name.'.xls');

//header('location:"Offer.xls"');
 //header("Location: http://www.awebsite.com");
     

$flag=0;
echo '<script>window.close();window.open("http:Offer.xls");window.open("http://http://192.168.10.7:8181//greenstudios/pages/Offers/","_blank");</script>';

//echo $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];

 
  // header("Location:".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);



}   ?>

<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
 $("#client").select2();
 $("#clien").select2();
 $("#consultant").select2();
 $("#architect").select2();
 $("#larchitect").select2();
 $("#contractor").select2();
 $("#refferal").select2();
 $("#maincontractor").select2();
  


   $("#subcontractor").select2({
    placeholder: "Click to View..."
  });
$('#submit').click(function(){
 location.reload();
});
  $("#fref").select2({
  	closeOnSelect: false
  });
</script>

<script src="../../js/boq.js"></script>

</body>

</html>
