<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{		
	
		$description = $_GET["description"];
		$filter = $_GET["filter"];
		$data = $_GET["data"];
		$hide = $_GET["hide"];
		
		$sql="Insert into userprofile (description,filter,datafilter,hide) values ('$description',$filter,'$data',$hide)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from userprofile where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$description = $_GET["description"];
		$filter = $_GET["filter"];
		$data = $_GET["data"];
		$hide = $_GET["hide"];
		$sql=" UPDATE userprofile SET hide=$hide,description='$description',filter=$filter,datafilter='$data'  where serial=$id";
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