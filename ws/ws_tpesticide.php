<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$dat= $_GET["dat"];
		$trade = $_GET["trade"];
		 
		$maintenance=$_GET["maintenance"];
		$sql="Insert into pesticide (maintenanceid,dat,trade,accepted) values 
		($maintenance,'$dat','$trade',1)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from pesticide where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$dat= $_GET["dat"];
		$trade = $_GET["trade"];
		 
		
		$sql=" UPDATE pesticide SET dat='$dat',trade='$trade'  where serial=$id";
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