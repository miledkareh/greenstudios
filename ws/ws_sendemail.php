<?php
header('Access-Control-Allow-Origin: *');
	require_once('DAL.class.php');
	error_reporting(E_ALL);
	date_default_timezone_set('Asia/Beirut');
	$date= date('Y-m-d') ;
	$message="";
	$checkindate=date('Y-m-d');
		   require '../PHPMailer/PHPMailerAutoload.php';
		 
	$description=$_GET['description'];
	$subject=$_GET['subject'];
	$email=$_GET['email'];
	$id=$_GET['id'];
	//$description=$description."\n http://mx1.greenstudios.net:8181/greenstudios/pages/Maintenances/Transaction.php?x=".$id;
	$sql="select 
	c.email as email from checkin as ch,
	maintenancedetails as md,maintenances as m,
	offers as o,
	customers as c 

	where ch.serial=$id and ch.visit=md.serial and md.maintenanceid=m.serial and m.offerid=o.serial and o.customerid=c.serial";
$db = new DAL(); 
$data=$db->getData($sql);

$qql="select maintenanceid from maintenancedetails where serial in (select visit from checkin where serial='".$id."' )";
$db = new DAL();		
$data2=$db->getData($qql);

	   $zzl="INSERT INTO `emails`(`maintenanceid`, `emails`) VALUES ('".$data2[0]['maintenanceid']."','".$email."')";
	$db = new DAL();		
		$data1=$db->ExecuteQuery($zzl);
	$mail = new PHPMailer(true);       
	$mail->isSMTP();
	$mail->Host = 'smtps.energybridge.net';
	$mail->Port       = 25;
	$mail->SMTPSecure = '';
	$mail->SMTPAuth   = true;
	$mail->Username = 'greenstudios\kmanja';
	$mail->Password = 'K@REN2018';

	$mail->From = 'support@greenstudios.net';
	$mail->FromName = 'Green Studios';
	$email=explode(";",$email);


	for($i=0;$i<sizeof($email);$i++){
	 $mail->AddAddress($email[$i]); 

	}
	$mail->AddAddress('Miled.elkareh@live.com');              
	//$mail->AddAddress('mkareh@dsoft-lb.com');
	//$mail->AddBCC('mkareh@dsoft-lb.com');        
	                              // Set email format to HTML
	$mail->Subject = $subject;

	require('../pages/fpdf/rotation.php');
	 
	
	class PDF extends PDF_Rotate
	{
		
		function convert_number_to_words($number) {
	
		$hyphen      = '-';
		$conjunction = ' And ';
		$separator   = ', ';
		$negative    = 'Negative ';
		$decimal     = ' Point ';
		$dictionary  = array(
			0                   => 'Zero',
			1                   => 'One',
			2                   => 'Two',
			3                   => 'Three',
			4                   => 'Four',
			5                   => 'Five',
			6                   => 'Six',
			7                   => 'Seven',
			8                   => 'Eight',
			9                   => 'Nine',
			10                  => 'Ten',
			11                  => 'Eleven',
			12                  => 'Twelve',
			13                  => 'Thirteen',
			14                  => 'Fourteen',
			15                  => 'Fifteen',
			16                  => 'Sixteen',
			17                  => 'Seventeen',
			18                  => 'Eighteen',
			19                  => 'Nineteen',
			20                  => 'Twenty',
			30                  => 'Thirty',
			40                  => 'Fourty',
			50                  => 'Fifty',
			60                  => 'Sixty',
			70                  => 'Seventy',
			80                  => 'Eighty',
			90                  => 'Ninety',
			100                 => 'Hundred',
			1000                => 'Thousand',
			1000000             => 'Million',
			1000000000          => 'Billion',
			1000000000000       => 'Trillion',
			1000000000000000    => 'Quadrillion',
			1000000000000000000 => 'Quintillion'
		);
	
		if (!is_numeric($number)) {
			return false;
		}
	
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}
	
		if ($number < 0) {
			return $negative . $this->convert_number_to_words(abs($number));
		}
	
		$string = $fraction = null;
	
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
	
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . $this->convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= $this->convert_number_to_words($remainder);
				}
				break;
		}
	
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
	
		return $string;
	}
		function Header()
	{
		
		$this->SetFont('Arial','B',12);
	$this->RotatedText(195,18,'G R E E N  S T U D I O S ',270);
	$this->SetFont('Arial','',5);
	$this->RotatedText(195,71,'L A N D S C A P E  T E C H N O L O G Y',270);
	$this->SetFont('Arial','',3);
	$this->RotatedText(195,111,'---------------------------------------------------------------------------------------------------------------------------------------------------------------
	------------------------------------------------------------------------------------------------------------------------------------------------------
	------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',270);
		include('../pages/configdb.php');
		$query = "Select * from genpar where country in (select country from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial in (select visit from checkin where serial=".$_GET['id'].")))) limit 1";
			//echo($_GET["to"]);
		 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		$data = array();
		if($x = mysqli_fetch_array($results)){
			
		$this->SetFont('Arial','',8);
		$this->SetTextColor(163,163,163);
		// Title
		$this->Cell(146,20,'',0,0,'L');
		$this->SetFont('Arial','',9);
		$this->SetTextColor(0,0,0);
		$this->Cell(29,20,$x['company'],0,0,'R');
		$this->Ln(4);
		$this->SetFont('Arial','',8);
		$this->Cell(175,20,$x['address'],0,0,'R');
		$this->Ln(3);
		$this->Cell(175,20,$x['street'],0,0,'R');
		$this->Ln(3);
		$this->Cell(175,20,$x['building'],0,0,'R');
		$this->Ln(3);
		$this->Cell(175,20,$x['floor'],0,0,'R');
		$this->Ln(3);
		$this->Cell(175,20,$x['city'],0,0,'R');
		$this->Ln(7);
		$this->Cell(175,20,$x['phone'],0,0,'R');
		$this->Ln(3);
		$this->Cell(175,20,$x['website'],0,0,'R');
		$this->Ln(18);
		
		}
	}
	function WordWrap(&$text, $maxwidth)
	{
		$text = trim($text);
		if ($text==='')
			return 0;
		$space = $this->GetStringWidth(' ');
		$lines = explode("\n", $text);
		$text = '';
		$count = 0;
	
		foreach ($lines as $line)
		{
			$words = preg_split('/ +/', $line);
			$width = 0;
	
			foreach ($words as $word)
			{
				$wordwidth = $this->GetStringWidth($word);
				if ($wordwidth > $maxwidth)
				{
					// Word is too long, we cut it
					for($i=0; $i<strlen($word); $i++)
					{
						$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
						if($width + $wordwidth <= $maxwidth)
						{
							$width += $wordwidth;
							$text .= substr($word, $i, 1);
						}
						else
						{
							$width = $wordwidth;
							$text = rtrim($text)."\n".substr($word, $i, 1);
							$count++;
						}
					}
				}
				elseif($width + $wordwidth <= $maxwidth)
				{
					$width += $wordwidth + $space;
					$text .= $word.' ';
				}
				else
				{
					$width = $wordwidth + $space;
					$text = rtrim($text)."\n".$word.' ';
					$count++;
				}
			}
			$text = rtrim($text)."\n";
			$count++;
		}
		$text = rtrim($text);
		return $count;
	}
	function Footer()
	{
		include('../pages/configdb.php');
		 $query = "Select dat from offers where Serial=".$_GET['id'];
			//echo($_GET["to"]);
		 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		$data = array();
		while($x = mysqli_fetch_array($results)){
			
		// Position at 1.5 cm from bottom
		$this->SetY(-28);
		// Arial italic 8
		$this->SetFont('Arial','',8);
		$newDate = date("d-m-Y", strtotime(date("Y/m/d")));
		$newDate=str_replace("-","  /  ",$newDate);
		$this->Cell(335,16,'--------------------------------------',0,0,'C');
		$this->Ln(4);
		$this->SetFont('Arial','',10);
		$this->Cell(335,20,$newDate,0,0,'C');
		$this->SetFont('Arial','',8);
		$this->RotatedText(159,277,'------------',270);
		$this->Ln(4);
		$this->Cell(335,22,'--------------------------------------',0,0,'C');
		// Page number
		}
		
	}
	function SetDash($black=null, $white=null)
		{
			if($black!==null)
				$s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
			else
				$s='[] 0 d';
			$this->_out($s);
		}
	function RotatedText($x,$y,$txt,$angle)
	{
		
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
	function ImprovedTable($header)
	{
		$budget=0;
		$total=0;
	 include('../pages/configdb.php');
	
	
		$query = "Select *,
		(select fullname from users where serial  in (select userid from maintenancedetails where serial=checkin.visit)) as user,
		 (select employees from maintenancedetails where serial=checkin.visit) as Employees,
		 (select fullname from mcontact where clientstatus='Contact' and maintenanceid in (select maintenanceid from maintenancedetails where serial=checkin.visit) limit 1) as contact,
		 (select fullname from mcontact where clientstatus='Company' and maintenanceid in (select maintenanceid from maintenancedetails where serial=checkin.visit) limit 1) as contact1,
		 (select mobile from mcontact where clientstatus='Contact' and  maintenanceid in (select maintenanceid from maintenancedetails where serial=checkin.visit) limit 1) as contactphone,
		 (select email from mcontact where clientstatus='Contact' and  maintenanceid in (select maintenanceid from maintenancedetails where serial=checkin.visit) limit 1) as contactemail,
		 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as fname,
		  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as lname,
		
		  (select company from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as company,
		
		  (select telephone from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as phone,
		
		(select email from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as email,
		
		(select notes from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as notes,
		(select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as title1,  
		(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as address1,
		(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit)))) as address2,
		(select projectname from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit))) as projectN,
		(select description from ptext where schedule=0 and location in (select country from offers where serial in (select offerid from maintenances where serial in (select maintenanceid from maintenancedetails where serial=checkin.visit))) limit 1) as body1,
		notes as feedback,
		TIMEDIFF(checkoutdate, checkindate) as time,
		(select work from maintenancedetails where serial= checkin.visit) as Work
		 from checkin 
		where serial=".$_GET['id'];
			//echo($_GET["to"]);
			
		 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		// echo $query;
		while($x = mysqli_fetch_array($results)){
		//	echo "ERROR";
		
			$this->SetTextColor(0,0,0);
			
			$this->SetXY(40, 56);
			$this->MultiCell(65,4,$x['contact1'],0,'L',0);
			$this->SetXY(15, 50);
			
			$this->Cell(25,16,'ATTENTION',0,0,'L');
			$this->SetTextColor(0,0,0);
			$this->SetXY(110, 56);
			$this->MultiCell(20,4,'PROJECT',0,'L',0);
			$this->SetTextColor(69,68,68);
			$this->SetXY(136, 56);
			$this->MultiCell(45,4,$x['projectN'],0,'L',0);
			$this->SetTextColor(0,0,0);
			
			$this->SetXY(15, 60);
			$this->Cell(25,16,'CONTACT',0,0,'L');
			$this->SetTextColor(0,0,0);
			$this->SetXY(40, 60);
			$this->Cell(25,16,$x['contact'],0,0,'L');
			$this->SetXY(40, 65);
			$this->Cell(25,16,$x['contactemail'],0,0,'L');
			$this->SetXY(40, 70);
			$this->Cell(25,16,$x['contactphone'],0,0,'L');
			$this->SetXY(110, 60);
			$this->Cell(25,16,'TITLE',0,0,'L');
			$this->SetTextColor(69,68,68);
			$this->SetXY(136, 66);
			$this->MultiCell(45,4,"Maintenance Visit Report",0,'L',0);
		
			$this->SetTextColor(0,0,0);
		
			$this->SetXY(15, 75);
			$this->Cell(25,16,'ADDRESS',0,0,'L');
			$this->SetTextColor(69,68,68);
			$this->SetXY(40, 81);
			$this->MultiCell(65,4,$x['address2'],0,'L',0);
			
			
			$this->SetXY(40, 95);
			$this->MultiCell(155,4,$x['body1'],0,'L',0);
			$this->SetXY(15, 125);
			$this->SetTextColor(0,0,0);
			 $this->SetFillColor(255, 255, 0);
			
			 
			$this->Cell(15,5,'Check IN',0,0,'L');
			
			$this->SetXY(40, 125);
			$this->SetTextColor(69,68,68);
			
		
				$this->Cell(25,5,$x['checkindate'],0,0,'L');
	$checkindate=$x['checkindate'];
			$this->SetXY(110, 125);
			
			$this->SetTextColor(0,0,0);
			$this->Cell(25,5,'Check OUT',0,0,'L');
			
			$this->SetXY(150, 125);
			$this->SetTextColor(69,68,68);
			if($x['checkout']==1)
				$this->Cell(25,5,$x['checkoutdate'],0,0,'L');
			else
			$this->Cell(25,5,"",0,0,'L');
			
			$this->SetXY(15, 135);
			$this->SetTextColor(0,0,0);
			$this->Cell(15,5,'Supervisor',0,0,'L');
			$this->SetXY(15, 142);
			$this->SetTextColor(0,0,0);
			$this->Cell(15,5,'Employees',0,0,'L');
				$employee1=$x['user'];
			$employee2='';
			$employee=explode(",", $x['Employees']);
			for($i=0;$i<sizeof($employee);$i++)
			{
				if($employee[$i] !='')
				{$sql="select fullname from users where serial=".$employee[$i]."";
				
				$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
		 while($y = mysqli_fetch_array($results)){
			 $employee2=$employee2.$y['fullname']."\n ";
		 }
		 }
			}
				
			$this->SetXY(110, 135);
			$this->SetTextColor(0,0,0);
			$this->Cell(25,5,'Time',0,0,'L');
			
			$this->SetXY(150, 135);
			$this->SetTextColor(69,68,68);
			if($x['checkout']==1)
				$this->Cell(25,5,$x['time'],0,0,'L');
			else
			$this->Cell(25,5,"",0,0,'L');
			$this->SetXY(40, 135);
			$this->SetTextColor(69,68,68);
			$this->MultiCell(40,5,$employee1,0,'L',0);
			$this->SetXY(40, 142);
			$this->SetTextColor(69,68,68);
			$employee2=ltrim($employee2, ', ');
			$this->MultiCell(40,5,$employee2,0,'L',0);
			 $this->Ln(5);
			 $this->SetX(15);
			$this->SetTextColor(0,0,0);
			$this->Cell(15,5,'Work Done',0,0,'L');
				$work1="";
			
			$work=explode(",", $x['Work']);
			for($i=0;$i<sizeof($work);$i++)
			{
				if($work[$i] !='')
				{$sql="select description from pwork where serial=".$work[$i]."";
				
				$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
		 while($y = mysqli_fetch_array($results)){
			 $this->SetTextColor(69,68,68);
			$this->SetX(40);
			$this->MultiCell(140,5,$y['description'],0,'L',0);
			$this->Ln(2);
		 }
		 }
			}
			
				
			
	
		 $this->SetTextColor(0,0,0);
			$this->Cell(109,18,"Rating",0,'L',0);
	  $this->SetFont('zapfdingbats','',25);
	   
		  if($x['rate']==0)
				$this->Cell(30,18,'I I I I I','','C');
		  else if($x['rate']==1){
			  $this->SetTextColor(255,255,0);
			  $this->Cell(7,18,'H','','C');
				  $this->SetTextColor(0,0,0);
			  $this->Cell(0,18,' I I I I','','C');
		  }	    
				
		  else if($x['rate']==2){
			  $this->SetTextColor(255,255,0);
					$this->Cell(18,18,'H H ','','C');
					$this->SetTextColor(0,0,0);
					$this->Cell(0,18,'I I I','','C');
		  } 
				
				else if($x['rate']==3){
					$this->SetTextColor(255,255,0);
					$this->Cell(27,18,'H H H ','','C');
					$this->SetTextColor(0,0,0);
					$this->Cell(0,18,'I I','','C');
				}    
				
				else if($x['rate']==4){  
				
					$this->SetTextColor(255,255,0);
					
					$this->Cell(37,18,'H H H H ','','C');
					$this->SetTextColor(0,0,0);
					$this->Cell(0,18,'I','','C');
				}
				else if($x['rate']==5){
					$this->SetTextColor(255,255,0);
				$this->Cell(12,18,'H H H H H','','C');
				$this->SetTextColor(0,0,0);
				}
		 
     $this->SetFont('Arial','',10);
	 $this->Ln(5);
	 	if($x['feedback']!=''){
	  $this->SetTextColor(0,0,0);
	  $this->Cell(5,5,"",0,'L',0);
		$this->MultiCell(23,5,"Client's FeedBack",0,'L',0);
		$this->Ln(-5);
		$this->Cell(30,5,"",0,'L',0);
		$this->SetTextColor(69,68,68);
		$this->MultiCell(55,5,$x['feedback'],0,'L',0);
			$this->Ln(5);
		}
		if($x['client']!=''){
	 $this->SetTextColor(0,0,0);
	  $this->Cell(5,5,"",0,'L',0);
		$this->MultiCell(23,5,"Client Name/Client Rep",0,'L',0);
		$this->Ln(-5);
		$this->Cell(30,5,"",0,'L',0);
		$this->SetTextColor(69,68,68);
		$this->MultiCell(20,5,$x['client'],0,'L',0);
			$this->Ln(5);
		}

		if($_GET['gsnote']!=''){
	$this->SetTextColor(0,0,0);
	  $this->Cell(5,5,"",0,'L',0);
		$this->MultiCell(23,5,"GS Feedback",0,'L',0);
		$this->Ln(-5);
		$this->Cell(30,5,"",0,'L',0);
		$this->SetTextColor(69,68,68);
		$this->MultiCell(55,5,$_GET['gsnote'],0,'L',0);
			$this->Ln(5);
		}
		
	$this->Cell(99,20,'',0,0,'L');
	$this->SetTextColor(69,68,68);
	$this->Cell(5,20,"Yours truly,",0,0,'L');
	
	$this->Ln(10);
	$this->Cell(9,16,'',0,0,'L');
	$this->Cell(90,20,"",0,0,'L');
	 $xx=$this->GetX();
		  $yy=$this->GetY();
//	$this->Image('../att/Signature.jpg',$xx,$yy+3,50,50);
	
	
		 $query = "select * from visitattachment where visitid =".$x['visit'];
		 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		 $t=0;
		 $count=0;
		 $page=0;
		 $count1=0;
		 $i= mysqli_num_rows($results);
		 if($i>0)
		 $this->AddPage();
		 $z=0;
		 $ff=$this->GetX();
		  $xx=$this->GetX();
		  $yy=$this->GetY();
		  $bb= $this->GetX();
		  $zz=$this->GetY();
		   $nbb=0;
		 while($y = mysqli_fetch_array($results)){
		
		if(file_exists('../att/visits/'.$y['visitid'].'/'.$y['description'])){
	
		  
		$nbb++;

	$data = getimagesize('../att/visits/'.$y['visitid'].'/'.$y['description']);
  $width = $data[0];
  $height = $data[1];


if($width>$height){

$percwidth=75/$width;
$percheight=$percwidth*$height;
$this->Image('../att/visits/'.$y['visitid'].'/'.$y['description'],$xx,$yy,75,$percheight);

}
else{


$percheight=75/$height;
$percwidth=$percheight*$width;
	$this->Image('../att/visits/'.$y['visitid'].'/'.$y['description'],$xx,$yy,$percwidth,75);

}

	 

	 	$count+=1;
	 	 $page+=1;
	 	 if($count==2){ 
	 	 	
	 	 	$yy=$yy+80;
	 	 	$xx=$ff;
			$count=0;
	 	 }else{
	 	 	$xx+=90;
	 	 }
	 	 if($page==6){
if($nbb!=$i){
	 	 	$this->AddPage();
	 	 	$xx=$bb;
	 	 	$yy=$zz;
	 	 	$page=0;
	 	 	}

	 	 }
 
		 }
		 }
		 $checkindate=$x['checkindate'];
			}
	
	
			
	}
	
	}
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	// Column headings
	$header = array('Trans #','Node','Member','Tag','Date In','Date Out','Time');
	// Data loading
	$pdf->SetFont('Arial','',9);
	$pdf->AddPage();
	$pdf->ImprovedTable($header);
	
	$date= date('Y-m-d') ;
	include('../pages/configdb.php');
	$query = "Select * from checkin 
		where serial=".$_GET['id'];
			//echo($_GET["to"]);
			
		 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		// echo $query;
		$x = mysqli_fetch_array($results);
		$date= date('Y-m-d',strtotime($x['checkindate'])) ;
$pdfdoc = $pdf->Output($date."-Maintenance report.pdf", "S");
$attachment = chunk_split(base64_encode($pdfdoc));
$description.="<br>Regards,<br>GreenStudios Team";
$mail->Body    = nl2br($description);
$mail->AltBody = nl2br($description);

$mail->addStringAttachment($pdfdoc, $date.'-Maintenance report.pdf');

try {

	if(!$mail->Send()) {
	
		echo $msg= 'Message could not be sent.';
		 echo 'Mailer Error: ' . $mail->ErrorInfo;
		echo 0;
		exit;
	 }
	 else
	{ $msg= 'Message has been sent';
		$zzl="Update checkin set sent=1 where serial=$id";
	$db = new DAL();		
		$data1=$db->ExecuteQuery($zzl);
	 echo 2;}

}catch (phpmailerException $e) {
	
	echo 0; //Pretty error messages from PHPMailer
	echo 'eror1';
	var_dump($e);
  } catch (Exception $e) {
	
	echo 'eror2';
	echo 0; //Boring error messages from anything else!
  }


	
	

?>