<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
	$val=1;
	
	$action=$_GET["action"];
$dbc = mysqli_connect("localhost", "root", "", "roof11");


	//request insert transaction	
	if($action == 1)
	{
	
		$fromdate = $_GET["fromdate"];
		$todate = $_GET["todate"];
		$fromtime= $_GET["fromtime"];
		$totime = $_GET["totime"];
		$fromdate = date('Y-m-d H:i:s', strtotime("$fromdate $fromtime"));
		$todate = date('Y-m-d H:i:s', strtotime("$todate $totime"));
		$description = $_GET["description"];
		$description = mysqli_real_escape_string($dbc,$description);
		$taskid = $_GET["taskid"];
		$status = $_GET["status1"];
		
		$sql="Insert into taskfollowup(status,fromdate,todate,description,taskid,userid) values ('$status','$fromdate','$todate','$description',$taskid,".$_SESSION['UserSerial'].")";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql1="select * from tasks where serial=$taskid";
		$db = new DAL();
		$data1=$db->getData($sql1);
		$sql1="Insert into timesheet (description,fromdate,todate,employee,project,taskid,taskfollowup) values ('$description','$fromdate','$todate',".$_SESSION['UserSerial'].",".$data1[0]['offerid'].",$taskid,$data)";
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql1);
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from taskfollowup where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$fromdate = $_GET["fromdate"];
		$todate = $_GET["todate"];
		$fromtime= $_GET["fromtime"];
		$totime = $_GET["totime"];
		$fromdate = date('Y-m-d H:i:s', strtotime("$fromdate $fromtime"));
		$todate = date('Y-m-d H:i:s', strtotime("$todate $totime"));
		$description = $_GET["description"];
		$description = mysqli_real_escape_string($dbc,$description);
		$taskid = $_GET["taskid"];
		$status = $_GET["status1"];
		$sql=" UPDATE taskfollowup SET fromdate='$fromdate',todate='$todate',status='$status',userid=".$_SESSION['UserSerial'].",description='$description',taskid=$taskid where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" UPDATE timesheet SET taskid=$taskid,description='$description',fromdate='$fromdate',todate='$todate' where taskfollowup=$id";
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