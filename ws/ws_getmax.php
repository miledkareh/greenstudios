<?php
header('Access-Control-Allow-Origin: *');
require_once('DAL.class.php');

$table=$_GET["table"];
		$sql="select max(serial)as mserial from $table";

	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>