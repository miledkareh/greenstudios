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

	
		
		$plant = $_GET["plant"];
		
		$plantnumber = $_GET["plantnumber"];
	
		$readingm=$_GET['readingm'];
		
		$sql="Insert into readingmplants (plantid,plantnumber,readingm) values ($plant,$plantnumber,$readingm)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		$sql="Delete from readingmplants where serial=$id";
	//	$sql="DELETE from clientcontacts where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
	$plant = $_GET["plant"];
		
		$plantnumber = $_GET["plantnumber"];
	
		
		$sql=" UPDATE readingmplants SET plantid=$plant,plantnumber=$plantnumber where serial=$id";
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