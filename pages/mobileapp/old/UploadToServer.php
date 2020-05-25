<?php


  
 $con=mysqli_connect("localhost","root","","greenstudios");

  if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }





  $result="success";
  foreach ($_FILES["uploaded_file"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["uploaded_file"]["tmp_name"][$key];
        $name = $_FILES["uploaded_file"]["name"][$key];
$ext = end((explode(".", $name)));
    $file_path = "../../att/visits/android/";
        $file_path = $file_path . $name;
            if(@move_uploaded_file($tmp_name, $file_path)) 
            {
              if($ext=="txt"){
				  
				
$handle = fopen($file_path, "r");
if ($handle) {

  if (strpos($name, 'transactionslog') !== false) {
  

  //=================================== Transactions =====================================================

$count=0;

    while (($line = fgets($handle)) !== false) {
       
$piecess = explode("|", $line );

$station=$piecess[0];
$shiftid = explode(";", $piecess[1] )[8];



for($i=1;$i<sizeof($piecess);$i++){
	
$line=$piecess[$i];
$values = explode(";", $line );

$tserial=$values[0];
$ticket=$values[1];
$driverin=$values[2];
$car=$values[3];
//$indate=$values[4];
$driverout=$values[5];
//$outdate=$values[6];
$amount=$values[7];

$userid=0;


$phpdatein = strtotime( $values[4] );
$indate = date( 'Y-m-d H:i:s', $phpdatein );

$phpdateout = strtotime( $values[6] );
$outdate = date( 'Y-m-d H:i:s', $phpdateout );
//$inimages=$pieces[12].','.$pieces[13].','.$pieces[14].','.$pieces[15];
//$outimages=$pieces[16].','.$pieces[17].','.$pieces[18].','.$pieces[19];
	$strsql="delete from transactions where shiftid=$shiftid and station='$station' and stationserial=$tserial ";
mysqli_query($con,$strsql)  or die(mysqli_error());

$strsql="insert into transactions (TICKET,DRIVERIN,CAR,INDATE,DRIVEROUT,OUTDATE,AMOUNT,SHIFTID,USERID,STATION,stationserial) values ('$ticket','$driverin','$car','$indate','$driverout','$outdate',$amount,$shiftid,$userid,'$station',$tserial)";
mysqli_query($con,$strsql)  or die(mysqli_error());
$id=mysqli_insert_id($con);


}
$count++;
    }

}

 elseif (strpos($name, 'driverslog') !== false) {
	
	//================================================ Drivers ==========================================================
	
//	$count=0;

    while (($line = fgets($handle)) !== false) {
       
$piecess = explode("|", $line );

$station=$piecess[0];
$shiftid = explode(";", $piecess[1] )[2];



for($i=1;$i<sizeof($piecess);$i++){
	
$line=$piecess[$i];
$values = explode(";", $line );

$did=$values[0];
$drivername=$values[1];
//$driverdate=$values[4];

$phpdriverdate = strtotime( $values[4] );
$driverdate = date( 'Y-m-d H:i:s', $phpdriverdate );

$phpdriveroutdate = strtotime( $values[5] );
$driveroutdate = date( 'Y-m-d H:i:s', $phpdriveroutdate );

$strsql="delete from drivers where shiftid=$shiftid and station='$station' and stationserial=$did";
mysqli_query($con,$strsql)  or die(mysqli_error());

$strsql="insert into drivers (Name,SHIFTID,STATION,DAT,stationserial,outdate) values ('$drivername',$shiftid,'$station','$driverdate',$did,'$driveroutdate')";
mysqli_query($con,$strsql)  or die(mysqli_error());
$id=mysqli_insert_id($con);


}
//$count++;
    }
	
}

elseif (strpos($name, 'shiftslog') !== false) {
	
	
	
	//$count=0;

    while (($line = fgets($handle)) !== false) {
       
$piecess = explode("|", $line );

$station=$piecess[0];
//$shiftid = explode(";", $piecess[1] )[0];



for($i=1;$i<sizeof($piecess);$i++){
	
$line=$piecess[$i];
$values = explode(";", $line );
$shiftid=$values[0];
$openingdate=$values[1];
$closedate=$values[2];
$userid=$values[3];
$station=$values[4];
$chosendate=$values[5];
$photo=$values[7];


$phpdateopen = strtotime( $values[1] );
$opendt = date( 'Y-m-d H:i:s', $phpdateopen );

$phpdateclose = strtotime( $values[2] );
$closedt = date( 'Y-m-d H:i:s', $phpdateclose );

$phpdatechosen = strtotime( $values[5] );
$chosendt = date( 'Y-m-d H:i:s', $phpdatechosen );

$strsql="delete from shifts where shiftid=$shiftid and station='$station'";
mysqli_query($con,$strsql)  or die(mysqli_error());

$strsql="insert into shifts (OPENINGDATE,CLOSEDATE,USERID,STATION,datt,pic,shiftid) values ('$opendt','$closedt',$userid,'$station','$chosendt','$photo',$shiftid)";
mysqli_query($con,$strsql)  or die(mysqli_error());
$id=mysqli_insert_id($con);


}
//$count++;
    }
	
	
	
	
	
}
	
    fclose($handle);
	
	
} else {
    $result="fail";
} 



}
            } else{

                 $result="fail";
            }  
    }
}
echo $result;
 ?>