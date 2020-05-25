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
	
		$dat= $_GET["dat"];
		$description = $_GET["description"];
	
		$description = mysqli_real_escape_string($dbc,$description);
		$offerid = $_GET["offerid"];
		
		$today = $_GET["today"];
		$sql="Insert into mfollowup (dat,description,maintenanceid,userid) values ('$dat','$description',$offerid,".$_SESSION['UserSerial'].")";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('New maintenance followup added','mfollowup',$data,".$_SESSION['UserSerial'].",'$today')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from mfollowup where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$dat= $_GET["dat"];
		$description = $_GET["description"];
		$description = mysqli_real_escape_string($dbc,$description);
		$offerid = $_GET["offerid"];
		$today = $_GET["today"];
		$sql=" UPDATE mfollowup SET userid=".$_SESSION['UserSerial'].",dat='$dat',description='$description',maintenanceid=$offerid where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('Maintenance Followup Updated','mfollowup',$id,".$_SESSION['UserSerial'].",'$today')";
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