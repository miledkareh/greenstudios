<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$sql="select * from irrigationtime where serial=$serial";
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