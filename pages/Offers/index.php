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
                
                    <h1 class="page-header">Projects</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="left">
						<form method="post" align="right">
					<div class="row">
						<div class="col-lg-3 nopadding">
						 	<div class="col-lg-3">
						 		&nbsp;&nbsp;
								  <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fdealer" id="fdealer"  value=""<?php if(isset($_POST['fdealer'])) {if($_POST['fdealer']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>Agent 
                                    </label>
                                    </div>
                                        <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="sp" id="sp"  value=""<?php if(isset($_POST['sp'])) {if($_POST['sp']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>Specified 
                                    </label>
                                    </div>
                                  </div>
                                  <div class="col-lg-2">
                                  	&nbsp;&nbsp;
                                     <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="fbd" id="fbd" value=""  value=""<?php if(isset($_POST['fbd'])) {if($_POST['fbd']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>BD 
                                    </label>
                                    </div>
                                    </div>
                                    <div class="col-lg-2">
                                    	&nbsp;&nbsp;
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="fhp" id="fhp" value=""  value=""<?php if(isset($_POST['fhp'])) {if($_POST['fhp']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>HP
                                    </label>
                               </div>
                            </div>
                            <div class="col-lg-2 nopadding">
                            	&nbsp;&nbsp;
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="frg" id="frg" value=""  value=""<?php if(isset($_POST['frg'])) {if($_POST['frg']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>RG 
                                    </label>
                               </div>
                              </div>
                             <div class="col-lg-2">
                             	&nbsp;&nbsp;
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="fgw" id="fgw" value=""  value=""<?php if(isset($_POST['fgw'])) {if($_POST['fgw']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>GW 
                                    </label>
                               </div>
                             </div>
                             </div>
                             <div class="col-lg-1 nopadding">
                               <label>Country</label>	 
                               <select  class="form-control" id="fcountry" name="fcountry[]" data-placeholder="Click to Select ..." multiple style="width: 100%;"  >
											 
											<?php 
											include('../configdb.php');
										$query="select distinct(Country) as country from offers order by country asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["country"]); ?>" <?php
												if (isset($_POST['fcountry'])) {


if(in_array($x['country'], $_POST['fcountry'])){echo('selected');}



												}
 ?>><?php echo($x["country"]); ?></option>




   
											<?php } ?>









											</select>
                             </div>
                              <div class="col-lg-1 nopadding">
                               	<label>City</label><select  class="form-control" id="fcity" name="fcity" style="width: 100%;" >
											<option selected value="All">All</option>
											<?php 
										$query="select distinct(city) as city from offers where city <> '' order by city asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["city"]); ?>" <?php if (isset($_POST['fcity'])) {	if ($_POST['fcity'] == $x['city']) echo("selected");} ?>><?php echo($x["city"]); ?></option>
											<?php } ?>
											</select>
                              </div>
                              
                              <div class="col-lg-2 nopadding">
                               		<label>Referral</label> <select  class="form-control" id="fref" name="fref[]" data-placeholder="Click to Select ..." style="width: 100%;" multiple >
											
											<?php 
										$query="select *  from customers where company <> '' order by company asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["Serial"]); ?>" <?php if(isset($_POST['fref'])){if(in_array($x['Serial'], $_POST['fref'])){echo('selected');}}?>><?php echo($x["company"]); ?></option>
											<?php } ?>
											</select>
                            </div>
                            <div class="col-lg-1 nopadding">
                            	<label>Status</label><select class="form-control" id="fstatus" name="fstatus" style="width: 100%; ">
      <option value="All" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'All') echo("selected");} ?>>All</option>
     <option value="INQUIRIES" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'INQUIRIES') echo("selected");} ?>>INQUIRIES</option>
	 <option value="OFFER" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'OFFER') echo("selected");} ?>>OFFER</option>
	  <option value="IN HAND" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'IN HAND') echo("selected");} ?>>IN HAND</option>
	   <option value="POTENTIAL" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'POTENTIAL') echo("selected");} ?>>POTENTIAL</option>
	    <option value="COMPLETED" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'COMPLETED') echo("selected");} ?>>COMPLETED</option>
	     <option value="CANCELED" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'CANCELED') echo("selected");} ?>>CANCELED</option>
	      <option value="SIGNED" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'SIGNED') echo("selected");} ?>>SIGNED</option>
	       <option value="ARCHIVED" <?php if (isset($_POST['fstatus'])) {	if ($_POST['fstatus'] == 'ARCHIVED') echo("selected");} ?>>ARCHIVED</option>
		</select>
                            </div>
                              <div class="col-lg-3 nopadding">
                                <div class="col-lg-6 nopadding">
                               <label>From Date</label>
						<input class="form-control" type="date"   name="fromdate"  id="fromdate"  value="<?php
								if (isset($_POST['fromdate'])) {echo($_POST['fromdate']);
								}
							?>" >
						</div>
					
						<div class="col-lg-5 nopadding" >
							<label>To Date</label><input class="form-control" type="date"   name="todate"  id="todate"   value="<?php
								if (isset($_POST['todate'])) {echo($_POST['todate']);
								}
							?>">
							
                              </div>
                             
                              </div>
                               
                            
                               </div>
                  
						<div class="row">
          <div class="col-lg-1">
                             
                                <input type="submit" id="search1" class="btn btn-outline btn-primary" value="Search">
                               
                               </div>
                              <div class="col-lg-1">
                              
                                <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php
  if ($_SESSION['oce'] != 1) { echo('disabled');
  }
