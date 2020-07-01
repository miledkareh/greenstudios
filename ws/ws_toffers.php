<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
include('../pages/configdb.php');
	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{
		$cont='';

$windowwid=$_GET['windowwid'];
$doorwid=$_GET['doorwid'];
$doorhei=$_GET['doorhei'];
$windowhei=$_GET['windowhei'];
$specified=$_GET['specified'];



$toto=$_GET['toto'];
$jamb=$_GET['jamb'];


$rad=$_GET['rad'];
$windowsqte=$_GET['windowsqte'];
$doorsqte=$_GET['doorsqte'];
$width=$_GET['width'];
$height=$_GET['height'];



$buildupp=$_GET['buildupp'];
$interialqte=$_GET['interialqte'];
$exterialqte=$_GET['exterialqte'];
 

  
$stationnb=$_GET['stationnb'];
$caliber=$_GET['caliber'];
$emittertype=$_GET['emittertype'];
$elegationlines=$_GET['elegationlines'];
$emittersqte=$_GET['emittersqte'];
$flowsensors=$_GET['flowsensors'];

$subcontractor=$_GET['subcontractor'];

if($subcontractor!=-1)
{
		    $cont=implode(",",$subcontractor);
}



$image1=$_GET['image1'];
$image2=$_GET['image2'];
$image3=$_GET['image3'];
$image4=$_GET['image4'];
$image5=$_GET['image5'];
$image6=$_GET['image6'];
$image7=$_GET['image7'];
$image8=$_GET['image8'];
$image9=$_GET['image9'];
$image10=$_GET['image10'];
$image11=$_GET['image11'];
$image12=$_GET['image12'];
		$status= $_GET["status"];
$statusdate = $_GET["statusdate"];
$projectname = $_GET["projectname"];
$date= $_GET["date"];
$duedate = $_GET["duedate"];
$country = $_GET["country"];
$city = $_GET["city"];
$pe = $_GET["pe"];
  $client=0+ $_GET["client"];
  $clien=0+ $_GET["clien"];
  $consultant =0+ $_GET["consultant"];
  $architect =0+ $_GET["architect"];
  $larchitect =0+ $_GET["larchitect"];
  $contractor =0+ $_GET["contractor"];
  $maincontractor =0+ $_GET["maincontractor"];
  $maincontractorreferral =0+ $_GET["maincontractorreferral"];
  $refferal =0+ $_GET["refferal"];
$refferaln = $_GET["refferaln"];
$currency = $_GET["currency"];
$gw = $_GET["gw"];
$intt = $_GET["intt"];
$ext = $_GET["ext"];
  $area =0+ $_GET["areaa"];
$rg = $_GET["rg"];
  $rgarea =0+ $_GET["rgarea"];
$ls = $_GET["ls"];
  $lsarea =0+ $_GET["lsarea"];
$buildup = $_GET["buildup"];
$tsupport = $_GET["tsupport"];
$tstartdate = $_GET["tstartdate"];
$tenddate = $_GET["tenddate"];
$hpdate= $_GET["hpdate"];
$bddate= $_GET["bddate"];
$agentdate= $_GET["agentdate"];
$design = $_GET["design"];
$dstartdate = $_GET["dstartdate"];
$denddate = $_GET["denddate"];
$hprobability= $_GET["hprobability"];
$kdate = $_GET["kdate"];
$offerref = $_GET["offerref"];
  $offervalue = 0+$_GET["offervalue"];
  $offerremaining =0+ $_GET["offerremaining"];
$cancelreason = $_GET["cancelreason"];
$notes = $_GET["notes"];
$cost = $_GET["cost"];
$gross = $_GET["gross"];
$troom = $_GET["troom"];
$kickoffna = $_GET["kickoffna"];
  if($status=='INQUIRIES'){$offer1='a';}
    elseif($status=='IN HAND'){$offer1='b';}
    elseif($status=='OFFER'){$offer1='c';}
    elseif($status=='POTENTIAL'){$offer1='d';}
	elseif($status=='COMPLETED'){$offer1='e';}
	elseif($status=='CANCELED'){$offer1='f';}
	elseif($status=='ARCHIVED'){$offer1='g';}
	elseif($status=='SIGNED'){$offer1='h';}
	if($hprobability==1){$offer2=1;}
	else{$offer2=0;}
$today = $_GET["today"];
$dealer = $_GET["dealer"];
$bd = $_GET["bd"];
$valuecurrency=$_GET['valuecurrency'];


		$sql="Insert into offers (subcontractor,specified,doorwid,doorhei,windowwid,windowhei,jamb,toto,stationnb,caliber,emittertype,elegationlines,emittersqte,flowsensors,buildupp,interialqte,exterialqte,rad,windowsqte,doorsqte,width,height,valuecurrency,cost,gross,kickoffna,maincontractor,maincontractorreferral,currency,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12,hpdate,bddate,agentdate,update1,projectname,dat,duedate,customerid,userid,country,city,contact,consultantid,architectid,contractorid,";
                $sql = $sql."referral,gw,gwint,gwext,gwarea,rg,rgarea,techsupportstartdate,techsupportenddate,designstartdate,designenddate,kickoff,offerref,buildup,offervalue,";
               $sql= $sql."notes,referalnotes, ";
               $sql= $sql."landscapearchitect,clientrep,techsupport,design,cancelreason,ls,lsarea,hp,pe,remaining,LastUpdated,LastUser,Manuel,Image,order1,order2,dealer,bd,troom,status,statusdate) values ('".$cont."','".$specified."',$doorwid,$doorhei,$windowwid,$windowhei,$jamb,'$toto',$stationnb,$caliber,'$emittertype',$elegationlines,$emittersqte,$flowsensors,'$buildupp',$interialqte,$exterialqte,'".$rad."',$windowsqte,$doorsqte,$width,$height,$valuecurrency,$cost,$gross,$kickoffna,$maincontractor,$maincontractorreferral,$currency,'$image1','$image2','$image3','$image4','$image5','$image6','$image7','$image8','$image9','$image10','$image11','$image12','$hpdate','$bddate','$agentdate',1,'$projectname','$date','$duedate',$client,".$_SESSION['UserSerial'].",'$country','$city',";
		 $sql= $sql."'',$consultant,$architect,$contractor,$refferal,$gw,$intt,$ext,$area,$rg,$rgarea,'$tstartdate','$tenddate','$dstartdate','$denddate','$kdate','$offerref','$buildup',$offervalue,'$notes','$refferaln',";
		 $sql= $sql."$larchitect,$clien,$tsupport,$design,'$cancelreason',$ls,$lsarea,$hprobability,'$pe',$offerremaining,'$today',".$_SESSION['UserSerial'].",0,'','$offer1','$offer2',$dealer,$bd,'$troom','$status','$statusdate')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Update offerattachment set offerid=$data,isnew=0 where offerid=0 and isnew=1 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('New Offer added','offers',$data,".$_SESSION['UserSerial'].",'$today')";
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);
		
	//echo($sql);
		// $_SESSION['UserSerial']
		 
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from offers where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
$cont='';

 $windowwid=$_GET['windowwid'];
