<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();

$_SESSION['timeout'] = time();
include('../pages/configdb.php');

	$sql="select * from maintenanceattachement where serial >= 114";
$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	echo "<br>";

	$dat= substr($x['description'],4,4)."-".substr($x['description'],8,2)."-".substr($x['description'],10,2);
	$sql="Update maintenanceattachement set dat='$dat' where serial=".$x['Serial'];
	$db = new DAL();		
	$data1=$db->ExecuteQuery($sql);
	
}
 
 echo "DONE";
/*$sql="select * from lumpsum where istaxprepare=1";
$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	$sql="select * from clientservices where clientid=".$x['serial']." and service=8 and type=1";
$result = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
if($y = mysqli_fetch_array($result)){}
else {
	$sql="Insert into clientservices (clientid,type,service,volume,userid)Values(".$x['serial'].",1,8,'Medium',8)";
	$db = new DAL();		
	$data1=$db->ExecuteQuery($sql);
	
}
	echo "Done LumpSum";
	
}
 * 
 */	
?>