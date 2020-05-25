<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<div class="container" style="padding:20px;20px;">
      <div class="">
	   <button id="btnExport">Export to xls</button>
        <div class="">
		<table id="dataTables-example" align="center" width="100%" cellspacing="0" border="1" >
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
									 
                                    </tr>
                                </thead>
                                <tbody>

								<?php
										include('../configdb.php');		

$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
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
<td><?php if ($x["GW"]!=1) {echo('N');} else {echo('Y');} ?> </td>
<td><?php if ($x["GWINT"]!=1) {echo('N');} else {echo('Y');} ?></td>
<td><?php if ($x["GWEXT"]!=1) {echo('N');} else {echo('Y');} ?></td>
<td><?php echo($x["GWAREA"]);?></td>
<td><?php if ($x["RG"]!=1) {echo('N');} else {echo('Y');} ?> </td>
<td><?php echo($x["RGAREA"]);?></td>
<td><?php if ($x["Offer"]!=1) {echo('N');} else {echo('Y');} ?> </td>
<td><?php if ($x["hp"]!=1) {echo('N');} else {echo('Y');} ?></td>
<td><?php echo($x["OfferRef"]);?></td>
<td><?php echo($x["OfferValue"]);?></td>
<td><?php echo($x["remaining"]);?></td>
<td><?php if ($x["OfferSigned"]!=1) {echo('N');} else {echo('Y');} ?></td>
<td><?php if ($x["OfferSigned"]==1){ if($x["OfferSignedDate"]!="0000-00-00"){echo($x["OfferSignedDate"]);}}?></td>
<td><?php if ($x["Canceled"]!=1) {echo('N');} else {echo('Y');} ?></td>
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
<td> <?php echo($x["cnt"]);?></td>
<td><?php echo($x["buildup"]);?></td>
<td ><?php if ($x["completed"]!=1) {echo('N');} else {echo('Y');} ?></td>
<td><?php echo($x["notes"]);?></td>
                                    </tr>
									<?php 
}?>
                                </tbody>
                            </table>
    </div>
      </div>

    </div>

<script src="../../js/offersexcel.js"></script>
