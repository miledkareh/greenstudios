<?php

$dbhandle = mysqli_connect("localhost","root","djGj5DAzFChLpm") 
  or die("Unable to connect to MySQL");
$selected = mysqli_select_db($dbhandle,"greenstudios") 
  or die("Could not select greenstudios");
date_default_timezone_set("Asia/Beirut");
?>