$doorwid=$_GET['doorwid'];
$doorhei=$_GET['doorhei'];
$windowhei=$_GET['windowhei'];


$toto=$_GET['toto'];
 $jamb=$_GET['jamb'];



$rad=$_GET['rad'];
$windowsqte=$_GET['windowsqte'];
$doorsqte=$_GET['doorsqte'];
$width=$_GET['width'];
$height=$_GET['height'];

$specified=$_GET['specified'];


$buildupp=$_GET['buildupp'];
$interialqte=$_GET['interialqte'];
$exterialqte=$_GET['exterialqte'];


$stationnb=$_GET['stationnb'];
$caliber=$_GET['caliber'];
$emittertype=$_GET['emittertype'];
$elegationlines=$_GET['elegationlines'];
$emittersqte=$_GET['emittersqte'];
$flowsensors=$_GET['flowsensors'];
$subcontractor=$_GET['subcontractor'];

if($subcontractor!=-1)
{
		    $cont=implode(",",$subcontractor);
}


		$id=$_GET["serial"];
		
 $status= $_GET["status"];
$statusdate = $_GET["statusdate"];
$image1=$_GET['image1'];
$image2=$_GET['image2'];
$image3=$_GET['image3'];
$image4=$_GET['image4'];
$image5=$_GET['image5'];
$image6=$_GET['image6'];
$image7=$_GET['image7'];
$image8=$_GET['image8'];
$image9=$_GET['image9'];
$image10=$_GET['image10'];
$image11=$_GET['image11'];
$image12=$_GET['image12'];
$projectname = $_GET["projectname"];
$date= $_GET["date"];
$duedate = $_GET["duedate"];
$country = $_GET["country"];
$city = $_GET["city"];
$pe = $_GET["pe"];
$kickoffna=$_GET['kickoffna'];
  $client=0+ $_GET["client"];
  $clien=0+ $_GET["clien"];
  $consultant =0+ $_GET["consultant"];
  $architect =0+ $_GET["architect"];
  $larchitect =0+ $_GET["larchitect"];
  $contractor =0+ $_GET["contractor"];
  $cost = $_GET["cost"];
