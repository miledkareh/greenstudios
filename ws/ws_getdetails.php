<?php
header('Access-Control-Allow-Origin: *');
require_once('DAL.class.php');
$action=$_GET["action"];
if($action==1){
$year=$_GET["year"];
	$year1='';
$country=$_GET["country"];
$country1='';
		if($year=="All")
			$year='';
		else{
			$year1=" and year(kickoff)='$year' ";
			$year=" and offerid in(select serial from offers where year(kickoff)='$year') ";}
		if($country=='All')
		$country='';
		else{$country1=" and country='$country' ";
			$country=" and offerid in( select serial from offers where country='$country')";}
		
			$sql="select (select sum(Valuee) from maintenances where status <> 'canceled' and offerid in (select serial from offers where RGAREA > 0 OR GWAREA >0)) as Valuee,
			(select sum(Valuee) from maintenances where status = 'canceled') as CValuee,
			(select sum(offervalue) From offers where serial in(select offerid from maintenances where status <> 'canceled')  $year1 $country1) as OfferValue,
			(select sum(offervalue) From offers where serial in(select offerid from maintenances where status = 'canceled')  $year1 $country1) as COfferValue,
			(select sum(offervalue) From offers where RGAREA >0 and serial in(select offerid from maintenances where status <> 'canceled')  $year1 $country1) as sRGoffer,
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where RGAREA>0 $year1 $country1)and status <> 'canceled') as sRGmaintenance, 
			 (select sum(offervalue) From offers where GWAREA >0  and serial in(select offerid from maintenances where status <> 'canceled') $year1 $country1) as sGWoffer,
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where GWAREA>0 $year1 $country1) and status <> 'canceled') as sGWmaintenance  
			 from maintenances where serial <>0 ".$year.$country;
}
else if($action==2){
$country=$_GET["country"];
	$fromdate=$_GET["fromdate"];
	$todate=$_GET["todate"];
		$fromdate1='';
	$todate1='';
	$country1='';
		if($fromdate=="")
			$fromdate='';
		else{
			$fromdate1=" and kickoff >= '$fromdate' ";
			$fromdate=" and offerid in(select serial from offers where kickoff >= '$fromdate') ";
			
		}
		if($todate=="")
			$todate='';
		else{
			$todate1=" and kickoff <= '$todate' ";
			$todate=" and offerid in(select serial from offers where kickoff <= '$todate') ";
		}
		if($country=='All')
		$country='';
		else{
			$country1=" and country='$country' ";
			$country=" and offerid in( select serial from offers where country='$country')";
		}
			$sql="select (select sum(Valuee) from maintenances where status <> 'canceled'  and offerid in (select serial from offers where RGAREA > 0 OR GWAREA >0) $fromdate $country $todate) as Valuee,
			(select sum(Valuee) from maintenances where status = 'canceled' $fromdate $country $todate) as CValuee,
			(select sum(offervalue) From offers where serial in(select offerid from maintenances where status <> 'canceled')  ".$fromdate1.$todate1.$country1.") as OfferValue,
			(select sum(offervalue) From offers where serial in(select offerid from maintenances where status = 'canceled')  ".$fromdate1.$todate1.$country1.") as COfferValue,
			(select sum(offervalue) From offers where RGAREA>0 and serial in(select offerid from maintenances where status <> 'canceled') ".$fromdate1.$todate1.$country1.") as sRGoffer,
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where RGAREA>0 ".$fromdate1.$todate1.$country1.") and status <> 'canceled') as sRGmaintenance, 
			  (select sum(offervalue) From offers where GWAREA>0 and serial in(select offerid from maintenances where status <> 'canceled') ".$fromdate1.$todate1.$country1.") as sGWoffer,
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where GWAREA>0 ".$fromdate1.$todate1.$country1.") and status <> 'canceled') as sGWmaintenance  
			 from maintenances where serial <>0 ".$fromdate.$todate.$country;

}
	else if($action==3){
$country=$_GET["country"];
	$city=$_GET['city'];
	$rg=$_GET['rg'];
	$gw=$_GET['gw'];
$fromdate=$_GET["fromdate"];
	$todate=$_GET["todate"];
		$fromdate1='';
	$todate1='';
	$country1='';
		if($fromdate=="")
			$fromdate='';
		else{
			$fromdate1=" and kickoff >= '$fromdate' ";
			$fromdate=" and offerid in(select serial from offers where kickoff >= '$fromdate') ";
			
		}
		if($todate=="")
			$todate='';
		else{
			$todate1=" and kickoff <= '$todate' ";
			$todate=" and offerid in(select serial from offers where kickoff <= '$todate') ";
		}
	$city1='';
		$rg1='';
		$gw1='';
		if($country=='All')
		$country='';
		else{
			$country1=" and country='$country' ";
			$country=" and offerid in( select serial from offers where country='$country')";
		}
		if($city=='All')
		$city='';
		else{
			$city1=" and city='$city' ";
			$city=" and offerid in( select serial from offers where city='$city')";
		}
		if($rg==1){
			$rg1=" and rg='$rg' ";
			$rg=" and offerid in( select serial from offers where rg=1)";}
			else
			$rg='';
			if($gw==1){
			$gw1=" and gw='$gw' ";
			$gw=" and offerid in( select serial from offers where gw=1)";}
			else
			$gw='';
			
			$sql="select (select sum(Valuee) from maintenances where status <> 'canceled' and offerid in (select serial from offers where RGAREA > 0 OR GWAREA >0)) as Valuee,
			(select sum(Valuee) from maintenances where status = 'canceled' and offerid in (select serial from offers where RGAREA > 0 OR GWAREA >0)) as CValuee,
			(select sum(offervalue) From offers where serial in(select offerid from maintenances where status <> 'canceled')  ".$city1.$gw1.$country1.$rg1.$fromdate1.$todate1.") as OfferValue,
			(select sum(offervalue) From offers where serial in(select offerid from maintenances where status = 'canceled')  ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as COfferValue,
			(select sum(offervalue) From offers where RGAREA >0 and serial in(select offerid from maintenances where status <> 'canceled') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sRGoffer,
			
			(select sum(offervalue) From offers where RGAREA >0 and serial in(select offerid from maintenances where status = 'active') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sRGactiveo,
			
			(select sum(offervalue) From offers where RGAREA >0 and serial in(select offerid from maintenances where status = 'free maintenance period') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sRGfreeo,
			
			(select sum(offervalue) From offers where GWAREA >0 and serial in(select offerid from maintenances where status = 'free maintenance period') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sGWfreeo,
			
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status <> 'canceled') as sRGmaintenance,
			
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status = 'free maintenance period') as sRGfreem, 
			
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status = 'canceled') as sRGcm,
			
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status = 'canceled') as sGWcm,
			
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status = 'free maintenance period') as sGWfreem, 
			
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status = 'active') as sRGactivem, 
			
			  (select sum(offervalue) From offers where GWAREA >0 and serial in(select offerid from maintenances where status <> 'canceled') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sGWoffer,
			  
			  (select sum(offervalue) From offers where GWAREA >0 and serial in(select offerid from maintenances where status = 'active') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sGWactiveo,
			  
			  (select sum(offervalue) From offers where GWAREA >0 and serial in(select offerid from maintenances where status = 'canceled') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sGWco,
			  
			  (select sum(offervalue) From offers where RGAREA >0 and serial in(select offerid from maintenances where status = 'canceled') ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") as sRGco,
			  
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status <> 'canceled') as sGWmaintenance,
			
			(select sum(Valuee) From maintenances where offerid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1.") and status = 'active') as sGWactivem ,
			(select sum(cost) from  visitcost where projectid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled')) as costrg,

(select sum(cost) from  visitcost where projectid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled' )and maintenanceid in(select serial from maintenances where status='active')) as costactiverg,

(select sum(cost) from  visitcost where projectid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled' )and maintenanceid in(select serial from maintenances where status='free maintenance period')) as costfrg,

(select sum(cost) from  visitcost where projectid in (select serial from offers where RGAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled' )and maintenanceid in(select serial from maintenances where status='canceled')) as costcrg,







(select sum(cost) from  visitcost where projectid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled')) as costgw,

(select sum(cost) from  visitcost where projectid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled' )and maintenanceid in(select serial from maintenances where status='active')) as costactivegw,

(select sum(cost) from  visitcost where projectid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled' )and maintenanceid in(select serial from maintenances where status='free maintenance period')) as costfgw,

(select sum(cost) from  visitcost where projectid in (select serial from offers where GWAREA>0 ".$city1.$rg1.$country1.$gw1.$fromdate1.$todate1." and status <> 'canceled' )and maintenanceid in(select serial from maintenances where status='canceled')) as costcgw,

(select sum(cost) from  visitcost where  maintenanceid in(select serial from maintenances where status='canceled')) as costc,

(select sum(cost) from  visitcost where  maintenanceid in(select serial from maintenances where status<>'canceled')) as costtotal

			 from maintenances where serial <>0 ".$country.$city.$rg.$gw.$fromdate.$todate;
			
}
	
	try {
		$db = new DAL();
		    
		$data=$db->getData($sql);
		
		header("Content-type:application/json"); 		
		
		echo json_encode($data);
			
	}catch(Exception $e) {
		echo 0;
	}

?>