?> >Add Offer</button>
                             </div>
                             <div class="col-lg-1">
                                
                               <input type="submit" id="submit" name="xls" value="Import xls"  class="btn btn-outline btn-primary" >
                             </div>      
            </div>
						
 
		 
							</form>  
		 
       
      
    
						
                     
                        <!-- /.panel-heading -->
					
                        <div class="panel-body">
		<div width="100%" align="right">	  </div>

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 80%;">
                                <thead>
                                    <tr>
									<th>PE</th>
                                      <th>Project Name </th>
                                      <th>Country</th>
									  <th>City</th>
									  <th>Client</th>
									  <th>Status</th>
									  <th>Status Date</th>
									  <th>GW</th>
									  <th>GW Area</th>
									   <th>RG</th>
									  <th>RG Area</th>
									  <th>Offer Ref#</th>
									  <th>Refferal</th>
																	  									 
									  <th>Offer</th>
									  <th>HP</th>
									  
									  <th>Offer value</th>
									  <th>Cost</th>
									  <th>Gross Margin</th>
									  <th>Remaining</th>
									 
									   <th>Canceled</th>
									  
									  <th>Kick Off Date</th>
								
									  <th>Due Date</th>
									  <th>Attach</th>
									  <th>Tasks</th>
									  <th>Build-UP</th>
									  <th>Printout</th>
									  <th>Completed</th>
									  <th>Notes</th>
									  <th>Duplicate</th>
									    <th>BOQ</th>
									   <?php if($_SESSION['ocd']==1){?>      <th>Delete</th> <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
										include('../configdb.php');
												
if(isset($_POST['fromdate']))
$fromdate=$_POST['fromdate'];
else {
	$fromdate='';
}
if(isset($_POST['todate']))
$todate=$_POST['todate'];
else {
	$todate='';
}
$confidential="";
if($_SESSION['IsAdmin']!=1){
	$confidential=" and confidential =0";
}
$country='';
$city='';
$hp="";
$bd="";
$gw="";
$rg="";
$dealer="";
$status="";
$sp="";
if(isset($_POST['fhp'])) 
{$hp=" and hp= 1 ";}
if(isset($_POST['fbd'])) 
{$bd=" and bd= 1 ";}
if(isset($_POST['fdealer'])) 
{$dealer=" and dealer= 1 ";}
if(isset($_POST['sp'])) 
{$sp=" and specified= 1 ";}
if(isset($_POST['frg'])) 
{$rg=" and RG= 1 ";}
if(isset($_POST['fgw'])) 
{$gw=" and GW= 1 ";}
// if(isset($_POST['fcountry']) && $_POST['fcountry'] != 'All') {$country=" and country ='".$_POST['fcountry']."'";}
// 	else {
// 		$country='';
// 	}
	if(isset($_POST['fcity']) && $_POST['fcity'] != 'All') {$city=" and city ='".$_POST['fcity']."'";}
	else {
		$city='';
	}
	
	if(isset($_POST['fstatus']) && $_POST['fstatus'] != 'All') {$status=" and status ='".$_POST['fstatus']."'";}
	else {
		$status="";
	}
	if(!isset($_POST['fref'])){$_POST['fref']=array(0);}

if(!isset($_POST['fcountry'])){$_POST['fcountry']=array(0);}

$query ="select *,(Select count(*)  from invoicereport where project=offers.serial) as cntoffer,(Select count(*)  from tasks where offerid=offers.serial) as cnttask,(select count(*) from invoicereport where project=offers.serial) as cprintout,(select company from customers where serial = offers.customerid) as Client,(select company from customers where serial = offers.referral) as Referral,(select username from users where serial=offers.lastuser) as LastUser,lastupdated,(select count(*) from offerattachment where offerid=offers.serial ".$confidential." and isnew=0) as cnt,(select count(*) from refferalnotes where offerid=offers.serial) as Refcnt,(select count(description) from offerattachment where offerid=offers.serial and main=1) as Imagee from offers where serial<>0 ";
 if($fromdate!=''){ $query =$query." and dat>='$fromdate'"; }
  if($todate!=''){ $query =$query." and dat<='$todate'"; }
  if($_SESSION['filter']==3){$query =$query." and serial in (".$_SESSION['datafilter'].")";}
    if($_SESSION['filter']==2){
		$countries=$_SESSION['datafilter'];
		$countries= str_replace(",", "','", $countries);
		$query =$query." and country in ('".$countries."')";}
		$query=$query.$bd.$dealer.$hp.$country.$city.$rg.$gw.$status.$sp;
		if(sizeof($_POST["fref"])>0  && implode("','",$_POST["fref"])!='0'){
		$query=$query." and referral in ('".implode("','",$_POST["fref"])."') ";
	}


  if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
	//if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
	
 $query =$query." Order by order1 asc,order2 desc,dat desc"; // OLD ORDER
   //$query.=" Order by order1 asc,duedate desc,statusdate desc";// new order
   $query1xls=$query;
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());

