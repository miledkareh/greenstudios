 <?php  
$action=$_POST['action'];
$detail=$_POST['detail'];
 

 $con=mysqli_connect("localhost","root","","greenstudios");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }




  if($action==1){
    $sql="Delete from maintenancedetails where serial='".$detail."' ";
     $result = mysqli_query($con,$sql);


     $sql="Delete from checkin where visit='".$detail."' ";
     $result = mysqli_query($con,$sql);
        echo 1;

}
 

 
else echo "not in";
?>