<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$sql="select *,(select CONCAT(country,' - ',city) from customers where serial=offers.customerid) as caddress from offers where serial=$serial";
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