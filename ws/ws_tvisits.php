<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{		
$maintenance= $_GET["maintenance"];
		$supervisor = $_GET["supervisor"];
		$notes = $_GET["notes"];
		$data = $_GET["data"];
		
		$checkindate = $_GET['checkindate'];
		$sql="Insert into maintenancedetails (update1,userid,maintenanceid,notes,employees,dat,accepted) values (1,'$supervisor','$maintenance','$notes','$data','$checkindate',1)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from maintenancedetails where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);

		$sql="DELETE from checkin where visit=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);

		$sql="DELETE from readingm where maintenancedetail_id=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);


		$sql="DELETE from pesticide where maintenancedetail_id=$id";
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);


			$sql="DELETE from irrigationtime where maintenancedetail_id=$id";
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		

		$sql="DELETE from notificationdetail where notification in (select serial from notification where visit=$id)";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="DELETE from notification where visit=$id";;
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$maintenance= $_GET["maintenance"];
		$supervisor = $_GET["supervisor"];
		$notes = $_GET["notes"];
		$data = $_GET["data"];
		
		$checkindate = $_GET['checkindate'];
		$sql=" UPDATE maintenancedetails SET dat='$checkindate',update1=1,userid='$supervisor',maintenanceid='$maintenance',notes='$notes',employees='$data'  where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" UPDATE checkin SET checkindate='$checkindate'  where visit=$id";
		
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