<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
$db = new DAL();
$action=$_GET["action"];

$serial=$_GET["id"];
if($action==1){
		$sql="select * from notification where serial =$serial";
}
else
	{$sql="select * from notificationdetail where serial =$serial";}

		$data=$db->getData($sql);

		header("Content-type:application/json"); 		
		echo json_encode($data);
	

?>