<?php
header('Access-Control-Allow-Origin: *');
	require_once('../../ws/DAL.class.php');
if($_GET['y']==1){
if (isset($_FILES["imageToUpload1"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload1"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload1"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload1"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==2){
	if (isset($_FILES["imageToUpload2"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload2"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload2"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload2"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==3){
	if (isset($_FILES["imageToUpload3"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload3"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload3"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload3"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==4){
	if (isset($_FILES["imageToUpload4"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload4"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload4"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload4"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==5){
	if (isset($_FILES["imageToUpload5"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload5"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload5"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload5"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==6){
	if (isset($_FILES["imageToUpload6"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload6"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload6"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload6"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==7){
	if (isset($_FILES["imageToUpload7"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload7"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload7"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload7"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==8){
	if (isset($_FILES["imageToUpload8"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload8"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload8"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload8"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==9){
	if (isset($_FILES["imageToUpload9"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload9"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload9"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload9"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==10){
	if (isset($_FILES["imageToUpload10"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload10"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload10"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload10"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==11){
	if (isset($_FILES["imageToUpload11"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload11"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload11"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload11"]["tmp_name"][$i],$target_file)){
}

}
}
}
else if($_GET['y']==12){
	if (isset($_FILES["imageToUpload12"])) {
	$target_dir = "../../att/images/".$_GET['x']."/";
	if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
	$myFile=$_FILES["imageToUpload12"];
	$fileCount=count($myFile["name"]);
	for($i=0;$i<$fileCount;$i++)
	{
$target_file = $target_dir . basename($_FILES["imageToUpload12"]["name"][$i]);
if(move_uploaded_file($_FILES["imageToUpload12"]["tmp_name"][$i],$target_file)){
}

}
}
}
echo "<script>window.close();</script>";
?>