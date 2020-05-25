<?php
//upload.php

if($_FILES["file"]["name"] != '')
{


 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = $test[0]. '.' . $ext;
 $location = 'icons/' . $name;  
 $increment = ''; //start with no suffix
 
while(file_exists($location)) {
    $increment++;
	 $location = "icons/" . $test[0].$increment.'.'.$ext;
	  
}
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo  $location;
  
}
?>