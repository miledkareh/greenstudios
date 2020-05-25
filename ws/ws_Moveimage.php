<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

if (isset($_GET['id'])){
		$id=$_GET["id"];
	$tablename=$_GET['tablename'];
		try {
		$sql="select *  from $tablename where serial=$id";
		$db = new DAL();
		$data=$db->getData($sql);
		 

  
 $location ='../att/visits/wip/'.$data[0]['visitid'].'/'.$data[0]['description'];  
 $increment = ''; //start with no suffix
 
while(file_exists($location)) {
    $increment++;
	 $location = '../att/visits/wip/'.$data[0]['visitid'].'/'.$increment.$data[0]['description'];
	  
}


// 		$sql1="insert into maintenanceattachement (update1,description,maintenancedetailid,path,dat,status) values 
// 			(1,'".$increment.$data[0]['description']."','".$data[0]['visitid']."','','".date("Y-m-d")."','wip')";


// 		$db = new DAL();
// 		$data2=$db->ExecuteQuery($sql1);

// 		if (!file_exists('../att/visits/wip/'.$data[0]['visitid'])) {
//     mkdir('../att/visits/wip/'.$data[0]['visitid'], 0777, true);
// }


// rename('../att/visits/'.$data[0]['visitid'].'/'.$data[0]['description'], '../att/visits/wip/'.$data[0]['visitid'].'/'.$increment.$data[0]['description']);

		$sql2="delete from $tablename where serial=$id ";


		$db = new DAL();
		$data3=$db->ExecuteQuery($sql2);


	}
 catch(Exception $e) {	

	}
}

try {
    	echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
?>