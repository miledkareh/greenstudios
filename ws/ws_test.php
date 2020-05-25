<?php
// outputs e.g.  somefile.txt was last modified: December 29 2002 22:16:23.
include('../pages/configdb.php');
$query = "Select * from offerattachment where attachementdate is NULL and dat is NULL";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){

	$filename = '../att/'.$x['status'].'/'.$x['offerid'].'/'.$x['description'];
if (file_exists($filename)) {
  $date= date ("Y-m-d H:i:s.", filemtime($filename));
	
	$query1="Update offerattachment set attachementdate='$date',dat='$date',update1=1 where serial=".$x['serial'];
	$results1 = mysqli_query($dbhandle,$query1)  or die(mysqli_error());
}



}
?>