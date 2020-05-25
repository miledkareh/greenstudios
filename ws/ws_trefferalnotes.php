<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$dat= $_GET["dat"];
		$description = $_GET["description"];
		$offerid = $_GET["offerid"];
		$sql="Insert into refferalnotes (update1,dat,description,offerid) values (1,'$dat','$description',$offerid)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from refferalnotes where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$dat= $_GET["dat"];
		$description = $_GET["description"];
		$offerid = $_GET["offerid"];
		$sql=" UPDATE refferalnotes SET update1=1,dat='$dat',description='$description',offerid=$offerid where serial=$id";
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