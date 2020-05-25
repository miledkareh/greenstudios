<?php
header('Access-Control-Allow-Origin: *');
	require_once('../../ws/DAL.class.php');
if($_GET['y']==2){
if (isset($_FILES["fileToUpload"])) {
	$target_dir = "../../att/wip/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["fileToUpload"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==1){
	if (isset($_FILES["fileToUpload1"])) {
	$target_dir = "../../att/regular/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["fileToUpload1"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["fileToUpload1"]["name"][$i]);
if(move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"][$i],$target_file)){
}

}
}
}
echo "<script>window.close();</script>";
?>