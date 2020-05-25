<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
$_SESSION['timeout'] = time();
$action=$_GET['action'];
if($action==1){
	if(isset($_GET["serial"])){
	$serial=$_GET["serial"];
	
	$sql="select *,(select currency from offers where serial=invoicereport.project) as currency,(select symbol from currencies where serial in(select currency from offers where serial =invoicereport.project ))as currencyS from invoicereport where serial=$serial";

}
}
else if($action==2){
	if(isset($_GET["serial"])){
	$serial=$_GET["serial"];
		$group=$_GET["group"];
		$idol=$_GET["fidol"];
		$sql1="";
		$fidol="";
	if($group!=0)
	$sql1=" and group1=$group ";
	if($idol=='All')
	$fidol="";
	else if($idol==0)
	$fidol=" and idol=0";
	else if($idol==1)
	$fidol=" and idol=1";
	else {
		$fidol='';
	}

	$sql="select serial,priceusd,priceaed,pricekd,description,ddescription as ddesc,code,dimension,unit,(select description from itemsgroups where serial=items.group1)as groupdesc,(select color from itemsgroups where serial=items.group1)as color,(select symbol from currencies where serial in(select currency from offers where serial in (select project from invoicereport where serial=$serial)))as currencyS from items where serial <> 0 $sql1 $fidol order by group1,code,description ";

}
}

function clean($string) {
   // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		if($action==2){
			for($i=0;$i<sizeof($data);$i++){
				$data[$i]['description']=clean($data[$i]['description']);
				$data[$i]['ddesc']=clean($data[$i]['ddesc']);
			}}
		header("Content-type:application/json"); 		
		
		echo json_encode( $data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>