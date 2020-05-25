<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
if(isset($_GET["id"])){
	$serial=$_GET["id"];
	$action=$_GET['action'];
	if($action==1)
	$sql="select * from plantpot where serial=$serial";
	else if ($action==2)
	$sql="select *,".$_SESSION['ViewQuantity']." as ViewQuantity from plantpot where plantid=$serial order by country asc,type asc,dat asc";


	else if ($action==3)
	$sql="select *,(select description from taskstatus where serial=taskfollowup.status) as statusN,(select Fullname from users where serial=taskfollowup.userid) as userN from taskfollowup where taskid=$serial";
	else if($action==4)
	$sql="select *,(select description from taskstatus where serial=taskfollowup.status) as statusN from taskfollowup where serial=$serial";
	else if($action==5)
	$sql="select * from maintenancefollowup where serial=$serial";
	else if ($action==6)
	$sql="select *,(select Fullname from users where serial=maintenancefollowup.userid) as userN from maintenancefollowup where maintenanceid=$serial";
	else if ($action==7)
	$sql="select *,(select Fullname from users where serial=mfollowup.userid) as userN from mfollowup where maintenanceid=$serial";
	else if($action==8)
	$sql="select * from mfollowup where serial=$serial";
}

	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>