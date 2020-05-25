<?php
session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload.']); 

    return; 
}
$serial=0+$_POST['serial'];
// get the files posted
$images = $_FILES['images'];
// a flag to see if everything is ok
$success = null;
// file paths to store
$paths= [];

// get file names
$filenames = $images['name'];
$initialPreview=[];
if (!file_exists("../att/visits/regular/$serial")) {
		
    mkdir("../att/visits/regular/$serial", 0777, true);
}
// loop and process files
for($i=0; $i < count($filenames); $i++){
	
    $ext = explode('.', basename($filenames[$i]));
    $target = "../att/visits/regular/$serial/". basename($filenames[$i]);


$increment = ''; //start with no suffix
$basename=basename($filenames[$i]);
while(file_exists($target)) {
    $increment++;
	 $target = "../att/visits/regular/$serial/" . $ext[0].$increment.'.'.$ext[1];
	 $basename = $ext[0].$increment.'.'.$ext[1];
}


    if(move_uploaded_file($images['tmp_name'][$i], $target)) {
        $success = true;
        $paths[] = $basename;
		$initialPreview[]="../../att/visits/regular/$serial/".$basename;
    } else {
        $success = false;
        break;
    }
}

// check and process based on successful status 
if ($success === true) {
	$initialPreviewConfig=array();
	
   for($i=0; $i < count($paths); $i++){
 $serial=0+$_POST['serial'];
 $description = mysqli_real_escape_string($dbc,$paths[$i]);
 $sql="Insert into maintenanceattachement (description,maintenancedetailid,status,userid,isnew) values ('".$description."',$serial,'regular',".$_SESSION['UserSerial'].",1)";



	
	try {
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);	
		$d=[];
		$type=explode('.',$paths[$i]);
		$type=end($type);
		switch($type){
			case 'pdf':$d = array('type'=>'pdf','caption' => $paths[$i] ,'width' => '120px','url' => "../../ws/ws_deleteimage.php?id=$data&tablename=maintenanceattachement",'key' => $data,'downloadUrl'=> "../../att/visits/regular/$serial/". $paths[$i]);
			break;
			case 'mp4':$d = array('type'=>'video','filetype'=>'video/mp4','caption' => $paths[$i] ,'url' => "../../ws/ws_deleteimage.php?id=$data&tablename=maintenanceattachement",'key' => $data,'downloadUrl'=> "../../att/visits/regular/$serial/". $paths[$i],'filename'=> $paths[$i]);
			break;
			case 'MP4':$d = array('type'=>'video','filetype'=>'video/mp4','caption' => $paths[$i] ,'url' => "../../ws/ws_deleteimage.php?id=$data&tablename=maintenanceattachement",'key' => $data,'downloadUrl'=> "../../att/visits/regular/$serial/". $paths[$i],'filename'=> $paths[$i]);
			break;
default:$d = array('caption' => $paths[$i] ,'width' => '120px','url' => "../../ws/ws_deleteimage.php?id=$data&tablename=maintenanceattachement",'key' => $data,'downloadUrl'=> "../../att/visits/regular/$serial/". $paths[$i]);
	break;
		}
//$d = array('caption' => $paths[$i] ,'width' => '120px','url' => "./ws/ws_deleteimage.php?id=$data&tablename=ticketattachments",'key' => $data);
		$initialPreviewConfig[]=$d;
	}catch(Exception $e) {
	}
   }
   $output = ['initialPreviewConfig'=>$initialPreviewConfig,'initialPreview'=>$initialPreview];
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading images. Contact the system administrator'];
    // delete any uploaded files
    foreach ($paths as $file) {
        unlink($file);
    }
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);


?>