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
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' ".$country." and manuel=0) as sInHandBudget,
				(select sum(OfferValue) from offers where (status='OFFER' or status='INQUIRIES') ".$country." and manuel=0) as sOFFERBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' ".$country." and manuel=0) as sCancelledBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' ".$country." and manuel=0) as sCompletedBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 ".$country." and manuel=0) as sHPBudget,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1 ".$country." and manuel=0) as sBusinessD,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 ".$country." and manuel=0) as sAgent  
				
				from offers where manuel=0";
				
	}
else
	{
			$sql="select 
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sOFFERVALUEm1,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sInHandBudgetm1,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sOFFERBudgetm1,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sCancelledBudgetm1,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sCompletedBudgetm1,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sHPBudget1,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1 and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sBusinessD1,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sAgentm1,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sOFFERVALUEm2,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sInHandBudgetm2,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='2' and year(Dat) = '$year'".$country.") as sOFFERBudgetm2,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sCancelledBudgetm2,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sCompletedBudgetm2,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 and manuel=0  and month(Dat)='2' and year(Dat) = '$year'".$country.") as sHPBudget2,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1 and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sBusinessD2,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sAgentm2,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sOFFERVALUEm3,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sInHandBudgetm3,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER'  and manuel=0  and month(Dat)='3' and year(Dat) = '$year'".$country.") as sOFFERBudgetm3,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sCancelledBudgetm3,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sCompletedBudgetm3,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sHPBudget3,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1 and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sBusinessD3,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sAgentm3,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sOFFERVALUEm4,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sInHandBudgetm4,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='4' and year(Dat) = '$year'".$country.") as sOFFERBudgetm4,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='4' and year(Dat) = '$year'".$country.") as sCancelledBudgetm4,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sCompletedBudgetm4,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sHPBudget4,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1 and manuel=0  and month(Dat)='4' and year(Dat) = '$year'".$country.") as sBusinessD4,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sAgentm4,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sOFFERVALUEm5,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sInHandBudgetm5,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sOFFERBudgetm5,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sCancelledBudgetm5,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sCompletedBudgetm5,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='5' and year(Dat) = '$year'".$country.") as sHPBudget5,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='5' and year(Dat) = '$year'".$country.") as sBusinessD5,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='5' and year(Dat) = '$year'".$country.") as sAgentm5,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sOFFERVALUEm6,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND'  and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sInHandBudgetm6,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER'  and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sOFFERBudgetm6,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sCancelledBudgetm6,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sCompletedBudgetm6,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sHPBudget6,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sBusinessD6,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sAgentm6,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sOFFERVALUEm7,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND'  and manuel=0 and month(Dat)='7' and year(Dat) = '$year'".$country.") as sInHandBudgetm7,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sOFFERBudgetm7,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sCancelledBudgetm7,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sCompletedBudgetm7,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='7' and year(Dat) = '$year'".$country.") as sHPBudget7,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='7' and year(Dat) = '$year'".$country.") as sBusinessD7,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and month(Dat)='7'  and manuel=0 and year(Dat) = '$year'".$country.") as sAgentm7,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='8' and year(Dat) = '$year'".$country.") as sOFFERVALUEm8,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='8' and year(Dat) = '$year'".$country.") as sInHandBudgetm8,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='8' and year(Dat) = '$year'".$country.") as sOFFERBudgetm8,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sCancelledBudgetm8,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sCompletedBudgetm8,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sHPBudget8,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sBusinessD8,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sAgentm8,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='9' and year(Dat) = '$year'".$country.") as sOFFERVALUEm9,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND'  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sInHandBudgetm9,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='9' and year(Dat) = '$year'".$country.") as sOFFERBudgetm9,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sCancelledBudgetm9,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sCompletedBudgetm9,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1   and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sHPBudget9,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sBusinessD9,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sAgentm9,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL')  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sOFFERVALUEm10,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='10' and year(Dat) = '$year'".$country.") as sInHandBudgetm10,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER'  and manuel=0  and month(Dat)='10' and year(Dat) = '$year'".$country.") as sOFFERBudgetm10,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sCancelledBudgetm10,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='10' and year(Dat) = '$year'".$country.") as sCompletedBudgetm10,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sHPBudget10,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sBusinessD10,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sAgentm10,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sOFFERVALUEm11,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sInHandBudgetm11,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sOFFERBudgetm11,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='11' and year(Dat) = '$year'".$country.") as sCancelledBudgetm11,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sCompletedBudgetm11,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='11' and year(Dat) = '$year'".$country.") as sHPBudget11,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1 and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sBusinessD11,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sAgentm11,
				
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL')  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sOFFERVALUEm12,
				(select COALESCE(sum(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='12' and year(Dat) = '$year'".$country.") as sInHandBudgetm12,
				(select COALESCE(sum(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='12' and year(Dat) = '$year'".$country.") as sOFFERBudgetm12,
				(select COALESCE(sum(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sCancelledBudgetm12,
				(select COALESCE(sum(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sCompletedBudgetm12, 
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1   and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sHPBudget12,
				(select COALESCE(sum(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sBusinessD12,
				(select COALESCE(sum(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0  and month(Dat)='12' and year(Dat) = '$year'".$country.") as sAgentm12 
				from offers WHERE year(Dat) = '$year'".$country." and manuel = 0 Limit 1";
				
}}
else
{
	if($year=="All"){
		$sql="select 
		(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' ".$country." and manuel=0) as sInHandBudget,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' ".$country." and manuel=0) as sOFFERBudget,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' ".$country." and manuel=0) as sCancelledBudget,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' ".$country." and manuel=0) as sCompletedBudget,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1".$country."  and manuel=0) as sHPBudget,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1 ".$country." and manuel=0) as sBusinessD,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 ".$country." and manuel=0) as sAgent,
				Dat 
				from offers where manuel = 0";
			
	}
else
	{
	$sql="select 
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sOFFERVALUEm1,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sInHandBudgetm1,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER'  and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sOFFERBudgetm1,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sCancelledBudgetm1,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sCompletedBudgetm1,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sHPBudget1,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1 and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sBusinessD1,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0 and month(Dat)='1' and year(Dat) = '$year'".$country.") as sAgentm1,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sOFFERVALUEm2,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sInHandBudgetm2,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER'  and manuel=0  and month(Dat)='2' and year(Dat) = '$year'".$country.") as sOFFERBudgetm2,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sCancelledBudgetm2,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sCompletedBudgetm2,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0  and month(Dat)='2' and year(Dat) = '$year'".$country.") as sHPBudget2,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1 and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sBusinessD2,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0 and month(Dat)='2' and year(Dat) = '$year'".$country.") as sAgentm2,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sOFFERVALUEm3,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sInHandBudgetm3,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER'  and manuel=0  and month(Dat)='3' and year(Dat) = '$year'".$country.") as sOFFERBudgetm3,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sCancelledBudgetm3,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sCompletedBudgetm3,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1   and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sHPBudget3,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1 and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sBusinessD3,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0 and month(Dat)='3' and year(Dat) = '$year'".$country.") as sAgentm3,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sOFFERVALUEm4,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sInHandBudgetm4,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='4' and year(Dat) = '$year'".$country.") as sOFFERBudgetm4,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='4' and year(Dat) = '$year'".$country.") as sCancelledBudgetm4,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sCompletedBudgetm4,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1   and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sHPBudget4,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1 and manuel=0  and month(Dat)='4' and year(Dat) = '$year'".$country.") as sBusinessD4,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='4' and year(Dat) = '$year'".$country.") as sAgentm4,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL')and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sOFFERVALUEm5,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sInHandBudgetm5,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER'  and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sOFFERBudgetm5,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sCancelledBudgetm5,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='5' and year(Dat) = '$year'".$country.") as sCompletedBudgetm5,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1   and manuel=0 and month(Dat)='5' and year(Dat) = '$year'".$country.") as sHPBudget5,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='5' and year(Dat) = '$year'".$country.") as sBusinessD5,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='5' and year(Dat) = '$year'".$country.") as sAgentm5,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sOFFERVALUEm6,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND'  and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sInHandBudgetm6,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER'  and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sOFFERBudgetm6,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sCancelledBudgetm6,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='6' and year(Dat) = '$year'".$country.") as sCompletedBudgetm6,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sHPBudget6,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sBusinessD6,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='6' and year(Dat) = '$year'".$country.") as sAgentm6,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sOFFERVALUEm7,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND'  and manuel=0 and month(Dat)='7' and year(Dat) = '$year'".$country.") as sInHandBudgetm7,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sOFFERBudgetm7,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sCancelledBudgetm7,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='7' and year(Dat) = '$year'".$country.") as sCompletedBudgetm7,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='7' and year(Dat) = '$year'".$country.") as sHPBudget7,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='7' and year(Dat) = '$year'".$country.") as sBusinessD7,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and month(Dat)='7'  and manuel=0 and year(Dat) = '$year'".$country.") as sAgentm7,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='8' and year(Dat) = '$year'".$country.") as sOFFERVALUEm8,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='8' and year(Dat) = '$year'".$country.") as sInHandBudgetm8,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='8' and year(Dat) = '$year'".$country.") as sOFFERBudgetm8,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sCancelledBudgetm8,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sCompletedBudgetm8,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sHPBudget8,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sBusinessD8,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='8' and year(Dat) = '$year'".$country.") as sAgentm8,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='9' and year(Dat) = '$year'".$country.") as sOFFERVALUEm9,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND'  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sInHandBudgetm9,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='9' and year(Dat) = '$year'".$country.") as sOFFERBudgetm9,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED' and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sCancelledBudgetm9,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sCompletedBudgetm9,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sHPBudget9,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sBusinessD9,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='9' and year(Dat) = '$year'".$country.") as sAgentm9,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL')  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sOFFERVALUEm10,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='10' and year(Dat) = '$year'".$country.") as sInHandBudgetm10,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='10' and year(Dat) = '$year'".$country.") as sOFFERBudgetm10,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sCancelledBudgetm10,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='10' and year(Dat) = '$year'".$country.") as sCompletedBudgetm10,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sHPBudget10,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sBusinessD10,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1  and manuel=0 and month(Dat)='10' and year(Dat) = '$year'".$country.") as sAgentm10,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sOFFERVALUEm11,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sInHandBudgetm11,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sOFFERBudgetm11,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='11' and year(Dat) = '$year'".$country.") as sCancelledBudgetm11,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED' and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sCompletedBudgetm11,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1 and manuel=0 and month(Dat)='11' and year(Dat) = '$year'".$country.") as sHPBudget11,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1 and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sBusinessD11,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0  and month(Dat)='11' and year(Dat) = '$year'".$country.") as sAgentm11,
				
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL')  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sOFFERVALUEm12,
				(select COALESCE(count(OfferValue), 0) from offers where status='IN HAND' and manuel=0  and month(Dat)='12' and year(Dat) = '$year'".$country.") as sInHandBudgetm12,
				(select COALESCE(count(OfferValue), 0) from offers where status='OFFER' and manuel=0  and month(Dat)='12' and year(Dat) = '$year'".$country.") as sOFFERBudgetm12,
				(select COALESCE(count(OfferValue), 0) from offers where status='CANCELED'  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sCancelledBudgetm12,
				(select COALESCE(count(OfferValue), 0) from offers where status='COMPLETED'  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sCompletedBudgetm12, 
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and hp=1  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sHPBudget12,
				(select COALESCE(count(OfferValue), 0) from offers where bd=1  and manuel=0 and month(Dat)='12' and year(Dat) = '$year'".$country.") as sBusinessD12,
				(select COALESCE(count(OfferValue), 0) from offers where (status ='IN HAND' or status = 'OFFER' or status = 'INQUIRIES' or status = 'POTENTIAL') and dealer=1 and manuel=0  and month(Dat)='12' and year(Dat) = '$year'".$country.") as sAgentm12 
				from offers WHERE year(Dat) = '$year'".$country." and manuel = 0 Limit 1";
					
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