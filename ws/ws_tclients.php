<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');


error_reporting(E_ALL);
ini_set('display_errors', 'on');
	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{

	
		$company = $_GET["company"];
		$specialty = $_GET["specialty"];
		$website= $_GET["website"];
		$country = $_GET["country"];
		$city = $_GET["city"];
		$tel = $_GET["tel"];
		$fax = $_GET["fax"];
		$fname = $_GET["fname"];
		$lname= $_GET["lname"];
		$title = $_GET["title"];
		$email = $_GET["email"];
			$mobile = $_GET["mobile"];
			$referral = $_GET["referred"];
		$notes = $_GET["notes"];
		$category=$_GET["category"];
		$phours=$_GET["phours"];
		$today=$_GET['today'];
		$dat=$_GET['dat'];
		$sql="Insert into customers (phours,dat,referral,update1,ccategory,fname,lname,userid,email,telephone,id,company,specialty,fn,activity,mobile,country,city,fax,project,offer,status,budget,area,category,notes,website,priority) values ('$phours','$dat','$referral',1,$category,'$fname','$lname',".$_SESSION['UserSerial'].",'$email','$tel',0,'$company','$specialty','','$title','$mobile','$country','$city','$fax','',0,'',0,0,'','$notes','$website','')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('New Client added','customers',$data,".$_SESSION['UserSerial'].",'$today')";
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from customers where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$company = $_GET["company"];
		$specialty = $_GET["specialty"];
		$website= $_GET["website"];
		$country = $_GET["country"];
		$city = $_GET["city"];
		$tel = $_GET["tel"];
		$fax = $_GET["fax"];
		$fname = $_GET["fname"];
		$lname= $_GET["lname"];
		$title = $_GET["title"];
		$email = $_GET["email"];
		$mobile = $_GET["mobile"];
		$notes = $_GET["notes"];
		$category=$_GET["category"];
		$today=$_GET['today'];
		$referral = $_GET["referred"];
		$phours=$_GET["phours"];
		$dat=$_GET['dat'];
		$sql=" UPDATE customers SET phours='$phours',dat='$dat',referral='$referral',update1=1,fname='$fname',ccategory=$category,lname='$lname',email='$email',telephone='$tel',company='$company',specialty='$specialty',activity='$title',mobile='$mobile',country='$country',city='$city',fax='$fax',notes='$notes',website='$website' where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('Client Updated','customers',$id,".$_SESSION['UserSerial'].",'$today')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
	try {
    	
		
		if($action==1)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>