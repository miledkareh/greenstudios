<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');


	
	$sql="select distinct(Country) as country from offers where Country <>'' order by Country asc";


	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>