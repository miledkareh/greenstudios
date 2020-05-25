<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];

session_start();

	//request insert transaction	
	if($action == 1)
	{		
	$description = $_GET["description"];
		$subject = $_GET["subject"];
		$dat = $_GET["dat"];
		$dat=date('Y-m-d', strtotime($dat));
		$duedate=$_GET["duedate"];
		$duedate=date('Y-m-d', strtotime($duedate));
		$viewer=$_GET["viewer"];
		$offer=$_GET["offer"];
		$employee=$_GET["employee"];
		$done=$_GET["done"];
		$type=$_GET["type"];
		$sql="Insert into notification (update1,description,subject,dat,duedate,userid,offerid,employee,done,isnotification,seen,confirm,viewer) values (1,'$description','$subject','$dat','$duedate',".$_SESSION['UserSerial'].",$offer,$employee,$done,$type,0,0,'$viewer')";
		
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
		$dat=date('Y-m-d', strtotime($dat));
		$duedate=$_GET["duedate"];
		$duedate=date('Y-m-d', strtotime($duedate));
			$viewer=$_GET["viewer"];
		$offer=$_GET["offer"];
			$employee=$_GET["employee"];
		
		$done=$_GET["done"];
		$type=$_GET["type"];
		$confirm=$_GET["confirm"];
		$sql=" UPDATE notification SET update1=1,dat='$dat',duedate='$duedate',subject='$subject',offerid=$offer,description='$description',done=$done,isnotification=$type,confirm=$confirm,employee=$employee,viewer='$viewer' where serial=$id";
		}
		else if ($action ==4)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from notificationdetail where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
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