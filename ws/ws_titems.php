<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$description= $_GET["description"];
		$ddescription = $_GET["ddescription"];
		$ddescription = mysqli_real_escape_string($dbc,$ddescription);
		$description = mysqli_real_escape_string($dbc,$description);
		$code=$_GET["code"];
		$unit=$_GET["unit"];
		$cat=$_GET["cat"];
		$ccode=$_GET["ccode"];
		$priceusd=$_GET["priceusd"];
		$pricekd=$_GET["pricekd"];
		$priceaed=$_GET["priceaed"];
		$group=$_GET["group"];
		$idol=$_GET["idol"];
		$dimension=$_GET["dimension"];
		$cost=$_GET["cost"];
		$usupplier=$_GET["usupplier"];
		$duplicate=$_GET["duplicate"];
		$dimension = mysqli_real_escape_string($dbc,$dimension);
		$currency=$_GET["currency"];
		$default1= $_GET["default1"];


	  	$sql="Insert into items (cat,cost,usupplier,idol,update1,description,ddescription,code,ccode,unit,group1,priceusd,dimension,currency,pricekd,priceaed,default1) values ('$cat',$cost,'$usupplier',$idol,1,'$description','$ddescription','$code','$ccode','$unit',$group,$priceusd,'$dimension',$currency,$pricekd,$priceaed,'".$default1."')";
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);	

		if($duplicate != 0){
			$sql="select * from itemattachment where itemid=$duplicate";
			$db = new DAL();		
			$data1=$db->getData($sql);	
			for($i=0;$i<sizeof($data1);$i++){
				$sql="insert into itemattachment (description,itemid,url,userid) values ('".$data1[$i]['description']."','$data','".mysqli_real_escape_string($dbc,$data1[$i]['url'])."','".$_SESSION['UserSerial']."')";
				
				$db = new DAL();
				$data2=$db->ExecuteQuery($sql);	
			}
			$sql="select * from itemquantity where itemid=$duplicate";
			$db = new DAL();		
			$data1=$db->getData($sql);	
			for($i=0;$i<sizeof($data1);$i++){
				$sql="insert into itemquantity (dat,itemid,size,qty) values ('".$data1[$i]['dat']."','$data','".$data1[$i]['size']."','".$data1[$i]['qty']."')";
				
				$db = new DAL();
				$data2=$db->ExecuteQuery($sql);	
			}
		}

		$sql="Update itemattachment  set itemid=$data where itemid=0 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);	
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from items where serial=$id";;
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);	
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$description= $_GET["description"];
		$ddescription = $_GET["ddescription"];
		$ddescription = mysqli_real_escape_string($dbc,$ddescription);
		$description = mysqli_real_escape_string($dbc,$description);
		$code=$_GET["code"];
		$unit=$_GET["unit"];
		$ccode=$_GET["ccode"];
		$priceusd=$_GET["priceusd"];
		$pricekd=$_GET["pricekd"];
		$priceaed=$_GET["priceaed"];
		$group=$_GET["group"];
		$dimension=$_GET["dimension"];
		$idol=$_GET["idol"];
		$cost=$_GET["cost"];
		$usupplier=$_GET["usupplier"];
		$dimension = mysqli_real_escape_string($dbc,$dimension);
		$currency=$_GET["currency"];


$cat=$_GET["cat"];
$default1= $_GET["default1"];


	  	$sql=" UPDATE items SET default1=$default1,cat='$cat',cost=$cost,usupplier='$usupplier',idol=$idol,currency=$currency,update1=1,description='$description',ddescription='$ddescription',code='$code',ccode='$ccode',group1=$group,dimension='$dimension',unit='$unit',priceusd=$priceusd,pricekd=$pricekd,priceaed=$priceaed where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);	
		}
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