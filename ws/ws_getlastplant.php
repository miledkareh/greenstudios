<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
 
	$type=$_GET["type"];
	$size=$_GET['size'];
		$country=$_GET['country'];
		$plantid=$_GET['plantid'];
	 
	  $sql="SELECT * FROM plantpot where type='".$type."' and size='".$size."' and  country='".$country."' and  plantid='".$plantid."' order by dat desc ";
 
	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>