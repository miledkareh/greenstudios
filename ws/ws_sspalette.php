<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');


$serial=$_GET["id"];

	$db = new DAL();
			
		 
	
		 
	  	$sql="select *    from palette where serial='".$serial."' ";

 
		$data=$db->getData($sql);
		 




		header("Content-type:application/json"); 		
		echo json_encode($data);
	

?>