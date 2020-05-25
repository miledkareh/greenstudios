<?php

// Connexion à la base de données
require_once('bdd.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

 $sql ="select count(*) as cnt from appointments where ((start<='$start' and end>'$start') or ( start<'$end' and end>='$end'))  and deleted='0000-00-00' and id<>$id";
	
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();
if($events[0]['cnt']>0){
	die ('Double');
}else{
	$sql = "UPDATE appointments SET  start = '$start', end = '$end',modified=now()";

	$sql =$sql." WHERE id = $id ";

	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}else{
		die ('OK');
	}

}}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
