<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{

		$project =0+ $_GET["project"];
		$expirydate = $_GET["expirydate"];
		$description= $_GET["description"];
		$value =0+ $_GET["value"];
		$paid=0+ $_GET["paid"];
		$invoiced=0+ $_GET["invoiced"];
		$visits =0+ $_GET["visits"];
		$notes = $_GET["notes"];
		$image1=$_GET['image1'];
$image2=$_GET['image2'];
$image3=$_GET['image3'];
$image4=$_GET['image4'];
$image5=$_GET['image5'];
$image6=$_GET['image6'];
$image7=$_GET['image7'];
$image8=$_GET['image8'];
$phours=$_GET['phours'];
$average=$_GET['average'];
		$kickoff = $_GET["kickoff"];
		$status = $_GET["status"];
		if($status=='canceled')
		$order1=2;
		else if($status=='free maintenance period')
		$order1=1;
		else if($status=='active')
		$order1=0;
		$sql="update offers set update1=1,kickoff='$kickoff' where serial=$project";
			$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="Insert into maintenances (phours,average,order1,image1,image2,image3,image4,image5,image6,image7,image8,invoiced,status,update1,offerid,description,expdate,valuee,paid,numofvisits,notes) values ('$phours','$average',$order1,'$image1','$image2','$image3','$image4','$image5','$image6','$image7','$image8',$invoiced,'$status',1,$project,'$description','$expirydate',$value,$paid,$visits,'$notes')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Update maintenanceattachement set maintenanceid=$data,isnew=0 where isnew=1 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from maintenances where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$project =0+ $_GET["project"];
		$expirydate = $_GET["expirydate"];
		$description= $_GET["description"];
		$value =0+ $_GET["value"];
		$paid=0+ $_GET["paid"];
		$visits =0+ $_GET["visits"];
		$notes = $_GET["notes"];
		$invoiced=0+ $_GET["invoiced"];
		$image1=$_GET['image1'];
$image2=$_GET['image2'];
$image3=$_GET['image3'];
$image4=$_GET['image4'];
$image5=$_GET['image5'];
$image6=$_GET['image6'];
$image7=$_GET['image7'];
$image8=$_GET['image8'];
$phours=$_GET['phours'];
$average=$_GET['average'];
		$kickoff = $_GET["kickoff"];
			$status = $_GET["status"];
			if($status=='canceled')
		$order1=2;
		else if($status=='free maintenance period')
		$order1=1;
		else if($status=='active')
		$order1=0;
		$sql="update offers set update1=1,kickoff='$kickoff' where serial=$project";
			$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" UPDATE maintenances SET average='$average',phours='$phours',order1=$order1,saved=0,image1='$image1',image2='$image2',image3='$image3',image4='$image4',image5='$image5',image6='$image6',image7='$image7',image8='$image8',invoiced=$invoiced,status='$status',update1=1,offerid=$project,description='$description',expdate='$expirydate',valuee=$value,paid=$paid,numofvisits=$visits,notes='$notes' where serial=$id";
$db = new DAL();		
		$data=$db->ExecuteQuery($sql);	
		$sql=" Update maintenanceattachement set isnew=0 where isnew=1 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);	
}
		else if ($action==4)
		{
		
		$sql="delete from maintenances where saved=1";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="Insert into maintenances (saved) values(1)";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
	try {
    	
		
		if($action==1 || $action==4)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>