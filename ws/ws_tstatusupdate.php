<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{		
	
		$status=$_GET["status"];
		$today=$_GET["today"];
		$offerid=$_GET["offerid"];
		$statusdate=$_GET["statusdate"];
		$sql="Insert into statusupdate (statuss,dat,offerid,statusdate) values ($status,'$today',$offerid,'$statusdate')";
		echo $sql;
	}//request delete transaction


	try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
		if($action==1)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo $e;
	}




	
	
		
		
?>
