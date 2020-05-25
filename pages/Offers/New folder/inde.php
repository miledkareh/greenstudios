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
								if($_SESSION['ocv']!=1){
									header("Location: ../Blank");
								}

  ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 50%;">
                                <thead>
                                    <tr>
									<th>PE</th>
                                      <th>Project Name </th>
                                      <th>Country</th>
									  <th>City</th>
									  <th>Client</th>
									  <th>Refferal</th>
									  <th>GW</th>
									  <th>INT</th>
									  <th>EXT</th>
									  <th>GW Area</th>
									  <th>RG</th>
									  <th>RG Area</th>
									  <th>Offer</th>
									  <th>HP</th>
									  <th>Offer Ref#</th>
									  <th>Offer value</th>
									  <th>Remaining</th>
									  <th>Signed</th>
									  <th>Signed Date</th>
									   <th>Canceled</th>
									  <th>Status</th>
									  <th>Status Date</th>
									  <th>Kick Off Date</th>
									  <th>Due Date</th>
									  <th>Attach</th>
									  <th>Build-UP</th>
									  <th>Completed</th>
									  <th>Notes</th>
									   <?php if($_SESSION['ocd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
										include('../configdb.php');		

$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$query ="select *,(select company from customers where serial = offers.customerid) as Client,(select company from customers where serial = offers.referral) as Referral,(select username from users where serial=offers.lastuser) as LastUser,lastupdated,(select count(*) from offerattachment where offerid=offers.serial) as cnt,(select description from offerattachment where offerid=offers.serial and main=1) as Imagee from offers where manuel=0 ";
 if($fromdate!=''){ $query =$query." and dat>='$fromdate'"; }
  if($todate!=''){ $query =$query." and dat<='$todate'"; }
  if($_SESSION['filter']==3){$query =$query." and serial in (".$_SESSION['datafilter'].")";}
    if($_SESSION['filter']==2){
		$countries=$_SESSION['datafilter'];
		$countries= str_replace(",", "','", $countries);
		$query =$query." and country in ('".$countries."')";}
 $query =$query." Order by order1,order2 desc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());

while($x = mysqli_fetch_array($results)){
?>
                                    <tr class="odd gradeX"  style="background-color:<?php
									if ($x["WIP"]==1 && $x["ls"]==0){echo("Yellow");}
									elseif ($x["WIP"]==1 && $x["ls"]==1){echo("Orange");}
									elseif ( $x["Inhand"]==1){echo("LightBlue");}
									elseif ($x["potential"]==1){echo("LightGreen");}
									elseif ($x["hp"]==1 && $x["Offer"]==1){echo("Green");}
									elseif ( $x["Offer"]==0){echo("Salmon");}
									elseif ($x["completed"]==1){echo("Violet");}
									elseif ($x["Canceled"]==1){echo("Red");}
									
												
?>">
<td><?php if($x["dealer"]==1){ ?> <span class="fa fa-star" style="color:yellow;"></span> <?php }?> <?php echo($x["pe"]);?></td>   
       <?php if($_SESSION['oce']==1){?>
<td class="center"><span  data-toggle="tooltip" data-placement="top" title="<?php echo("LastUser : ".$x["LastUser"]);?><?php echo("  LastUpdated : ".$x["LastUpdated"]);?>">
<a  id="Edit_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal" style="color:black;" > <?php echo($x["ProjectName"]);?></a></span>
</td>
<?php } else{ ?>                         	
<td><?php echo($x["ProjectName"]);?></td>
<?php } ?>
<td><a  id="Img_<?php echo($x["Serial"]."/".$x["Imagee"]);?>"  data-toggle="modal" data-target="#ImageModal" style="color:black;" > <?php echo($x["Country"]);?></a></td>
<td><?php echo($x["city"]);?></td>
<td><?php echo($x["Client"]);?></td>
<td><?php echo($x["Referral"]);?></td>
<td><?php if ($x["GW"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php if ($x["GWINT"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php if ($x["GWEXT"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php echo($x["GWAREA"]);?></td>
<td><?php if ($x["RG"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php echo($x["RGAREA"]);?></td>
<td><?php if ($x["Offer"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php if ($x["hp"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php echo($x["OfferRef"]);?></td>
<td><?php echo($x["OfferValue"]);?></td>
<td><?php echo($x["remaining"]);?></td>
<td><?php if ($x["OfferSigned"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php if ($x["OfferSigned"]==1){ if($x["OfferSignedDate"]!="0000-00-00"){echo($x["OfferSignedDate"]);}}?></td>
<td><?php if ($x["Canceled"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php if ($x["Canceled"]==1){echo("CANCELED");}
elseif ($x["completed"]==1){echo("COMPLETED");}
elseif ($x["potential"]==1){echo("POTENTIAL");}
elseif ($x["hp"]==1 && $x["Offer"]==1){echo("HIGH PROBABILITY");}
elseif ( $x["Offer"]==1){echo("OFFER");}
elseif ( $x["Inhand"]==1){echo("IN HAND");}
elseif ( $x["WIP"]==1){echo("WIP");}
elseif ( $x["Offer"]==0){echo("INQUIRIES");}
?></td>
<td><?php if ( $x["Offer"]==1){if($x["OfferDate"]!="0000-00-00"){echo($x["OfferDate"]);}} else{ if($x["duedate"]!="0000-00-00"){echo($x["duedate"]);} }?></td>
<td><?php if($x["kickoff"]!="0000-00-00"){ echo($x["kickoff"]);}?></td>
<td><?php if($x["duedate"]!="0000-00-00"){echo($x["duedate"]);} ?></td>
<td> <a  href ="attachments.php?x=<?php echo($x["Serial"]);?>" target="_blank"  ><?php echo($x["cnt"]);?> </a></td>
<td><?php echo($x["buildup"]);?></td>
<td ><?php if ($x["completed"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php echo($x["notes"]);?></td>
<?php if($_SESSION['ocd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["Serial"]);?>"   <?php if($_SESSION['ocd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php }  ?>
                                    </tr>
									<?php 
}?>
                                </tbody>
                            </table>
                           
                 
                   
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
 

</body>

</html>
