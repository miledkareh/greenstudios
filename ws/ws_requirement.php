<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET['action']))
$action=$_GET['action'];
if($action==1){
	$serial=$_GET['serial'];
	$sql=" select * from requirements where serial=".$serial;
}
else if($action==2){
	$id=$_GET['id'];
	if($id=='')
	$sql="select * from requirements";
	else
	$sql="select * from requirements where companyid=$id";
}
else{
	$id=$_GET['id'];
	if($id=='')
	$sql="select * from requirements";
	else{
		if(isset($_GET['project'])){
		$project=$_GET['project'];

			$sql="select * from requirements where companyid=$id and
			 if((select RG from offers where serial=$project)=1 && (select GW from offers where serial=$project)=1,(rg_checkbox=1 or gw_checkbox=1),
			 if((select RG from offers where serial=$project)=1,rg_checkbox=1,
			 if((select GW from offers where serial=$project)=1,gw_checkbox=1,'')))
			 ";
			// echo $sql;
		}else{
			$sql="select * from requirements where companyid=$id";	
		}
		}
	//$sql="select * from requirements where companyid=$id";
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