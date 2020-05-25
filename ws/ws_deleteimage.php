<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if (isset($_GET['id'])){
		$id=$_GET["id"];
	$tablename=$_GET['tablename'];
		try {
		$sql="Delete from $tablename where serial=$id";}
 catch(Exception $e) {	

	}
}

try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
?>