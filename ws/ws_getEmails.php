<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
$action=$_GET['action'];
if($action==1){
	$id=$_GET["id"];
	
	// $sql="select c.email as email 
	// from checkin as ch,
	// maintenancedetails as md,
	// maintenances as m
	// offers as o,
	// customers as c 
	// where 
	// ch.serial=$id and ch.visit=md.serial and md.maintenanceid=m.serial and m.offerid=o.serial and (o.customerid=c.serial or o.consultantid=c.serial or o.architectid=c.serial or o.contractorid=c.serial or o.clientrep=c.serial or o.landscapearchitect=c.serial or o.maincontractorreferral=c.serial or o.referral=c.serial) and  c.email <> ''";

	$sql="select email from mcontact where maintenanceid in (select maintenanceid from maintenancedetails where serial ='".$id."' ) ";
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