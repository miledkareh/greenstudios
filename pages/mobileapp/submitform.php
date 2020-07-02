 <?php 
 $con=mysqli_connect("localhost","root","djGj5DAzFChLpm","greenstudios");

 if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
$ID=$_POST['ID'];

$workdone=$_POST['workdone'];
$water=$_POST['water'];
$mix=$_POST['mix'];// Firteliser
$ph=$_POST['ph'];// ph
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

 
 if($sp2=="ON"||$sp2==" ON")$inj=1;else $inj=0;
 if($sp1=="Yes"||$sp1==" Yes")$alarm=1;
 else if($sp1=="No"||$sp1==" No")$alarm=0;
 else $alarm=-1;

 
   $sql=" UPDATE maintenancedetails SET work='".$workdone."' where Serial=$ID";
 $result = mysqli_query($con,$sql);	 
   


  $sql="select maintenanceid from maintenancedetails where Serial=$ID";
 $result = mysqli_query($con,$sql);	 
 $arr=mysqli_fetch_array($result);
 $mainID=$arr[0];
 $sql="select offerid from maintenances where Serial=$mainID";
 $result = mysqli_query($con,$sql);	 
 $arr=mysqli_fetch_array($result);
 $offerid=$arr[0];
 $sql="select gwint,customerid,gwarea,rgarea from offers where serial=$offerid";
 $result = mysqli_query($con,$sql);	
 $arr=mysqli_fetch_array($result);
$GWINT=$arr[0];
$clientid=$arr[1];
$gwarea=$arr[2];
$rgarea=$arr[3];
  $sql="UPDATE checkin SET  update1=1,checkout=1,checkoutdate='".date("Y-m-d H:i:s")."',rate='3'  where visit=$ID";
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
$sql="select cost from servicescost where serial=1";
 $result = mysqli_query($con,$sql);	
 $arr=mysqli_fetch_array($result);
$cost=$arr[0];
$sql="INSERT INTO visitcost( clientid, projectid , maintenanceid,visitid,`serviceid`,cost) VALUES ($clientid,$offerid,$mainID,$ID,1,$cost)";
$result = mysqli_query($con,$sql);

$sql="select cost from servicescost where serial=8";
 $result = mysqli_query($con,$sql);	
 $arr=mysqli_fetch_array($result);
$cost=$arr[0];
$sql="INSERT INTO visitcost( clientid, projectid , maintenanceid,visitid,`serviceid`,cost) VALUES ($clientid,$offerid,$mainID,$ID,8,$cost)";
$result = mysqli_query($con,$sql);
$sql="select employees,(select checkindate from checkin where visit=$ID) as fromdate,(select checkoutdate from checkin where visit=$ID) as fromdate,(select cost from servicescost where serial=2) as cost from maintenancedetails where serial=$ID";
 $result = mysqli_query($con,$sql);	
 $arr=mysqli_fetch_array($result);
$employee=$arr[0];
$count=sizeof(explode(",",$employee));
$fromdate=$arr[1];
$todate=$arr[2];
$minutes = round(abs(strtotime($fromdate) - strtotime($todate)) / 60,2);
$cost=$count*$minutes*($arr[3]/60);
$sql="INSERT INTO visitcost( clientid, projectid , maintenanceid,visitid,`serviceid`,cost) VALUES ($clientid,$offerid,$mainID,$ID,2,$cost)";
$result = mysqli_query($con,$sql);
$service=0;
if($GWINT==1){
  $sql="select cost,(select nbplants from readingm where maintenancedetail_id=$ID) as nbplants from servicescost where serial=3";
  $service=3;
}else{
$sql="select cost,(select nbplants from readingm where maintenancedetail_id=$ID) as nbplants from servicescost where serial=4";
$service=4;
}
$result = mysqli_query($con,$sql);
$arr=mysqli_fetch_array($result);
$cost=$arr[1]*$arr[0];
$sql="INSERT INTO visitcost( clientid, projectid , maintenanceid,visitid,`serviceid`,cost) VALUES ($clientid,$offerid,$mainID,$ID,$service,$cost)";
$result = mysqli_query($con,$sql);
$sql="select fertelizedmix,(select cost from servicescost where serial=6) as cost5,(select cost from servicescost where serial=7) as cost20,galonsnb from readingm where maintenancedetail_id=$ID";
$result = mysqli_query($con,$sql);
$arr=mysqli_fetch_array($result);
$fertelizedmix=$arr[0];
$cost5=$arr[1];
$cost20=$arr[2];
if($fertelizedmix=='New Vaniperen 20L'){
  $cost=$cost20*$arr[3];
  $sql="INSERT INTO visitcost( clientid, projectid , maintenanceid,visitid,`serviceid`,cost) VALUES ($clientid,$offerid,$mainID,$ID,7,$cost)";
$result = mysqli_query($con,$sql);
}else if($fertelizedmix=='New Vaniperen 5L'){
  $cost=$cost5*$arr[3];
  $sql="INSERT INTO visitcost( clientid, projectid , maintenanceid,visitid,`serviceid`,cost) VALUES ($clientid,$offerid,$mainID,$ID,6,$cost)";
$result = mysqli_query($con,$sql);
}
$sql="select cost from servicescost where serial=5";
 $result = mysqli_query($con,$sql);	
 $arr=mysqli_fetch_array($result);
 if($gwarea>0)
$cost=$arr[0]*$gwarea;
else
$cost=$arr[0]*$rgarea;
$sql="INSERT INTO visitcost( clientid, projectid , maintenanceid,visitid,`serviceid`,cost) VALUES ($clientid,$offerid,$mainID,$ID,5,$cost)";
$result = mysqli_query($con,$sql);
  foreach(glob('C:/wamp/www/GreenStudios/att/visits/android/*.*') as $filename){
    
     


$path = $filename;
$file = basename($path);         // $file is set to "index.php"
$file = basename($path, ".php");

//echo $file.'<br>';

    rename($filename,'C:/wamp/www/GreenStudios/att/visits/'.$ID.'/'.$file);
  }

 echo 1;
 
 
 
?>