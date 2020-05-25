<?php
session_start();
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');

	$val=1;
	
	$action=$_GET["action"];
	include('../pages/configdb.php');

	//request insert transaction	
	if($action == 1)
	{
	
		$palettename=$_GET['palettename'];
		$link=$_GET['link'];
		// if($country!='')
		// $country=implode(',', $country);

 
 
 
		$sql="INSERT INTO `palette`(`palettename`, `plants`) VALUES ('".$palettename."','".$link."')";
		 
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		 

		 

}//request delete transaction
 else 	if($action == 2)
	{
	
		$id=$_GET['id'];
	 
		 

        $sql="update palette set deleted=1 where serial='".$id."' ";
		 
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		 

		 

}//request delete transaction


 else 	if($action == 3)
	{
	
		$id=$_GET['id'];
		$ID=$_GET['ID'];
	 
		    $sql="select  plants from palette where serial='".$ID."' ";
		    $db = new DAL();	
		  $data=$db->getData($sql);
		  $p= implode($data[0],",");
		      $rep=	str_replace(",".$id,"",$p);
          $sql="update palette set plants='".$rep."' where serial='".$ID."' ";
		 
		$db = new DAL();		
		$data=$db->ExecuteQuery($sql);
		 

		 

}//request delete transaction
	try {
    	
		
		if($action==1 || $action==3)				
			echo $data;
		else 
			echo 1;
	}
	catch(Exception $e) {	
		echo 0;
	}
		
?>