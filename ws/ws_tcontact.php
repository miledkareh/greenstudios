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
		$lname= $_GET["lname"];
		$title = $_GET["title"];
		$email = $_GET["email"];
		$mobile = $_GET["mobile"];
		$clientid=$_GET['clientID'];
		$position=$_GET['position'];
		$department=$_GET['department'];
		$division=$_GET['division'];
		$religion=$_GET['religion'];
		$sql="Insert into clientcontacts (clientid,religion,department,division,position,fname,lname,userid,email,mobile,title) values ($clientid,$religion,$department,'$division','$position','$fname','$lname',".$_SESSION['UserSerial'].",'$email','$mobile','$title')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		$sql="Update clientcontacts set deleted=1 where serial=$id";
	//	$sql="DELETE from clientcontacts where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$fname = $_GET["fname"];
		$lname= $_GET["lname"];
		$title = $_GET["title"];
		$email = $_GET["email"];
		$mobile = $_GET["mobile"];
		$position=$_GET['position'];
		$department=$_GET['department'];
		$division=$_GET['division'];
		$religion=$_GET['religion'];
		$sql=" UPDATE clientcontacts SET religion=$religion,position='$position',department=$department,division='$division',fname='$fname',lname='$lname',email='$email',mobile='$mobile',title='$title' where serial=$id";
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