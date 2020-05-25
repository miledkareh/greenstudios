<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$description= $_GET["description"];
		$total = $_GET["total"];
		$invoice=$_GET["invoice"];
		$sql="Insert into invoicearea (description,total,invoice,update1) values ('$description',$total,$invoice,1)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from invoicearea where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$description= $_GET["description"];
		$total = $_GET["total"];
		$invoice=$_GET["invoice"];
		$sql=" UPDATE invoicearea SET update1=1,description='$description',total=$total,invoice=$invoice where serial=$id";
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