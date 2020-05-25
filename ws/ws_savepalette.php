<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');


$serial=$_GET["id"];

	$db = new DAL();
			
		//$serial=$_GET['serial'];
	
		 
	  	$sql="select plants from palette where serial='".$serial."' ";


		$data=$db->getData($sql);
		$p= implode($data[0],",");

      $sql="select * from plants where serial in(".$p.") ";
$data1=$db->getData($sql);




		header("Content-type:application/json"); 		
		echo json_encode($data1);
	

?>