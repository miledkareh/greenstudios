<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();

if(isset($_GET["id"])){
	if($_GET['action']==1)
	{$serial=$_GET["id"];
	$sql="select * from readingmplants where serial=$serial";}
	else {
		$serial=$_GET["id"];
	$sql="select *,(select scientic from plants where serial=readingmplants.plantid) as plantN from readingmplants where readingm=$serial";
	}
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