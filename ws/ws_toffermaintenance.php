<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$visits= $_GET["visits"];
		$currency = $_GET["currency"];
		$offerid = $_GET["offerid"];
		$agreement = $_GET["agreement"];
		$total = $_GET["total"];
		$fees = $_GET["fees"];
		$email = $_GET["email"];
		$phone = $_GET["phone"];
		$spotfees = $_GET["spotfees"];
		$sql="Insert into offermaintenance (update1,visits,currency,agreement,invoiceid,total,fees,email,phone,spotfees)values (1,'$visits',$currency,'$agreement',$offerid,'$total','$fees','$email','$phone','$spotfees')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from offermaintenance where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$visits= $_GET["visits"];
		$currency = $_GET["currency"];
		$offerid = $_GET["offerid"];
		$agreement = $_GET["agreement"];
		$total = $_GET["total"];
		$fees = $_GET["fees"];
		$email = $_GET["email"];
		$phone = $_GET["phone"];
		$spotfees = $_GET["spotfees"];
		$sql=" UPDATE offermaintenance SET spotfees='$spotfees',email='$email',phone='$phone',update1=1,visits='$visits',total='$total',invoiceid=$offerid,currency=$currency,agreement='$agreement',fees='$fees' where serial=$id";
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