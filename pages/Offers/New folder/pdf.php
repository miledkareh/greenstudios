<?php
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
include('../configdb.php');	
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

$html=' <table width="100%" style="font-size: 50%;">
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
									
                                    
                                    </tr>
                                </thead>
                                <tbody>';
								while($x = mysqli_fetch_array($results)){
									$color="";
									if ($x["WIP"]==1 && $x["ls"]==0){$color="Yellow";}
									elseif ($x["WIP"]==1 && $x["ls"]==1){$color="Orange";}
									elseif ( $x["Inhand"]==1){$color="LightBlue";}
									elseif ($x["potential"]==1){$color="LightGreen";}
									elseif ($x["hp"]==1 && $x["Offer"]==1){$color="Green";}
									elseif ( $x["Offer"]==0){$color="Salmon";}
									elseif ($x["completed"]==1){$color="Violet";}
									elseif ($x["Canceled"]==1){$color="Red";}
								$html=$html.'<tr class="odd gradeX"  style="background-color:'.$color.'"><td>';
								$html=$html.$x["pe"].'</td><td>'.$x["ProjectName"].'</td><td> ';
								$html=$html.$x["Country"].'</td><td>'.$x["city"].'</td><td> ';
									$html=$html.$x["Client"].'</td><td>'.$x["Referral"].'</td><td> ';
										$html=$html.$x["GW"].'</td><td>'.$x["GWINT"].'</td><td> ';
											$html=$html.$x["GWEXT"].'</td><td>'.$x["GWAREA"].'</td><td> ';
$html=$html.$x["RG"].'</td><td>'.$x["RGAREA"].'</td><td> ';
$html=$html.$x["Offer"].'</td><td>'.$x["hp"].'</td><td> ';
	$html=$html.$x["OfferRef"].'</td><td>'.$x["OfferValue"].'</td> ';
														//	$html=$html.$x["remaining"].'</td><td>'.$x["OfferSigned"].'</td> ';
														
															
								$html=$html.'</tr>';
								}
                              $html=$html.  '</tbody>
                            </table>';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A2', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("codex",array("Attachment"=>0));
?>