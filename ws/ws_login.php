<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
session_start();
	if(isset($_GET['uname']) && isset($_GET['upwd']))
	{
	
		$db = new DAL();
			
		$username=$_GET['uname'];
		$password=$_GET['upwd'];
		
		
		$sql="select serial as id, fullname as name, password as pwd,admin from 
			  users where username='$username' and password='$password'" ;
		$data=$db->getData($sql);
		$_SESSION['IsAdmin']=$data[0]["admin"];

		header("Content-type:application/json"); 		
		echo json_encode($data);	
	}
	else
		echo "";
?>