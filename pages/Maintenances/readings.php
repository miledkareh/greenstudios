<?php error_reporting(0); ?>
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
<link href="../../vendor/fileupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" href="../../select2/dist/css/select2.css"> 
</head>

<body>
	  <?php
  session_start();
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
								if($_SESSION['mcv']!=1){
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
                
                    <h2 class="page-header"><?php echo $_GET['y'];?> - Readings - <?php  
                    $query = "select * from offers where serial in (select offerid from maintenances where serial=".$_GET['x'].")";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){}
if($x['GWINT']==1 && $x['GWEXT']==1) echo "-Indoor/Outdoor"."- GW AREA ".$x['GWAREA']; 
else if($x['GWINT']==1) echo "Indoor"."- GW AREA ".$x['GWAREA']; 
else if($x['GWEXT']==1) echo "Outdoor"."- GW AREA ".$x['GWAREA'];
  else if($x['RG']==1) echo  " RG AREA ".$x['RGAREA'];
  echo "m<sup>2<sup>"
?>
                    </h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    	
                        <div class="panel-heading" align="right">
                  <div class="row">
                        	<div class="col-lg-10" align="left"><label>IRRIGATION FLOW</label></div>
                        	<div class="col-lg-2">
							   <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['mce']!=1){ echo('disabled'); }?> >Add</button>
			</div>
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                        <th>Zone</th>
                                        <th>Linear meter (m)</th>
                                        <th>Emitter type</th>
										<th>Number of emitter</th>
										<th>Flow per emitter (L/min)</th>
										<th>Total flow (L/min)</th>
										<th># minutes/day</th>
										<th>Daily water consumption (L)</th>
                                        <th> Daily Total water consumption </th>
										
									
									
                                              <th>Edit</th> 
									    <th>Delete</th>
									
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
      $query = "select *,
  (select SUM(watercons) from irrigationflow where irrigationflow.dat=AA.dat and  maintenanceid=".$_GET['x'].") as TOT,
  (select description from offerzones where serial=AA.zone) as ZONE
   from irrigationflow as AA where maintenanceid=".$_GET['x']."  order by dat desc";
 
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >              
                                    	<td><?php echo $x['dat'];?></td>                     	
                                        <td><?php echo($x["ZONE"]);?></td>
										  <td><?php echo($x["linearmeter"]);?></td>
										  <td><?php echo($x["emittertype"]);?></td>
										  <td><?php echo($x["emitternumber"]);?></td>
										  <td><?php echo($x["emitterflow"]);?></td>
										  <td><?php echo($x["emitternumber"]*$x["emitterflow"]);?></td>
										  <td><?php echo($x["minday"]);?></td>
										  <td><?php echo($x["watercons"]);?></td>
                                          <td><?php echo(round( $x["TOT"],2)  );?></td>
							
<td class="center"><a href="#" id="Editt_<?php echo($x["serial"]);?>"   data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a></td>
                                
<td class="center"><a href="#" id="dell_<?php echo($x["serial"]);?>"    ><p class="fa fa-trash-o"></p> Delete</a></td>


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
            
              <div class="col-lg-12">
                    <div class="panel panel-default">
                    	
                        <div class="panel-heading" align="right">
                  <div class="row">
                        	<div class="col-lg-10" align="left"><label>IRRIGATION TIME</label></div>
                        	<div class="col-lg-2">
							   <button type="button" id="AddTime" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal1" <?php if($_SESSION['mce']!=1){ echo('disabled'); }?> >Add</button>
			</div>
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                        <th>Zone</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
										
                                            <th>Edit</th> 
									      <th>Delete</th> 
									
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
$query = "select * from irrigationtime where accepted=1 and  maintenanceid=".$_GET['x']." order by dat desc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >              
                                    	<td><?php echo $x['dat'];?></td>                     	
                                        <td><?php echo($x["zone"]);?></td>
										  <td><?php echo(date("H:i:s", strtotime($x["starttime"])));?></td>
										  <td><?php echo(date("H:i:s", strtotime($x["endtime"])));?></td>
										 
								
<td class="center"><a href="#" id="Edit_<?php echo($x["serial"]);?>"   data-toggle="modal" data-target="#myModal1" ><p class="fa fa-edit"></p> Edit</a></td>
                                 

