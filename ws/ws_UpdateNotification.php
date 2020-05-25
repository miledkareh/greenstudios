<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{		
	$id=$_GET["serial"];
		$sql=" UPDATE notification SET seen=1 where serial=$id";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["serial"];
		$done=$_GET["done"];
		$confirm=$_GET["confirm"];
		
		$sql=" UPDATE notification SET done=$done,confirm=$confirm where serial=$id";
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
	$name = $_GET["name"];
		$username = $_GET["username"];
		$pwd = $_GET["psw"];
		$admin=$_GET["admin"];
		$hide=$_GET["hide"];
		$profile=$_GET["profile"];
		$country=$_GET["country"];
	
		
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