<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

$action=$_GET['action'];
if($action==1){
if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$sql="select * from invoicedetail where serial=$serial";
}
}
else if($action==2){
	$serial=$_GET["id"];
	$sql="select *,(select description from items where serial =invoicedetail.item) as itemN from invoicedetail where invoice=$serial";
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