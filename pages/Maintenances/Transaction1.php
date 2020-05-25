<?php

require('../fpdf/rotation.php');
 
  session_start();
  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
									if($_SESSION['ircv']!=1){
									header("Location: ../Blank");
								}

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
	include('../configdb.php');
	 $query = "Select * from genpar limit 1";
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
	include('../configdb.php');
	 $query = "Select dat from offers where Serial=".$_GET['x'];
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
 include('../configdb.php');


    $query = "Select *,(select fullname from users where serial =d.userid) as user,
    d.employees as Employees,
    					c.fname as fname,
    					
    					c.lname as lname,
    					c.company as company,
    					c.telephone as phone,
    					c.email as email,
    					c.notes as notes,
    					c.activity as title1,
    					c.country as address1,
    					c.city as address2,
    					o.projectname as projectN,
    					(select description from ptext limit 1) as body1,checkin.notes as feedback,TIMEDIFF(checkin.checkoutdate, checkin.checkindate) as time,d.work as Work 
    					 from checkin,customers as c,maintenances as m,maintenancedetails as d,offers as o where checkin.serial=".$_GET['x']." and d.serial=checkin.visit and m.serial=d.maintenanceid and o.serial=m.offerid and c.serial=o.customerid";
		//echo($_GET["to"]);
		
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	// echo $query;
	while($x = mysqli_fetch_array($results)){
	//	echo "ERROR";
		$this->SetTextColor(0,0,0);
		
		$this->SetXY(40, 56);
		$this->MultiCell(65,4,$x['company'],0,'L',0);
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
		$this->Cell(25,16,$x['fname']." ".$x['lname'],0,0,'L');
		$this->SetXY(40, 65);
		$this->Cell(25,16,$x['email'],0,0,'L');
		$this->SetXY(40, 70);
		$this->Cell(25,16,$x['phone'],0,0,'L');
		$this->SetXY(110, 60);
		$this->Cell(25,16,'TITLE',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetXY(136, 66);
		$this->MultiCell(45,4,$x['title1'],0,'L',0);
		 
		$this->SetTextColor(0,0,0);
		$this->SetXY(15, 80);
		$this->Cell(25,16,'SUBJECT',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetXY(40, 86);
		$this->MultiCell(65,4,"Maintenance Visit",0,'L',0);
		$this->SetTextColor(0,0,0);
	
		$this->SetXY(15, 90);
		$this->Cell(25,16,'ADDRESS',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetXY(40, 96);
		$this->MultiCell(65,4,$x['notes'],0,'L',0);
		
		
		$this->SetXY(40, 106);
		$this->MultiCell(160,4,$x['body1'],0,'L',0);
		$this->SetXY(15, 120);
		$this->SetTextColor(0,0,0);
		 $this->SetFillColor(255, 255, 0);
		
		 
		$this->Cell(15,5,'Check IN',0,0,'L');
		
		$this->SetXY(40, 120);
		$this->SetTextColor(69,68,68);
		
	
			$this->Cell(25,5,$x['checkindate'],0,0,'L');

		$this->SetXY(110, 120);
		
		$this->SetTextColor(0,0,0);
		$this->Cell(25,5,'Check OUT',0,0,'L');
		
		$this->SetXY(150, 120);
		$this->SetTextColor(69,68,68);
		if($x['checkout']==1)
			$this->Cell(25,5,$x['checkoutdate'],0,0,'L');
		else
		$this->Cell(25,5,"",0,0,'L');
		
		$this->SetXY(15, 130);
		$this->SetTextColor(0,0,0);
		$this->Cell(15,5,'Employees',0,0,'L');
			$employee1=$x['user'];
		
		$employee=explode(",", $x['Employees']);
		for($i=0;$i<sizeof($employee);$i++)
		{
			if($employee[$i] !='')
			{$sql="select fullname from users where serial=".$employee[$i]."";
			
			$results = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
	 while($y = mysqli_fetch_array($results)){
	 	$employee1=$employee1.", ".$y['fullname'];
	 }
	 }
		}
			
		$this->SetXY(110, 130);
		$this->SetTextColor(0,0,0);
		$this->Cell(25,5,'Time',0,0,'L');
		
		$this->SetXY(150, 130);
		$this->SetTextColor(69,68,68);
		if($x['checkout']==1)
			$this->Cell(25,5,$x['time'],0,0,'L');
		else
		$this->Cell(25,5,"",0,0,'L');
		$this->SetXY(40, 130);
		$this->SetTextColor(69,68,68);
		$this->MultiCell(40,5,$employee1,0,'L',0);

		 $this->Ln(10);
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
		$this->Cell(104,7,"Rate",0,'L',0);
  $this->SetFont('zapfdingbats','',10);
	  if($x['rate']==0)
		    $this->Cell(30,7,'I I I I I','','C');
	  else if($x['rate']==1)	    
			$this->Cell(30,7,'H I I I I','','C');
	  else if($x['rate']==2)	    
			$this->Cell(30,7,'H H I I I','','C');
			else if($x['rate']==3)	    
			$this->Cell(30,7,'H H H I I','','C');
			else if($x['rate']==4)	    
			$this->Cell(30,7,'H H H H I','','C');
			else if($x['rate']==5)	    
			$this->Cell(30,7,'H H H H H','','C');
     $this->SetFont('Arial','',10);
	 $this->Ln(1);
	  $this->SetTextColor(0,0,0);
		$this->Cell(22,5,"FeedBack",0,'L',0);
		$yy=$this->GetY();
		$this->Cell(8,5,"",0,'L',0);
		$this->SetTextColor(69,68,68);
		$this->MultiCell(55,5,$x['feedback'],0,'L',0);
			$this->Ln(5);
		
	
	
		
$this->Cell(95,20,'',0,0,'L');
$this->SetTextColor(69,68,68);
$this->Cell(5,20,"Yours truly,",0,0,'L');

$this->Ln(10);
$this->Cell(5,16,'',0,0,'L');
$this->Cell(90,20,"",0,0,'L');
$this->Cell(80,20,"Jamil Corbani",0,0,'L');
$this->Ln(11);
$this->Cell(119,16,'',0,0,'L');
$this->Cell(50,0,'','T');
$this->Ln(1);
$this->Cell(5,16,'',0,0,'L');
$this->Cell(90,20,"",0,0,'L');
$this->Cell(80,20,"CEO",0,0,'L');
$this->AddPage();
	 $query = "select * from visitattachment where visitid =".$x['serial'];
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	 $t=0;
	 $count=0;
	 $count1=0;
	 $i= mysqli_num_rows($results);
	 while($y = mysqli_fetch_array($results)){
	 
		
	 
	 if($count==3){
	 	$this->Ln(55);
		 $count=0;
		 $t=0;
	 }
	 $count+=1;
	   $xx=$this->GetX();
	  $yy=$this->GetY();
	 	$this->Image('../../att/visits/'.$x['serial'].'/'.$y['description'],$xx+$t,$yy,50,50);
	 $t+=55;
	 $count1+=1;
	 if($count1==12){
	 $this->AddPage();
	 $count1=0;
	 $this->SetX(0);
	 $this->SetY(0);}
	 }
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

$pdf->Output();
?>