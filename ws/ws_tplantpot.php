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
	
		$type= $_GET["type"];
		$size = $_GET["size"];
	
		$plantid = $_GET["plantid"];
		$date = $_GET["date"];
		$qty = $_GET["qty"];
		$cost = $_GET["cost"];
		$country = $_GET["country"];
		$sql="Insert into plantpot (dat,type,size,plantid,qty,cost,country) values ('$date','$type','$size',$plantid,$qty,$cost,'$country')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from plantpot where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$type= $_GET["type"];
		$size = $_GET["size"];
		$date = $_GET["date"];
		$plantid = $_GET["plantid"];
		
		$qty = $_GET["qty"];
		$cost = $_GET["cost"];
		$country = $_GET["country"];
		$sql=" UPDATE plantpot SET `dat`='$date',country='$country',type='$type',size='$size',plantid=$plantid,qty=$qty,cost=$cost where serial=$id";
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