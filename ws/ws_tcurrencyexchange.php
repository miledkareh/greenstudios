<?php
session_start();
$_SESSION['timeout'] = time();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{

	
		$date = $_GET["date"];
		$from = 0+$_GET["fcurrency"];
		$to=0+ $_GET["tcurrency"];
		$fa =0+ $_GET["famount"];
$ta =0+ $_GET["tamount"];
		$sql="Insert into bource (dat,fromcurrency,tocurrency,fromamount,toamount,user) values ('$date',$from,$to,$fa,$ta,".$_SESSION['UserSerial'].")";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
	
		$sql="DELETE from bource where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$date = $_GET["date"];
		$from = 0+$_GET["fcurrency"];
		$to=0+ $_GET["tcurrency"];
		$fa =0+ $_GET["famount"];
$ta =0+ $_GET["tamount"];
		$sql=" UPDATE bource SET dat='$date',fromcurrency=$from,tocurrency=$to,fromamount=$fa,toamount=$ta where serial=$id";
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