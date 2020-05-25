<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{		
	$name = $_GET["name"];
		$username = $_GET["username"];
		$pwd = $_GET["psw"];
		$admin=$_GET["admin"];
			$hide=$_GET["hide"];
		$profile=$_GET["profile"];
		$country=$_GET["country"];
		$cost=$_GET["cost"];
		$complaint=$_GET["complaint"];
		$isemployee=$_GET["isemployee"];
$issupervisor = $_GET["issupervisor"];
$ViewQuantity = $_GET["ViewQuantity"];

		$sql="Insert into users (ViewQuantity,isemployee,update1,Fullname,username,password,isadmin,country,userprofile,hidevalues,cost,complaint,issupervisor) values ('$ViewQuantity',$isemployee,1,'$name','$username','$pwd',$admin,'$country',$profile,$hide,$cost,$complaint,$issupervisor)";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from users where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
	$name = $_GET["name"];
		$username = $_GET["username"];
		$pwd = $_GET["psw"];
		$admin=$_GET["admin"];
		$hide=$_GET["hide"];
		$profile=$_GET["profile"];
		$country=$_GET["country"];
		$cost=$_GET["cost"];
		$complaint=$_GET["complaint"];
		$isemployee=$_GET["isemployee"];
		$issupervisor=$_GET["issupervisor"];
		$ViewQuantity = $_GET["ViewQuantity"];
		$sql=" UPDATE users SET ViewQuantity='$ViewQuantity',issupervisor=$issupervisor, isemployee=$isemployee,update1=1,fullname='$name',username='$username',password='$pwd',isadmin=$admin,country='$country',userprofile=$profile,hidevalues=$hide,cost=$cost,complaint=$complaint where serial=$id";
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