 <?php 
$proid=$_POST['project'];
$supid=$_POST['supervisor'];
$arr=$_POST['ar'];
$sess=$_POST['sess'];
 $da=date("h");
  $da+=1;
 $dat=date("y-m-d");
 $mi=date("i:s");
 $gooddat=$dat." ".$da.":".$mi;
date_default_timezone_set("Asia/Beirut");

	 $con=mysqli_connect("localhost","root","djGj5DAzFChLpm","greenstudios");
  

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }


if($proid==0){
	$pwork="";
   $result = mysqli_query($con,"SELECT * from offerzones where offerid in(select offerid from maintenances where Serial in(select maintenanceid from maintenancedetails WHERE Serial='".$supid."'))");
  while($row = mysqli_fetch_array($result)){
   $pwork.=$row['serial']."ZYZ".$row['description']."U,U";

  }
     echo $pwork;


}

else if($proid==-1){
 
  
     foreach(glob('../../att/visits/android/*.*') as $filename){
    
    $path = $filename;
$file = basename($path);         
$file = basename($path, ".php");


       rename($filename, '../'.$supid.'/'.$file);
  }

 
     echo 1;
 
}
 



	else{

 
   $sql="Insert into maintenancedetails (update1,userid,maintenanceid,employees,dat) values 
                                       (1,'".$supid."','".$proid."','".$arr."','".date("Y-m-d h:i:s")."')";
        $result = mysqli_query($con,$sql); 

 $visitID=mysqli_insert_id($con);
    

    
      $sql="INSERT INTO `checkin`(`visit`, `checkindate`, `userid`, `checkin`, `update1`, `dat`) VALUES ('".mysqli_insert_id($con)."','".date("Y-m-d h:i:s")."','".$sess."',1,1,'".date("Y-m-d h:i:s")."')";
      $result = mysqli_query($con,$sql);

  
   if (!file_exists('../../att/visits/'.$visitID)) {
    mkdir('../../att/visits/'.$visitID, 0777, true);
}
 
 echo 1;
 }
 
 
?>