<?php
header('Access-Control-Allow-Origin: *');
require_once('DAL.class.php');


	$action = $_GET["action"];

	if ($action ==1)
	{
			$sql= "select * from userprofile";
	
	}
	elseif ($action ==2)
	{
			$sql= "select distinct Country from offers";
	
	}

elseif ($action ==3)
	{
			$sql= "select * from offers";
	
	}
	elseif ($action ==4)
	{
		if(isset($_GET['id']))
		{$id=$_GET['id'];
			$sql= "select * from customers where serial=$id";}
		else
			$sql= "select * from customers";
	}
	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>