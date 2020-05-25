<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET["action"])){
	$action=$_GET['action'];
}
if($action==1){
	$serial=$_GET["id"];
	$sql="select * from itemattachment where itemid=$serial";
}
else if ($action==2){
	$serial=$_GET["id"];
	$sql="select * from itemattachment where itemid=$serial";
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