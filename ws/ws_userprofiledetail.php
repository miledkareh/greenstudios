<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	
		$serial=$_GET["serial"];
		$canedit=$_GET["canedit"];
		$candelete=$_GET["candelete"];
		$canview=$_GET["canview"];
		$profile=$_GET["profile"];
		$sql=" INSERT INTO userprofiledetail (form,profileid,canedit,canview,candelete) values ($serial,$profile,$canedit,$canview,$candelete)";
		
	try {
    	$db = new DAL();	
$data=$db->ExecuteQuery("Delete From userprofiledetail where form=$serial and profileid=$profile");		
		$data=$db->ExecuteQuery($sql);
	}
	catch(Exception $e) {	
		echo 0;
	}




	
	
		
		
?>