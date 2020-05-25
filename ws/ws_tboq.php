<?php
 session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];



	//request insert transaction	
	if($action == 1)
	{ 


		$gwwidth = $_GET["gwwidth"];
		$gwheight = $_GET["gwheight"];
		$gwarea = $_GET["gwarea"];
		$windowsqty = $_GET["windowsqty"];
		$windowswidth = $_GET["windowswidth"];
		$windowsheight = $_GET["windowsheight"];
		$windowsarea = $_GET["windowsarea"];


		$doorsqty = $_GET["doorsqty"];
		$doorswidth = $_GET["doorswidth"];
		$doorsheight = $_GET["doorsheight"];
		$doorsarea = $_GET["doorsarea"];
		$zonesqty = $_GET["zonesqty"];
		$pvcqty = $_GET["pvcqty"];


		$pvcclose = $_GET["pvcclose"];
		$pvcwater = $_GET["pvcwater"];
		$omegaqty = $_GET["omegaqty"];
		$omegascrews = $_GET["omegascrews"];

		$omegaanchors = $_GET["omegaanchors"];
		$omegawater = $_GET["omegawater"];
		$jambsqty = $_GET["jambsqty"];
		$jambsscrews = $_GET["jambsscrews"];
		$jambsanchors = $_GET["jambsanchors"];

		$jambswater = $_GET["jambswater"];

		$pipe = $_GET["pipe"];
		$gs = $_GET["gs"];
		$staples = $_GET["staples"];
		$lock = $_GET["lock"];
		$skin = $_GET["skin"];

		$emitters = $_GET["emitters"];
		$staplesqty = $_GET["staplesqty"];
		$gutterwalls = $_GET["gutterwalls"];
		$gutterwindows = $_GET["gutterwindows"];
		$gutterdoors = $_GET["gutterdoors"];
		$sensorssm150t = $_GET["sensorssm150t"];

		$microtype = $_GET["microtype"];
		$sensorsflow = $_GET["sensorsflow"];
		$microqty = $_GET["microqty"];

		$offer_ID = $_GET["offer_ID"];





		$modulus = $_GET["modulus"];
		$skinqty = $_GET["skinqty"];
		$skinadd = $_GET["skinadd"];
		$skintype = $_GET["skintype"];
		$skintype1 = $_GET["skintype1"];
		$staplespersqm = $_GET["staplespersqm"];

		$corners = $_GET["corners"];

		$pipesize = $_GET["pipesize"];

		$pcemitters = $_GET["pcemitters"];
		

 $elbow = $_GET["elbow"];
			$ball = $_GET["ball"];
			$adapter = $_GET["adapter"];


			$elbowqty = $_GET["elbowqty"];
			$ballqty = $_GET["ballqty"];
			$adapterqty = $_GET["adapterqty"];

			$plumbsys = $_GET["plumbsys"];

			$plumbsysqty = $_GET["plumbsysqty"];




$closetype = $_GET["closetype"];
$watertype = $_GET["watertype"];
$omegatype = $_GET["omegatype"];
$screwstype = $_GET["screwstype"];
$anchorstype = $_GET["anchorstype"];

$watersealanttype = $_GET["watersealanttype"];
$watersealant2type = $_GET["watersealant2type"];
$jambstype = $_GET["jambstype"];
$staplestype = $_GET["staplestype"];




			

	 
	  	$sql="INSERT INTO `boq`(closetype,watertype,omegatype,screwstype,anchorstype,watersealanttype,watersealant2type,jambstype,staplestype,plumbsysqty,plumbsys,`offer_id`, `gw_width`, `gw_height`, `gw_area`, `windows_width`, `windows_height`, `windows_area`, `windows_qty`, `doors_qty`, `doors_width`, `doors_height`, `doors_area`, `zonesqty`, `pvcqty`, `pvcclose`, `pvcwater`, `omegaqty`, `omegascrews`, `omegaanchors`, `omegawater`, `jambsqty`, `jambsscrews`, `jambsanchors`, `jambswater`, `pipe`, `gs`, `staples`, `lockk`, `skin`, `emitters`, `staplesqty`, `gutterwalls`, `gutterwindows`, `gutterdoors`, `sensorssm150t`, `microtype`, `sensorsflow`, `microqty`,


	  	modulus,skinqty,skinadd,skintype,skintype1,staplespersqm,corners,pipesize,pcemitters,elbow,ball,adapter,elbowqty,ballqty,adapterqty) 
		VALUES (
'".$closetype."','".$watertype."','".$omegatype."','".$screwstype."','".$anchorstype."','".$watersealanttype."','".$watersealant2type."','".$jambstype."','".$staplestype."',
		'".$plumbsysqty."','".$plumbsys."','".$offer_ID."','".$gwwidth."','".$gwheight."','".$gwarea."','".$windowswidth."','".$windowsheight."','".$windowsarea."','".$windowsqty."','".$doorsqty."','".$doorswidth."','".$doorsheight."','".$doorsarea."','".$zonesqty."','".$pvcqty."','".$pvcclose."','".$pvcwater."','".$omegaqty."','".$omegascrews."','".$omegaanchors."','".$omegawater."','".$jambsqty."','".$jambsscrews."','".$jambsanchors."','".$jambswater."','".$pipe."','".$gs."','".$staples."','".$lock."','".$skin."','".$emitters."','".$staplesqty."','".$gutterwalls."','".$gutterwindows."','".$gutterdoors."','".$sensorssm150t."','".$microtype."','".$sensorsflow."','".$microqty."',
		'".$modulus."','".$skinqty."','".$skinadd."','".$skintype."','".$skintype1."','".$staplespersqm."','".$corners."','".$pipesize."','".$pcemitters."','".$elbow."','".$ball."','".$adapter."','".$elbowqty."','".$ballqty."','".$adapterqty."')";
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		 
	}//request delete transaction
	else if ($action ==2)
	{
		$id=$_GET["id"];
		
		$sql="DELETE from boq where serial=$id";;
		//$sql="Update users set user_status=2 where user_id=$id";;
	$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
	}
	//update request
	else if ($action==3)
		{
		$id=$_GET["serial"];
		
	$corners = $_GET["corners"];

		$gwwidth = $_GET["gwwidth"];
		$gwheight = $_GET["gwheight"];
		$gwarea = $_GET["gwarea"];
		$windowsqty = $_GET["windowsqty"];
		$windowswidth = $_GET["windowswidth"];
		$windowsheight = $_GET["windowsheight"];
		$windowsarea = $_GET["windowsarea"];


		$doorsqty = $_GET["doorsqty"];
		$doorswidth = $_GET["doorswidth"];
		$doorsheight = $_GET["doorsheight"];
		$doorsarea = $_GET["doorsarea"];
		$zonesqty = $_GET["zonesqty"];
		$pvcqty = $_GET["pvcqty"];


		$pvcclose = $_GET["pvcclose"];
		$pvcwater = $_GET["pvcwater"];
		$omegaqty = $_GET["omegaqty"];
		$omegascrews = $_GET["omegascrews"];

		$omegaanchors = $_GET["omegaanchors"];
		$omegawater = $_GET["omegawater"];
		$jambsqty = $_GET["jambsqty"];
		$jambsscrews = $_GET["jambsscrews"];
		$jambsanchors = $_GET["jambsanchors"];

		$jambswater = $_GET["jambswater"];

		$pipe = $_GET["pipe"];
		$gs = $_GET["gs"];
		$staples = $_GET["staples"];
		$lock = $_GET["lock"];
		$skin = $_GET["skin"];

		$emitters = $_GET["emitters"];
		$staplesqty = $_GET["staplesqty"];
		$gutterwalls = $_GET["gutterwalls"];
		$gutterwindows = $_GET["gutterwindows"];
		$gutterdoors = $_GET["gutterdoors"];
		$sensorssm150t = $_GET["sensorssm150t"];

		$microtype = $_GET["microtype"];
		$sensorsflow = $_GET["sensorsflow"];
		$microqty = $_GET["microqty"];

		$offer_ID = $_GET["offer_ID"];





		$modulus = $_GET["modulus"];
		$skinqty = $_GET["skinqty"];
		$skinadd = $_GET["skinadd"];
		$skintype = $_GET["skintype"];
		$skintype1 = $_GET["skintype1"];
		$staplespersqm = $_GET["staplespersqm"];

		$pipesize = $_GET["pipesize"];


		$pcemitters = $_GET["pcemitters"];

			$elbow = $_GET["elbow"];
			$ball = $_GET["ball"];
			$adapter = $_GET["adapter"];


			$elbowqty = $_GET["elbowqty"];
			$ballqty = $_GET["ballqty"];
			$adapterqty = $_GET["adapterqty"];

	$plumbsys = $_GET["plumbsys"];

			$plumbsysqty = $_GET["plumbsysqty"];




			$closetype = $_GET["closetype"];
$watertype = $_GET["watertype"];
$omegatype = $_GET["omegatype"];
$screwstype = $_GET["screwstype"];
$anchorstype = $_GET["anchorstype"];

$watersealanttype = $_GET["watersealanttype"];
$watersealant2type = $_GET["watersealant2type"];
$jambstype = $_GET["jambstype"];
$staplestype = $_GET["staplestype"];


		$sql="update `boq` set 
closetype='".$closetype."',watertype='".$watertype."',omegatype='".$omegatype."',screwstype='".$screwstype."',anchorstype='".$anchorstype."',watersealanttype='".$watersealanttype."',watersealant2type='".$watersealant2type."',jambstype='".$jambstype."',staplestype='".$staplestype."',
		 `plumbsysqty`='".$plumbsysqty."',`plumbsys`='".$plumbsys."',`adapterqty`='".$adapterqty."',`ballqty`='".$ballqty."',`elbowqty`='".$elbowqty."', `adapter`='".$adapter."',`ball`='".$ball."',`elbow`='".$elbow."',`pcemitters`='".$pcemitters."',`pipesize`='".$pipesize."',`corners`='".$corners."',`gw_width`='".$gwwidth."', `gw_height`='".$gwheight."', `gw_area`='".$gwarea."', `windows_width`='".$windowswidth."', `windows_height`='".$windowsheight."', `windows_area`='".$windowsarea."', `windows_qty`='".$windowsqty."', `doors_qty`='".$doorsqty."', `doors_width`='".$doorswidth."', `doors_height`='".$doorsheight."', `doors_area`='".$doorsarea."', `zonesqty`='".$zonesqty."', `pvcqty`='".$pvcqty."', `pvcclose`='".$pvcclose."', `pvcwater`='".$pvcwater."', `omegaqty`='".$omegaqty."', `omegascrews`='".$omegascrews."', `omegaanchors`='".$omegaanchors."', `omegawater`='".$omegawater."', `jambsqty`='".$jambsqty."', `jambsscrews`='".$jambsscrews."', `jambsanchors`='".$jambsanchors."', `jambswater`='".$jambswater."', `pipe`='".$pipe."', `gs`='".$gs."', `staples`='".$staples."', `lockk`='".$lock."', `skin`='".$skin."', `emitters`='".$emitters."', `staplesqty`='".$staplesqty."', `gutterwalls`='".$gutterwalls."', `gutterwindows`='".$gutterwindows."', `gutterdoors`='".$gutterdoors."', `sensorssm150t`='".$sensorssm150t."', `microtype`='".$microtype."', `sensorsflow`='".$sensorsflow."', `microqty`='".$microqty."',
	  	    modulus='".$modulus."',skinqty='".$skinqty."',skinadd='".$skinadd."',skintype='".$skintype."',skintype1='".$skintype1."',staplespersqm='".$staplespersqm."'

	  	where serial='".$id."' ";


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