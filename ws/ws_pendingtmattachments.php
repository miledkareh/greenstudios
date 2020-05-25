<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
	$val=1;
	
	$action=$_GET["action"];
	//request insert transaction	
	if($action == 1)
	{
		 
	}//request delete transaction
	else if ($action ==2)
	{ 
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET['serial'];


		  $sql="select maintenancedetailid,description from maintenanceattachement where Serial='".$id."' ";
		 $db = new DAL();		
		$data1=$db->getData($sql);
		 
		    $sql="select maintenanceid from maintenancedetails where Serial='".$data1[0]['maintenancedetailid']."' ";
		 $db = new DAL();		
		$data=$db->getData($sql);

		$sql=" UPDATE maintenanceattachement SET approved=1 ,maintenanceid='".$data[0]['maintenanceid']."' where  Serial=$id";
		 $db = new DAL();		
		$data2=$db->ExecuteQuery($sql);



       $file_path = "../att/visits/wip/".$data1[0]['maintenancedetailid']."/".$data1[0]['description'];
        $file_path2 = "../att/wip/".$data1[0]['description'];    
copy($file_path,$file_path2);




		}
		else if ($action==4)
		{ 

		$id=$_GET['maintainancedetail_ID'];






		  $sql="select maintenancedetailid,description from maintenanceattachement where maintenancedetailid='".$id."' ";
		 $db = new DAL();		
		$data1=$db->getData($sql);

		for ($i=0; $i <sizeof($data1) ; $i++) { 
			 
		
		 
		      $sql="select maintenanceid from maintenancedetails where Serial='".$data1[$i]['maintenancedetailid']."' ";
		 $db = new DAL();		
		$data=$db->getData($sql);

		  $sql=" UPDATE maintenanceattachement SET approved=1 ,maintenanceid='".$data[0]['maintenanceid']."' where  maintenancedetailid=$id";
		 $db = new DAL();		
		$data2=$db->ExecuteQuery($sql);



       $file_path = "../att/visits/wip/".$data1[$i]['maintenancedetailid']."/".$data1[$i]['description'];
        $file_path2 = "../att/wip/".$data1[$i]['description'];    
copy($file_path,$file_path2);

}





		




		}
		else if ($action==5)
		{ 
		
		}
		else if ($action ==6)
	{ 
		$id=$_GET["id"];
		$sql="SELECT * from maintenanceattachement where serial=$id";
		$db = new DAL();		
		$data=$db->getData($sql);
	$img="../att/visits/".$data[0]['status']."/".$data[0]['maintenancedetailid']."/".$data[0]['description']; 
		//echo($img);
		unlink($img);
		$sql="DELETE from maintenanceattachement where serial=$id";;

	
	}
else if ($action==7)
		{ 
		}
		else if ($action==8)
		{
		 
		}
	try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
		if($action==1)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>