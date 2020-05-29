 <?php  
$action=$_POST['action'];
$detail=$_POST['detail'];
$employee="00";

 $con=mysqli_connect("localhost","root","djGj5DAzFChLpm","greenstudios");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }




  if($action==1){
    $sql="select  maintenanceid from maintenancedetails where Serial='".$detail."'   ";
     $result = mysqli_query($con,$sql);
         $row1 = mysqli_fetch_array($result) ;

    
     $sql="select starttime,endtime from irrigationtime where accepted=1 and maintenanceid='".$row1[0]."'  order by serial ASC ";
       $result = mysqli_query($con,$sql);
        while( $row = mysqli_fetch_array($result))
       {  
        $employee=$row['starttime'].",".$row['endtime'];
        }
     echo $employee;

}
 

 
else echo "not in";
?>