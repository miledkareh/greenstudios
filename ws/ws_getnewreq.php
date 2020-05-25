<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

 
$offerid=$_GET['offerid'];
$company=$_GET['company'];
 
 


 


	  $sql=" select * from requirements where  companyid='".$company."' 
	  and rg_checkbox=(select rg from offers where serial='".$offerid."') 
	  and gw_checkbox=(select gw from offers where serial='".$offerid."') " ;
 
 
 
	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>