<?php
header('Access-Control-Allow-Origin: *');
require_once('DAL.class.php');
$action=$_GET["action"];
$year=$_GET["year"];
$country="";
if(isset($_GET["country"]) && $_GET["country"]!='All')
$country=" and Country='".$_GET["country"]."'";
if($action==1){
	if($year=="All"){
		$sql="select 
				
				(select sum(OfferValue) from offers where status='IN HAND' ".$country." and manuel=0) as sInHandBudget,
				(select sum(OfferValue) from offers where (status='OFFER' or status='INQUIRIES') ".$country." and manuel=0) as sOFFERBudget,
				(select sum(OfferValue) from offers where status='CANCELED' ".$country." and manuel=0) as sCancelledBudget,
				(select sum(OfferValue) from offers where status='COMPLETED' ".$country." and manuel=0) as sCompletedBudget,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 ".$country." and manuel=0) as sHPBudget,
				(select sum(OfferValue) from offers where bd=1 ".$country." and manuel=0) as sBusinessD,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 ".$country." and manuel=0) as sAgent  
				
				from offers where manuel=0";
				
	}
	else {
		$sql="select 
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and year(Dat) = '$year' ".$country." and manuel=0) as sOFFERVALUE,
				(select sum(OfferValue) from offers where status='IN HAND' and year(Dat) = '$year' ".$country." and manuel=0) as sInHandBudget,
				(select sum(OfferValue) from offers where status='OFFER' and year(Dat) = '$year' ".$country."  and manuel=0) as sOFFERBudget,
				(select sum(OfferValue) from offers where status='CANCELED' and year(Dat) = '$year' ".$country." and manuel=0) as sCancelledBudget,
				(select sum(OfferValue) from offers where status='COMPLETED' and year(Dat) = '$year' ".$country." and manuel=0) as sCompletedBudget,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 and year(Dat) = '$year' ".$country."  and manuel=0) as sHPBudget,
				(select sum(OfferValue) from offers where bd=1 and year(Dat) = '$year' ".$country." and manuel=0) as sBusinessD,
				(select sum(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and year(Dat) = '$year' ".$country." and manuel=0) as sAgent,
				Dat 
				from offers WHERE year(Dat) = '$year' ".$country."";
}}
else{
	if($year=="All"){
		$sql="select 
				(select count(OfferValue) from offers where status='IN HAND' ".$country." and manuel=0) as sInHandBudget,
				(select count(OfferValue) from offers where status='OFFER' ".$country." and manuel=0) as sOFFERBudget,
				(select count(OfferValue) from offers where status='CANCELED' ".$country." and manuel=0) as sCancelledBudget,
				(select count(OfferValue) from offers where status='COMPLETED' ".$country." and manuel=0) as sCompletedBudget,
				(select count(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 ".$country." and manuel=0) as sHPBudget,
				(select count(OfferValue) from offers where bd=1 ".$country.") as sBusinessD,
				(select count(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 ".$country.") as sAgent 
				from offers";
				
	}
	else {
	$sql="select 
				(select count(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and year(Dat) = '$year' ".$country." and manuel=0) as sOFFERVALUE,
				(select count(OfferValue) from offers where status='IN HAND' and year(Dat) = '$year' ".$country." and manuel=0) as sInHandBudget,
				(select count(OfferValue) from offers where status='OFFER' and year(Dat) = '$year' ".$country." and manuel=0) as sOFFERBudget,
				(select count(OfferValue) from offers where status='CANCELED' and year(Dat) = '$year' ".$country." and manuel=0) as sCancelledBudget,
				(select count(OfferValue) from offers where status='COMPLETED' and year(Dat) = '$year' ".$country." and manuel=0) as sCompletedBudget,
				(select count(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 and year(Dat) = '$year' ".$country." and manuel=0) as sHPBudget,
				(select count(OfferValue) from offers where bd=1 and year(Dat) = '$year' ".$country." and manuel=0) as sBusinessD,
				(select count(OfferValue) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and year(Dat) = '$year' ".$country." and manuel=0) as sAgent,
				Dat 
				from offers WHERE year(Dat) = '$year' ".$country."";
}}
	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>