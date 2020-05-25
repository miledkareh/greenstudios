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
		$sql="Insert into offerfollowup (dat,description,offerid,userid,update1) values ('$dat','$description',$offerid,".$_SESSION['UserSerial'].",1)";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('New followup added','offerfollowup',$data,".$_SESSION['UserSerial'].",'$today')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from offerfollowup where serial=$id";;
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
		$sql=" UPDATE offerfollowup SET update1=1,userid=".$_SESSION['UserSerial'].",dat='$dat',description='$description',offerid=$offerid where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('Followup Updated','offerfollowup',$id,".$_SESSION['UserSerial'].",'$today')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}



	else if($action == 4)
	{
	
		$dat= $_GET["dat"];
		$description = $_GET["description"];
	
		$description = mysqli_real_escape_string($dbc,$description);
		$offerid = $_GET["offerid"];
		
		$sql="Insert into offerzones ( `description`, `offerid`, `dat`) values ('$description',$offerid,'$dat')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		// $sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('New followup added','offerfollowup',$data,".$_SESSION['UserSerial'].",'$today')";
		// $db = new DAL();		
		// $data=$db->ExecuteQuery($sql);
	}//request delete transaction

	else if ($action ==5)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from offerzones where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}

	else if ($action==6)
		{
		$id=$_GET["serial"];
		$dat= $_GET["dat"];
		$description = $_GET["description"];
		$description = mysqli_real_escape_string($dbc,$description);
		$offerid = $_GET["offerid"];
		 
		$sql=" UPDATE offerzones SET  dat='$dat',description='$description',offerid=$offerid where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		// $sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('Followup Updated','offerfollowup',$id,".$_SESSION['UserSerial'].",'$today')";
		// $db = new DAL();		
		// $data=$db->ExecuteQuery($sql);
		}

	try {
    	
		
		if($action==1||$action==4)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>