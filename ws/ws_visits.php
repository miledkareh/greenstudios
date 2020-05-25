<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');


$serial=$_GET["id"];

	$db = new DAL();
			
		//$serial=$_GET['serial'];
	
		 
		$sql="select *,(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate from maintenancedetails where serial =$serial";


		$data=$db->getData($sql);

		header("Content-type:application/json"); 		
		echo json_encode($data);
	

?>