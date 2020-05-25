<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	include('../pages/configdb.php');
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	$flag=$_GET['flag'];
		
		$sql="update invoicedetail set viewprices='".$flag."' where serial='".$_GET['id']."' ";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}//request delete transaction
	
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