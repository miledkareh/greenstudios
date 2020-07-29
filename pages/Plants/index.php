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
  <link href="../../vendor/bootstrap/css/bootstrap-multiselect.css" rel="stylesheet">
    <link rel="stylesheet" href="../../select2/dist/css/select2.css">
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
									if($_SESSION['plcv']!=1){
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
                
                    <h1 class="page-header">Plants</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
                        	<form method="post" id="form1">
				<div class="row nopadding">
				
					
				
					<div class="col-lg-2 nopadding">
						Location<select class="form-control"  id="flocation" name="flocation[]" multiple>

  <option value="Indoor" <?php if(isset($_POST['flocation'])){if(in_array('Indoor', $_POST['flocation'])){echo('selected');}}?>>Indoor</option>
  <option value="Outdoor" <?php if(isset($_POST['flocation'])){if(in_array('Outdoor', $_POST['flocation'])){echo('selected');}}?>>Outdoor</option>
  <option value="Indoor/Outdoor" <?php if(isset($_POST['flocation'])){if(in_array('Indoor/Outdoor', $_POST['flocation'])){echo('selected');}}?>>Indoor/Outdoor</option>
</select>
					</div>
					<div class="col-lg-2 nopadding">
						Luminosity<select class="form-control"  id="fluminosity" name="fluminosity[]" multiple>

						  <option value="Full sun" <?php if(isset($_POST['fluminosity'])){if(in_array('Full sun', $_POST['fluminosity'])){echo('selected');}}?>><?php echo ('Full sun'); ?></option>
						  <option value="Full shade" <?php if(isset($_POST['fluminosity'])){if(in_array('Full shade', $_POST['fluminosity'])){echo('selected');}}?>><?php echo ('Full shade'); ?></option>
						  <option value="Full sun-half shade" <?php if(isset($_POST['fluminosity'])){if(in_array('Full sun-half shade', $_POST['fluminosity'])){echo('selected');}}?>><?php echo ('Full sun-half shade'); ?></option>
						  <option value="Half sun-Full shade" <?php if(isset($_POST['fluminosity'])){if(in_array('Half sun-Full shade', $_POST['fluminosity'])){echo('selected');}}?>><?php echo ('Half sun-Full shade'); ?></option>
						    <option value="Full sun-Full shade" <?php if(isset($_POST['fluminosity'])){if(in_array('Full sun-Full shade', $_POST['fluminosity'])){echo('selected');}}?>><?php echo ('Full sun-Full shade'); ?></option>


						
</select>
					</div>
					<div class="col-lg-2 nopadding">
						Hardiness Zone<select class="form-control"  id="fhardiness" name="fhardiness[]" multiple>

						  <option value="Gulf region" <?php if(isset($_POST['fhardiness'])){if(in_array('Gulf region', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('Gulf region'); ?></option>
						 
						  <option value="Gulf region/ 0-1000" <?php if(isset($_POST['fhardiness'])){if(in_array('Gulf region/ 0-1000', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('Gulf region/ 0-1000'); ?></option>
						   <option value="Gulf region/ 0-500" <?php if(isset($_POST['fhardiness'])){if(in_array('Gulf region/ 0-500', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('Gulf region/ 0-500'); ?></option>
						   	   <option value="Gulf region/ 0 - > 1000" <?php if(isset($_POST['fhardiness'])){if(in_array('Gulf region/ 0 - > 1000', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('Gulf region/ 0 - > 1000'); ?></option>


						 <option value="500-1000" <?php if(isset($_POST['fhardiness'])){if(in_array('500-1000', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('500-1000'); ?></option>
						 <option value="0-500" <?php if(isset($_POST['fhardiness'])){if(in_array('0-500', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('0-500'); ?></option>
						  <option value="0-1000" <?php if(isset($_POST['fhardiness'])){if(in_array('0-1000', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('0-1000'); ?></option>
						   <option value="0 - > 1000" <?php if(isset($_POST['fhardiness'])){if(in_array('0 - > 1000', $_POST['fhardiness'])){echo('selected');}}?>><?php echo ('0 - > 1000'); ?></option>
</select>




 
        			 
        			 
        		 










					</div>
						<div class="col-lg-2 nopadding">
						Growth Habit<select class="form-control"  id="fgrowth" name="fgrowth[]" multiple>

						  <option  value="Round shape" <?php if(isset($_POST['fgrowth'])){if(in_array('Round shape', $_POST['fgrowth'])){echo('selected');}}?>><?php echo ('Round shape'); ?></option>
						   <option  value="Creeping" <?php if(isset($_POST['fgrowth'])){if(in_array('Creeping', $_POST['fgrowth'])){echo('selected');}}?>><?php echo ('Creeping'); ?></option>
						   <option  value="Upright" <?php if(isset($_POST['fgrowth'])){if(in_array('Upright', $_POST['fgrowth'])){echo('selected');}}?>><?php echo ('Upright'); ?></option>
						 
</select>
					</div>
					
					<div class="col-lg-2 nopadding">
						Flower Color<select class="form-control"  id="fcolor" name="fcolor[]" multiple>

						  <option value="Multiple color" <?php if(isset($_POST['fcolor'])){if(in_array('Multiple color', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Multiple color'); ?></option>
						  <option value="No flower" <?php if(isset($_POST['fcolor'])){if(in_array('No flower', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('No flower'); ?></option>
						  <option value="White" <?php if(isset($_POST['fcolor'])){if(in_array('White', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('White'); ?></option>
						  <option value="Pink" <?php if(isset($_POST['fcolor'])){if(in_array('Pink', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Pink'); ?></option>
						  <option value="Yellow" <?php if(isset($_POST['fcolor'])){if(in_array('Yellow', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Yellow'); ?></option>
						  <option value="Orange" <?php if(isset($_POST['fcolor'])){if(in_array('Orange', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Orange'); ?></option>
						  <option value="Purple" <?php if(isset($_POST['fcolor'])){if(in_array('Purple', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Purple'); ?></option>
						  <option value="Blue" <?php if(isset($_POST['fcolor'])){if(in_array('Blue', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Blue'); ?></option>
						  <option value="Red" <?php if(isset($_POST['fcolor'])){if(in_array('Red', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Red'); ?></option>
						  <option value="Green" <?php if(isset($_POST['fcolor'])){if(in_array('Green', $_POST['fcolor'])){echo('selected');}}?>><?php echo ('Green'); ?></option>
</select>
					</div>
					
				
						<div class="col-lg-2 nopadding">
						Foliage Color<select class="form-control"  id="ffcolor" name="ffcolor[]" multiple>

  
						  <option value="Green" <?php if(isset($_POST['ffcolor'])){if(in_array('Green', $_POST['ffcolor'])){echo('selected');}}?>><?php echo ('Green'); ?></option>
						  <option value="Yellow" <?php if(isset($_POST['ffcolor'])){if(in_array('Yellow', $_POST['ffcolor'])){echo('selected');}}?>><?php echo ('Yellow'); ?></option>
						  <option value="Red" <?php if(isset($_POST['ffcolor'])){if(in_array('Red', $_POST['ffcolor'])){echo('selected');}}?>><?php echo ('Red'); ?></option>
						  <option value="Variegated" <?php if(isset($_POST['ffcolor'])){if(in_array('Variegated', $_POST['ffcolor'])){echo('selected');}}?>><?php echo ('Variegated'); ?></option>
						 
</select>
					</div>
						<div class="col-lg-2 nopadding">
						Salty Spray Tolerance<select class="form-control"  id="fspray" name="fspray[]" multiple>

  
						  <option value="Tolerant" <?php if(isset($_POST['fspray'])){if(in_array('Tolerant', $_POST['fspray'])){echo('selected');}}?>>Tolerant</option>
						  <option value="Slightly tolerant" <?php if(isset($_POST['fspray'])){if(in_array('Slightly tolerant', $_POST['fspray'])){echo('selected');}}?>>Slightly tolerant</option>
						  <option value="Not tolerant" <?php if(isset($_POST['fspray'])){if(in_array('Not tolerant', $_POST['fspray'])){echo('selected');}}?>>Not tolerant</option>
						
</select>
					</div>
						<div class="col-lg-2 nopadding">
						Strong wind resistance<select class="form-control"  id="fwindresistance" name="fwindresistance[]" multiple>

  <?php
								
include('../configdb.php');
$query = "Select distinct(windresistance) as windresistance From plants where windresistance <> '' order by windresistance asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error()); 
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo $x['windresistance']; ?>" <?php if(isset($_POST['fwindresistance'])){if(in_array($x['windresistance'], $_POST['fwindresistance'])){echo('selected');}}?>><?php echo ($x['windresistance']); ?></option>
						  <?php } ?>
</select>
					</div>
						<div class="col-lg-2 nopadding">
						Growth Speed<select class="form-control"  id="fgrowthspeed" name="fgrowthspeed[]" multiple>

  <?php
								
include('../configdb.php');
$query = "Select distinct(growthspeed) as growthspeed From plants where growthspeed <> '' order by growthspeed asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo $x['growthspeed']; ?>" <?php if(isset($_POST['fgrowthspeed'])){if(in_array($x['growthspeed'], $_POST['fgrowthspeed'])){echo('selected');}}?>><?php echo ($x['growthspeed']); ?></option>
						  <?php } ?>
</select>
					</div>
					
					
					
						
				
					<div class="col-lg-2 nopadding">
						Maintenance Needs<select class="form-control"  id="fmaintenance" name="fmaintenance[]" multiple>

  <?php
								
include('../configdb.php');
$query = "Select distinct(maintenanceneeds) as maintenanceneeds From plants where maintenanceneeds <> '' order by maintenanceneeds asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo $x['maintenanceneeds']; ?>" <?php if(isset($_POST['fmaintenance'])){if(in_array($x['maintenanceneeds'], $_POST['fmaintenance'])){echo('selected');}}?>><?php echo ($x['maintenanceneeds']); ?></option>
						  <?php } ?>
</select>
					</div>
					
					
					
					
						<div class="col-lg-2 nopadding">
						Trials<select class="form-control"  id="favailability" name="favailability[]" multiple>

						  <option value="Not tested" <?php if(isset($_POST['favailability'])){if(in_array('Not tested', $_POST['favailability'])){echo('selected');}}?>>Not tested</option>
						  <option value="Tested" <?php if(isset($_POST['favailability'])){if(in_array('Tested', $_POST['favailability'])){echo('selected');}}?>>Tested</option>
						  <option value="Under trial" <?php if(isset($_POST['favailability'])){if(in_array('Under trial', $_POST['favailability'])){echo('selected');}}?>>Under trial</option>
						
</select>
					</div>
					<div class="col-lg-2 nopadding">
						Country<select class="form-control"  id="fcountry" name="fcountry[]" multiple>
							<?php 
											include('../configdb.php');
										$query="select distinct(Country) as country from offers order by country asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo $x['country'];?>" <?php if(isset($_POST['fcountry'])){if(in_array($x['country'], $_POST['fcountry'])){echo('selected');}}?>><?php echo $x['country'];?></option>
						<?php }?>
</select>
					</div>












					
					<?php
								
include('../configdb.php');
$query = "select sum(qty*cost)as total,sum(qty) as sqty from plantpot where country='Lebanon'";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){}?>
					<div class="row">
					<div class="col-md-2">&nbsp;
						Availability<select class="form-control" name="available">
							<option value="All" <?php if(isset($_POST['available']) && $_POST['available']=='All') echo "selected"?>>All</option>
							<option value="No" <?php if(isset($_POST['available']) && $_POST['available']=='No') echo "selected"?>>No</option>
							<option value="Yes"<?php if(isset($_POST['available']) && $_POST['available']=='Yes') echo "selected"?>>Yes</option>
						</select>
					</div>
					<div class="col-md-1">&nbsp;
						<button type="button" id="search"  class="btn btn-outline btn-primary" onclick="this.form.submit()"  >Search</button>
					</div>
					<div class="col-md-1" >&nbsp;
						 <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['plce']!=1){ echo('disabled'); }?>>Add Plant</button>
					</div>
					<div class="col-md-2">&nbsp;
						<button type="button" id="check" style="width: 100%" class="btn btn-outline btn-primary"   >Check All</button>
					</div>
					<div class="col-md-1" ><br>
						 <button type="button" id="uncheck" class="btn btn-outline btn-primary"  >Uncheck</button>
					</div>
					<div class="col-md-2" ><br>
						 <button type="button" id="print" class="btn btn-outline btn-primary"  >Go to Palette</button>
					</div> 
					
					
					<?php if($_SESSION['hidevalues']==0){?>
					<div class="col-md-1" align="left"><label>Total</label>
						<input type="text" id="search" style="width: 100%" value="<?php echo $x['total'];?>" disabled readonly>
					</div>
					<div class="col-md-1" align="left"><label>Quantity</label>
						<input type="text" id="search" style="width: 100%" value="<?php echo $x['sqty'];?>" disabled readonly>
					</div>
					<?php }?>

				
					</div>
					<div class="row">
					<div class="col-md-10"></div>
					<div class="col-md-1 " > &nbsp;
						 <button type="button" id="savepalette"  class="btn btn-outline btn-primary"  >Save Palette</button>
					</div>
					</div>
					</form>
							  
							   
			
					</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" data-page-length='-1' class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th></th>
                                    	<th>Select</th>
                                    	 <th>Images</th>
                                    	 
                                        <th>Country</th>
                                        <th>Scientific Name</th>
                                        <th>Common Name</th>
                                        <th>Location</th>
                                        <th>Luminosity</th>
                                         <th>Hardiness Zone</th>
                                          <th>Growth Habit</th>
                                           <th>Planting Density</th>
                                            <th>Flower Color</th>
                                             <th>Foliage Color</th>
                                              <th>Salty Spray Tolerance</th>
                                               <th>Strong Wind Resistance</th>
                                                <th>Growth Speed</th>
                                                 <th>Drought Tolerance</th>
                                                  <th>Tolerance Salty Water</th>
                                                  <!--  <th>Total indoor lighting intensity</th>
                                                    <th>Artificial light types efficiency</th> -->
                                                     <th>Maintenance needs</th>
                                                      <th>Production by GS</th>
                                                       <th>Tray</th>
                                                        <th>POT</th>
                                                         <th>Remarks</th>
                                                         <?php if($_SESSION['hidevalues']==0){?>
                                                         <th>Total</th>
                                                         <?php }?>
                                                        
                                         <?php if($_SESSION['plce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['plcd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
				$location='';$pot='';
				$luminosity='';$totalin='';$artificial='';$maintenance='';$production='';$tray='';		
				$hardiness='';$windresistance='';$growthspeed='';$tolerance='';$tolerance1='';
				$growth='';	$density='';	$color='';$foliagecolor='';$spray='';
include('../configdb.php');

if(!isset($_POST['flocation'])){$_POST['flocation']=array(0);}
if(!isset($_POST['fluminosity'])){$_POST['fluminosity']=array(0);}
if(!isset($_POST['fhardiness'])){$_POST['fhardiness']=array(0);}
if(!isset($_POST['fgrowth'])){$_POST['fgrowth']=array(0);}
if(!isset($_POST['fcolor'])){$_POST['fcolor']=array(0);}
if(!isset($_POST['ffcolor'])){$_POST['ffcolor']=array(0);}
if(!isset($_POST['fspray'])){$_POST['fspray']=array(0);}
if(!isset($_POST['fwindresistance'])){$_POST['fwindresistance']=array(0);}
if(!isset($_POST['fgrowthspeed'])){$_POST['fgrowthspeed']=array(0);}
if(!isset($_POST['fmaintenance'])){$_POST['fmaintenance']=array(0);}
if(!isset($_POST['favailability'])){$_POST['favailability']=array(0);}
if(!isset($_POST['fcountry'])){$_POST['fcountry']=array(0);}
$available="";
if(isset($_POST['available'])){
	if($_POST['available']=='No')
	$available=" and (select sum(qty) from plantpot where plantid=plants.serial) =0";
	else if($_POST['available']=='Yes')
	$available=" and (select sum(qty) from plantpot where plantid=plants.serial) >0";
}
$query = "
 Select *,
 (select  qty  from plantpot where plantid=plants.serial and type='Tray' order by dat desc limit 1) as tray,
(select   qty  from plantpot where plantid=plants.serial and type='POT' order by dat desc limit 1) as pot,
(select sum(qty*cost) from plantpot where plantid=plants.serial) as total,(select url from plantattachment where plantid=plants.serial limit 1) as image From plants where serial <> 0 $available";

if(sizeof($_POST["flocation"])>0  && implode("','",$_POST["flocation"])!='0'){
		$query=$query." and location1 in ('".implode("','",$_POST["flocation"])."') ";
	}
if(sizeof($_POST["fluminosity"])>0  && implode("','",$_POST["fluminosity"])!='0'){
		$query=$query." and luminosity in ('".implode("','",$_POST["fluminosity"])."') ";
	}
if(sizeof($_POST["fhardiness"])>0  && implode("','",$_POST["fhardiness"])!='0'){
		$query=$query." and hardiness in ('".implode("','",$_POST["fhardiness"])."') ";
	}
if(sizeof($_POST["fgrowth"])>0  && implode("','",$_POST["fgrowth"])!='0'){
		$query=$query." and growth in ('".implode("','",$_POST["fgrowth"])."') ";
	}	
if(sizeof($_POST["fcolor"])>0  && implode("','",$_POST["fcolor"])!='0'){
		$query=$query." and color in ('".implode("','",$_POST["fcolor"])."') ";
	}	
if(sizeof($_POST["ffcolor"])>0  && implode("','",$_POST["ffcolor"])!='0'){
		$query=$query." and foliagecolor in ('".implode("','",$_POST["ffcolor"])."') ";
	}	
if(sizeof($_POST["fspray"])>0  && implode("','",$_POST["fspray"])!='0'){
		$query=$query." and spray in ('".implode("','",$_POST["fspray"])."') ";
	}	
if(sizeof($_POST["fwindresistance"])>0  && implode("','",$_POST["fwindresistance"])!='0'){
		$query=$query." and windresistance in ('".implode("','",$_POST["fwindresistance"])."') ";
	}	
if(sizeof($_POST["fgrowthspeed"])>0  && implode("','",$_POST["fgrowthspeed"])!='0'){
		$query=$query." and growthspeed in ('".implode("','",$_POST["fgrowthspeed"])."') ";
	}	
if(sizeof($_POST["fmaintenance"])>0  && implode("','",$_POST["fmaintenance"])!='0'){
		$query=$query." and maintenanceneeds in ('".implode("','",$_POST["fmaintenance"])."') ";
	}	
if(sizeof($_POST["favailability"])>0  && implode("','",$_POST["favailability"])!='0'){
		$query=$query." and availability1 in ('".implode("','",$_POST["favailability"])."') ";
	}	
if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
	$country=implode(",",$_POST["fcountry"]);
		$query=$query." and country like ('%$country%') ";
	}

			$query.=" order by scientic asc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                    <tr class="odd gradeX"  >                                   	
                                        <td></td>
                                        <td><input type="checkbox" class="chcktbl_" name="Cedit" value="<?php echo($x["serial"]);?>" id="Cedit_<?php echo($x["serial"]);?>"/></td>
                                         <td>
                                        	<?php 
                                        	$query="select * from plantattachment where plantid=".$x['serial'];
                                        	$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($y = mysqli_fetch_array($resultss)){?>
	
                                        	<img style="width: 130px; height: 100px;" src="<?php echo $y['url']; ?>"/>
                                        	<?php }?>
                                        	</td>
	                                        <!--  <td><?php echo($x["serial"]);?></td>
	                                        <td><?php echo($x["ref"]);?></td> -->
                                        <td><?php echo($x["country"]);?></td>
                                        <td><?php echo($x["scientic"]);?></td>
                                        <td><?php echo($x["common"]);?></td>
                                        <td><?php echo $x['location1']; ?> </td>
                                        <td><?php echo($x["luminosity"]);?></td>
                                        <td><?php echo($x["hardiness"]);?></td>
                                        <td><?php echo($x["growth"]);?></td>
                                        <td><?php echo($x["density"]);?></td>
                                        <td><?php echo($x["color"]);?></td>
                                        <td><?php echo($x["foliagecolor"]);?></td>
                                        <td><?php echo($x["spray"]);?></td>
                                        <td><?php echo($x["windresistance"]);?></td>
                                        <td><?php echo($x["growthspeed"]);?></td>
                                        <td><?php echo($x["tolerance"]);?></td>
                                        <td><?php echo($x["tolerance1"]);?></td>
                                        <!-- <td><?php echo($x["totalin"]);?></td>
                                        <td><?php echo($x["artificiallight"]);?></td> -->
                                        <td><?php echo($x["maintenanceneeds"]);?></td>
                                        <td><?php echo($x["production"]);?></td>
                                        <td><?php echo($x["tray"]);?></td>
                                        <td><?php echo($x["pot"]);?></td>
                                        <td><?php echo($x["remarks"]);?></td>
                                        <?php if($_SESSION['hidevalues']==0){?>
                                        <td><?php echo($x["total"]);?></td>
                                        <?php }?>
                                       
                                       <?php if($_SESSION['plce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>&nbsp;&nbsp;
<a  id="Dup_<?php echo($x["serial"]);?>" 	 data-toggle="modal" data-target="#myModal"  ><p class="fa fa-file"></p> Duplicate</a>
</td>
<?php }  ?>
<?php if($_SESSION['plcd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["serial"]);?>"   <?php if($_SESSION['plcd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
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
<script type="text/javascript" src="../../Datatables/FixedHeader-3.1.3/js/datatables.fixedHeader.min.js"></script><!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    
  
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap-multiselect.js"></script>
    <!-- DataTables JavaScript -->
    

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

 <script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
<script src="../../bower_components/dist/sweetalert2.all.min.js"></script>
<script src="../../select2/dist/js/select2.js"></script>
<script src="../../select2/dist/js/i18n/it.js"></script>
<script src="../../select2/dist/js/i18n/nl.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <?php if($_SESSION['IsAdmin']==1){?>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
        	  stateSave: true,
        	
        	 
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
        	
        	   stateSave: true,
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
    <script>
    $(document).ready(function() {
    	 $(document).on("keypress",".select2-input",function(event){
    if (event.ctrlKey || event.metaKey) {
        var id =$(this).parents("div[class*='select2-container']").attr("id").replace("s2id_","");
        var element =$("#"+id);
        if (event.which == 97){
            var selected = [];
            element.find("option").each(function(i,e){
                selected[selected.length]=$(e).attr("value");
            });
            element.select2("val", selected);
        } else if (event.which == 100){
            element.select2("val", "");
        }
    }
});
         
			
    
			 $('#fref').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
         $('#fcname').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
         $('#fsname').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
         $('#fluminosity').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
         $('#flocation').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#fhardiness').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#fgrowth').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#fcolor').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#ffcolor').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#fspray').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#fwindresistance').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
          $('#fgrowthspeed').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#fmaintenance').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#favailability').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
        $('#fremarks').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
         $('#fcountry').multiselect({
            includeSelectAllOption: true,
			 buttonWidth: '100%'
        });
         $("#country").select2({
  	closeOnSelect: false
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
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Ref#<input class="form-control" type="text"   name="ref"  id="ref" style="width:100%;" required>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Country<select name="country" class="form-control" id="country" data-placeholder="Click to Select ..."  style="width: 100%;" multiple>
				<?php 
											include('../configdb.php');
										$query="select distinct(Country) as country from offers order by country asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
				 <option value="<?php echo $x['country'];?>"><?php echo $x['country'];?></option>		
						<?php }?>
						</select>
        	</div>	
        	</div>	
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Scientic Name<input class="form-control" type="text"   name="scientic"  id="scientic" style="width:100%;" required>
        	</div>	
	<div class="col-lg-6 nopadding">
        		Common Name<input class="form-control" type="text"   name="common"  id="common" style="width:100%;" required>
        	</div>
        	</div>
        	<div class="row nopadding">
        		<div class="col-lg-6 nopadding">
        		Location
        		<select name="class1" class="form-control" id="location1" style="width: 100%;" >
				 <option value="Indoor">Indoor</option>
				<option value="Outdoor">Outdoor</option>
				<option value="Indoor/Outdoor">Indoor/Outdoor</option>		
						</select>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Luminosity 
<select  id="luminosity" class="form-control" >
   <option value="Full sun"  > Full sun </option>
   <option value="Full shade"  > Full shade </option>
   <option value="Full sun-half shade"  > Full sun-half shade </option>
   <option value="Half sun-Full shade"  > Half sun-Full shade </option>
   <option value="Full sun-Full shade"  > Full sun-Full shade </option>
 
</select>



 










        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Hardiness Zone
        		<select class="form-control"   id="hardiness" name="hardiness">
        			<option value="0-500">0-500</option>
        			<option value="0-1000">0-1000</option>
        			<option value="0 - > 1000">0 - > 1000</option>
        			<option value="500-1000">500-1000</option>
        			<option value="Gulf region">Gulf region</option>
        			<option value="Gulf region/ 0-1000">Gulf region/ 0-1000</option>
        			<option value="Gulf region/ 0-500">Gulf region/ 0-500</option>
        			<option value="Gulf region/ 0 - > 1000">Gulf region/ 0 - > 1000</option>
        		</select>

 









        		 
 
        	</div>
        	<div class="col-lg-6 nopadding">
        		Growth Habit<input class="form-control" type="text" id="growthhabit" name="growthhabit" list="growthhabitt" />
<datalist id="growthhabitt">
  <?php
								
include('../configdb.php');
$query = "Select distinct(growth) as growth From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['growth']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Planting Density<input class="form-control" type="text" id="density" name="density" list="densityy" />
<datalist id="densityy">
  <?php
								
include('../configdb.php');
$query = "Select distinct(density) as density From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['density']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Flower Color<input class="form-control" type="text" id="color" name="color" list="colorr" />
<datalist id="colorr">
  <?php
								
include('../configdb.php');
$query = "Select distinct(color) as color From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['color']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Foliage Color<input class="form-control" type="text" id="color1" name="color1" list="colorr1" />
<datalist id="colorr1">
  <?php
								
include('../configdb.php');
$query = "Select distinct(foliagecolor) as color From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['color']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Salty Spray Tolerance<select name="class1" class="form-control" id="tolerance" style="width: 100%;" >
				 <option value="Tolerant">Tolerant</option>
				<option value="Slightly tolerant">Slightly tolerant</option>
				<option value="Not tolerant">Not tolerant</option>		
						</select>
        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Strong Wind Resistance<input class="form-control" type="text" id="resistance" name="resistance" list="resistancee" />
<datalist id="resistancee">
  <?php
								
include('../configdb.php');
$query = "Select distinct(windresistance) as windresistance From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['windresistance']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Growth Speed<input class="form-control" type="text" id="growthspeed" name="growthspeed" list="growthspeedd" />
<datalist id="growthspeedd">
  <?php
								
include('../configdb.php');
$query = "Select distinct(growthspeed) as growthspeed From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['growthspeed']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Drought Tolerance<input class="form-control" type="text" id="dtolerance" name="dtolerance" list="dtolerancee" />
<datalist id="dtolerancee">
  <?php
								
include('../configdb.php');
$query = "Select distinct(tolerance) as tolerance From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['tolerance']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Tolerance Salty Water<select name="class1" class="form-control" id="tolerance1" style="width: 100%;" >
				 <option value="Tolerant">Tolerant</option>
				<option value="Slightly tolerant">Slightly tolerant</option>
				<option value="Not tolerant">Not tolerant</option>		
						</select>
        	</div>
        	</div>
        	<div style="display: none" class="row nopadding">
        	<div  class="col-lg-6 nopadding">
        		Total Indoor Lighting Intensity<input class="form-control" type="text" id="total" name="total" list="totall" />
<datalist id="totall">
  <?php
								
include('../configdb.php');
$query = "Select distinct(totalin) as totalin From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['totalin']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Artificial Light Types Efficiency<input class="form-control" type="text" id="artificial" name="artificial" list="artificiall" />
<datalist id="artificiall">
  <?php
								
include('../configdb.php');
$query = "Select distinct(artificiallight) as artificiallight From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['artificiallight']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Maintenance Needs<input class="form-control" type="text" id="maintenance" name="maintenance" list="maintenancee" />
<datalist id="maintenancee">
  <?php
								
include('../configdb.php');
$query = "Select distinct(maintenanceneeds) as maintenance From plants";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['maintenance']); ?></option>
						  <?php } ?>
</datalist>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Production By GS	<select name="class1" class="form-control" id="production" style="width: 100%;" >
				 <option value="Yes">Yes</option>
				<option value="No">No</option>	
						</select>
        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding" style="display: none;">
        		Tray<input class="form-control" type="text"   name="tray"  id="tray" style="width:100%;"  required>
        	</div>
        	<div class="col-lg-6 nopadding" style="display: none;">
        		POT<input class="form-control" type="text"   name="pot"  id="pot" style="width:100%;"  required>
        	</div>
	</div>
        	<div class="row nopadding">
        	<div class="col-lg-6 nopadding">
        		Trials <select name="class1" class="form-control" id="availability1" style="width: 100%;" >
				 <option value="Not tested">Not tested</option>
				<option value="Tested">Tested</option>
				<option value="Under trial">Under trial</option>		
						</select>
        	</div>
        	<div class="col-lg-6 nopadding">
        		Remarks<textarea class="form-control" type="text"   name="remarks"  id="remarks" style="width:100%;" rows="4" required></textarea>
        	</div>
        	</div>
        	<div class="row nopadding">
        	<div class='col-lg-6 nopadding'>
		<label id ="lblalert2" style="visibility: hidden; color: red;">Please Save the Plant before adding POT/Tray !</label>
	</div>
	<div class='col-lg-6 nopadding' align="right">
		<button type="button" id="Ad1" class="btn btn-outline btn-primary" >Add Pot/Tray</button>
	</div>
	</div>
		
						 <br>
			 <div class="row">
			<table align="left" style="width: 100%;" border="1">
				<thead>
					<th>Type</th>
					<th>Cost</th>
					<th>Size</th>
					<th>Date</th>
					<th>QTY</th>
					<th>Difference</th>

					<?php if ($_SESSION['ViewQuantity']==1){?>
					<th>Action</th>
					<?php }?>
				</thead>
				<tbody id="followup"></tbody>
			</table>	
			</div>
			<br><br><br><br>
        	 <div class="checkbox">
        <label>
        <input type="checkbox" id="used" value="used">Not to be used &nbsp;
        </label>
        </div>
	<div class="col-lg-12 nopadding" align="center">
		<label>Image</label>
 		 <div class="file-loading">
            <input id="images" name="images[]" type="file" multiple>
    </div>
    </div>

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Scientic Name!</label>
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
		<label>Date</label><input class="form-control" type="date"   name="date"   id="date" style="width:100%;" >	
	<label>Type</label><select name="class1" class="form-control" id="type" style="width: 100%;" >
				 <option value="POT">POT</option>
				<option value="Tray">Tray</option>	
						</select>
							<label style="display: none;">Country</label><select style="display: none;" name="country" class="form-control" id="country1"   style="width: 100%;" >
				<?php 
											include('../configdb.php');
										$query="select distinct(Country) as country from offers order by country asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
				 <option value="<?php echo $x['country'];?>"><?php echo $x['country'];?></option>		
						<?php }?>
						</select>
	<label>Size</label><input class="form-control" type="text"   name="size"  id="size" style="width:100%;" >
		<label>Quantity</label><input class="form-control" type="number"   name="qty"  id="qty" style="width:100%;" >
		<label>Unit Cost</label><input class="form-control" type="number"   name="cost"  id="cost" style="width:100%;" >
		
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
 </div> 
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../../js/plants.js"></script>

</body>

</html>
