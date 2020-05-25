<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{		
	$id=$_GET["serial"];
		$sql=" UPDATE tasks SET seen=1 where serial=$id";
		
	}//request delete transaction
	
	try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
		if($action==1)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}




	
	
		
		
?>