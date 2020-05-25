<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$dat= $_GET["dat"];
		$zone = $_GET["zone"];
		$linearmeter=$_GET["linearmeter"];
		$emittertype=$_GET["emittertype"];
		$emitternumber=$_GET["emitternumber"];
		$emitterflow=$_GET["emitterflow"];
		$totalflow=$_GET["totalflow"];
		$minday=$_GET["minday"];
		$watercons=$_GET["watercons"];
		$maintenance=$_GET["maintenance"];
		  $sql="Insert into irrigationflow (maintenanceid,dat,zone,linearmeter,emittertype,emitternumber,emitterflow,totalflow,minday,watercons) values 
		('".$maintenance."','".$dat."','".$zone."','".$linearmeter."','".$emittertype."','".$emitternumber."','".$emitterflow."','".$totalflow."','".$minday."','".$watercons."')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from irrigationflow where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$dat= $_GET["dat"];
		$zone = $_GET["zone"];
		$linearmeter=$_GET["linearmeter"];
		$emittertype=$_GET["emittertype"];
		$emitternumber=$_GET["emitternumber"];
		$emitterflow=$_GET["emitterflow"];
		$totalflow=$_GET["totalflow"];
		$minday=$_GET["minday"];
		$watercons=$_GET["watercons"];
		$sql=" UPDATE irrigationflow SET dat='$dat',zone='$zone',linearmeter=$linearmeter,emittertype='$emittertype',emitternumber=$emitternumber,emitterflow=$emitterflow,totalflow=$totalflow,minday=$minday,watercons=$watercons where serial=$id";
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