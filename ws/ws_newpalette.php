<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
	$val=1;
	
	$action=$_GET["action"];
//$dbc = mysqli_connect("localhost", "dsoflbne_dsoft", "dsoft@123", "dsoflbne_pharmacy");


	//request insert transaction	
	  if ($action==3)
		{
		$id=$_GET["serial"];
		$description= $_GET["description"];
		  	$plantselect= $_GET["plantselect"];
		  	$p=implode($plantselect, ",");
		$sql=" UPDATE palette SET palettename='".$description."',plants='".$p."' where serial=$id";
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