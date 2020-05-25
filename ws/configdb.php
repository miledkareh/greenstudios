<?php

$dbhandlet = mysqli_connect("localhost","root","") 
  or die("Unable to connect to MySQL");
$selected = mysqli_select_db($dbhandle,"test") 
  or die("Could not select greenstudios");

?>