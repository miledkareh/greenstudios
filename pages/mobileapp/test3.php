 <?php 
$action=$_POST['action'];


 $con=mysqli_connect("localhost","root","djGj5DAzFChLpm","greenstudios");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }


 




if($action==3){
   $employee="";
  $sql="SELECT Fullname,serial FROM `users` WHERE isemployee=1 and isadmin=0";
      $result = mysqli_query($con,$sql);
      while( $row = mysqli_fetch_array($result))
      {  $employee.=$row['Fullname'].",".$row['serial']."-";}
    echo $employee;

}

else if($action==2){
$proj="";
   $result = mysqli_query($con,"select offerid,Description,ProjectName,maintenances.serial as SERIAL from offers,maintenances where   offers.Serial=maintenances.offerId and Cancelled=0");
  while($row = mysqli_fetch_array($result)){
   $proj.=$row['ProjectName']." / ".$row['Description']."ZXC".$row['SERIAL']."!";

  }
     echo $proj;

}

else if($action==1){
$proj="";
$User=$_POST['userid'];
// $result=  mysqli_query($con,"select *,(select ProjectName from offers where  serial in (select offerId from maintenances where Serial= maintenancedetails.maintenanceid ))as ProjectName,(select checkout from checkin where visit=maintenancedetails.Serial and checkout=0 )as checkout,(select checkin from checkin where visit=maintenancedetails.Serial and checkin=1)as checkin, Employees From maintenancedetails   order by (select checkindate from checkin where visit=maintenancedetails.Serial) desc");
   


$result=mysqli_query($con,"select *,maintenancedetails.Serial as SERIAL from  checkin,maintenances,offers,maintenancedetails 
where  checkin.checkout=0
and offers.Serial=maintenances.offerId
and checkin.visit=maintenancedetails.Serial
and maintenances.Serial=maintenancedetails.maintenanceid
and checkin.UserId='".$User."' order by checkin.dat DESC ");


   while($row = mysqli_fetch_array($result)){
   $proj.=$row['ProjectName']."ZXC".$row['Serial']."/".$row['dat']."!".$row['SERIAL']."AZX!";

  }
     echo $proj;

}
else if($action==4){
$pwork="";
   $result = mysqli_query($con,"select * from   pwork where 1 order by order1 asc");
  while($row = mysqli_fetch_array($result)){
   $pwork.=$row['SERIAL']."X,X".$row['Description']."Y,Y".$row['img']."Z,Z";

  }
     echo $pwork;

}

else if($action==5){
$pwork="";
   $result = mysqli_query($con,"select Distinct (zone) from irrigationtime ");
  while($row = mysqli_fetch_array($result)){
   $pwork.=$row['zone']."U,U";

  }
     echo $pwork;

}


else if($action==6){
$pwork="";
   $result = mysqli_query($con,"select Distinct (trade) from allpesticide ");
  while($row = mysqli_fetch_array($result)){
   $pwork.=$row['trade']."U,U";

  }
     echo $pwork;

}


else if($action==7){
   $employee="";
  $sql="SELECT Fullname,serial FROM `users` WHERE issupervisor=1";
      $result = mysqli_query($con,$sql);
      while( $row = mysqli_fetch_array($result))
      {  $employee.=$row['Fullname'].",".$row['serial']."-";}
    echo $employee;

}
else if($action==8){
     $employee="";
  $sql="select *,maintenancedetails.Serial as SERIAL,ProjectName as NN from  checkin,maintenances,offers,maintenancedetails,users
where users.Serial=checkin.UserId and
  offers.Serial=maintenances.offerId
and checkin.visit=maintenancedetails.Serial
and maintenances.Serial=maintenancedetails.maintenanceid ORDER BY (checkin.Serial)DESC limit 20";
      $result = mysqli_query($con,$sql);
      while( $row = mysqli_fetch_array($result))
      {  $employee.=$row['NN']."SDSD!".$row['SERIAL']."ASAS!".$row['checkindate']."xcx!".$row['checkoutdate']."XDXD!".$row['Fullname']."ZZX!";}
    echo $employee;

}

 
else echo "not in";
?>