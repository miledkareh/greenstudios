<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	include('../pages/configdb.php');
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
	
		$item= $_GET["item"];
		$total = $_GET["total"];
		$invoice=$_GET["invoice"];
		$quantity=$_GET["quantity"];
		$price=$_GET["price"];
		$sql="Insert into invoicedetail (price,update1,item,total,invoice,quantity) values ($price,1,$item,$total,$invoice,$quantity)";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from invoicedetail where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		$item= $_GET["item"];
		$total = $_GET["total"];
		$invoice=$_GET["invoice"];
		$quantity=$_GET["quantity"];
		$price=$_GET["price"];
		
		$sql=" UPDATE invoicedetail SET price=$price,update1=1,item=$item,total=$total,invoice=$invoice,quantity=$quantity where serial=$id";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="select sum(total) as stotal,(select currency from offers where serial in (select project from invoicereport where serial=$invoice)) as currency from invoicedetail where invoice=$invoice";
		$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
		if($x = mysqli_fetch_array($results)){}
		$amount=$x['stotal'];
		$date=date('Y-m-d');
	$query="select * from bource where FromCurrency =".$x['currency']." and ToCurrency =2 and Dat <='$date' order by serial desc Limit 1";
	$result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	if($y = mysqli_fetch_array($result)){
		 $amount = $amount* $y['ToAmount'] / $y['FromAmount'];
	}
		  $sql=" UPDATE offers SET valuecurrency=".$x['stotal'].",valueusd=$amount,offervalue=$amount where serial in (select project from invoicereport where serial=$invoice)";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
		else if ($action==4)
		{
		$data1=$_GET["data1"];
		$invoice=$_GET["invoice"];
		$total=0;
		for($i=0;$i<sizeof($data1);$i++){
			$total+=$data1[$i]['total'];
				$sql=" INSERT INTO invoicedetail (item,price,invoice,quantity,total,update1) values (".$data1[$i]['item'].",".$data1[$i]['price'].",$invoice,".$data1[$i]['quantity'].",".$data1[$i]['total'].",1)";
			$db = new DAL();
			$data=$db->ExecuteQuery($sql);
			}
			$sql="select sum(total) as stotal,(select currency from offers where serial in (select project from invoicereport where serial=$invoice)) as currency from invoicedetail where invoice=$invoice";
		$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
		if($x = mysqli_fetch_array($results)){}
		$amount=$x['stotal'];
		$date=date('Y-m-d');
	$query="select * from bource where FromCurrency =".$x['currency']." and ToCurrency =2 and Dat <='$date' order by serial desc Limit 1";
	$result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	if($y = mysqli_fetch_array($result)){
		 $amount = $amount* $y['ToAmount'] / $y['FromAmount'];
	}
		  $sql=" UPDATE offers SET valuecurrency=".$x['stotal'].",offervalue=$amount,valueusd=$amount  where serial in (select project from invoicereport where serial=$invoice)";
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