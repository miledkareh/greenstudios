<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{

	
		$company = $_GET["company"];
		$city = $_GET["city"];
		
		$street = $_GET["street"];
		$street = mysqli_real_escape_string($dbc,$street);
		
		$building=$_GET['building'];
		$building = mysqli_real_escape_string($dbc,$building);
		$floor=$_GET['floor'];
		$phone=$_GET['phone'];
		$website=$_GET['website'];
		$vat=$_GET['vat'];
		$address=$_GET['address'];
		$address = mysqli_real_escape_string($dbc,$address);
		$body1=$_GET['body1'];
		$body1 = mysqli_real_escape_string($dbc,$body1);
		$body2=$_GET['body2'];
		$body2 = mysqli_real_escape_string($dbc,$body2);
		$account=$_GET['account'];
		$accountNum=$_GET['accountNum'];
		$swift=$_GET['swift'];
		$swift = mysqli_real_escape_string($dbc,$swift);
		$ibanusd=$_GET['ibanusd'];
		$ibanusd = mysqli_real_escape_string($dbc,$ibanusd);
		$ibanlbp=$_GET['ibanlbp'];
		$ibanlbp = mysqli_real_escape_string($dbc,$ibanlbp);
		$ibaneuro=$_GET['ibaneuro'];
		$ibaneuro = mysqli_real_escape_string($dbc,$ibaneuro);
		$commercial=$_GET['commercial'];
		$commercial = mysqli_real_escape_string($dbc,$commercial);
		$bank=$_GET['bank'];
		$bank = mysqli_real_escape_string($dbc,$bank);
		$bankname=$_GET['bankname'];
		$bankname = mysqli_real_escape_string($dbc,$bankname);
		$bankaddress=$_GET['bankaddress'];
		$bankaddress = mysqli_real_escape_string($dbc,$bankaddress);
		$offerV=$_GET['offerV'];
		$warranty=$_GET['warranty'];
		
		
		$sql="Insert into genpar (update1,offerV,warranty,company,city,street,building,floor,phone,website,vat,accountname,address,body1,body2,accountnumber,swift,ibanusd,ibanlbp,ibaneuro,bank,bankname,bankaddress,commercialNum) values (1,'$offerV','$warranty','$company','$city','$street','$building','$floor','$phone','$website','$vat','$account','$address','$body1','$body2','$accountNum','$swift','$ibanusd','$ibanlbp','$ibaneuro','$bank','$bankname','$bankaddress','$commercial')";
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from genpar where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
			
			$company = $_GET["company"];
		$city = $_GET["city"];
		
		$street = $_GET["street"];
		$street = mysqli_real_escape_string($dbc,$street);
		
		$building=$_GET['building'];
		$building = mysqli_real_escape_string($dbc,$building);
		$floor=$_GET['floor'];
		$phone=$_GET['phone'];
		$website=$_GET['website'];
		$vat=$_GET['vat'];
		$address=$_GET['address'];
		$address = mysqli_real_escape_string($dbc,$address);
		$body1=$_GET['body1'];
		$body1 = mysqli_real_escape_string($dbc,$body1);
		$body2=$_GET['body2'];
		$body2 = mysqli_real_escape_string($dbc,$body2);
		$account=$_GET['account'];
		$accountNum=$_GET['accountNum'];
		$swift=$_GET['swift'];
		$swift = mysqli_real_escape_string($dbc,$swift);
		$ibanusd=$_GET['ibanusd'];
		$ibanusd = mysqli_real_escape_string($dbc,$ibanusd);
		$ibanlbp=$_GET['ibanlbp'];
		$ibanlbp = mysqli_real_escape_string($dbc,$ibanlbp);
		$ibaneuro=$_GET['ibaneuro'];
		$ibaneuro = mysqli_real_escape_string($dbc,$ibaneuro);
		$commercial=$_GET['commercial'];
		$commercial = mysqli_real_escape_string($dbc,$commercial);
		$bank=$_GET['bank'];
		$bank = mysqli_real_escape_string($dbc,$bank);
		$bankname=$_GET['bankname'];
		$bankname = mysqli_real_escape_string($dbc,$bankname);
		$bankaddress=$_GET['bankaddress'];
		$bankaddress = mysqli_real_escape_string($dbc,$bankaddress);
		$offerV=$_GET['offerV'];
		$warranty=$_GET['warranty'];
		
		
		$sql=" UPDATE genpar SET update1=1,offerV='$offerV',warranty='$warranty',company='$company',city='$city',street='$street',building='$building',floor='$floor',phone='$phone',website='$website',vat='$vat',accountname='$account',address='$address',body1='$body1',body2='$body2',accountnumber='$accountNum',swift='$swift',ibanusd='$ibanusd',ibanlbp='$ibanlbp',ibaneuro='$ibaneuro',bank='$bank',bankname='$bankname',bankaddress='$bankaddress',commercialNum='$commercial' where serial=$id";
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