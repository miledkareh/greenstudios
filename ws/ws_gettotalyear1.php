<?php
header('Access-Control-Allow-Origin: *');
require_once('DAL.class.php');
$action=$_GET["action"];
$year=$_GET["year"];
$currency=$_GET['currency'];
$country="";
if(isset($_GET["country"]) && $_GET["country"]!='All')
$country=" and Country='".$_GET["country"]."'";
include('../pages/configdb.php');
$query = "Select *  From status Limit 10";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	
if($action==1){
	
if($year=="All"){
			$sql="select ";
	
$i=1;
		while($x = mysqli_fetch_array($results)){
			$sql=$sql."(select sum(amount) from offervalues where offerid in (select serial from offers where status=".$x['serial']." ".$country.")and currency=$currency) as s".$i.",
			(select description from status where serial=".$x['serial'].")as statusN".$i.", 
			(select color from status where serial=".$x['serial'].")as statusC".$i.",";
			
		$i++;
		}
			$sql=$sql."	".$i." as i    
				from offervalues Limit 1";
				
	}
	else {
		$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		$sql="select ";
	
$i=1;
		while($x = mysqli_fetch_array($results)){
			$sql=$sql."(select sum(amount) from offervalues where offerid in (select serial from offers where status=".$x['serial']." and year(Dat)='$year' ".$country.")and currency=$currency) as s".$i.",
			(select description from status where serial=".$x['serial'].")as statusN".$i.", 
			(select color from status where serial=".$x['serial'].")as statusC".$i.",";
			
		$i++;
		}
			$sql=$sql."	".$i." as i    
				from offervalues where offerid in (select serial from offers where year(Dat)='$year'".$country.") Limit 1";
}}
else{
	if($year=="All"){
		$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
					$sql="select ";
	
$i=1;
		while($x = mysqli_fetch_array($results)){
			$sql=$sql."(select count(amount) from offervalues where offerid in (select serial from offers where status=".$x['serial']." ".$country.")and currency=$currency) as s".$i.",
			(select description from status where serial=".$x['serial'].")as statusN".$i.", 
			(select color from status where serial=".$x['serial'].")as statusC".$i.",";
			
		$i++;
		}
			$sql=$sql."	".$i." as i    
				from offervalues Limit 1";
				
	}
	else {
		$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		$sql="select ";
	
$i=1;
		while($x = mysqli_fetch_array($results)){
			$sql=$sql."(select count(amount) from offervalues where offerid in (select serial from offers where status=".$x['serial']." and year(Dat)='$year' ".$country.")and currency=$currency) as s".$i.",
			(select description from status where serial=".$x['serial'].")as statusN".$i.", 
			(select color from status where serial=".$x['serial'].")as statusC".$i.",";
			
		$i++;
		}
			$sql=$sql."	".$i." as i    
				from offervalues where offerid in (select serial from offers where year(Dat)='$year'".$country.") Limit 1";
			
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