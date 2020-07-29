<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
	
		$size = $_GET["size"];
	
		$itemid = $_GET["itemid"];
		
		$qty = $_GET["qty"];
		
		$sql="Insert into itemquantity (dat,cost,itemid,qty) values (CURRENT_DATE(),'$size',$itemid,'$qty')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from itemquantity where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		
		$size = $_GET["size"]; 
		$itemid = $_GET["itemid"];
		
		$qty = $_GET["qty"];
	
		$sql=" UPDATE itemquantity SET  cost='$size',itemid=$itemid,qty='$qty' where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
		}
	try {
    	
		
		if($action==1)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>