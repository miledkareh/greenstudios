<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$sql="select *,(select max(code) from invoicereport) as mcode,(select symbol from currencies where serial=offers.currency) as currencyS from offers where serial=$serial";
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