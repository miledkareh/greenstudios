<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
	 
 //$sql="SELECT * FROM `items`where group1='14' order by idol asc,description";
$sql="SELECT * FROM `items` where group1=14 and code=500 ORDER BY idol ASC , description ASC";

$db = new DAL();		
$data=$db->getdata($sql);	
$nb=5000;
$first=0;
for ($i=0; $i <sizeof($data) ; $i++) {
	if($first==0){
		$sql1='update items set code='.$nb.' where serial='.$data[$i]['serial'].' ';
		$first=1;

	}
	else {
	$nb+=1;
	$sql1='update items set code='.$nb.' where serial='.$data[$i]['serial'].' ';
	  }

echo $sql1."<br>";
$db = new DAL();		
$data2=$db->ExecuteQuery($sql1);	
}
 
 
 
 
	try {
    	
		
		 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>