 <?php 
$ID=$_POST['ID'];
$workdone=$_POST['workdone'];
$water=$_POST['water'];
$mix=$_POST['mix'];
$ph=$_POST['ph'];
$nbofplants=$_POST['nbofplants'];
$sp1=$_POST['sp1'];
$sp2=$_POST['sp2'];
$fert=$_POST['fert'];
$endtime=$_POST['endtime'];
$strttime=$_POST['strttime'];
$comp=$_POST['comp'];
$pesticideschosen=$_POST['pesticideschosen'];
$zonesnamesend=$_POST['zonesnamesend'];

$galonsnb=$_POST['galonsnb'];


 $da=date("h");
  $da+=1;
 $dat=date("y-m-d");
 $mi=date("i:s");
 $gooddat=$dat." ".$da.":".$mi;
date_default_timezone_set("Asia/Beirut");

 
 if($sp2=="ON"||$sp2==" ON")$inj==1;else $inj==0;
 if($sp1=="Yes"||$sp1==" Yes")$alarm==1;
 else if($sp1=="No"||$sp1==" No")$alarm=0;
 else $alarm=-1;

 $con=mysqli_connect("localhost","root","djGj5DAzFChLpm","greenstudios");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }


   $sql=" UPDATE maintenancedetails SET work='".$workdone."' where Serial=$ID";
 $result = mysqli_query($con,$sql);	 
   


  $sql="select maintenanceid from maintenancedetails where Serial=$ID";
 $result = mysqli_query($con,$sql);	 
 $arr=mysqli_fetch_array($result);
 $mainID=$arr[0];

	
 
  $sql="UPDATE checkin SET  update1=1,checkout=1,checkoutdate='".date("Y-m-d h:i:s")."'  where visit=$ID";
      $result = mysqli_query($con,$sql);	


$stime=explode("P,P",$strttime);
$etime=explode("S,S",$endtime);
$z=explode("K,K",$zonesnamesend);
  


    


    for($i=0;$i<$comp;$i++){
 $sql="INSERT INTO `irrigationtime`( `dat`, `zone`, `starttime`, `endtime`, `maintenanceid`,maintenancedetail_id) VALUES ('".date("y-m-d")."','".$z[$i]."','".$stime[$i]."','".$etime[$i]."','".$mainID."','".$ID."')";
      $result = mysqli_query($con,$sql);	


}
  

 	//try{
$sql="INSERT INTO `readingm`(  `dat`, `ecclean`, `ecfertilized`, `plantnumber`, `ph`, `maintenanceid`, `injector`,fertelizedmix,alarm,maintenancedetail_id,nbplants,galonsnb) VALUES 
('".date("y-m-d")."','".$water."','".$mix."','".$nbofplants."','".$ph."','".$mainID."','".$inj."','".$fert."','".$alarm."','".$ID."','".$nbofplants."','".$galonsnb."')";
 $result = mysqli_query($con,$sql);


$sql="INSERT INTO `pesticide`( `dat`, `trade` , `maintenanceid`,maintenancedetail_id) VALUES ('".date("y-m-d")."','".$pesticideschosen."','".$mainID."','".$ID."')";
 $result = mysqli_query($con,$sql);
// /}

// catch(Exception $e) { 
//     echo -1;
//   }
 

  foreach(glob('C:/wamp/www/GreenStudios/att/visits/android/*.*') as $filename){
    
     


$path = $filename;
$file = basename($path);         // $file is set to "index.php"
$file = basename($path, ".php");

//echo $file.'<br>';

    rename($filename,'C:/wamp/www/GreenStudios/att/visits/'.$ID.'/'.$file);
  }

 echo 1;
 
 
 
?>