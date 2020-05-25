<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$dat= $_GET["dat"];
		$zone = $_GET["zone"];
		$starttime=$_GET["starttime"];
		$endtime=$_GET["endtime"];
		
		$maintenance=$_GET["maintenance"];
		$sql="Insert into irrigationtime (maintenanceid,dat,zone,starttime,endtime,accepted) 
		values ($maintenance,'$dat','$zone','$starttime','$endtime',1)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from irrigationtime where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$dat= $_GET["dat"];
		$zone = $_GET["zone"];
		$starttime=$_GET["starttime"];
		$endtime=$_GET["endtime"];
		
		$maintenance=$_GET["maintenance"];
		$sql=" UPDATE irrigationtime SET dat='$dat',zone='$zone',starttime='$starttime',endtime='$endtime' where serial=$id";
		}
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