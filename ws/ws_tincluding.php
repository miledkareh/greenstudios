<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{

	
		
		$description = $_GET["includingdesc"];
		$description = mysqli_real_escape_string($dbc,$description);
		$companyid = $_GET["companyid"];
		$gw_checkbox = $_GET["gw_checkbox"];
		$rg_checkbox = $_GET["rg_checkbox"];
		$sql="Insert into including (description,update1,companyid,rg,gw) values ('$description',1,$companyid,'$rg_checkbox','$gw_checkbox')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from including where serial=$id";;
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
	
		$description = $_GET["includingdesc"];
		$description = mysqli_real_escape_string($dbc,$description);
		$companyid = $_GET["companyid"];
		$gw_checkbox = $_GET["gw_checkbox"];
		$rg_checkbox = $_GET["rg_checkbox"];
		$sql=" UPDATE including SET description='$description',update1=1,companyid=$companyid,gw='$gw_checkbox',rg='$rg_checkbox' where serial=$id";
		
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