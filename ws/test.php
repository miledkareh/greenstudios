<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
include('../pages/configdb.php');

	$sql="select * from offers";
$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	
	$amount=$x['OfferValue'];
		$date=$x['Dat'];
	$query="select * from bource where FromCurrency =".$x['currency']." and ToCurrency =2 and Dat <='$date' order by serial desc Limit 1";
	$result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	if($y = mysqli_fetch_array($result)){
		 $amount = $amount* $y['ToAmount'] / $y['FromAmount'];
	}
		$sql=" UPDATE offers SET valueusd=$amount where serial=".$x['Serial'];
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);

	
}
 
 echo "DONE";

?>