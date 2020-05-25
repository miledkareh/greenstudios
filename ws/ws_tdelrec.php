<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	include('../pages/configdb.php');
	 

 
		$id=$_GET["id"];
		
		$sql="select Serial from maintenancedetails where accepted=0 and maintenanceid='".$id."' ";
		 
	    $db = new DAL();		
		 
		$data=$db->getData($sql);


		$sql="DELETE from maintenancedetails where maintenanceid='".$id."' ";
		 
	    $db = new DAL();		
		$data1=$db->ExecuteQuery($sql);

for ($i=0; $i <sizeof($data) ; $i++) { 



  $sql="DELETE from checkin where visit='".$data[0]['Serial']."' ";
		 
 	    $db = new DAL();		
  		$data1=$db->ExecuteQuery($sql);

  		 $sql="DELETE from readingm where maintenancedetail_id='".$data[0]['Serial']."' ";
		 
 	    $db = new DAL();		
  		$data1=$db->ExecuteQuery($sql);




  		 $sql="DELETE from pesticide where maintenancedetail_id='".$data[0]['Serial']."' ";
		 
 	    $db = new DAL();		
  		$data1=$db->ExecuteQuery($sql);

  		 $sql="DELETE from irrigationtime where maintenancedetail_id='".$data[0]['Serial']."' ";
		 
 	    $db = new DAL();		
  		$data1=$db->ExecuteQuery($sql);



	
}



		// $sql="DELETE from invoicedetail where serial=$id";;
		 
	 //    $db = new DAL();		
		// $data=$db->ExecuteQuery($sql);
	 
		 
	try {
    	
		
		 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>