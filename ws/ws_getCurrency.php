<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
$action=$_GET['action'];
if($action==1){
	$dat=$_GET["dat"];
	$fromcurrency=$_GET["fromcurrency"];
	$tocurrency=$_GET["tocurrency"];
	$sql="select * from bource where FromCurrency =$fromcurrency and ToCurrency =$tocurrency and Dat <='$dat' order by serial desc Limit 1";
}

	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>