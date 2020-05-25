<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if (isset($_GET['id'])){
		$id=$_GET["id"];
		$page=$_GET["page"];
 $serial=0+$_GET['serial'];
 if($serial==0){
 $sql="Delete from $page  where serial=$id";}
 else{$sql="update $page set image1='' where serial=$id";}
	unlink('../../img/'.$_GET["name"]);
}

try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		if($action==1)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
?>