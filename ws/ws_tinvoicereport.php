<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
include('../pages/configdb.php');
	$val=1;
	$data=0;
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
$body3 = $_GET["body3"];
	$discount = $_GET["discount"];
		$company = $_GET["company"];
		$subject = $_GET["subject"];
		$subject = mysqli_real_escape_string($dbc,$subject);
		$requirement= $_GET["requirement"];
		$project = $_GET["project"];
		$including = $_GET["including"];
		$warranty=$_GET['warranty'];
		$delivery=$_GET['delivery'];
		$payment=$_GET['payment'];
		$paymentd=$_GET['paymentd'];
		$validity=$_GET['validity'];
		$proposal=$_GET['proposal'];
		$client=$_GET['client'];
		$rarea=$_GET['rarea'];
		$ritem=$_GET['ritem'];
		$offerdesc=$_GET['offerdesc'];
		$excluding=$_GET['excluding'];
		$excluding = mysqli_real_escape_string($dbc,$excluding);
		$notes=$_GET['notes'];
	$notes = mysqli_real_escape_string($dbc,$notes);
		$body1=$_GET['body1'];
		$body1 = mysqli_real_escape_string($dbc,$body1);
		$body2=$_GET['body2'];
		$body2 = mysqli_real_escape_string($dbc,$body2);
		$ispercentage=$_GET['ispercentage'];
		$mcode=$_GET['mcode'];
		$sql="Insert into invoicereport (body3,code,ritem,rarea,paymentdetails,offerdesc,clientid,ispercentage,discount,companyid,update1,excluding,notes,subject,requirement,project,including,userid,delivery,warranty,payment,validity,proposal,body1,body2) values ('".$body3."',$mcode,$ritem,$rarea,'$paymentd','$offerdesc',$client,$ispercentage,$discount,$company,1,'$excluding','$notes','$subject','$requirement',$project,'$including',".$_SESSION['UserSerial'].",'$delivery','$warranty','$payment','$validity','$proposal','$body1','$body2')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="Update offers set OfferRef='$proposal' where serial=$project";
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
$query = "Select * from offers where serial=$project";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){
	if($x['RG']==1)
	$sql="Insert into invoicearea (description,total,invoice) values ('RG',".$x['RGAREA'].",$data)";
	else if($x['GW']==1){
		if($x['INTGW']==1)
		$sql="Insert into invoicearea (description,total,invoice) values ('INDOOR',".$x['GWAREA'].",$data)";
		else if($x['EXTGW']==1)
			$sql="Insert into invoicearea (description,total,invoice) values ('GW OUTDOOR',".$x['GWAREA'].",$data)";
		else
		$sql="Insert into invoicearea (description,total,invoice) values ('GW',".$x['GWAREA'].",$data)";
	}
		
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
}
	
		
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from invoicereport where serial=$id";;
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="DELETE from invoicedetail where invoice=$id";;
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="DELETE from invoicearea where invoice=$id";;
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="DELETE from offermaintenance where invoiceid=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		//$sql="Update users set user_status=2 where user_id=$id";;
	
	}
	//update request
	else if ($action==3)
		{$body3=$_GET["body3"];
		$id=$_GET["serial"];
		$discount = $_GET["discount"];
			$company = $_GET["company"];
			$subject = $_GET["subject"];
		$subject = mysqli_real_escape_string($dbc,$subject);
		$requirement= $_GET["requirement"];
		$project = $_GET["project"];
		$including = $_GET["including"];
		$warranty=$_GET['warranty'];
		$delivery=$_GET['delivery'];
		$payment=$_GET['payment'];
		$validity=$_GET['validity'];
		$paymentd=$_GET['paymentd'];
		$rarea=$_GET['rarea'];
		$ritem=$_GET['ritem'];
		$proposal=$_GET['proposal'];
		$excluding=$_GET['excluding'];
		$client=$_GET['client'];
		$offerdesc=$_GET['offerdesc'];
		$excluding = mysqli_real_escape_string($dbc,$excluding);
		$notes=$_GET['notes'];
	$notes = mysqli_real_escape_string($dbc,$notes);
		$body1=$_GET['body1'];
		$body1 = mysqli_real_escape_string($dbc,$body1);
		$body2=$_GET['body2'];
		$body2 = mysqli_real_escape_string($dbc,$body2);
		$ispercentage=$_GET['ispercentage'];
		
		$query = "Select *,(select isnew from invoicereport where serial=$id) as isnew from offers where serial=$project";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){
	if($x['isnew']==1){
	if($x['RG']==1)
	$sql="Insert into invoicearea (description,total,invoice) values ('RG',".$x['RGAREA'].",$id)";
	else if($x['GW']==1){
		if($x['INTGW']==1)
		$sql="Insert into invoicearea (description,total,invoice) values ('INDOOR',".$x['GWAREA'].",$id)";
		else if($x['EXTGW']==1)
			$sql="Insert into invoicearea (description,total,invoice) values ('GW OUTDOOR',".$x['GWAREA'].",$id)";
		else
		$sql="Insert into invoicearea (description,total,invoice) values ('GW',".$x['GWAREA'].",$id)";
					}
	$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
	}
		
		
}
		$sql=" UPDATE invoicearea SET update1=1 where invoice=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" UPDATE invoicedetail SET update1=1 where invoice=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" UPDATE offermaintenance SET update1=1 where invoiceid=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" UPDATE invoicereport SET body3='".$body3."', isnew=0,rarea='$rarea',ritem='$ritem',paymentdetails='$paymentd',offerdesc='$offerdesc',clientid='$client',ispercentage='$ispercentage',discount='$discount',companyid='$company',update1=1,excluding='$excluding',notes='$notes',subject='$subject',requirement='$requirement',project='$project',including='$including',userid=".$_SESSION['UserSerial'].",validity='$validity',payment='$payment',delivery='$delivery',warranty='$warranty',proposal='$proposal',body1='$body1',body2='$body2' where serial=$id";
	
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
else if ($action==4)
		{
			$offer=$_GET['offer'];
			$client=$_GET['client'];
			$sql="Insert into invoicereport (userid,isnew,project,clientid) values (".$_SESSION['UserSerial'].",1,$offer,$client)";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
		else if ($action==5)
		{
			$sql="Delete from invoicereport where isnew=1 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
else if($action==6){
	$id=$_GET['id'];
	$query = "Select * from invoicereport where serial=$id";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){
			$sql="Insert into invoicereport (ritem,rarea,paymentdetails,offerdesc,clientid,ispercentage,discount,companyid,update1,excluding,notes,subject,requirement,project,including,userid,delivery,warranty,payment,validity,proposal,body1,body2) values 
			(".$x['ritem'].",".$x['rarea'].",'".$x['paymentdetails']."','".$x['offerdesc']."',".$x['clientid'].",".$x['ispercentage'].",".$x['discount'].",".$x['companyid'].",0,'".$x['excluding']."','".mysqli_real_escape_string($dbc,$x['notes'])."','".$x['subject']."','".$x['requirement']."',".$x['project'].",'".$x['including']."',".$_SESSION['UserSerial'].",'".$x['delivery']."','".$x['warranty']."','".$x['payment']."','".$x['validity']."','".$x['proposal']."','".$x['body1']."','".$x['body2']."')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);

		$query = "Select * from invoicedetail where invoice=$id";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	$sql="Insert into invoicedetail (price,update1,item,total,invoice,quantity) values (".$x['price'].",0,".$x['item'].",".$x['total'].",$data,".$x['quantity'].")";
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
		}
$query = "Select * from invoicearea where invoice=$id";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	$sql="Insert into invoicearea (description,total,invoice,update1) values ('".$x['description']."',".$x['total'].",$data,0)";
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
		}
		$query = "Select * from offermaintenance where invoiceid=$id";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	$sql="Insert into offermaintenance (update1,visits,currency,agreement,invoiceid,total,fees,email,phone,spotfees)values (0,'".$x['visits']."',".$x['currency'].",'".$x['agreement']."',$data,'".$x['total']."','".$x['fees']."','".$x['email']."','".$x['phone']."','".$x['spotfees']."')";
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
		}
		}
}
	try {
    	
		
		if($action==1 || $action==4 || $action==6)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>