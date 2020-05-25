<?php
session_start();
$_SESSION['timeout'] = time();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{

	
		
		$fname = $_GET["fname"];
		
		$title = $_GET["title"];
		$email = $_GET["email"];
		$mobile = $_GET["mobile"];
		$clientid=$_GET['clientID'];
		$clientstatus=$_GET['clientstatus'];
		$sql="Insert into mcontact (maintenanceid,fullname,userid,email,mobile,title,clientstatus) values ($clientid,'$fname',".$_SESSION['UserSerial'].",'$email','$mobile','$title','$clientstatus')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		$sql="Delete from mcontact where serial=$id";
	//	$sql="DELETE from clientcontacts where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$fname = $_GET["fname"];
		
		$title = $_GET["title"];
		$email = $_GET["email"];
		$mobile = $_GET["mobile"];
		$clientstatus=$_GET['clientstatus'];
		$sql=" UPDATE mcontact SET clientstatus='$clientstatus',fullname='$fname',email='$email',mobile='$mobile',title='$title' where serial=$id";
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