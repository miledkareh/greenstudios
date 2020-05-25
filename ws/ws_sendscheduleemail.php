<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
	date_default_timezone_set('Asia/Beirut');
	$date= date('Y-m-d H:i:s') ;
	$message="";
	
	require '../PHPMailer/PHPMailerAutoload.php';
		 
	$description=$_POST['description'];
	$subject=$_POST['subject'];
	$email=$_POST['email'];
	$id=$_POST['id'];
	$description.="<br>Regards,<br>GreenStudios Team";
	//$description=$description."\n http://mx1.greenstudios.net:8181/greenstudios/pages/Maintenances/Transaction.php?x=".$id;
	
	  
	$mail = new PHPMailer(true);       
	$mail->isSMTP();
	$mail->Host = 'smtps.energybridge.net';
	$mail->Port       = 25;
	$mail->SMTPSecure = '';
	$mail->SMTPAuth   = false;
	$mail->Username = 'greenstudios\kmanja';
	$mail->Password = 'K@REN2018';

	$mail->From = 'support@greenstudios.net';
	$mail->FromName = 'Green Studios';
	if (strpos($email, ';') !== false) {
	$email=explode(";",$email);


	for($i=0;$i<sizeof($email);$i++){
	 $mail->AddAddress($email[$i]); 

	}
}else{
	$mail->AddAddress($email); 
}
	//$mail->AddAddress('Miled.elkareh@live.com');              
	//$mail->AddAddress('mkareh@dsoft-lb.com');
	//$mail->AddBCC('mkareh@dsoft-lb.com');        
	                              // Set email format to HTML
	$mail->Subject = $subject;



$mail->Body    = nl2br($description);
$mail->AltBody = nl2br($description);

try {

	if(!$mail->Send()) {
	
		$msg= 'Message could not be sent.';
		echo 0;
		exit;
	 }
	 else
	{ $msg= 'Message has been sent';
		$zzl="INSERT INTO `scheduleemails`(`appointmentid`, `emails`,`description`,dat) VALUES ('$id','".$email."','$description','$date')";
		$db = new DAL();		
			$data1=$db->ExecuteQuery($zzl);
		$zzl="Update appointments set sent=1 where serial=$id";
	$db = new DAL();		
		$data1=$db->ExecuteQuery($zzl);
	 echo 2;}

}catch (phpmailerException $e) {
	
	echo 0; //Pretty error messages from PHPMailer
  } catch (Exception $e) {
	
	echo 0; //Boring error messages from anything else!
  }


	
	

?>