while($x = mysqli_fetch_array($results)){
	
?>
                                    <tr class="odd gradeX"  style="background-color:<?php

									if ($x["status"] == 'CANCELED') {echo("Red");
									} elseif ($x["status"] == 'COMPLETED') {echo("Violet");
									} elseif ($x["status"] == 'POTENTIAL') {echo("Green");
									} elseif ($x["status"] == 'OFFER') {echo("");
									} elseif ($x["status"] == 'IN HAND') {echo("LightBlue");
									} elseif ($x["status"] == 'INQUIRIES') {echo("#F75A53");
									}elseif ($x["status"] == 'ARCHIVED') {echo("yellow");}
								?>">
<td><?php if($x["hp"]==1){ ?> <span class="fa fa-star fa-2x" style="color:yellow;"></span> <?php } ?><?php if ($x["bd"]==1){?> <span class="fa fa-user"></span> <?php } ?><?php if ($x["dealer"]==1){?> <span class="fa fa-flag"></span> <?php } ?><?php echo($x["pe"]); ?></td>   
       <?php if($_SESSION['oce']==1){?>
<td class="center"><span  data-toggle="tooltip" data-placement="top" title="<?php echo("LastUser : " . $x["LastUser"]); ?><?php echo("  LastUpdated : " . $x["LastUpdated"]); ?>">
<a  id="Edit_<?php echo($x["Serial"]); ?>"  data-toggle="modal" data-target="#myModal" style="color:black;" > <?php echo($x["ProjectName"]); ?></a></span>
</td>
<?php } else{ ?>                         	
<td><?php echo($x["ProjectName"]); ?></td>
<?php } ?>
<td><a  id="Img_<?php echo($x["Serial"] . "/" . $x["Imagee"]); ?>"  data-toggle="modal" data-target="#ImageModal" style="color:black;" > <?php echo($x["Country"]); ?></a></td>
<td><?php echo($x["city"]); ?></td>
<td><?php echo($x["Client"]); ?></td>
<td><?php echo($x["status"]); ?></td>
<td><?php echo($x["statusdate"]); ?></td>
<td><?php
	if ($x["GW"] != 1) {echo('<p class="fa fa-times"></p>');
	} else {echo('<p class="fa fa-check"></p>');
	}
 ?> </td>
<td><?php echo($x["GWAREA"]); ?></td>
<td><?php
	if ($x["RG"] != 1) {echo('<p class="fa fa-times"></p>');
	} else {echo('<p class="fa fa-check"></p>');
	}
 ?> </td>
<td><?php echo($x["RGAREA"]); ?></td>
<td><?php echo($x["OfferRef"]); ?></td>
<td> 
	<?php echo($x["Referral"]); ?>
	<!--<a  href ="refferalnotes.php?x=<?php echo($x["Serial"]);?>" target="_blank"  ><?php echo($x["Refcnt"]);?> </a> -->
	</td>




<td><?php
	if ($x["cntoffer"] > 0) {echo('<p class="fa fa-times"></p>');
	} else {echo('<p class="fa fa-check"></p>');
	}
 ?> </td>
<td><?php
	if ($x["hp"] != 1) {echo('<p class="fa fa-times"></p>');
	} else {echo('<p class="fa fa-check"></p>');
	}
 ?></td>

<td><?php echo(number_format(round($x["OfferValue"], 2))); ?></td>
<td><?php echo(number_format(round($x["cost"], 2))); ?></td>
<td><?php echo(round($x["gross"], 2)); ?></td>
<td><?php echo($x["remaining"]); ?></td>

<td><?php
	if ($x["status"] != 'CANCELED') {echo('<p class="fa fa-times"></p>');
	} else {echo('<p class="fa fa-check"></p>');
	}
 ?></td>

<td><?php echo($x["kickoff"]);?></td>
<td><?php
	if ($x["duedate"] != "0000-00-00") {echo($x["duedate"]);
	}
 ?></td>
<td> <a  href ="attachments.php?x=<?php echo($x["Serial"]); ?>" target="_blank"  ><?php echo($x["cnt"]); ?> </a></td>
<td> <a  href ="../Tasks/index.php?z=<?php echo($x["Serial"]); ?>" target="_blank"  ><?php echo($x["cnttask"]); ?> </a></td>
<td><?php echo($x["buildup"]); ?></td>
<td> <a  href ="../InvoiceReport/index.php?x=<?php echo($x["Serial"]); ?>&c=<?php echo($x["CustomerID"]); ?>" target="_blank"  ><?php echo($x["cprintout"]); ?> </a></td>
<td ><?php
	if ($x["status"] != 'Completed') {echo('<p class="fa fa-times"></p>');
	} else {echo('<p class="fa fa-check"></p>');
	}
 ?></td>
<td><?php echo($x["notes"]); ?></td>

<td class="center">
<a  id="Dup_<?php echo($x["Serial"]); ?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Duplicate</a>
</td>
<td><a href="boq.php?offerid=<?php echo($x["Serial"]); ?>">BOQ</a></td>
<?php if($_SESSION['ocd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["Serial"]); ?>"   <?php
	if ($_SESSION['ocd'] != 1) { echo('disabled');
	}
?> ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php } ?>
                                    </tr>
									<?php
										}
									?>

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
        <?php if($_SESSION['hidevalues']==0){?>
<div class="row">
	    
<br />

	 <div class="col-lg-12">
                	
                    <div class="panel panel-default">
             
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 100%;">
                                <thead>
                                                <tr>
                                                	<th></th>
                                        <th>Total</th>
                                       
                                        <th>RG</th>
                                        <th>GW</th>
                                
                                    <th>Remaining</th>

                                    </tr>
                                            </thead>
                     <tbody>
                                              <?php
								
include('../configdb.php');
//	if(isset($_POST['fcountry']) && $_POST['fcountry'] != 'All') {$country=$_POST['fcountry'];}
//	else {
	//	$country='';
	//}
	if(isset($_POST['fromdate']))
$fromdate=$_POST['fromdate'];
else {
	$fromdate='';
}
if(isset($_POST['todate']))
$todate=$_POST['todate'];
else {
	$todate='';
}

$query="select (select sum(RGAREA) from offers where status <>'COMPLETED' and status <> 'CANCELED' and manuel=0";
 

  if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }

 
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.")as sRGAREA,
				(select sum(GWAREA) from offers where status <>'COMPLETED' and status <> 'CANCELED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }


 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWAREA,
				(select sum(lsarea) from offers where status <>'COMPLETED' and status <> 'CANCELED' and manuel=0";
			if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sLANDAREA,
				(select sum(OfferValue) from offers where status <>'COMPLETED' and status <> 'CANCELED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sOFFERVALUE,
				(select sum(OfferValue) from offers where status ='IN HAND' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sInHandBudget,
				(select sum(OfferValue) from offers where status ='IN HAND' and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sINHANDGWBudget,
				(select sum(OfferValue) from offers where status ='IN HAND' and RG=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' ";} 
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sINHANDRGBudget,
				(select sum(OfferValue) from offers where status ='IN HAND' and ls=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sINHANDLANDOFFERBudget,
				(select sum(remaining) from offers where status ='IN HAND' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sINHANDRemaining,
				
				(select sum(OfferValue) from offers where status ='OFFER' and hp=0 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' ";} 
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sOFFERBudget,
 (select sum(OfferValue) from offers where (status ='OFFER' or status ='INQUIRIES') and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' ";} 
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sOFFERINQBudget,
				(select sum(OfferValue) from offers where status ='OFFER' and GW=1 and hp=0 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}

if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWOFFERBudget,
				(select sum(OfferValue) from offers where status ='OFFER' and RG=1 and hp=0 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGOFFERBudget,
				(select sum(OfferValue) from offers where status ='OFFER' and ls=1  and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sLANDOFFERBudget,
				(select sum(OfferValue) from offers where status ='CANCELED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sCancelledBudget,
				(select sum(OfferValue) from offers where status ='CANCELED' and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' ";} 
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWCancelledBudget,
				(select sum(OfferValue) from offers where status ='CANCELED' and RG=1  and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGCancelledBudget,
				(select sum(OfferValue) from offers where status ='CANCELED' and ls=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sLANDCancelledBudget,
				(select sum(OfferValue) from offers where status ='COMPLETED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sCompletedBudget,
				(select sum(OfferValue) from offers where status ='COMPLETED' and GW=1 and manuel=0 ";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWCompletedBudget,
				(select sum(OfferValue) from offers where status ='COMPLETED' and RG=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGCompletedBudget,
				(select sum(OfferValue) from offers where status ='COMPLETED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' ";} 
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sLANDCompletedBudget,
				(select sum(remaining) from offers where status ='COMPLETED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRemainingCompletedBudget,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' ) and  hp=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sHPBudget,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' ) and  hp=1 and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWHPBudget,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' ) and  hp=1 and RG=1 and manuel=0 ";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGHPBudget,
				(select sum(OfferValue) from offers where hp=1 and ls=1 and status='OFFER' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sLANDHPBudget,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sAgent,
				(select sum(OfferValue) from offers where bd=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sBusinessD,
				(select sum(OfferValue) from offers where bd=1 and RG=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGBusinessD,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and RG=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGAgent,
				(select sum(OfferValue) from offers where bd=1 and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWBusinessD,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWAgent,
				(select sum(OfferValue) from offers where status= 'INQUIRIES' and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWINQ,
 
 (select sum(OfferValue) from offers where status = 'INQUIRIES' and RG=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGINQ,
 
  (select sum(OfferValue) from offers where status = 'INQUIRIES' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sINQ,
 
 (select sum(OfferValue) from offers where status = 'ARCHIVED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sARCHIVED,
 
 (select sum(OfferValue) from offers where status = 'ARCHIVED' and RG=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGARCHIVED,
 
 (select sum(OfferValue) from offers where status = 'ARCHIVED' and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWARCHIVED,
 
 (select sum(remaining) from offers where status = 'ARCHIVED' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRemainingARCHIVED,
 
				(select sum(OfferValue) from offers where status= 'POTENTIAL' and GW=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sGWPOT,
 
 (select sum(OfferValue) from offers where status = 'POTENTIAL' and RG=1 and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sRGPOT,
 
  (select sum(OfferValue) from offers where status = 'POTENTIAL' and manuel=0";
				if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }
 if($fromdate!=''){ $query =$query." and Dat>='$fromdate' "; }
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
 if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
 $query =$query.") as sPOT  
				from offers ";
 if($fromdate!=''){ $query =$query." where Dat>='$fromdate' "; 
 if($todate!='' ){ $query =$query." and Dat<='$todate'";}
  if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }}
else if($todate!='' ){ $query =$query." where Dat<='$todate'"; 
if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." and country in ('".implode("','",$_POST["fcountry"])."') ";
  }

  }
else{
  if(sizeof($_POST["fcountry"])>0  && implode("','",$_POST["fcountry"])!='0'){
    $query=$query." where  country in ('".implode("','",$_POST["fcountry"])."') ";
  }

}
	$query2xls=$query;

  
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){;?>
	
									 <tr class="odd gradeX">
                                    	
                                    <td >Budget</td>
                                    <td ><?php echo(number_format(round((float)$x["sOFFERINQBudget"], 2))); ?></td>
                                       <td ><?php echo(number_format(round((float)$x["sRGAREA"], 2))); ?></td>
                                        <td ><?php echo(number_format(round((float)$x["sGWAREA"], 2))); ?></td>
                                       <td > </td>
                                      </tr>
									<tr class="odd gradeX">
                                    	
                                    <td style="background-color: #F75A53;">INQUIRY</td>
                                    <td style="background-color: #F75A53;"><?php echo(number_format(round((float)$x["sINQ"], 2))); ?></td>
                                       <td style="background-color: #F75A53;"><?php echo(number_format(round((float)$x["sRGINQ"], 2))); ?></td>
                                        <td style="background-color: #F75A53;"><?php echo(number_format(round((float)$x["sGWINQ"], 2))); ?></td>
                                       <td style="background-color: #F75A53;"> </td>
                                      </tr>
                                   
                                      <tr class="odd gradeX">
                                      	<td style="background-color: lightblue;">In Hand</td>
                                         <td style="background-color: lightblue;"><?php echo(number_format(round($x["sInHandBudget"], 2))); ?></td>
                                         <td style="background-color: lightblue;"><?php echo(number_format(round($x["sINHANDRGBudget"], 2))); ?></td>
                                         <td style="background-color: lightblue;"><?php echo(number_format(round($x["sINHANDGWBudget"], 2))); ?></td>
                                         <td style="background-color: lightblue;"><?php echo(number_format(round($x["sINHANDRemaining"], 2))); ?></td>
                                        </tr>
                                        <tr class="odd gradeX">
                                        	<td >Offer not HP</td>
                                         <td ><?php echo(number_format(round($x["sOFFERBudget"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sRGOFFERBudget"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sGWOFFERBudget"], 2))); ?></td>
                                         <td > </td>
                                         </tr>
                                          <tr class="odd gradeX">
                                    	
                                    <td style="background-color: green;">Potential</td>
                                    <td style="background-color: green;"><?php echo(number_format(round($x["sPOT"], 2))); ?></td>
                                       <td style="background-color: green;"><?php echo(number_format(round((float)$x["sRGPOT"], 2))); ?></td>
                                        <td style="background-color: green;"><?php echo(number_format(round((float)$x["sGWPOT"], 2))); ?></td>
                                       <td style="background-color: green;"> </td>
                                      </tr>
                                      <tr class="odd gradeX">
                                         	<td style="background-color: violet;">Complete</td>
                                         <td style="background-color: violet;"><?php echo(number_format(round($x["sCompletedBudget"], 2))); ?></td>
                                         <td style="background-color: violet;"><?php echo(number_format(round($x["sRGCompletedBudget"], 2))); ?></td>
                                         <td style="background-color: violet;"><?php echo(number_format(round($x["sGWCompletedBudget"], 2))); ?></td>
                                         <td style="background-color: violet;"><?php echo(number_format(round($x["sRemainingCompletedBudget"], 2))); ?></td>
                                         </tr>
                                         <tr class="odd gradeX">
                       					 <td style="background-color: red;">Cancelled</td>
                                         <td style="background-color: red;"><?php echo(number_format(round($x["sCancelledBudget"], 2))); ?></td>
                                         <td style="background-color: red;"><?php echo(number_format(round($x["sRGCancelledBudget"], 2))); ?></td>
                                         <td style="background-color: red;"><?php echo(number_format(round($x["sGWCancelledBudget"], 2))); ?></td>
                                         <td style="background-color: red;"> </td>
                                         </tr>
                                         
                                        
                                         <tr class="odd gradeX">
                                         <td ><span class="fa fa-star fa-2x" style="color:yellow;"></span> High Prob</td>
                                         <td ><?php echo(number_format(round($x["sHPBudget"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sRGHPBudget"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sGWHPBudget"], 2))); ?></td>
                     
                                         <td > </td>
                                        
                                    </tr>
                                      <tr class="odd gradeX">
                                         	<td ><span class="fa fa-user"></span> Business Development</td>
                                         <td ><?php echo(number_format(round($x["sBusinessD"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sRGBusinessD"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sGWBusinessD"], 2))); ?></td>
                                         <td ></td>
                                         </tr>
                                          <tr class="odd gradeX" >
                                         	<td ><span class="fa fa-flag"></span> Agent</td>
                                         <td ><?php echo(number_format(round($x["sAgent"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sRGAgent"], 2))); ?></td>
                                         <td ><?php echo(number_format(round($x["sGWAgent"], 2))); ?></td>
                                         <td ></td>
                                         </tr>
                                         <tr class="odd gradeX" >
                                         	<td style="background-color: yellow;"> Archived</td>
                                         <td style="background-color: yellow;"><?php echo(number_format(round($x["sARCHIVED"], 2))); ?></td>
                                         <td style="background-color: yellow;"><?php echo(number_format(round($x["sRGARCHIVED"], 2))); ?></td>
                                         <td style="background-color: yellow;"><?php echo(number_format(round($x["sGWARCHIVED"], 2))); ?></td>
                                         <td style="background-color: yellow;"><?php echo(number_format(round($x["sRemainingARCHIVED"], 2))); ?></td>
                                         </tr>
									<?php
											}
										?>
                                            </tbody>
                            </table>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            
</div>
<?php } ?>
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
		   <legend  style="font-size: 15px;" >Project Info</legend>
		
	
		
		<div class="col-lg-6 nopadding">
			Date<input class="form-control" type="date"   name="date"  id="date"  >
		</div>
		<div class="col-lg-6 nopadding">
			Due Date<input class="form-control" type="date"   name="duedate"  id="duedate"  >
		</div>
		<div class="col-lg-6 nopadding">
			Project Name<input class="form-control" type="text"   name="pname"  id="pname"  required>
		</div>
		<div class="col-lg-6 nopadding">
			PE<input class="form-control" type="text"   name="pe"  id="pe"  >
		</div>
			<div class="col-lg-6 nopadding">
			Country<input class="form-control" type="text" id="country" name="country" list="countryy" />
<datalist id="countryy">
  <?php
								
include('../configdb.php');
$query = "Select distinct(country) as country From offers";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['country']); ?></option>
						  <?php } ?>
</datalist>
		</div>
<div class="col-lg-6 nopadding">
		City<input class="form-control" type="text" id="city" name="city" list="cityy" />
<datalist id="cityy">
  <?php
								
include('../configdb.php');
$query = "Select distinct(city) as city From offers";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo($x['city']); ?></option>
						  <?php } ?>
</datalist>
		</div>
		
		<div class="col-lg-5 nopadding">
				
	<?php	$query = "Select * From customers order by fname asc";
			$results = mysqli_query($dbhandle, $query) or die(mysqli_error());
		?>
		Client/owner<select class="form-control" id="client" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>
		<div class="col-lg-1 nopadding">
		</br>
		<button type="button" id="Ad2" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>
	
		<div class="col-lg-5 nopadding">
		Clien Rep<select class="form-control" id="clien" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>
		<div class="col-lg-1 nopadding">
			</br>
		<button type="button" id="Ad3" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>

<div class="col-lg-5 nopadding">
				
	
		Consultant<select class="form-control" id="consultant" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>
		<div class="col-lg-1 nopadding">
			</br>
		<button type="button" id="Ad4" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>
		<div class="col-lg-5 nopadding">
				
	
		Architect<select class="form-control" id="architect" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>
		<div class="col-lg-1 nopadding">
			</br>
		<button type="button" id="Ad5" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>
<div class="col-lg-5 nopadding">
		Landscape Architect<select class="form-control" id="larchitect" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>
		<div class="col-lg-1 nopadding">
			</br>
		<button type="button" id="Ad6" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>
		<div class="col-lg-5 nopadding">
		Contractor<select class="form-control" id="contractor" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>
		<div class="col-lg-1 nopadding">
			</br>
		<button type="button" id="Ad7" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>
		<div class="col-lg-5 nopadding">
		Referral<select class="form-control" id="refferal" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?></select>
</div>
<div class="col-lg-1 nopadding">
	</br>
		<button type="button" id="Ad8" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
	if ($_SESSION['cce'] != 1) { echo('disabled');
	}
?> >Add</button>
		</div>
		<div class="col-lg-5 nopadding">
		Main Contractor<select class="form-control" id="maincontractor" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>

		<div class="col-lg-1 nopadding">
			</br>
		<button type="button" id="Ad9" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>
		<div class="col-lg-5 nopadding" style="display: none;">
		Main Contractor Referral<select class="form-control" id="maincontractorreferral" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
	}
?>
		</select>
		</div>
		<div class="col-lg-1 nopadding" style="display: none;">
			</br>
		<button type="button" id="Ad10" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal3" <?php
			if ($_SESSION['cce'] != 1) { echo('disabled');
			}
		?> >Add</button>
		</div>


<div class="col-lg-6 nopadding"  >
      Sub Contractors  <select   multiple class="form-control" id="subcontractor" style="width: 100%; ">
     <option value="0"></option>
    <?php
mysqli_data_seek($results, 0);
    while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['company'] . "/" . $x['fname'] . " " . $x['lname']); ?></option>
 <?php
  }
?>
    </select>
    </div>



		<table width="100%">
			<tr style="display: none;">
		<td colspan="2" >Refferal Notes<textarea class="form-control" id="refferaln" size="3" style="width: 100%; "></textarea></td>
		</tr><tr>
			<td colspan="2">Expected Date of Project Kick-Off<input class="form-control" type="date"   name="kdate"  id="kdate"  ></td>
			 <td style="display: none">&nbsp;<div class="checkbox">
                                    <label>
                                        &nbsp;<input type="checkbox" id="kickoffna" value="kickoffna">N/A &nbsp;
                                    </label>
                               </div>
                               </td>
			</tr><tr>
		<td colspan="2">Notes<input class="form-control" type="text"   name="notes"  id="notes" style="width: 100%; " ></td>
		</tr>
	
		</table>
		</fieldset>
<br>
 <table width="100%">
			 <tr>
			 <td>
			Offer Status<select class="form-control" id="status" style="width: 100%; ">
	 <option value="INQUIRIES" >INQUIRIES</option>
	 <option value="OFFER">OFFER</option>
	 <option value="IN HAND">IN HAND</option>
	 <option value="POTENTIAL">POTENTIAL</option>
	 <option value="COMPLETED">COMPLETED</option>
	 <option value="CANCELED">CANCELED</option>
	 <option value="SIGNED">SIGNED</option>
	 <option value="ARCHIVED">ARCHIVED</option>
		</select></td>
		          <td> Offer Status
							     <input class="form-control" type="date"   name="statusdate"  id="statusdate"  >
			 </td>
			 </tr>
			 </table>
			 <br>
			 <table width="100%">

			  	 <tr>

			  <td colspan="2" width="100%">
			  Cancel Reason
			<input class="form-control" type="text"   name="cancelreason"  id="cancelreason"  >
			 </td>
			 </tr>
			 <tr style="display: none;">
			 <td colspan="2" width="100%">
			    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="tsupport" value="tsupport" style="display: none;"> &nbsp;
                                    </label>
                               </div>
							
								   
			 </td>
			 </tr>
			 <tr style="display: none;">
			 <td>
			      <input class="form-control" type="date"   name="tstartdate"  id="tstartdate" style="display: none;">
			 </td>
			  <td>
		
			    <input class="form-control" type="date"   name="tenddate"  id="tenddate"  style="display: none;">
			  
			 </td>
			 </tr>
	
			 <tr style="display:none;">
			 <td colspan="2">
			    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="design" value="design">Design &nbsp;
                                    </label>
                               </div>
							
			 </td>
			 </tr>
			 <tr style="display:none;">
			  <td>
			       <input class="form-control" type="date"   name="dstartdate"  id="dstartdate"  >
			  </td>
			  <td>
							       <input class="form-control" type="date"   name="denddate"  id="denddate"  >
			 </td>
			 </tr>
			
			 	 <tr>

		

			  <td colspan="2" width="100%">
			  	 Ref #
			<input class="form-control" type="text"   name="offerref"  id="offerref"  >
			 </td>
       </tr>
       </table>
       <table width="100%">
       <tr>
            <td> 
            <?php if($_SESSION['hidevalues']!=1){?>
			  	 Value
			  <?php } ?>
			<input class="form-control" type="number"   name="valuecurrency"    id="valuecurrency"  <?php if($_SESSION['hidevalues']==1){?> style=" display:none; visibility:hidden;"    <?php } ?> >
            </td>
            <td> 	
            <?php	$query = "Select * From currencies";
				$results = mysqli_query($dbhandle, $query) or die(mysqli_error());
			?>
			 	 			Currency<select class="form-control" id="currency1" style="width: 100%; ">
	 
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['SERIAL']); ?>" ><?php echo($x['Symbol']); ?></option>
 <?php
	}
?>
		</select> 
        </td>
        
            <td>
            <br>
            <button class="btn btn-primary" id="convert" style="width:100%;margin:2px;">Convert <span class="fa fa-dollar"></span></button></td>
            <td>
         
            <?php if($_SESSION['hidevalues']!=1){?>
			  	 Value USD
			  <?php } ?>
			<input class="form-control" type="text"   name="offervalue"    id="offervalue"  <?php if($_SESSION['hidevalues']==1){?> style=" display:none; visibility:hidden;"    <?php } ?> >
      
            </td>
        </tr>
        </table>
        <table width="100%">
		
		

			  <tr>
			   <td width="50%">
			  	 Remaining
			<input class="form-control" type="text"   name="offerremaining"  id="offerremaining"  >
			 </td>
			 </tr>
			  <tr>

		

			  <td width="50%">
			  <?php if($_SESSION['hidevalues']!=1){?>
			  	 Cost
			  <?php } ?>
			<input class="form-control" type="text"   name="cost"  id="cost"  <?php if($_SESSION['hidevalues']==1){?> style=" display:none; visibility:hidden;"    <?php } ?> >
			 </td>
			   <td width="50%">
			  	 Gross Margin
			<input class="form-control" type="text"   name="gross"  id="gross"  >
			 </td>
			 </tr>
			 </table>
			  

			  
			  <table ><tr><td >
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dealer" value="dealer">Agent &nbsp;
                                    </label>
                               </div>
                               <input class="form-control" type="date"   name="agentdate"  id="agentdate" >
							   </td>
							   <td>&nbsp;</td>
							      <td >
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="bd" value="bd">Business development &nbsp;
                                    </label>
                               </div>
                               <input class="form-control" type="date"   name="bddate"  id="bddate" >
							   </td>
							    <td>&nbsp;</td>
							 <td >
			   <div class="checkbox">
                                     <label>
                                      <input type="checkbox" id="hprobability" value="hprobability">High Probability &nbsp;
                                    </label>
                               </div>
                              <input class="form-control" type="date"   name="hpdate"  id="hpdate" >
                             </td>
							<div class="checkbox">
                                     <label>
                                      <input type="checkbox" id="specified" value="specified">  Specified &nbsp;
                                    </label>
                               </div>
							   </tr>
							 
							  </table>
<br>
			<fieldset width="100%" height="100%">
			 <legend  style="font-size: 15px;" >Project type</legend>
			 <table style=" border: 1px solid #DDD;" width="100%">
			  <caption >GW</caption>
			 <tr>
			<td>  <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="gw" value="gw">GW &nbsp;
                                    </label>
                               </div>
							   </td>
							   <td>
							   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="int" value="int">INT &nbsp;
                                    </label>
                               </div>
							     </td>
							   <td>
							   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="ext" value="ext">EXT &nbsp;
                                    </label>
                               </div>
							     </td>
								<td>Area<input class="form-control" type="text"   name="area"  id="area"  ></td>




			
			</tr>
			 </table>




<br><br>



<div class="center hidden"><h4>BoQ</h4>

 <div class="row"  >
     <div class="col-lg-2">
  <div class="checkbox">
        <label>
        <input type="radio" checked name="regularity" id="regular" value="1">regular &nbsp;
        </label>
        </div>
      </div>

      <div class="col-lg-2">
  <div class="checkbox">
        <label>
        <input type="radio" name="regularity"  id="irregular" value="0">irregular &nbsp;
        </label>
        </div>
      </div>

     


      <div class="col-lg-2">
  <div class="checkbox">
        <label>
        <input type="checkbox" name="interial"  id="interial"  >internal &nbsp;
        </label>
          <input class="form-control" type="number"   name="interialqte"  id="interialqte" disabled="disabled" >
        </div>
      </div>


      <div class="col-lg-2">
  <div class="checkbox">
        <label>
        <input type="checkbox" name="exterial"  id="exterial"  >external &nbsp;
        </label>
          <input class="form-control" type="number"   name="exterialqte"  id="exterialqte" disabled="disabled" >
        </div>
      </div>
         
        </div>


        <div class="row">
           <div class="col-lg-2">
 
        <label>
       Height
        </label>
          <input class="form-control" type="number"   name="height"  id="height"  >
        
      </div>

      <div class="col-lg-2">
 
        <label>
       Width
        </label>
          <input class="form-control" type="number"   name="width"  id="width"  >
        
      </div>

<div class="col-lg-2">
 
        <label>
       m<sup>2</sup>
        </label>
          <input class="form-control" type="text"   name="cm"  id="cm" disabled="disabled"  >
        
      </div>



<div class="col-lg-2">
 
        <label>
    Humidity Sensor 
        </label>
          <input class="form-control" type="number"   name="buildupp"  id="buildupp"   >


        
      </div>
 



<div class="col-lg-2">
                  <label>
    Jambs   
        </label>
          <input class="form-control" type="number"   name="jamb"  id="jamb"   >
</div>



        </div>


<div class="row">
   <div class="col-lg-2">
  <div class="checkbox">
        <label>
        <input type="checkbox"  id="doors" value="doors">doors &nbsp;
        </label>
         <input class="form-control" type="number"   name="doorsqte"  id="doorsqte" disabled="disabled"  >
        </div>
     </div>


      <div class="col-lg-2">
  <div class="checkbox">
        <label>
        doors Width
        </label>
         <input class="form-control" type="number"   name="doorwid"  id="doorwid" disabled="disabled"  >
        </div>
     </div>



      <div class="col-lg-2">
  <div class="checkbox">
        <label>
        doors Height
        </label>
         <input class="form-control" type="number"   name="doorhei"  id="doorhei" disabled="disabled"  >
        </div>
     </div>

     
</div>
<div class="row">
   <div class="col-lg-2">
  <div class="checkbox">
        <label>
        <input type="checkbox"  id="windows" value="windows">windows &nbsp;
        </label>
         <input class="form-control" type="number"   name="windowsqte"  id="windowsqte" disabled="disabled" >
        </div>
      </div>


      <div class="col-lg-2">
  <div class="checkbox">
        <label>
         windows  Width
        </label>
         <input class="form-control" type="number"   name="windowwid"  id="windowwid" disabled="disabled" >
        </div>
      </div>



      <div class="col-lg-2">
  <div class="checkbox">
        <label>
         windows Height
        </label>
         <input class="form-control" type="number"   name="windowhei"  id="windowhei" disabled="disabled" >
        </div>
      </div>
</div>


<br><br>

<h4>Irrigation System</h4>

<div class="row">
<div class="col-lg-2">
 
        <label>
  # Of Station
        </label>
          <input class="form-control" type="number"   name="stationnb"  id="stationnb"   >
        
      </div>


      <div class="col-lg-2">
 
        <label>
  caliber
        </label>
          <input class="form-control" type="number"   name="caliber"  id="caliber"   >
        
      </div>



   <div class="col-lg-2">
 
        <label>
  Flow sensors
        </label>
          <input class="form-control" type="number"   name="flowsensors"  id="flowsensors"   >
        
      </div>

  

      <div style="display: none" class="col-lg-6">
  
<label>   Type </label>
<select class="form-control" name="toto" id="toto">
      <option selected value="Type 0 ">Type 0</option>
      <option value="Type 1">Type 1</option>
      <option value="Type 2">Type 2</option>
      <option value="Type 3">Type 3</option>
       
    </select>
 

</div>

      </div>

<div class="row">
  
<div class="col-lg-4">

<label> Emitter Type </label>
<select class="form-control" id="emittertype">
      <option value="GPH 1">GPH 1</option>
      <option value="GPH 2">GPH 2</option>
      <option value="GPH 5">GPH 5</option>
      <option value="GPH 7">GPH 7</option>
      <option value="GPH 10">GPH 10</option>
      <option value="3 mm">3 mm</option>
    </select>
</div>

<div class="col-lg-4">
  
<label> irrigation Lines </label>
<input class="form-control" type="number"   name="elegationlines"  id="elegationlines"   >


</div>


<div class="col-lg-4">
  
<label> Emitters Quantity </label>
<input class="form-control" type="number" disabled  name="emittersqte"  id="emittersqte"   >


</div>



</div>



        </div>




			
			 <table style=" border: 1px solid #DDD;" width="100%">
			  <caption>RG</caption>
			 <tr>
			 <td >
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="rg" value="rg">RG &nbsp;
                                    </label>
                               </div>
							  </td><td>&nbsp;&nbsp;</td>
							  <td>
								Area<input class="form-control" type="text"   name="rgarea"  id="rgarea"  >



								
								</td></tr></table>







		<table style=" border: 1px solid #DDD;display:none;" >
			  <caption>Design</caption><tr>
			 <td >
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="ls" value="ls">Design &nbsp;
                                    </label>
                               </div>
							  </td>
							  <td>
								Area<input class="form-control" type="text"   name="lsarea"  id="lsarea"  style="width: 100%; ">
								
								</td></tr></table>
						
				
				<table width="100%"  >
			
				<tr>
				<td>
					Build-UP<textarea class="form-control" id="buildup" size="3" style="width: 100%; "></textarea>
				</td>
				</tr>
				<tr style="display: none;">
				<td>
					<textarea class="form-control" id="troom" size="3" style="width: 100%; display: none;" ></textarea>
				</td>
				</tr>
				</table>
				</fieldset>
						<br>
				<br>

							  <br>
<div class="row" id="taskattdiv">
	<div class="col-lg-6 nopadding" align="center">
		<label>Work In Progress</label>
 		 <div class="file-loading">
            <input id="images" name="images[]" type="file" multiple>
    </div>
    </div>
    <div class="col-lg-6 nopadding" align="center" <?php if($_SESSION['Hide']==1){?>style="display: none;" <?php }?>>
    	<label>Prices & Correspondance</label>
 		 <div class="file-loading">
          <input id="images1" name="images[]" type="file" multiple>
    </div>
    </div>
</div>
							  	
							   <br>
							   
							    	
							   
							   <div align="left">
			<table border="1" id="tableattachment1" style="width: 80%">
				
			</table>
			</div>
			<br>
			<legend  style="font-size: 15px;" >Images</legend>
			<div class="col-lg-12">
			<div class="col-lg-3">
				  	<form id="formimage1" target="blank" action="upload1.php?x=<?php
				if (isset($_GET['x']))
					echo $_GET['x'] . "&y=1";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload1[]" id="imageToUpload1" style="display:none;">
						
					<image id="image1" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload1').click();"/	> 
							 
							   </form>
			</div>
			<div class="col-lg-3">
				  	<form id="formimage2" target="blank" action="upload1.php?x=<?php
				if (isset($_GET['x']))
					echo $_GET['x'] . "&y=2";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload2[]" id="imageToUpload2" style="display:none;" >
						
					<image id="image2" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload2').click();"/> 
							 
							   </form>
			</div>
			<div class="col-lg-3">
				  	<form id="formimage3" target="blank" action="upload1.php?x=<?php
				if (isset($_GET['x']))
					echo $_GET['x'] . "&y=3";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload3[]" id="imageToUpload3" style="display:none;" >
						
					<image type="image" id="image3" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload3').click();"/> 
							 
							   </form>
			</div>
				<div class="col-lg-3">
				  	<form id="formimage4" target="blank" action="upload1.php?x=<?php
					if (isset($_GET['x']))
						echo $_GET['x'] . "&y=4";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload4[]" id="imageToUpload4" style="display:none;" >
						
					<image id="image4" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload4').click();"/> 
							 
							   </form>
			</div>
				<div class="col-lg-3">
				  	<form id="formimage5" target="blank" action="upload1.php?x=<?php
					if (isset($_GET['x']))
						echo $_GET['x'] . "&y=5";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload5[]" id="imageToUpload5" style="display:none;" >
						
					<image id="image5" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload5').click();"/> 
							 
							   </form>
			</div>
				<div class="col-lg-3">
				  	<form id="formimage6" target="blank" action="upload1.php?x=<?php
					if (isset($_GET['x']))
						echo $_GET['x'] . "&y=6";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload6[]" id="imageToUpload6" style="display:none;" >
						
					<image id="image6" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload6').click();"/> 
							 
							   </form>
			</div>
			<div class="col-lg-3">
				  	<form id="formimage7" target="blank" action="upload1.php?x=<?php
				if (isset($_GET['x']))
					echo $_GET['x'] . "&y=7";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload7[]" id="imageToUpload7" style="display:none;" >
						
					<image id="image7" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload7').click();"/> 
							 
							   </form>
			</div>
			<div class="col-lg-3">
				  	<form id="formimage8" target="blank" action="upload1.php?x=<?php
				if (isset($_GET['x']))
					echo $_GET['x'] . "&y=8";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload8[]" id="imageToUpload8" style="display:none;" >
						
					<image id="image8" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload8').click();"/> 
							 
							   </form>
			</div>
				<div class="col-lg-3">
				  	<form id="formimage9" target="blank" action="upload1.php?x=<?php
					if (isset($_GET['x']))
						echo $_GET['x'] . "&y=9";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload9[]" id="imageToUpload9" style="display:none;" >
						
					<image id="image9" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload9').click();"/> 
							 
							   </form>
			</div>
				<div class="col-lg-3">
				  	<form id="formimage10" target="blank" action="upload1.php?x=<?php
					if (isset($_GET['x']))
						echo $_GET['x'] . "&y=10";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload10[]" id="imageToUpload10" style="display:none;" >
						
					<image id="image10" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload10').click();"/> 
							 
							   </form>
			</div>
				<div class="col-lg-3">
				  	<form id="formimage11" target="blank" action="upload1.php?x=<?php
					if (isset($_GET['x']))
						echo $_GET['x'] . "&y=11";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload11[]" id="imageToUpload11" style="display:none;" >
						
					<image  id="image11" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload11').click();"/> 
							 
							   </form>
			</div>
				<div class="col-lg-3">
				  	<form id="formimage12" target="blank" action="upload1.php?x=<?php
					if (isset($_GET['x']))
						echo $_GET['x'] . "&y=12";
 ?>" method="post" enctype="multipart/form-data">
							  
							  	<input type="file" name="imageToUpload12[]" id="imageToUpload12" style="display:none;" >
							  <image id="image12" src="" width="120" height="100" onclick = "document.getElementById('imageToUpload12').click();"/>
							   </form>
						    
			</div>
			
		</div>
	<div class='col-lg-6 nopadding'>
		<label id ="lblalert2" style="visibility: hidden; color: red;">Please Save the Offer before adding Follow Up !</label>
	</div>
	<div class='col-lg-6 nopadding' align="right">
		<button type="button" id="Ad1" class="btn btn-outline btn-primary" >Add FollowUp</button>
	</div>
		
						 <br>
			 
			<table align="left" style="width: 100%;" border="1">
				<thead>
					<th>Date</th>
					<th>Description</th>
					
					<th>Done By</th>
					
					<th>Delete</th>
				</thead>
				<tbody id="followup"></tbody>
			</table>



      <br>


      <div class='col-lg-6 nopadding'>
    <label id ="alert" style="visibility: hidden; color: red;">Please Save the Offer before adding Zones  !</label>
  </div>
      <div  class='col-lg-6 nopadding' align="right">
    <button  style="display: none" type="button" id="addzoness" class="btn btn-outline btn-primary" >Add Zones </button>
  </div>
    
             <br>
       
      <table  style="display: none" align="left" style="width: 100%;" border="1">
        <thead>
          <th>Date</th>
          <th>Description</th>
           <th>Delete</th>
        </thead>
        <tbody id="zoness"></tbody>
      </table>	
      </div>
        <div class="modal-footer" >
			<label id ="lblalert1" style="visibility: hidden; color: red;">Please Choose Attachment !</label>
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Project Name !</label>



		<table align="center"  >
			
		<tr>
				<td>
	
        <button type="button" id="printout"class="btn btn-outline btn-primary" >Printout</button>
		</td>
			<td width="10">
		</td>
			<td>
	
        <button type="button" id="ref"class="btn btn-outline btn-primary" >Refferal notes</button>
		</td>
			<td width="10">
		</td>
		<td>
	
        <button type="button" id="att1"class="btn btn-outline btn-primary" >Attach</button>
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
    $("#fcountry").select2({
    closeOnSelect: false
  });
</script>

<script src="../../js/offers.js"></script>

</body>

</html>
