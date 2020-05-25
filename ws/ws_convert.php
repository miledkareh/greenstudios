<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');


	$currency=$_GET["currency"];
	$dat=$_GET["dat"];
	$sql="select * from bource where FromCurrency=$currency and ToCurrency=2 and Dat<='$dat' order by serial desc Limit 1 ";


	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>