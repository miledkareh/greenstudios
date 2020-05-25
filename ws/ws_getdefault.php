<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET["ID"])){
	$serial=$_GET["ID"];
  	$sql="select * from items where default1=1 and cat = (select cat from items where serial='".$serial."' ) and serial <>'".$serial."' ";
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