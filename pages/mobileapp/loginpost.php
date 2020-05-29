 <?php
   $con=mysqli_connect("localhost","root","djGj5DAzFChLpm","greenstudios");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   
   $username = $_POST['username'];
   $password = $_POST['password'];
   $result = mysqli_query($con,"SELECT username,Serial,password,isadmin FROM users where 
   Username='$username' and Password='$password'");
   $row = mysqli_fetch_array($result);
    
$rowcount=mysqli_num_rows($result);
if($rowcount!=0)echo $row[1]."SSS".$row[3];
else echo 0;

    
   
   mysqli_close($con);
?>