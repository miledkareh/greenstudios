<?php
header('Access-Control-Allow-Origin: *');
session_start();
$_SESSION['timeout'] = time();
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$name= $_GET["name"];
		$name = mysqli_real_escape_string($dbc,$name);
		$symbol= $_GET["symbol"];
	echo $name;
		$sql="Insert into currencies (name,symbol,user) values ('$name','$symbol',".$_SESSION['UserSerial'].")";
		echo $sql;
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from currencies where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
	$name= $_GET["name"];
		$symbol= $_GET["symbol"];
		$sql=" UPDATE currencies SET name='$name',symbol='$symbol' where serial=$id";
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