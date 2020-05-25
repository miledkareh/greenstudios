<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];
session_start();


	//request insert transaction	
	if($action == 1)
	{
	
		$visit=$_GET["serial"];
		$notes= $_GET["notes"];
		$today = $_GET["today"];
		$rate=$_GET["rate"];
		$sql="Insert into complain (update1,description,visit,dat,rate,fromuser,seen) values (1,'$notes',$visit,'$today',$rate,".$_SESSION['UserSerial'].",0)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from invoicearea where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$sql=" UPDATE complain SET seen=1 where serial=$id";
		}
		else if ($action==4)
		{
		$visit=$_GET["serial"];
		$notes= $_GET["notes"];
		$today = $_GET["today"];
		$rate=$_GET["rate"];
		$subject=$_GET['subject'];
		$offerid=$_GET['offerid'];
		$sql=" Insert into notification(update1,dat,duedate,visit,rate,description,userid,complaint,subject,offerid,isnotification) values(1,'$today','$today',$visit,$rate,'$notes',".$_SESSION['UserSerial'].",1,'$subject',$offerid,1)";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into notificationdetail(update1,notification,done,seen,confirm,userid) values(1,$data,0,0,0,".$_SESSION['UserSerial'].")";
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