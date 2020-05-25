<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();

$_SESSION['timeout'] = time();
include('../pages/configdb.php');

	$sql="select * from plantattachment where plantid >228 order by plantid asc";
$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
$serial= $x['plantid']-1;
	
$sql="Update plantattachment set plantid=$serial where plantid=".$x['plantid'];
$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
}
 
 echo "DONE";

?>