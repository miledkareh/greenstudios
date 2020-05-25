<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();

$_SESSION['timeout'] = time();
include('../pages/configdb.php');

	$sql="select * from offers where kickoffna=1";
$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
$kickoff = date('Y-m-d', strtotime("+3 months", strtotime($x['Dat'])));
	
	$sql="Update offers set kickoff='$kickoff' where serial=".$x['Serial'];
	$db = new DAL();		
	$data1=$db->ExecuteQuery($sql);
	
}
 $sql="select * from offers ";
$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
$dat = date('Y-m-d', strtotime("+7 days", strtotime($x['Dat'])));
	
	$sql="Update offers set duedate='$dat' where serial=".$x['Serial'];
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