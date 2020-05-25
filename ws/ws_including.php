<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if(isset($_GET['action']))
$action=$_GET['action'];
if($action==1){
	$serial=$_GET['serial'];
	$sql=" select * from including where serial=".$serial;
}
else{
	$id=$_GET['id'];
	if($id=='')
	$sql="select * from including";
	else{
		if(isset($_GET['project'])){
		$project=$_GET['project'];

			$sql="select * from including where companyid=$id and
			 if((select RG from offers where serial=$project)=1 && (select GW from offers where serial=$project)=1,(rg=1 or gw=1),
			 if((select RG from offers where serial=$project)=1,rg=1,
			 if((select GW from offers where serial=$project)=1,gw=1,'')))
			 ";
	
			}
			 else{
				$sql="select * from including where companyid=$id";
			 }
		}
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