$gross = $_GET["gross"];
  $maincontractor =0+ $_GET["maincontractor"];
  $maincontractorreferral =0+ $_GET["maincontractorreferral"];
  $refferal =0+ $_GET["refferal"];
$refferaln = $_GET["refferaln"];
$gw = $_GET["gw"];
$intt = $_GET["intt"];
$ext = $_GET["ext"];
  $area =0+ $_GET["areaa"];
$rg = $_GET["rg"];
  $rgarea =0+ $_GET["rgarea"];
$ls = $_GET["ls"];
  $lsarea =0+ $_GET["lsarea"];
$buildup = $_GET["buildup"];
$tsupport = $_GET["tsupport"];
$tstartdate = $_GET["tstartdate"];
$tenddate = $_GET["tenddate"];
$design = $_GET["design"];
$dstartdate = $_GET["dstartdate"];
$denddate = $_GET["denddate"];
$hprobability= $_GET["hprobability"];
$kdate = $_GET["kdate"];
$offerref = $_GET["offerref"];
  $offervalue = 0+$_GET["offervalue"];
  $offerremaining =0+ $_GET["offerremaining"];
$cancelreason = $_GET["cancelreason"];
$notes = $_GET["notes"];
$troom = $_GET["troom"];
   if($status=='INQUIRIES'){$offer1='a';}
    elseif($status=='IN HAND'){$offer1='b';}
    elseif($status=='OFFER'){$offer1='c';}
    elseif($status=='POTENTIAL'){$offer1='d';}
	elseif($status=='COMPLETED'){$offer1='e';}
	elseif($status=='CANCELED'){$offer1='f';}
	elseif($status=='ARCHIVED'){$offer1='g';}
	elseif($status=='SIGNED'){$offer1='h';}
	if($hprobability==1){$offer2=1;}
	else{$offer2=0;}
