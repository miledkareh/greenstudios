<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
 
 if(isset($_GET['id'])){
	$id=$_GET["id"];
	$sql="";
	$sql="select * from emails where maintenanceid in( select maintenanceid from maintenancedetails where serial in (select visit from checkin where serial='".$id."' )) order by serial desc ";
 }else{
	 $schedule=$_GET['schedule'];
	 $sql="select * from scheduleemails where appointmentid=$schedule  order by serial desc limit 1";
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