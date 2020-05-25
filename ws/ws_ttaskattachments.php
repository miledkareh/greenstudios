<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
	$val=1;
	//$dbc = mysqli_connect("localhost", "roof11n_11User-", "x&l]Qa^NL69J", "roof11n_roof11");
	$action=$_GET["action"];
	//request insert transaction	
	if($action == 1)
	{
		$attachment = $_GET["attachment"];
		$attachment = basename($attachment); 
		$attachment = mysqli_real_escape_string($dbc,$attachment);
		$maintenance = $_GET["maintenance"];
		$sql="Insert into taskattachments (description,taskid,path) values ('$attachment',$maintenance,'')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];	
			$sql="SELECT * from taskattachments where serial=$id";
		$db = new DAL();		
		$data=$db->getData($sql);
	$img="../att/maintenance/".$data[0]['description']; 
		//echo($img);
		unlink($img);
		$sql="DELETE from taskattachments where serial=$id";;

	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$task = $_GET["maintenance"];
		$sql=" UPDATE taskattachments SET save=1,taskid=$task where (save=0 and userid=".$_SESSION['UserSerial'].") or serial=$id";
		}
			else if ($action==4)
		{
		include('../pages/configdb.php');
$query = "Select * From taskattachments where save=0 and userid=".$_SESSION['UserSerial'];
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
		//echo($img);
		unlink("../att/".$x['description']);
}
		$sql="DELETE from taskattachments where save=0 and userid=".$_SESSION['UserSerial'];
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