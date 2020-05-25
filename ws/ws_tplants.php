<?php
session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];
	include('../pages/configdb.php');

	//request insert transaction	
	if($action == 1)
	{
	
		$ref=$_GET['ref'];
		$scientic=$_GET['scientic'];
		$common=$_GET['common'];
		$location1=$_GET['location1'];
		$luminosity=$_GET['luminosity'];
		$hardiness=$_GET['hardiness'];
		$growthhabit=$_GET['growthhabit'];
		$density=$_GET['density'];
		$color=$_GET['color'];
		$color1=$_GET['color1'];
		$tolerance=$_GET['tolerance'];
		$resistance=$_GET['resistance'];
		$growthspeed=$_GET['growthspeed'];
		$dtolerance=$_GET['dtolerance'];
		$tolerance1=$_GET['tolerance1'];
		$total=$_GET['total'];
		$artificial=$_GET['artificial'];
		$maintenance=$_GET['maintenance'];
		$production=$_GET['production'];
		$availability=$_GET['availability'];
		$remarks=$_GET['remarks'];
		$tray=$_GET['tray'];
		$pot=$_GET['pot'];
		$color1 = mysqli_real_escape_string($dbc,$color1);
		$color = mysqli_real_escape_string($dbc,$color);
		$common = mysqli_real_escape_string($dbc,$common);
		$scientic = mysqli_real_escape_string($dbc,$scientic);
		$used=$_GET['used'];
		$country=$_GET['country'];
		$duplicate=$_GET['duplicate'];
		if($country!='')
		$country=implode(',', $country);

 
 
 
		$sql="Insert into plants (duplicate,country,nouse,ref,scientic,common,location1,luminosity,hardiness,growth,density,color,foliagecolor,
		spray,windresistance,growthspeed,tolerance,tolerance1,totalin,artificiallight,maintenanceneeds,
		production,availability1,remarks,tray,pot) values ('$duplicate','$country',$used,'$ref','$scientic','$common','$location1','$luminosity','$hardiness','$growthhabit','$density','$color','$color1',
		'$tolerance','$resistance','$growthspeed','$dtolerance','$tolerance1','$total','$artificial','$maintenance',
		'$production','$availability','$remarks','$tray','$pot')";
		 
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		if($duplicate != 0){
		$sql="select * from plantattachment where plantid=$duplicate";
		$db = new DAL();		
		$data1=$db->getData($sql);	
		for($i=0;$i<sizeof($data1);$i++){
			$sql="insert into plantattachment (description,plantid,url,userid) values ('".$data1[$i]['description']."','$data','".mysqli_real_escape_string($dbc,$data1[$i]['url'])."','".$_SESSION['UserSerial']."')";
			
			$db = new DAL();
			$data2=$db->ExecuteQuery($sql);	
		}
	}
		$sql="Update plantattachment  set plantid=$data where plantid=0 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);	


		$sql2="INSERT INTO `audit`(`description`, `dat`, `tableserial`, `tablename`, `userid`) VALUES 
		('New Plant has been Added','".date("Y-m-d")."','".$data."','Plants','".$_SESSION['UserSerial']."')";
		$db = new DAL();		
		$data2=$db->ExecuteQuery($sql2);	

		 

}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from plants where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);


	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$ref=$_GET['ref'];
		$scientic=$_GET['scientic'];
		$common=$_GET['common'];
		$location1=$_GET['location1'];
		$luminosity=$_GET['luminosity'];
		$hardiness=$_GET['hardiness'];
		$growthhabit=$_GET['growthhabit'];
		$density=$_GET['density'];
		$color=$_GET['color'];
		$color1=$_GET['color1'];
		$tolerance=$_GET['tolerance'];
		$resistance=$_GET['resistance'];
		$growthspeed=$_GET['growthspeed'];
		$dtolerance=$_GET['dtolerance'];
		$tolerance1=$_GET['tolerance1'];
		$total=$_GET['total'];
		$artificial=$_GET['artificial'];
		$maintenance=$_GET['maintenance'];
		$production=$_GET['production'];
		$availability=$_GET['availability'];
		$remarks=$_GET['remarks'];
		$tray=$_GET['tray'];
		$pot=$_GET['pot'];
		$country=$_GET['country'];
		if($country!='')
		$country=implode(',', $country);
		$used=$_GET['used'];
		$color1 = mysqli_real_escape_string($dbc,$color1);
		$color = mysqli_real_escape_string($dbc,$color);
			$common = mysqli_real_escape_string($dbc,$common);
		$scientic = mysqli_real_escape_string($dbc,$scientic);

	   
			 
			   	$sql=" UPDATE plants SET country='$country',nouse=$used,ref='$ref',scientic='$scientic',common='$common',location1='$location1',luminosity='$luminosity',hardiness='$hardiness',growth='$growthhabit',density='$density',color='$color',foliagecolor='$color1',
		spray='$tolerance',windresistance='$resistance',growthspeed='$growthspeed',tolerance='$dtolerance',tolerance1='$tolerance1',totalin='$total',artificiallight='$artificial',maintenanceneeds='$maintenance',
		production='$production',availability1='$availability',remarks='$remarks',tray='$tray',pot='$pot' where serial=$id";
  
  		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$data=1;
	 
 $sql2="INSERT INTO `audit`(`description`, `dat`, `tableserial`, `tablename`, `userid`) VALUES 
		('Plant has been Updated','".date("Y-m-d")."','".$id."','Plants','".$_SESSION['UserSerial']."')";
		$db = new DAL();		
		$data2=$db->ExecuteQuery($sql2);	
   
 

		}
	try {
    	
		
		if($action==1 || $action==3)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>