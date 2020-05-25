<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{		
	$notification = $_GET["notification"];
		$employee = $_GET["employee"];
		$done=$_GET["done"];
		$userid=$_GET["userid"];
		$confirm=$_GET["confirm"];
		$seen=$_GET["seen"];
		$sql="Insert into notificationdetail(update1,notification,userid,employee,done,seen,confirm) values (1,'$notification',$userid,$employee,$done,$seen,$confirm)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from notification where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
	$description = $_GET["description"];
		$subject = $_GET["subject"];
		$dat = $_GET["dat"];
		$duedate=$_GET["duedate"];
			$userid=$_GET["userid"];
		$offer=$_GET["offer"];
		$employee=$_GET["employee"];
		$done=$_GET["done"];
		$type=$_GET["type"];
	
		$sql=" UPDATE notification SET update1=1,dat='$dat',duedate='$duedate',subject='$subject',offerid=$offer,description='$description',employee='$employee',done=$done,type=$type where serial=$id";
		}
			else if ($action==4)
		{
			
		$id = $_GET["notification"];
		$employee = $_GET["employee"];
		$done=$_GET["done"];
		$confirm=$_GET["confirm"];
		
	
		$sql=" UPDATE notificationdetail SET update1=1,employee=$employee,done=$done,confirm=$confirm where serial=$id";
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