<td class="center"><a href="#" id="del_<?php echo($x["serial"]);?>"    ><p class="fa fa-trash-o"></p> Delete</a></td>


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
             <div class="col-lg-12">
                    <div class="panel panel-default">
                    	
                        <div class="panel-heading" align="right">
                  <div class="row">
                        	<div class="col-lg-10" align="left"><label>Maintenance</label></div>
                        	<div class="col-lg-2">
							   <button type="button" id="AddMaintenance" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal2" <?php if($_SESSION['mce']!=1){ echo('disabled'); }?> >Add</button>
			</div>
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example3" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                        <th>EC Clean Water</th>
                                        <th>EC Fertilized Mix</th>
                                         <th>Fertilized Mix</th>
                                           <th>Gallons #</th>
                                           <th>Total Vaniperen used(liters)</th>
                                        <th>pH</th>
                                        <th>Injector</th>
                                        <th>Alarm Working</th>
                                        <th>Plant #</th>
                                       
                                      <th>Edit</th> 
									    <th>Delete</th> 
									
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
$query = "select * from readingm where accepted=1 and  maintenanceid=".$_GET['x']." order by dat asc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
$tot=0;
while($x = mysqli_fetch_array($results)){

  
if($x["fertelizedmix"]=='New Vaniperen 20L')
    $tot+=($x["galonsnb"]*20);

if($x["fertelizedmix"]=='New Vaniperen 5L')
    $tot+=($x["galonsnb"]*5);
    ?>


                                    <tr class="odd gradeX" >              
                                    	<td><?php echo $x['dat'];?></td>                     	
                                        <td><?php echo($x["ecclean"]);?></td>
                                        <td><?php echo($x["ecfertilized"]);?></td>
                                         <td><?php echo($x["fertelizedmix"]);?></td>
                                          <td><?php echo($x["galonsnb"]);?></td>
                                           <td><?php echo($tot);?></td>
                                        <td><?php echo($x["ph"]);?></td>
                                       <td><?php if($x["injector"]==1) echo "ON"; else echo "OFF";?></td>

                                        <td><?php if($x["alarm"]=="-1")echo "No Alarm";else if($x["alarm"]=="1")echo "Yes" ;else echo "No";?></td>
                                        <td><?php echo($x["nbplants"]);?></td>
                                           
										  
										 
							
<td class="center"><a href="#" id="Edittt_<?php echo($x["serial"]);?>"   data-toggle="modal" data-target="#myModal2" ><p class="fa fa-edit"></p> Edit</a></td>
                     
<td class="center"><a href="#" id="delll_<?php echo($x["serial"]);?>"    ><p class="fa fa-trash-o"></p> Delete</a></td>


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
            
            
              <div class="col-lg-12">
                    <div class="panel panel-default">
                    	
                        <div class="panel-heading" align="right">
                  <div class="row">
                        	<div class="col-lg-10" align="left"><label>LUX</label></div>
                        	<div class="col-lg-2">
							   <button type="button" id="AddLux" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php if($_SESSION['mce']!=1){ echo('disabled'); }?> >Add</button>
			</div>
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                    	<th>Name</th>
                                        <th>Date</th>
                                      <th>Edit</th> 
									      <th>Delete</th>
									
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
$query = "select * from lux where maintenanceid=".$_GET['x']." and isnew=0 order by dat desc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >              
                                    	<td><a href="../../att/Lux/<?php echo $x['description'];?>" target="_blank"><?php echo $x['description'];?></a></td>                     	
                                       <td><?php echo $x['dat']; ?></td>
										  
										 
									
<td class="center"><a href="#" id="Editttt_<?php echo($x["serial"]);?>"   data-toggle="modal" data-target="#myModal3" ><p class="fa fa-edit"></p> Edit</a></td>

<td class="center"><a href="#" id="dellll_<?php echo($x["serial"]);?>"    ><p class="fa fa-trash-o"></p> Delete</a></td>


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
            
              <div class="col-lg-12">
                    <div class="panel panel-default">
                    	
                        <div class="panel-heading" align="right">
                  <div class="row">
                        	<div class="col-lg-10" align="left"><label>Pesticide Spray</label></div>
                        	<div class="col-lg-2">
							   <button type="button" id="AddSpray" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal4" <?php if($_SESSION['mce']!=1){ echo('disabled'); }?> >Add</button>
			</div>
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example4" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                        <th>Trade Name</th>
                                     <!--    <th>Active Ingredient</th>
                                        <th>Dose</th>
                                        <th>Method of application</th> -->
										
                                           <th>Edit</th> 
									    <th>Delete</th> 
									
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
$query = "select * from pesticide where accepted=1 and  maintenanceid=".$_GET['x']." order by dat desc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX" >              
                                    	<td><?php echo $x['dat'];?></td>                     	
                                        <td><?php echo($x["trade"]);?></td>
                                        <!-- <td><?php echo($x["ingredient"]);?></td>
                                        <td><?php echo($x["dose"]);?></td>
                                        <td><?php echo($x["method"]);?></td> -->
										  
										 
									
<td class="center"><a href="#" id="Edittt_<?php echo($x["serial"]);?>"   data-toggle="modal" data-target="#myModal4" ><p class="fa fa-edit"></p> Edit</a></td>

<td class="center"><a href="#" id="delll_<?php echo($x["serial"]);?>"    ><p class="fa fa-trash-o"></p> Delete</a></td>


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
 <script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
 <script src="../../bower_components/dist/sweetalert2.all.min.js"></script>
  <script src="../../select2/dist/js/select2.js"></script>
<script src="../../select2/dist/js/i18n/it.js"></script>
<script src="../../select2/dist/js/i18n/nl.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
           $('#dataTables-example1').DataTable({
            responsive: true
        });
        $('#dataTables-example2').DataTable({
            responsive: true
        });
          $('#dataTables-example3').DataTable({
            responsive: true
        });
          $('#dataTables-example4').DataTable({
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
	
   	  Date <input type="date" value="<?php echo date("Y-m-d"); ?>" name="checkindate" class="form-control" id="dat">
		Zone
        <select class="form-control" id="zone">
            <option value="0"></option>
            <?php $sql="select *,(select ProjectName from offers where serial=offerzones.offerid)as ProjectName from offerzones where offerid='".$_GET['z']."' ";
            $res = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($y = mysqli_fetch_array($res)){?>

             ?>
             <option value="<?php echo $y['serial']; ?>"><?php echo $y['description']."/".$y['ProjectName']; ?></option>
         <?php } ?>
        </select>

        
		Linear meter (m)<input class="form-control" type="number"   name="linearmeter"  id="linearmeter" style="width:100%;" required>
		Emitter Type<select class="form-control" id="emittertype">
			<option value="GPH 1">GPH 1</option>
			<option value="GPH 2">GPH 2</option>
			<option value="GPH 5">GPH 5</option>
			<option value="GPH 7">GPH 7</option>
			<option value="GPH 10">GPH 10</option>
			<option value="3 mm">3 mm</option>
		</select>
		Number of emitter<input class="form-control" type="number"   name="emitternumber"  id="emitternumber" style="width:100%;" required>
		Flow per emitters<input class="form-control" type="number"   name="emitterflow"  id="emitterflow" style="width:100%;" required>
		Total flow (L/min)<input class="form-control" type="number"   name="totalflow"  id="totalflow" style="width:100%;" required>
		# minutes/day<input class="form-control" type="number"   name="minday"  id="minday" style="width:100%;" required>
		Daily water consumption (L)<input class="form-control" type="number"   name="watercons"  id="watercons" style="width:100%;" required>
	

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill The Date !</label>
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
        	
        Date <input type="date" name="checkindate" class="form-control" id="dat1">
		Zone
         <select class="form-control" id="zone1">
            <option value="0"></option>
            <?php $sql="select *,(select ProjectName from offers where serial=offerzones.offerid)as ProjectName from offerzones where offerid='".$_GET['z']."' ";
            $res = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($y = mysqli_fetch_array($res)){?>

             ?>
             <option value="<?php echo $y['serial']; ?>"><?php echo $y['description']."/".$y['ProjectName']; ?></option>
         <?php } ?>
        </select>
		Start Time<input class="form-control" type="time"   name="starttime"  id="starttime" step="1" style="width:100%;" required>
		End Time<input class="form-control" type="time"   name="endtime"  step="1" id="endtime" style="width:100%;" required>
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert1" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add2"class="btn btn-outline btn-primary" > Save</button>
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
        	
        Date <input type="date" name="checkindate" class="form-control" id="dat2">
		EC Clean Water<input class="form-control" type="text"   name="ecclean"  id="ecclean" style="width:100%;" required>
		EC Fertilized Mix<input class="form-control" type="text"   name="ecfertilized"  id="ecfertilized" style="width:100%;" required>
		PH<input class="form-control" type="text"   name="ph"  id="ph" style="width:100%;" required>
		Injector<select class="form-control"  name="injector"  id="injector" style="width:100%;">
			<option value="1">ON</option>
			<option value="0">OFF</option>
			</select>

            Fertilized Mix
            <select class="form-control"  name="fertelizedmix"  id="fertelizedmix" style="width:100%;">
            <option value="Same Vaniperen 20L">Same Vaniperen 20L</option>
            <option value="Same Vaniperen 5L">Same Vaniperen 5L</option>
            <option value="New Vaniperen 20L">New Vaniperen 20L</option>
            <option value="New Vaniperen 5L">New Vaniperen 5L</option>
            </select>


  galons # 
            <input type="number" id="galonnn" class="form-control">


            
            Alarm Working
            <select class="form-control"  name="alarm"  id="alarm" style="width:100%;">
            <option value="1">  Yes   </option>
            <option value="0">    No </option>
            <option value="-1">  No Alarm   </option>
            
            </select>
           plants # 
            <input type="number" id="nbplants" class="form-control">
             
	<br>
<!-- 	 <table style="width: 100%;">
	<tr>
		<td><label id ="lblalert6" style="visibility: hidden; color: red;">Please Save before adding plants !</label></td>
		<td align="right"><button  type="button" id="AdPlant" class="btn btn-outline btn-primary"  >Add Plants</button></td>
	</tr>
</table>
<br>
<table style="width: 100%;" border="1">
	<thead>
		<th>Plant</th>
		<th>Number Of Plant</th>
		<th>Edit</th>
		<th>Delete</th>
		</thead>
		<tbody id="clientbody"></tbody>
</table> -->	
<br>
	 </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert2" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add3"class="btn btn-outline btn-primary" > Save</button>
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
        	<div class="row" id="taskattdiv">
	<div class="col-lg-12 nopadding" align="center">
		
 		 <div class="file-loading">
            <input id="images" name="images[]" type="file" multiple>
        </div>
Date
<input type="date" id="datelux" class="form-control">

    </div>
</div>
        	
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert3" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
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
  <div class="modal fade" id="myModal4" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title4"></h4>
        </div>

        <div class="modal-body" align="center">		
        	
        Date <input type="date" name="checkindate" class="form-control" id="dat4">
        Trade Name
		<select class="form-control"     name="trade"  id="trade" style="width:100%;" required>
        <!-- Active Ingredient<input class="form-control" type="text"   name="ingredient"  id="ingredient" style="width:100%;" required>
        Dose<input class="form-control" type="text"   name="dose"  id="dose" style="width:100%;" required>
        Method of Application<input class="form-control" type="text"   name="method"  id="method" style="width:100%;" required> -->

<?php $query = "select * from allpesticide";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
    <option value="<?php echo $x['trade'];?>"><?php echo $x['trade'];?></option>
    <?php }?>


    </select>
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert4" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add5"class="btn btn-outline btn-primary" > Save</button>
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
   <div class="modal fade" id="myModal5" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title5"></h4>
        </div>

        <div class="modal-body" align="center">		
        		<div class="row">
		<div class="col-lg-12">
		Plant<select class="form-control" id="plant" style="width:100%;">
			<?php $query = "select * from plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
	<option value="<?php echo $x['serial'];?>"><?php echo $x['scientic'];?></option>
	<?php }?>
		</select>
		</div>
		</div>	
		Number of Plants<input class="form-control" type="number"   name="plantnumber"  id="plantnumber" style="width:100%;" required>
       
       
        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert5" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
			
		<tr>
		<td>
	
        <button type="button" id="add6"class="btn btn-outline btn-primary" > Save</button>
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
 	$("#plant").select2();
 </script>
<script src="../../js/readings.js"></script>
</body>

</html>
