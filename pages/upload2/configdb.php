<?php

$dbhandle = mysqli_connect("localhost","root","") 
  or die("Unable to connect to MySQL");
$selected = mysqli_select_db($dbhandle,"auditax") 
  or die("Could not select auditax");

?>