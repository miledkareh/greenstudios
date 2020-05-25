<?php
header('Access-Control-Allow-Origin: *');
require_once('DAL.class.php');
$action=$_GET["action"];
$fromdate=$_GET["fromdate"];
$todate=$_GET["todate"];
$country="";
if(isset($_GET["country"]) && $_GET["country"]!='All')
$country=" and Country='".$_GET["country"]."'";
if($action==1){

		$sql="select 
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sInHandBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sOFFERBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sCancelledBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sCompletedBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sHPBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1 ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sBusinessD,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sAgent  
				
				from offers where manuel=0 and dat >= '$fromdate' and dat <= '$todate'";
}
else
{
	
		$sql="select 
		(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sInHandBudget,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sOFFERBudget,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sCancelledBudget,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sCompletedBudget,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1".$country."  and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sHPBudget,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1 ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sBusinessD,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 ".$country." and manuel=0 and dat >= '$fromdate' and dat <= '$todate') as sAgent,
				Dat 
				from offers and manuel = 0 and dat >= '$fromdate' and dat <= '$todate'";
				
	}

	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>