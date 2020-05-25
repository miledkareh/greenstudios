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
	
		$status= $_GET["status"];
		$color = $_GET["color"];
		$nocolor = $_GET["nocolor"];
		$sql="Insert into status (description,color,nocolor) values ('$status','$color',$nocolor)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from tasks where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$done= $_GET["done"];
		$taskstatus= $_GET["taskstatus"];
		
		$sql=" UPDATE tasks SET done=$done,seen=1,taskstatus=$taskstatus where serial=$id";
		}
		else if ($action==4)
		{
		$id=$_GET["serial"];
		$status= $_GET["status"];
	
		
		$sql=" UPDATE tasks SET taskstatus=$status where serial=$id";
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