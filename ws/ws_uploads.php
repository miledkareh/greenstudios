<?php
include('../pages/configdb.php');
$action=$_GET['x'];
if($action==1){
$query = "Select * from offerattachment where new=1";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	echo "hi";
	if (isset($x['path'])) {
	echo("hi");
		if (parse_url($x['path'], PHP_URL_SCHEME)) {
			
	$target_dir = "../att/".$x['status']."/".$x['offerid']."/";

	if (!file_exists($target_dir)) {
		
    mkdir($target_dir, 0777, true);
}
	$myFile=$x['path'];
	
$target_file = $target_dir . $x['description'];

if(copy('file://'.$x['path'],$target_file)){
	echo "D O N E";
}
	}
}
}
$query = "Update offerattachment set new=0";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
}

?>