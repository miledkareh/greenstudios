<?php
session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];

$dt = new DateTime();

$dt->format('Y-m-d H:i');

if($action == 1)
	{
		$description = $_GET["name"];		
		$description = mysqli_real_escape_string($dbc,$description);
		$url=$_GET['url'];
		$offerid = $_GET["offerid"];
		$status = $_GET["status"];	
		$sql="Insert into offerattachment (description,path,save,offerid,userid,status) values ('$description','$url',0,$offerid,".$_SESSION['UserSerial'].",'$status')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('New Attachment added','offerattachment',$data,".$_SESSION['UserSerial'].",'$dt')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		$sql="SELECT * from offerattachment where serial=$id";
		$db = new DAL();		
		$data=$db->getData($sql);
	$img="../att/".$data[0]['status']."/".$data[0]['description']; 
		//echo($img);
		unlink($img);
		$sql="DELETE from offerattachment where serial=$id";;

	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$serial=$_GET['serial'];
		$offerid =$_GET["offerid"];
		$pvt = $_GET["privatee"];
		$main = $_GET["main"];
		$confidential=$_GET["confidential"];
		$today=$_GET['today'];
		$sql=" UPDATE offerattachment SET dat='$today',private=$pvt,main=$main,confidential=$confidential,update1=1,save=1,attachementdate='$today',isnew=0 where (userid=".$_SESSION['UserSerial']." and offerid=$offerid and isnew=1) or serial=$serial";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		//$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('Attachment Updated','offerattachment',$id,".$_SESSION['UserSerial'].",'$dt')";
		//$db = new DAL();		
		//$data=$db->ExecuteQuery($sql);
		}
		else if ($action==4)
		{
		include('../pages/configdb.php');
$query = "Select * From offerattachment where offerid=0 and userid=".$_SESSION['UserSerial'];
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
		//echo($img);
		unlink("../att/".$x['status']."/".$x['description']);
}
		$sql="DELETE from offerattachment where offerid=0 and userid=".$_SESSION['UserSerial'];
		}
			else if ($action==5)
		{
		$name =$_GET["name"];
		//ec$date =$_GET["date"];ho($img);
		unlink("../att/".$name);
		$sql="DELETE from offerattachment where description='$name'";;
		}
else if ($action==6)
		{
			$offerid=$_GET['offerid'];
		$sql="DELETE from offerattachment where offerid=$offerid and isnew=1 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}


/*
	//request insert transaction	
	if($action == 1)
	{
		$attachment = $_GET["attachment"];
		
		$array=split (",", $attachment); 	
		$pvt = $_GET["privatee"];
		$main = $_GET["main"];
		$offer =0+ $_GET["offerid"];
		$confidential=$_GET["confidential"];
		$status=$_GET["status"];
		$dat=$_GET['dat'];
		$db = new DAL();		
		$today=$_GET['today'];
		if(count($array)>1){
			for($i=1;$i<count($array);$i++){
				$sql="Insert into offerattachment (dat,description,private,offerid,path,main,confidential,update1,status,attachementdate) values ('$today','".$array[$i]."',$pvt,$offer,'',$main,$confidential,1,'$status','$dat')";
				$data=$db->ExecuteQuery($sql);
			}
		}
		$sql="Insert into offerattachment (dat,description,private,offerid,path,main,confidential,update1,status,attachementdate) values ('$today','".$array[0]."',$pvt,$offer,'',$main,$confidential,1,'$status','$dat')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('New Attachment added','offerattachment',$data,".$_SESSION['UserSerial'].",'$dt')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		$sql="SELECT * from offerattachment where serial=$id";
		$db = new DAL();		
		$data=$db->getData($sql);
	$img="../att/".$data[0]['status']."/".$data[0]['offerid']."/".$data[0]['description']; 
		//echo($img);
		unlink($img);
		$sql="DELETE from offerattachment where serial=$id";;

	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$attachment = $_GET["attachment"];
		$array=split (",", $attachment);  	
		$pvt = $_GET["privatee"];
		$offer =0+ $_GET["offerid"];
		$main = $_GET["main"];
		$confidential=$_GET["confidential"];
		$status=$_GET["status"];
		$dat=$_GET['dat'];
		$db = new DAL();		
		$today=$_GET['today'];
		if(count($array)>1){
			for($i=1;$i<count($array);$i++){
				$sql="Insert into offerattachment (dat,update1,description,private,offerid,path,main,confidential,status,attachementdate) values ('$today',1,'".$array[$i]."',$pvt,$offer,'',$main,$confidential,'$status','$dat')";
				$data=$db->ExecuteQuery($sql);
			}
		}
		
		$sql=" UPDATE offerattachment SET dat='$today',description='".$array[0]."',private=$pvt,offerid=$offer,main=$main,confidential=$confidential,update1=1,status='$status',attachementdate='$dat' where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('Attachment Updated','offerattachment',$id,".$_SESSION['UserSerial'].",'$dt')";
		}
 * 
 */
	try {
    	
		
		if($action==1)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>