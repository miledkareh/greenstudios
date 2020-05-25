<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];

 
	if($action == 1)
	{		
		$maintenancedetails= $_GET["maintenancedetails"];
		 
		 
		$sql="UPDATE `irrigationtime` SET `accepted` = '1' WHERE   maintenancedetail_id='".$maintenancedetails."' ";
		$sql1="UPDATE `pesticide` SET `accepted` = '1' WHERE `maintenancedetail_id` ='".$maintenancedetails."' ";
		$sql2="UPDATE `readingm` SET `accepted` = '1' WHERE `maintenancedetail_id`  ='".$maintenancedetails."' ";
		
			$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$data=$db->ExecuteQuery($sql1);
		$data=$db->ExecuteQuery($sql2);
	} 
	 
	 
	try {
    
		
		 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}




	
	
		
		
?>