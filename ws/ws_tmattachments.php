<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
	$val=1;
	
	$action=$_GET["action"];
	//request insert transaction	
	if($action == 1)
	{
		$attachment = $_GET["attachment"];
		$attachment = basename($attachment); 	
		$detail = $_GET["detail"];
		$maintenance = $_GET["maintenance"];
		$sql="Insert into maintenanceattachement (update1,description,maintenancedetailid,maintenanceid,path) values (1,'$attachment',$detail,$maintenance,'')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		$sql="SELECT * from maintenanceattachement where serial=$id";
		$db = new DAL();		
		$data=$db->getData($sql);
	$img="../att/maintenance/".$data[0]['maintenancedetailid']."/".$data[0]['description']; 
		//echo($img);
		unlink($img);
		$sql="DELETE from maintenanceattachement where serial=$id";;

	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET['serial'];
		$offerid =$_GET["offerid"];
		$today=$_GET['today'];

		$sql=" UPDATE maintenanceattachement SET update1=1,dat='$today',isnew=0 where (userid=".$_SESSION['UserSerial']." and maintenancedetailid=$offerid and isnew=1) or serial=$id";
		}
		else if ($action==4)
		{
		include('../pages/configdb.php');
$query = "Select * From maintenanceattachement where maintenanceid=0 and userid=".$_SESSION['UserSerial'];
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
		//echo($img);
		unlink("../att/".$x['status']."/".$x['description']);
}
		$sql="DELETE from maintenanceattachement where maintenanceid=0 and userid=".$_SESSION['UserSerial'];
		}
		else if ($action==5)
		{
			$offerid=$_GET['offerid'];
		$sql="DELETE from maintenanceattachement where maintenancedetailid=$offerid and isnew=1 and userid=".$_SESSION['UserSerial'];
		
		}
		else if ($action ==6)
	{
		$id=$_GET["id"];
		$sql="SELECT * from maintenanceattachement where serial=$id";
		$db = new DAL();		
		$data=$db->getData($sql);
	$img="../att/visits/".$data[0]['status']."/".$data[0]['maintenancedetailid']."/".$data[0]['description']; 
		//echo($img);
		unlink($img);
		$sql="DELETE from maintenanceattachement where serial=$id";;

	
	}
else if ($action==7)
		{
		$id=$_GET['serial'];
		$offerid =$_GET["offerid"];
		$today=$_GET['today'];

		$sql=" UPDATE maintenanceattachement SET update1=1,dat='$today',isnew=0,approved=1 where (userid=".$_SESSION['UserSerial']." and maintenanceid=$offerid and isnew=1) or serial=$id";
		}
		else if ($action==8)
		{
		include('../pages/configdb.php');
$query = "Select * From maintenanceattachement where isnew=1 and userid=".$_SESSION['UserSerial'];
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
		//echo($img);
		unlink("../att/".$x['status']."/".$x['description']);
}
		$sql="DELETE from maintenanceattachement where isnew=1 and userid=".$_SESSION['UserSerial'];
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