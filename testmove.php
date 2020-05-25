<?php  foreach(glob('C:/Users/user/Desktop/img/*.*') as $filename){
    
     


$path = $filename;
$file = basename($path);         // $file is set to "index.php"
$file = basename($path, ".php");

echo $file.'<br>';

    rename($filename, 'C:/Users/user/Desktop/img2/'.$file);
        }?>