<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
$_SESSION['timeout'] = time();
	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{

	
		$description = $_GET["description"];
		$offerid = $_GET["offerid"];
		$employee= $_GET["employee"];
		$viewer = $_GET["viewer"];
		$today = $_GET["today"];
		$department = $_GET["department"];
		$taskstatus = $_GET["taskstatus"];
		$subject = $_GET["subject"];
		$maintenanceid = $_GET["maintenanceid"];
		$sql="Insert into tasks (maintenanceid,subject,taskstatus,department,description,offerid,toemployee,viewer,dat,userid,seen,done) values ($maintenanceid,'$subject',$taskstatus,$department,'$description',$offerid,$employee,'$viewer','$today',".$_SESSION['UserSerial'].",0,0)";
		
		/*$sql1="Select *,(select projectname from offers where serial=$offerid) as projectname,(select fullname from employee where serial in (select employeeid from users where serial=".$_SESSION['UserSerial'].")) as sender from employee where serial in (select employeeid from users where serial=$employee)";
			$db = new DAL();
		$data=$db->getData($sql1);
		if($data[0]['email']!='')
		mail($data[0]['email'],"New Task :".$data[0]['projectname'],"Assigned by ".$data[0]['sender']." on $today - $description");
*/
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from tasks where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
			$serial = $_GET["serial"];
	$description = $_GET["description"];
		$offerid = $_GET["offerid"];
		$employee= $_GET["employee"];
		
		$viewer = $_GET["viewer"];
		$today = $_GET["today"];
		$taskstatus = $_GET["taskstatus"];
		$department = $_GET["department"];
		$subject = $_GET["subject"];
		$maintenanceid = $_GET["maintenanceid"];
		$sql=" Update tasks set maintenanceid=$maintenanceid,subject='$subject',department=$department,taskstatus=$taskstatus,description='$description',offerid=$offerid,toemployee=$employee,viewer='$viewer',dat='$today' where serial=$serial ";
		}
		else if ($action==4)
		{

		$offerid = $_GET["offerid"];
		
		$sql=" Update tasks set active=1 where offerid=$offerid ";
		}
		else if ($action==5)
		{
		
		$serial = $_GET["serial"];
		$status = $_GET["status"];
		$sql=" Update tasks set taskstatus=$status where serial=$serial ";
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