$today = $_GET["today"];
$dealer = $_GET["dealer"];
$bd = $_GET["bd"];
$hpdate= $_GET["hpdate"];
$bddate= $_GET["bddate"];
$agentdate= $_GET["agentdate"];
$currency = $_GET["currency"];
$newphoto=0;
$sql="select * from offers where serial =$id";
$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
if($x = mysqli_fetch_array($results)){
	if($image1 != $x['image1'] || $image2 != $x['image2'] || $image3 != $x['image3'] || $image4 != $x['image4'] || $image5 != $x['image5'] || $image6 != $x['image6'] || $image7 != $x['image7'] || $image8 != $x['image8'] || $image9 != $x['image9'] || $image10 != $x['image10'] || $image11 != $x['image11'] || $image12 != $x['image12'])
$newphoto=1;
}
$valuecurrency=$_GET['valuecurrency'];


 //stationnb,caliber,emittertype,elegationlines,emittersqte,flowsensors


		$sql=" UPDATE offers SET subcontractor='".$cont."', specified='".$specified."', doorwid='".$doorwid."',doorhei='".$doorhei."',windowwid='".$windowwid."',windowhei='".$windowhei."', jamb='".$jamb."', toto='".$toto."',stationnb='".$stationnb."',caliber='".$caliber."',emittertype='".$emittertype."',elegationlines='".$elegationlines."',emittersqte=$emittersqte,flowsensors=$flowsensors,buildupp='$buildupp',interialqte=$interialqte,exterialqte=$exterialqte,  rad='".$rad."',windowsqte='".$windowsqte."',doorsqte='".$doorsqte."',width=$width,height=$height, valuecurrency='".$valuecurrency."',cost=$cost,gross=$gross,kickoffna=$kickoffna,maincontractor=$maincontractor,maincontractorreferral=$maincontractorreferral,currency=$currency,image1='$image1',image2='$image2',image3='$image3',image4='$image4',image5='$image5',image6='$image6',image7='$image7',image8='$image8',image9='$image9',image10='$image10',image11='$image11',image12='$image12',hpdate='$hpdate',bddate='$bddate',agentdate='$agentdate',update1=1,projectname='$projectname',dat='$date',duedate='$duedate',customerid=$client,country='$country',city='$city',contact='',consultantid=$consultant,architectid=$architect,";
		$sql= $sql."contractorid=$contractor,referral=$refferal,gw=$gw,gwint=$intt,gwext=$ext,gwarea=$area,rg=$rg,rgarea=$rgarea,";
		$sql= $sql."techsupportstartdate='$tstartdate',techsupportenddate='$tenddate',designstartdate='$dstartdate',designenddate='$denddate',kickoff='$kdate',offerref='$offerref',buildup='$buildup',offervalue=$offervalue,";
		$sql= $sql."notes='$notes',referalnotes='$refferaln',";
		$sql= $sql."landscapearchitect=$larchitect,clientrep=$clien,techsupport=$tsupport,design=$design,cancelreason='$cancelreason',ls=$ls,lsarea=$lsarea,hp=$hprobability,pe='$pe',remaining=$offerremaining,LastUpdated='',LastUser='".$_SESSION['UserSerial']."',Manuel=0,Image='' ";
		$sql= $sql.",newphoto=$newphoto,order1='$offer1',order2='$offer2',LastUpdated='$today',dealer=$dealer,bd=$bd,troom='$troom',status='$status',statusdate='$statusdate',saved=0 where serial=$id";
		 
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);

		$sql=" Insert into audit (description,tablename,tableserial,userid,dat) values ('Offer Updated','offers',$id,".$_SESSION['UserSerial'].",'$today')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql=" Update offerattachment set attachementdate='$today',dat='$today',isnew=0 where offerid=$id and  isnew=1 and userid=".$_SESSION['UserSerial'];
		$db = new DAL();		
		$data1=$db->ExecuteQuery($sql);


// $zql="select * from invoicedetail where invoice in (select serial from invoicereport where project='".$id."')";
// $db = new DAL();		
// $data_zql=$db->getdata($zql);

// for ($k=0; $k < sizeof($data_zql); $k++) {

// if($currency=='3')
// 	$zql1="select pricekd as pricee,(pricekd*".$data_zql[$k]['quantity'].")as tot from items where serial=(select item from invoicedetail where serial='".$data_zql[$k]['serial']."')" ;
// else if($currency=='4')
// 	$zql1="select priceaed as pricee,(priceaed*".$data_zql[$k]['quantity'].")as tot from items where serial=(select item from invoicedetail where serial='".$data_zql[$k]['serial']."')" ;
// else 
// 	$zql1="select priceusd as pricee,(priceusd*".$data_zql[$k]['quantity'].")as tot from items where serial=(select item from invoicedetail where serial='".$data_zql[$k]['serial']."')" ;

// $db = new DAL();		
// $data_zql1=$db->getdata($zql1);



// 	  $zql2="update invoicedetail  set price='".$data_zql1[0]['pricee']."',total='".$data_zql1[0]['tot']."' where serial='".$data_zql[$k]['serial']."' ";
// 	$db = new DAL();		
// $data_zql2=$db->ExecuteQuery($zql2);

// }



		}
	else if ($action==4)
		{
		
		$sql="delete from offers where saved=1";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		$sql="Insert into offers (saved) values(1)";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
		else if ($action==5)
		{
		
		$sql="delete from offers where saved=1";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		}
	try {
    	
		
		if($action==1 || $action==4)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>