<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$sql="select * from ptext where serial=$serial";
}else{
	$offer=$_GET['project'];
	$client=$_GET['client'];
	$sql="select *,(select email from customers where serial=$client) as email from ptext where location in (select country from offers where serial=$offer) and schedule=1 limit 1";
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