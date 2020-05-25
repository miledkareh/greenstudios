<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
		$alarm=$_GET["alarm"];
		$fertelizedmix=$_GET["fertelizedmix"];
		$dat= $_GET["dat"];
			$galonnn= $_GET["galonnn"];
		$ecclean = $_GET["ecclean"];
		$ecfertilized=$_GET["ecfertilized"];
		$ph=$_GET["ph"];
		$injector=$_GET["injector"];
		$nbplants=$_GET["nbplants"];
	
		$maintenance=$_GET["maintenance"];
		$sql="Insert into readingm (injector,maintenanceid,dat,ecclean,ecfertilized,ph,fertelizedmix,alarm,accepted,nbplants,galonsnb) values 
		($injector,$maintenance,'$dat','$ecclean','$ecfertilized','$ph','$fertelizedmix','$alarm',1,'".$nbplants."','".$galonnn."')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from readingm where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}

	
	//update request
	else if ($action==3)
		{
			$galonnn= $_GET["galonnn"];
			$fertelizedmix=$_GET["fertelizedmix"];
			$alarm=$_GET["alarm"];
		$id=$_GET["serial"];
		$dat= $_GET["dat"];
		$ecclean = $_GET["ecclean"];
		$ecfertilized=$_GET["ecfertilized"];
		$ph=$_GET["ph"];
	$injector=$_GET["injector"];
	$nbplants=$_GET["nbplants"];
		  $sql=" UPDATE readingm SET galonsnb='".$galonnn."',nbplants='".$nbplants."',alarm='$alarm',fertelizedmix='$fertelizedmix', injector=$injector,dat='$dat',ecclean='$ecclean',ecfertilized='$ecfertilized',ph='$ph' where serial=$id";
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