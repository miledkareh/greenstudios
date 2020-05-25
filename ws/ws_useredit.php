<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
$db = new DAL();
if(isset($_GET["id"])){
$serial=$_GET["id"];

		$sql="select * from users where serial =$serial";
}
else
	$sql="select * from users";

		$data=$db->getData($sql);

		header("Content-type:application/json"); 		
		echo json_encode($data);
	

?>