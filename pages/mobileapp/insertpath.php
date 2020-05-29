 <?php 
$description=$_POST['description'];
$visitid=$_POST['visitid'];
 
$sess=$_POST['sess'];
 
date_default_timezone_set("Asia/Beirut");
 // $con=mysqli_connect("localhost","dsoflbne_dsoft","dsoft@123","dsoflbne_greenstudios");
 $con=mysqli_connect("localhost","root","djGj5DAzFChLpm","greenstudios");
   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

$path=explode("CVC",$description);

$sql="select serial from maintenancedetails where maintenanceid=$visitid order by (serial) DESC limit 1";
 
 $result = mysqli_query($con,$sql);	 
 $arr=mysqli_fetch_array($result);
 $mainID=$arr[0];
 
	 
for ($i=0; $i <sizeof($path); $i++) { 
  


  $sql="INSERT INTO `visitattachment`(`description`,  `visitid`, `dat`, `userid`) VALUES ('".$path[$i]."','".$visitid."','".date("Y-m-d")."','".$sess."')";
        $result = mysqli_query($con,$sql); 




	$sql1="insert into maintenanceattachement 
	(update1,description,maintenancedetailid,path,dat,status) values 
	(1,'".$path[$i]."','".$visitid."','','".date("Y-m-d")."','wip')";

			 $result = mysqli_query($con,$sql1); 




}
 
 

 
    

     
 
echo $mainID;
 
 
 
?>