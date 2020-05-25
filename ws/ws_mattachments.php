<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
	$action=$_GET['action'];
if($action==1){
if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$sql="select * from taskattachments where serial=$serial";
}
}
else if($action==2){
	$serial=$_GET["id"];
	$sql="select * from maintenanceattachement where maintenanceid=$serial and status='wip' and isnew=0";
}
else if($action==3){
	$serial=$_GET["id"];
	$sql="select * from maintenanceattachement where maintenanceid=$serial and status='regular' and isnew=0";
}
else if($action==4){
	$serial=$_GET["id"];
	$sql="select * from maintenanceattachement where serial=$serial";
}
else if($action==5){
	$serial=$_GET["id"];
	$sql="select * from visitattachment where visitid=$serial";
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