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
		$project = $_GET["project"];
		$Latitude = $_GET["Latitude"];
		$Longitude = $_GET["Longitude"];
		$today = $_GET["today"];
		$location=$_GET['location'];
		$checkindate=$_GET['checkindate'];
		$sql="Insert into checkin (description,visit,checkinlatitude,checkinlongitude,userid,checkindate,checkinlocation,checkin,update1,dat) values ('$description',$project,$Latitude,$Longitude,".$_SESSION['UserSerial'].",'$checkindate','$location',1,1,'$today')";
	
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from checkin where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$description= $_GET["description"];
		$project = $_GET["project"];
	$location = $_GET["location"];
		$sql=" UPDATE checkin SET update1=1,checkinlocation='$location',description='$description',project=$project,userid=".$_SESSION['UserSerial']." where serial=$id";
	
		}
		else if ($action==4)
		{
		$id=$_GET["serial"];
		$Latitude = $_GET["Latitude"];
		$Longitude = $_GET["Longitude"];
		$today = $_GET["today"];
		$notes=$_GET["notes"];
		$rate=$_GET["rate"];
		$dataa=$_GET["dataa"];
		$client=$_GET['client'];
		$gsnotes=$_GET['gsnotes'];
		$sent=$_GET['sent'];
		$approved=$_GET['approved'];
		$checkoutdate = $_GET['checkoutdate'];


		$sql=" UPDATE checkin SET sent='$sent',gsnotes='$gsnotes',update1=1,client='$client',notes='$notes',userid=".$_SESSION['UserSerial'].",checkoutlatitude=$Latitude,checkoutlongitude=$Longitude,checkoutdate='$checkoutdate',checkout=1,rate=$rate,dat='$today' where visit=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
		$sql=" UPDATE maintenancedetails SET work='$dataa' , accepted='".$approved."' where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);

$sql=" UPDATE readingm SET   accepted='".$approved."' where maintenancedetail_id=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);


$sql=" UPDATE readingm SET   accepted='".$approved."' where maintenancedetail_id=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);


$sql=" UPDATE irrigationtime SET   accepted='".$approved."' where maintenancedetail_id=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);

		$sql=" UPDATE pesticide SET   accepted='".$approved."' where maintenancedetail_id=$id";


		}

else if ($action==5)
		{
		$id=$_GET["serial"];
		$Latitude = $_GET["Latitude"];
		$Longitude = $_GET["Longitude"];
		$today = $_GET["today"];
		$notes=$_GET["notes"];
		$rate=$_GET["rate"];
		$dataa=$_GET["dataa"];
		$client=$_GET['client'];
		$gsnotes=$_GET['gsnotes'];
		$sent=$_GET['sent'];
	  	$checkoutdate = $_GET['checkoutdate'];


		$sql=" UPDATE checkin SET sent='$sent',gsnotes='$gsnotes',update1=1,client='$client',notes='$notes',userid=".$_SESSION['UserSerial'].",checkoutlatitude=$Latitude,checkoutlongitude=$Longitude,checkoutdate='$checkoutdate',checkout=1,rate=$rate,dat='$today' where visit=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
		$sql=" UPDATE maintenancedetails SET work='$dataa'   where serial=$id";
		 

 

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