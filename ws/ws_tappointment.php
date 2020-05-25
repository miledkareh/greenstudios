<?php
session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	$title = $_GET['title'];
	$start = $_GET['start'];
	$end = $_GET['end'];
	$starttime=$_GET['starttime'];
	$endtime=$_GET['endtime'];
	$color = $_GET['color'];;
	$notes = $_GET['notes'];;
	$offer = $_GET['offer'];;
	$start = date('Y-m-d H:i:s', strtotime("$start $starttime"));
	$end = date('Y-m-d H:i:s', strtotime("$end $endtime"));
	
	$db = new DAL();
		    $sql ="select count(*) as cnt from appointments where ((start<='$start' and end>'$start') or ( start<'$end' and end>='$end'))and deleted='0000-00-00'";
		$data=$db->getData($sql);
		if($data[0]['cnt']>0){
			echo 1;
			
		}else{
			
	$client=0+$_GET['client'];
	

		$repeat = $_GET['repeat'];
	$base=0;
		if($repeat!=""){
	$date = $start;
	$date1 = $end;
	$end_date = $repeat;

  $date = date ("Y-m-d H:i:s", strtotime("+7 day", strtotime($date)));
				$date1 = date ("Y-m-d H:i:s", strtotime("+7 day", strtotime($date1)));
	while (strtotime($date) <= strtotime($end_date)) {
				$db = new DAL();	
	$sql = "INSERT INTO appointments(offer,notes,title, start, end, color,clientid,base,created,user,muser) values ($offer,'$notes','$title', '$date', '$date1', '$color',$client,$base,now(),".$_SESSION['UserSerial'].",".$_SESSION['UserSerial'].")";				
		$data=$db->ExecuteQuery($sql);
		if($base==0){$base=$data;}
				  $date = date ("Y-m-d H:i:s", strtotime("+7 day", strtotime($date)));
				$date1 = date ("Y-m-d H:i:s", strtotime("+7 day", strtotime($date1)));
	}
	}
	$sql = "INSERT INTO appointments(offer,notes,title, start, end, color,clientid,base,created,user,muser) values ('$offer','$notes','$title', '$start', '$end', '$color',$client,$base,now(),".$_SESSION['UserSerial'].",".$_SESSION['UserSerial'].")";				
		try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);			
			echo $data;
	}
	catch(Exception $e) {	
		echo 0;
	}
		}

	}//update request
	else if ($action==3)
		{
			$del=$_GET['del'];
			$id = $_GET['serial'];
			$base=0;
			
			if($del==1){
				$sql="update appointments set deleted=now(),muser=".$_SESSION['UserSerial']." where id=$id";
									if($all==1){
			
	$sql=$sql." or base=$id  ";	
	if($base>0){
	$sql=$sql." or base =$base or id =$base";	}	
		}
			
				try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);			
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
			
			}
			else{
	$title = $_GET['title'];
	if (strpos($title, '/') !== false) {
    $string = explode("/", $title);
		$title=$string[0];
}
	$color =$_GET['color'];
	$start = $_GET['start'];
	$end = $_GET['end'];
	$starttime = $_GET['starttime'];
	$endtime = $_GET['endtime'];
	$notes = $_GET['notes'];;
	$start = date('Y-m-d H:i:s', strtotime("$start $starttime"));
	$end = date('Y-m-d H:i:s', strtotime("$end $endtime"));
		$all = $_GET['all'];
		$offer = $_GET['offer'];;
	$db = new DAL();
		      $sql ="select count(*) as cnt from appointments where ((start<='$start' and end>'$start') or ( start<'$end' and end>='$end'))  and deleted='0000-00-00' and id<>$id";
		$data=$db->getData($sql);
		if($data[0]['cnt']>0){
			echo 0;
		}else{
	$client=0+$_GET['client'];
	
	
	$sql = "UPDATE appointments SET  offer=$offer,notes='$notes',title = '$title', color = '$color' ,start='$start' ,end='$end',clientid=$client,modified=now(),muser=".$_SESSION['UserSerial'];

	$sql =$sql." WHERE id = $id ";
		if($all==1){
					$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql = "UPDATE appointments SET  offer=$offer,notes='$notes',title = '$title', color = '$color',clientid=$client,modified=now(),muser=".$_SESSION['UserSerial'];
		$sql =$sql." WHERE id = $id or base=$id  ";	
	if($base>0){
	$sql=$sql." or base =$base or id =$base";	
		}		
		}
		
		
		
		
				try {
    	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);			
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		}
		}
		}
	
		
?>