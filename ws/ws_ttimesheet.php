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
		$fromdate = $_GET["fromdate"];
		$todate = $_GET["todate"];
		$fromtime= $_GET["fromtime"];
		$totime = $_GET["totime"];
		$fromdate = date('Y-m-d H:i:s', strtotime("$fromdate $fromtime"));
		$todate = date('Y-m-d H:i:s', strtotime("$todate $totime"));
		$employee = $_GET["employee"];
		$project = $_GET["project"];
		$sql="Insert into timesheet (update1,project,description,fromdate,todate,employee) values (1,$project,'$description','$fromdate','$todate',".$_SESSION['UserSerial'].")";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from timesheet where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
			$description= $_GET["description"];
		$fromdate = $_GET["fromdate"];
		$todate = $_GET["todate"];
		$fromtime= $_GET["fromtime"];
		$totime = $_GET["totime"];
		$fromdate = date('Y-m-d H:i:s', strtotime("$fromdate $fromtime"));
		$todate = date('Y-m-d H:i:s', strtotime("$todate $totime"));
		$employee = $_GET["employee"];
		$project = $_GET["project"];
		$sql=" UPDATE timesheet SET project=$project,description='$description',fromdate='$fromdate',todate='$todate',employee=".$_SESSION['UserSerial']." where serial=$id";
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