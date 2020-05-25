<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$description= $_GET["description"];
	
		$sql="Insert into lux (description,update1) values ('$description',1)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from lux where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{

		$maintenance= $_GET["maintenance"];
		$datelux= $_GET["datelux"];
		$sql=" UPDATE lux SET isnew=0,dat='".$datelux."' where userid=".$_SESSION['UserSerial']." and isnew=1 and maintenanceid=$maintenance";
		}
		else if ($action==4)
		{
		
		$maintenance= $_GET["maintenance"];
		$sql=" Delete from lux where maintenanceid=$maintenance and isnew=1 and userid=".$_SESSION['UserSerial'];
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