<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
$action=$_GET['action'];
if($action==1){
if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$sql="select * from offermaintenance where serial=$serial";
}
}
else if($action==2){
	$serial=$_GET["id"];
	$sql="Select *,(select projectname from offers where serial in (select project from invoicereport where serial =offermaintenance.invoiceid)) as projectname,(select symbol from currencies where serial=offermaintenance.currency) as currencyS From offermaintenance where invoiceid=$serial";
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