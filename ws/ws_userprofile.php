<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');


$serial=$_GET["id"];

	$db = new DAL();
			
		//$serial=$_GET['serial'];
	
		 
		$sql="select * from userprofile where serial =$serial";


		$data=$db->getData($sql);

		header("Content-type:application/json"); 		
		echo json_encode($data);
	

?>