<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$specialty= $_GET["specialty"];
		$color = $_GET["color"];
		$ordernb = $_GET["ordernb"];
		$sql="Insert into itemsgroups (description,color,order2) values ('$specialty','$color','".$ordernb."')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from itemsgroups where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$specialty= $_GET["specialty"];
			$ordernb = $_GET["ordernb"];
		$color = $_GET["color"];
		$sql=" UPDATE itemsgroups SET description='$specialty',color='$color',order2='".$ordernb."' where serial=$id";
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