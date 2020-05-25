<?php session_start(['cookie_lifetime' => 86400]);
 error_reporting(0); 

 
?>
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
<link rel="stylesheet" href="../../select2/dist/css/select2.css">
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
		padding:8px !important;
		margin:0 !important;
	}

</style>
<link rel="stylesheet" href="../date/themes/base/jquery.ui.all.css">

	<script src="../date/jquery-1.9.1.js"></script>
	<script src="../../vendor/jquery/jquery.min.js"></script>
	<script src="../date/ui/jquery.ui.core.js"></script>
	
	<script src="../date/ui/jquery.ui.widget.js"></script>
	
	<script src="../date/ui/jquery.ui.datepicker.js"></script>
	
	<script>
	$(function() {
		if ( $('[type="date"]').prop('type') != 'date' ) {
    $('[type="date"]').datepicker();
}
		
	});
	</script>
</head>

<body>
	  <?php
  
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
                
                    <h1 class="page-header">Maintenances</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
                        	<form method="post">
                        		<div class="row nopadding" align="left">
                        		<div class="col-lg-2 nopadding">
                               <label>Country</label>	 
                               <select  class="form-control" id="fcountry" name="fcountry" style="width: 100%;" >
											<option selected value="All">All</option>
											<?php 
											include('../configdb.php');
										$query="select distinct(Country) as country from offers where country <> '' order by country asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["country"]); ?>" <?php
												if (isset($_POST['fcountry'])) {
													if ($_POST['fcountry'] == $x['country'])
														echo("selected");
												}
 ?>><?php echo($x["country"]); ?></option>
											<?php } ?>
											</select>
                             </div>
                              <div class="col-lg-2 nopadding">
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
                        	 <div class="col-lg-1 nopadding">
                            	<br>
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="frg" id="frg" value=""  value=""<?php if(isset($_POST['frg'])) {if($_POST['frg']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>RG 
                                    </label>
                               </div>
                              </div>
                             <div class="col-lg-1 nopadding">
                             	<br>
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="fgw" id="fgw" value=""  value=""<?php if(isset($_POST['fgw'])) {if($_POST['fgw']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>GW 
                                    </label>
                               </div>
                             </div>
                             
                              <div class="col-lg-1 nopadding">
                            	<br>
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="fin" id="fin" value=""  value=""<?php if(isset($_POST['fin'])) {if($_POST['fin']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>IN 
                                    </label>
                               </div>
                              </div>
                             <div class="col-lg-1 nopadding">
                             	<br>
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="fout" id="fout" value=""  value=""<?php if(isset($_POST['fout'])) {if($_POST['fout']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>OUT 
                                    </label>
                               </div>
                             </div>
                             
                             
                             
                             <div class="col-lg-2">
						<label>From Date</label><input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "fromdate" name="fromdate"  value="<?php if (isset($_POST['fromdate'])) {echo($_POST['fromdate']);} ?>"/>
					</div>
					<div class="col-lg-2">
						<label>To Date</label><input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "todate" name="todate"  value="<?php if (isset($_POST['todate'])) {echo($_POST['todate']);} ?>"/>
					</div>
                             <div class="col-lg-1 nopadding">
                             	<br><button type="button" id="search" class="btn btn-outline btn-primary" onclick="this.form.submit();">Search</button>
                             	</div>
                             	
                             <div class="col-lg-1 nopadding">
                             	<br>
                             	 <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['mce']!=1){ echo('disabled'); }?> >Add </button>
                             </div>
							  </div>
			
						</form>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 85%;">
                                <thead>
                                    <tr>
                                        
										<th>Project Name</th>
										<th>Status</th>
										<th>Country</th>
										<th>City</th>
										<th>Client</th>
										<th>GW</th>
										<th>INT</th>
										<th>EXT</th>
										<th>GW Area</th>
										<th>RG</th>
										<th>RG Area</th>
										
										<?php if($_SESSION['hidevalues']==0){?>
										<th>Offer Value</th>
										<th>Maintenance Value</th>
										<th> Maintenance %</th>
										<th>Remaining</th>

                                        

										<?php }?>
                                        <th>Cost Value</th>
                                        <th>Cost %</th>
										<th>Kick Off Date</th>
										<th>Expiry Date</th>
										<th>Notes</th>
										<th>Attachment</th>
										<th>Readings</th>
										 
											<th>Visits</th>

                                            <th>Offer Ref#</th>

                                              
                                           <?php if($_SESSION['mce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['mcd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
include('../configdb.php');
$rg='';
$gw='';
$in='';
$out='';
$country='';
$city='';
if(isset($_POST['fromdate']) && $_POST['fromdate']!='')
$fromdate=" and offerid in (select serial From offers where kickoff >= '".$_POST['fromdate']."')";
else {
	$fromdate='';
}
if(isset($_POST['todate']) && $_POST['todate']!='')
$todate=" and offerid in (select serial From offers where kickoff <= '".$_POST['todate']."')";
else {
	$todate='';
}
if(isset($_POST['frg'])) 
{$rg=" and offerid in (select serial from offers where RG= 1) ";}
if(isset($_POST['fgw'])) 
{$gw=" and offerid in (select serial from offers where GW= 1) ";}
if(isset($_POST['fin'])) 
{$in=" and offerid in (select serial from offers where GWINT= 1) ";}
if(isset($_POST['fout'])) 
{$gw=" and offerid in (select serial from offers where GWEXT= 1) ";}
if(isset($_POST['fcountry']) && $_POST['fcountry'] != 'All') {$country=" and offerid in (select serial from offers where country ='".$_POST['fcountry']."')";}
	else {
		$country='';
	}
	if(isset($_POST['fcity']) && $_POST['fcity'] != 'All') {$city=" and offerid in (select serial from offers where city ='".$_POST['fcity']."' )";}
	else {
		$city='';
	}
$query = "Select  *,
(select sum(cost) from visitcost where visitid in (select serial from maintenancedetails where maintenanceid=maintenances.serial and accepted=1)) as scost,
(select PE From offers where serial = maintenances.offerId) as pe ,
(select Projectname From offers where serial = maintenances.offerId) as projectname ,
(select status From offers where serial = maintenances.offerId) as projectstatus ,
(select Country From offers where serial = maintenances.offerId) as Country ,
(select City From offers where serial = maintenances.offerId) as City ,
(select company from customers where serial in (select customerid from offers where serial = maintenances.offerId)) as Client,
(select GW From offers where serial = maintenances.offerId) as GW,(select GWINT From offers where serial = maintenances.offerId) as GWINT ,
(select GWEXT From offers where serial = maintenances.offerId) as GWEXT ,(select GWarea From offers where serial = maintenances.offerId) as GWAREA ,
(select RG From offers where serial = maintenances.offerId) as RG ,(select RGarea From offers where serial = maintenances.offerId) as RGAREA ,
(select offerref From offers where serial = maintenances.offerId) as OfferRef,(select offervalue From offers where serial = maintenances.offerId) as OfferValue ,
(select remaining From offers where serial = maintenances.offerId) as Remaining ,(select kickoff From offers where serial = maintenances.offerId ) as KickOffDate,
(select count(serial) as cnt from maintenancedetails where accepted=1 and  maintenanceid = maintenances.serial) as VisitCount,
(select count(*) from maintenanceattachement where maintenanceid=maintenances.serial and isnew=0 and approved=1) as cntatt From maintenances where saved=0 $country $city $rg $gw $in $out order by order1 asc,(select projectname From offers where serial = maintenances.offerId ) asc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
                                    <tr class="odd gradeX" style="background-color:<?php if ($x["status"]=='canceled'){echo("salmon");} else if($x['status']=='active') echo "lightgreen"; else if($x['status']=='free maintenance period') echo "yellow"; ?>">                                   	
                                   <!--      <td><?php echo($x["pe"]);?></td>
										  <td><?php echo($x["Description"]);?></td> -->
										   <td><?php echo($x["projectname"]);?></td>
										   <td><?php echo($x["status"]);?></td>
										    <td><?php echo($x["Country"]);?></td>
											  <td><?php echo($x["City"]);?></td>
											    <td><?php echo($x["Client"]);?></td>
											  
												<td><?php if ($x["GW"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php if ($x["GWINT"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php if ($x["GWEXT"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php echo($x["GWAREA"]);?></td>
<td><?php if ($x["RG"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php echo($x["RGAREA"]);?></td>

												 
												  <?php if($_SESSION['hidevalues']==0){?>
												    <td><?php echo($x["OfferValue"]);?></td>
													 <td><?php echo($x["Valuee"]);?></td>
													 	 <td><?php echo(round($x["Valuee"]*100/$x["OfferValue"],2)."%");?></td>
													  <td><?php echo($x["invoiced"]-$x["Paid"]);?></td>





													  <?php }?>

                                                      
                                                      <td><a  href="view.php?x=<?php echo($x["Serial"]);?>"><?php echo round(($x["scost"]),2);?></a></td>
                                                        <td><?php echo  round((($x["scost"]*100)/$x["Valuee"]),2); ;?></td>
													    <td><?php echo($x["KickOffDate"]);?></td>
														 <td><?php echo($x["ExpDate"]);?></td>
														   <td><?php echo($x["Notes"]);?></td>
														   
 <td><a href="./attachments1.php?x=<?php echo($x["Serial"]);?>" ><?php echo($x["cntatt"]);?></a></td>
 <td><a  href="./readings.php?x=<?php echo($x["Serial"]);?>&y=<?php echo($x["projectname"]);?>&z=<?php echo($x["offerId"]);?>">Readings</a></td>
  
 <td><a  href="./visits.php?x=<?php echo($x["Serial"]);?>&y=<?php echo($x["projectname"]);?>&z=<?php echo($x["offerId"]);?>"><?php echo($x["VisitCount"]);?></a></td>

  <td><?php echo($x["OfferRef"]);?></td>

   
                                      <?php if($_SESSION['mce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['mcd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["Serial"]);?>"   <?php if($_SESSION['ocd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
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
            <div class="col-lg-12">
<div class="panel panel-default">
	<h3> &nbsp;Offer / Maintenance Values</h3>  
<div class="panel-body">
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <thead>
                                                <tr>
                                                	<th></th>
                                        <th>Offer</th>
                                       
                                        <th>Maintenance</th>
                                        <th>Maintenance %</th>
                                <th>Cost</th>
                                   <th>Cost %</th>

                                    </tr>
                                            </thead>
                     <tbody>
                        	
									 <tr class="odd gradeX">
                                    	
                                    <td >Totals</td>
                                    <td id="tdoffer"></td>
                                       <td id="tdmaintenance"></td>
                                        <td id="tdperc"></td>
                                         <td id="tdcost"></td>
                                          <td id="tdcostperc"></td>
                                       
                                      </tr>
									<tr class="odd gradeX">
                                    	
                                    <td >RG</td>
                                    <td id="tdrgoffer"></td>
                                       <td id="tdrgmaintenance"></td>
                                        <td id="tdrgperc"></td>
                                          <td id="tdrgcost"></td>
                                           <td id="tdrgcostperc"></td>
                                       
                                      </tr>
                                      <tr class="odd gradeX" style="background-color: lightgreen">
                                      	<td >Active RG</td>
                                         <td id="tdrgactiveo"></td>
                                         <td id="tdrgactivem"></td>
                                         <td id="tdrgactivep"></td>
                                          <td id="tdrgactivecost"></td>
                                           <td id="tdrgactivecostperc"></td>
                                        
                                        </tr>
                                     <tr class="odd gradeX" style="background-color: yellow">
                                      	<td >Free Maintenance Period RG</td>
                                         <td id="tdrgfreeo"></td>
                                         <td id="tdrgfreem"></td>
                                         <td id="tdrgfreep"></td>
                                          <td id="tdrgfreecost"></td>
                                           <td id="tdrgfreecostperc"></td>
                                        
                                        </tr>
                                         <tr class="odd gradeX" style="background-color: salmon">
                                      	<td >Cancelled RG</td>
                                         <td id="tdcrgo"></td>
                                         <td id="tdcrgm"></td>
                                         <td id="tdcrgp"></td>
                                          <td id="tdcrgcost"></td>
                                           <td id="tdcrgcostperc"></td>
                                        
                                        </tr>		
                                      <tr class="odd gradeX">
                                      	<td >GW</td>
                                         <td id="tdgwoffer"></td>
                                         <td id="tdgwmaintenance"></td>
                                         <td id="tdgwperc"></td>


                                         <td id="tdgwcost"></td>
                                         <td id="tdgwcostperc"></td>
                                        
                                        </tr>
                                         <tr class="odd gradeX" style="background-color: lightgreen">
                                      	<td >Active GW</td>
                                         <td id="tdgwactiveo"></td>
                                         <td id="tdgwactivem"></td>
                                         <td id="tdgwactivep"></td>

                                           <td id="tdgwactivecost"></td>
                                             <td id="tdgwactivecostperc"></td>
                                        
                                        </tr>
                                        <tr class="odd gradeX" class="odd gradeX" style="background-color: yellow">
                                      	<td >Free Maintenance Period GW</td>
                                         <td id="tdgwfreeo"></td>
                                         <td id="tdgwfreem"></td>
                                         <td id="tdgwfreep"></td>

                                           <td id="tdgwfreecost"></td>
                                             <td id="tdgwfreecostperc"></td>
                                        
                                        </tr>	
                                         <tr class="odd gradeX" class="odd gradeX" style="background-color: salmon">
                                      	<td >Cancelled GW</td>
                                         <td id="tdcgwo"></td>
                                         <td id="tdcgwm"></td>
                                         <td id="tdcgwp"></td>

                                          <td id="tdcgwcost"></td>
                                           <td id="tdcgwcostperc"></td>
                                        
                                        </tr>	
                                         <tr class="odd gradeX">
                                      	<td >Canceled</td>
                                         <td id="tdcoffer"></td>
                                         <td id="tdcmaintenance"></td>
                                         <td id="tdcperc"></td>

                                          <td id="tdcancelcost"></td>
                                           <td id="tdcancelcostperc"></td>
                                        
                                        </tr>
                                        		
                                       
											
                                        
                                         
                                      		
                                            </tbody>
                            </table>
</div>
</div>
</div>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

 <div class="col-lg-12">
<div class="panel panel-default">
    <h3> &nbsp;Offer / Zones</h3>  
<div class="panel-body">
    <div class='col-lg-6 nopadding'>
    <label id ="alert" style="visibility: hidden; color: red;">Please Save the Offer before adding Zones  !</label>
  </div>
      <div class='col-lg-6 nopadding' align="right">
    <button type="button" id="addzoness" class="btn btn-outline btn-primary" >Add Zones </button>
  </div>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                <thead>
 <tr>
                                            
                                        <th>Offer</th>
                                       
                                        <th>Date</th>
                                        <th>Description</th>
                                     <?php if($_SESSION['mce']==1 || $_SESSION['mcd']==1){?>      <th>Action</th> <?php }?>
                                   

                                    </tr>

                                                 
                                            </thead>
                     <tbody>
                             <?php            $query = "select *,(select ProjectName from offers where offers.serial=offerzones.offerid) as project from offerzones";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($y = mysqli_fetch_array($results)){?>
                                     <tr class="odd gradeX">
                                        
                                     <td><?php echo $y['project']; ?></td>
                                      <td><?php echo $y['dat']; ?></td>
                                       <td><?php echo $y['description']; ?></td>
                                       <?php if($_SESSION['mce']==1 || $_SESSION['mcd']==1){?> 
                <td class="center">
                                                                      <?php if($_SESSION['mce']==1){?>

<a href="#" id="Edittt_<?php echo($y["serial"]);?>"  data-toggle="modal" data-target="#myModala" ><p class="fa fa-edit"></p> </a>

<?php }  ?>
<?php if($_SESSION['mcd']==1){?>
<a href="#" id="delll1_<?php echo($y["serial"]);?>"   <?php if($_SESSION['mcd']!=1){ echo('disabled'); }?> data-toggle="modal" data-target="#myModala">&nbsp;&nbsp;<p class="fa fa-trash-o"></p> </a></td>
<?php } } ?>
                                      </tr>
                                   
                                    <?php } ?>
                                     
                                        
                                         
                                         
                                                
                                       
                                            
                                        
                                         
                                            
                                            </tbody>
                            </table>
</div>
</div>
</div>
<!-- //////////////////////////////////////////pending///////////////////////////////////-->


<!-- <div class="col-lg-12">
<div class="panel panel-default">
    <h3> Pending checkout</h3>  
<div class="panel-body">
    <div class='col-lg-6 nopadding'>
    
  </div>
      <div class='col-lg-6 nopadding' align="right">
   
  </div>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example4">
                                <thead>
 <tr>
                                            
                                        <th>Maintainance</th>
                                       
                                        <th>Date checkout</th>
                                        
                                     <?php if($_SESSION['mce']==1 || $_SESSION['mcd']==1){?>      <th>Action</th> <?php }?>
                                   

                                    </tr>

                                                 
                                            </thead>
                     <tbody>
  <?php     $query = "
select *,maintenances.serial as SERIAL,
(select serial from offers where serial=maintenances.offerId) as OFFERSERIAL,
(select ProjectName from offers where serial=maintenances.offerId) as Pname from  
maintenances,checkin,maintenancedetails 
where maintenancedetails.accepted=0 
 and checkin.checkout=1
 
and checkin.visit=maintenancedetails.Serial
and maintenances.Serial=maintenancedetails.maintenanceid


                             ";
//
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($y = mysqli_fetch_array($results)){?>
                                     <tr class="odd gradeX">
                                        
                                     <td><?php echo $y['Pname']; ?></td>
                                      <td><?php echo $y['checkoutdate']; ?></td>
                                      
                                       <?php if($_SESSION['mce']==1 || $_SESSION['mcd']==1){?> 
                <td class="center">
                                                                      <?php if($_SESSION['mce']==1){?>

<a href="pendingvisits.php?x=<?php echo($y["SERIAL"]);?>&z=<?php echo ($y["OFFERSERIAL"]); ?>"    ><p class="fa fa-edit"></p> </a>

<?php }  ?>
<?php if($_SESSION['mcd']==1){?>
<a href="#" id="dellll1_<?php echo($y["SERIAL"]);?>"   <?php if($_SESSION['mcd']!=1){ echo('disabled'); }?> data-toggle="modal"  >&nbsp;&nbsp; </p> </a></td>
<?php } 


} ?>
                                      </tr>
                                   
                                    <?php } ?>
                                     
                                        
                                         
                                         
                                                
                                       
                                            
                                        
                                         
                                            
                                            </tbody>
                            </table>
</div>
</div>
</div>




 -->

 <div class="modal fade" id="visitmodal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title222"></h4>
        </div>

        <div class="modal-body" align="center">   
   
  
 
  <label>Ec Clean Water</label>
  <input class="form-control" type="text"   name="descriptiona"  id="eccleanwater" style="width:100%;" >
  <label>Ec Fertelized Mix</label>
  <input class="form-control" type="text"   name="descriptiona"  id="ecfertelizedmix" style="width:100%;" >
    <label>PH</label>
  <input class="form-control" type="text"   name="descriptiona"  id="ph" style="width:100%;" >
<label>Pesticide Sprayed</label>
  <input class="form-control" type="text"   name="descriptiona"  id="pesticidesprayed" style="width:100%;" >
<label>Alarm Working</label>
  <input class="form-control" type="text"   name="descriptiona"  id="alarmworking" style="width:100%;" >
  <label>Injector</label>
  <input class="form-control" type="text"   name="descriptiona"  id="injector" style="width:100%;" >
  <label>Fertelized Mix</label>
  <input class="form-control" type="text"   name="descriptiona"  id="fertelizedmix" style="width:100%;" >
  <label>Work</label>
<select class="form-control" id="work" name= "work" style="width: 100%; " size="10" multiple="multiple">
            <?php
$query = "Select *  From pwork";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
        while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['SERIAL']); ?>" ><?php echo($x['Description']); ?></option>
 <?php 
}?>
</select>



        </div>
        <div class="modal-footer" >
    
          <label id ="alert1" style="visibility: hidden; color: red;">Please Fill Description!</label>
    <table align="center"  >
      
    <tr>
    <td>
  
        <button type="button" id="addddd"class="btn btn-outline btn-primary" >Save</button>
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
  <label>Maintenance</label>
  <select   class="form-control" id="maintenancezone"  >
                            <?php
                                $rt=date("Y-m-d");
include('../configdb.php');
$query = "select offerid,Description,ProjectName,offers.serial as SERIAL from offers,maintenances where   offers.Serial=maintenances.offerId and Cancelled=0";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
                          <option value="<?php echo($x['SERIAL']); ?>"><?php echo($x['ProjectName']); ?></option>
                          <?php } ?>
                        </select>
  <label>Date</label><input class="form-control" type="date" value='<?php echo  $rt; ?>'   name="dato"  id="dato" style="width:100%;" >
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





            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
   
 
    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript" src="../../Datatables/FixedHeader-3.1.3/js/datatables.fixedHeader.min.js"></script>
<script src="../../bower_components/dist/sweetalert2.all.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 <script src="../../vendor/fileupload/js/fileinput.js" type="text/javascript"></script>
 <script src="../../select2/dist/js/select2.js"></script>
<script src="../../select2/dist/js/i18n/it.js"></script>
<script src="../../select2/dist/js/i18n/nl.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <style>
    .modal-fullscreen .modal-dialog {
  margin: 0;
  width: 100%;
  animation-duration:0.6s;
}
</style>
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
		$('#dataTables-example2').DataTable({
		
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			dom: 'Blfrtip',	
					  responsive: true,
					  "aaSorting" : [],
						  "stateSave": true,
						  
				  });

 $('#dataTables-example3').DataTable({
            
             
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
		$('#dataTables-example2').DataTable({
		dom: 'Blfrtip',	
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					  responsive: true,
					  "aaSorting" : [],
						  "stateSave": true,
						  
				  });
    });
    </script>
    <?php }?>
        <script>
        $(document).ready(function() {
        $('#dataTables-example1').DataTable({
            responsive: true,
				
				"aaSorting" : [],
				"stateSave": true,
				
		});
	
         $("#project").select2();
	});

    </script>

	  <div name="myModal" class="modal fade modal-fullscreen" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog modal-lg" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="left">	
        	
			<table style="width: 100%;">
	<tr>
		<td><label id ="lblalert1" style="visibility: hidden; color: red;">Please add Client before you add the contacts !</label></td>
		<td align="right"><button  type="button" id="Adcontact" class="btn btn-outline btn-primary"  >Add Contact</button></td>
	</tr>
</table>
<br>

<table id="dataTables-example2"  width="100%" class="table table-striped table-bordered table-hover" >
	<thead>
		<th>Fullname</th>
		<th>Mobile</th>
		<th>Email</th>
		<th>Title</th>
		<th>Edit</th>
		<th>Delete</th>
		</thead>
		<tbody id="clientbody"></tbody>
</table>	
<br>
	<div class="row">
		<div class="col-lg-5 nopadding">
				 <?php	$query = "Select *,(select company from customers where serial  = offers.CustomerID) as Client  From offers order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
	Project / Client
	
	<select class="form-control" id="project" style="width: 100%; ">
		<?php
		while($x = mysqli_fetch_array($results)){?>
		<option value="<?php echo($x['Serial']); ?>" ><?php echo($x['ProjectName']." / ".$x['Client']); ?></option>
 <?php 
}?>
		</select>
		</div>
		<div class="col-lg-1 nopadding">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <button type="button" style="width: 100%" id="new"class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModall" >Add</button>
		</div>
		<div class="col-lg-3 nopadding">
			 Kick Off Date<input class="form-control" type="date"   name="kickoffdate"  id="kickoffdate"  >
		</div>
		<div class="col-lg-3 nopadding">
			Expiry Date<input class="form-control" type="date"   name="expirydate"  id="expirydate"  >
		</div>
</div>
   	  
				
		<div style="display:none; visibility:hidden;">
		<select class="form-control" id="kickoff" style="width: 100%; " style="display:none; visibility:hidden;">
			<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['kickoff']); ?></option>
 <?php 
}?>
</select>
</div>


<div class="row">
	
<div <?php if($_SESSION['hidevalues']==1){?> style="display:none;" <?php }?> class="col-lg-3 nopadding" >
			Value<input class="form-control" type="number"   name="value"  id="value"  >
		</div>
		<div class="col-lg-3 nopadding" <?php if($_SESSION['hidevalues']==1){?> style="display:none;" <?php }?> >
			Invoiced<input class="form-control" type="number"   name="invoiced"  id="invoiced"  >
		</div>
<div class="col-lg-3 nopadding" <?php if($_SESSION['hidevalues']==1){?> style="display:none;" <?php }?> >
			Paid<input class="form-control" type="number"   name="paid"  id="paid"  >
		</div>
		
		<div class="col-lg-4 nopadding" <?php if($_SESSION['hidevalues']==1){?> style="display:none;" <?php }?> >
			Remaining<input class="form-control" type="number"   name="remaining"  id="remaining" readonly>
		</div>
		<div class="col-lg-3 nopadding">
			Preferred Hours<input class="form-control" type="text"   name="phours"  id="phours"  >
		</div>
		<div class="col-lg-3 nopadding">
			Average time spent on site <input class="form-control" type="text"   name="average"  id="average"  >
		</div>
		</div>
		<div class="row">
			
		
<div class="col-lg-4 nopadding">
			Description<input class="form-control" type="text"   name="description"  id="description"  >
		</div>
<div class="col-lg-4 nopadding">
			Allowed Visits<input class="form-control" type="text"   name="visits"  id="visits"  >
		</div>

			 <div class="col-lg-4 nopadding">
			 	Status
			 	<select class="form-control" id="mstatus" style="width: 100%; ">
	 
	 <option value="canceled">canceled</option>
	 <option value="active">active</option>
	 <option value="free maintenance period">free maintenance period</option>
		</select>
                               </div>
		</div>
		<div class="row">
<div class="col-lg-12 nopadding">
Notes<textarea class="form-control" id="notes" size="3" style="width: 100%; "></textarea>
    </div>
</div>
<br>
<div class="row">
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
			</div>
			<div class="row">
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
			</div>
			<br>
<div class="row" id="taskattdiv">
	<div class="col-lg-6 nopadding" align="center">
		<label>WIP</label>
 		 <div class="file-loading">
            <input id="images" name="images[]" type="file" multiple>
        </div>
    </div>
    <div class="col-lg-6 nopadding" align="center">
    	<label>Prices & Correspondance</label>
 		 <div class="file-loading">
            <input id="images1" name="images[]" type="file" multiple>
        </div>
    </div>
</div>
<div class='col-lg-6 nopadding'>
		<label id ="lblalert2" style="visibility: hidden; color: red;">Please Save the Maintenance before adding Follow Up !</label>
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
			<br>

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

  	    <div class="modal fade" id="myModall" role="dialog">
    <div class="modal-dialog" >
   
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
		
		<div class="col-lg-4 nopadding">
				
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
	<div class="col-lg-1 nopadding">
			</div>
		<div class="col-lg-4 nopadding">
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

<div class="col-lg-4 nopadding">
				
	
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
		<div class="col-lg-1 nopadding">
			</div>
		<div class="col-lg-4 nopadding">
				
	
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
<div class="col-lg-4 nopadding">
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
		<div class="col-lg-1 nopadding">
			</div>
		<div class="col-lg-4 nopadding">
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
		<div class="col-lg-4 nopadding">
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
		<div class="col-lg-1 nopadding">
			</div>
		<div class="col-lg-4 nopadding">
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
		<table width="100%">
			<tr >
		<td colspan="2" >Refferal Notes<textarea class="form-control" id="refferaln" size="3" style="width: 100%; "></textarea></td>
		</tr><tr>
			<td colspan=2"">Expected Date of Project Kick-Off<input class="form-control" type="date"   name="kdate"  id="kdate"  ></td>
			 <td style="display: none;">&nbsp;<div class="checkbox">
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
			 <tr>
			 <td colspan="2">
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
			 </tr>
			 </tr>
			 	 <tr>

		

			  <td width="50%">
			  <?php if($_SESSION['hidevalues']!=1){?>
			  	 Value
			  <?php } ?>
			<input class="form-control" type="text"   name="offervalue"  id="offervalue"  <?php if($_SESSION['hidevalues']==1){?> style=" display:none; visibility:hidden;"    <?php } ?> >
			 </td>
			   <td width="50%">
			  	 Remaining
			<input class="form-control" type="text"   name="offerremaining"  id="offerremaining"  >
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
							
							   </tr>
							 
							  </table>
							
		
      </div>
        <div class="modal-footer" >
			
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Project Name !</label>
		<table align="center"  >
			
		<tr>
		
			<td width="10">
		</td>
	
			<td width="10">
		</td>
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
   <div class="modal fade" id="myModal1" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title1"></h4>
        </div>

        <div class="modal-body" align="left">		

Full Name<input class="form-control" type="text"   name="fname"  id="fname" style="width:100%;" required>
	
	Mobile<input class="form-control" type="text"   name="mobile1"  id="mobile1" style="width:100%;" >
Title <input class="form-control" type="text"   name="titlee"  id="titlee" style="width:100%;" >
Email<input class="form-control" type="text"   name="email"  id="email" style="width:100%;" >

 <!--<input type="checkbox" id="admin"  name="Admin" value="admin"> Admin -->

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert2" style="visibility: hidden; color: red;">First Name must be filled !</label>
		<table align="right"  >
			
		<tr>
			<td>
	
        <button type="button" id="add3"class="btn btn-block btn-primary" >Save</button>
		</td>
		<td width="10">
		</td>
		<td>
          <button type="button" id="exit1"class="btn btn-block btn-primary" data-dismiss="modal">Exit</button>
          </td>
		</tr>
		</table>
		
        </div>
	
      </div>
    
    </div>
  </div>
 </div> 
<script src="../../js/maintenances.js"></script>
</body>

</html>
 