<?php

require('../fpdf/rotation.php');
 
  session_start();
  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
									if($_SESSION['plcv']!=1){
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
	include('../configdb.php');
	$this->Image('../../att/palette-legend1.jpg',245,0,45);
	 
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

     if ( $this->PageNo() !== 1 ) {
        $this->Image('../../att/palette-legend.jpg',0,180,295);
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
function ImprovedTable()
{
	$budget=0;
	$total=0;
 include('../configdb.php');


    $query = "Select *,scientic as plantN,(select description from plantattachment where plantid=plants.serial limit 1)as description
from plants where serial in (".$_GET['x'].") order by scientic ASC  ";
		//echo($_GET["to"]);
		
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	// echo $query;
	$count=1;
	while($x = mysqli_fetch_array($results)){
	//	echo "ERROR";
	if($x['description']!=''){
	if($count==1){
		$yy=$this->GetY();
		$this->SetXY(10, $yy);
	   if(strlen($x['plantN'])>=32)
        {$this->SetFont('Arial','B',7);}
else{
	    $this->SetFont('Arial','B',8);
    }
		$this->SetTextColor(0,0,0);
		
		$this->MultiCell(61,4,strtoupper($x['plantN']),0,'L',0);
        $this->Ln(5); 
		
		
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Location: '.$x['location1'],0,0,'L');
		$this->Ln(5);
		$this->Cell(25,4,'Luminosity: '.$x['luminosity'],0,0,'L');
		$this->Ln(5);
		$this->Cell(25,4,'Hardiness: '.$x['hardiness'],0,0,'L');
		$this->Ln(5);
		$this->Cell(25,4,'Growth Speed: '.$x['growthspeed'],0,0,'L');
		$this->Ln(5);
		$this->Cell(25,4,'Maintenance Needs: '.$x['maintenanceneeds'],0,0,'L');
		
	  $yy=$this->GetY();
		$this->Image('../../att/Plants/'.$x['description'],70,$yy-29,40,34);
		$this->Ln(5);
		$this->Cell(90,0,'','T');
		$this->Ln(10);
		$count++;
		}
else{
	$yy=$this->GetY();
		$this->SetXY(120, $yy-44);
	 if(strlen($x['plantN'])>=32)
        {$this->SetFont('Arial','B',7);}
    else{
	$this->SetFont('Arial','B',8);
}
		$this->SetTextColor(0,0,0);
		
		$this->MultiCell(61,4,strtoupper($x['plantN']),0,'L',0);
          $this->Ln(5); 

		//$this->Ln(5);
		$yy=$this->GetY();
		$this->SetXY(120, $yy);
		$this->SetFont('Arial','',10);
		$this->Cell(25,4,'Location: '.$x['location1'],0,0,'L');
		$this->Ln(5);
		$yy=$this->GetY();
		$this->SetXY(120, $yy);
		$this->Cell(25,4,'Luminosity: '.$x['luminosity'],0,0,'L');
		$this->Ln(5);
		$yy=$this->GetY();
		$this->SetXY(120, $yy);
		$this->Cell(25,4,'Hardiness: '.$x['hardiness'],0,0,'L');
		$this->Ln(5);
		$yy=$this->GetY();
		$this->SetXY(120, $yy);
		$this->Cell(25,4,'Growth Speed: '.$x['growthspeed'],0,0,'L');
		$this->Ln(5);
		$yy=$this->GetY();
		$this->SetXY(120, $yy);
		$this->Cell(25,4,'Maintenance Needs: '.$x['maintenanceneeds'],0,0,'L');
		
	  $yy=$this->GetY();
	 
		$this->Image('../../att/Plants/'.$x['description'],180,$yy-29,40,34);
		$this->Ln(5);
		$yy=$this->GetY();
	  $this->SetXY(120, $yy);
		$this->Cell(90,0,'','T');
		$this->Ln(10);
		$count=1;
}
}
	
		
	
		
   




		}
$this->Image('../../att/palette-legend.jpg',0,180,295);

		
}

}

$pdf = new PDF();
//$pdf->AliasNbPages();
// Column headings
// Data loading
$pdf->SetFont('Arial','',9);
 $pdf->AddPage1('L');
 $pdf->Image('palette.jpg',0,20,295);
    $pdf->SetFont('Arial','',10);
     
     $pdf->SetXY(265, 165);
        $pdf->Cell(120,0,date("Y-m-d"),'L');
   
 $pdf->AddPage('L');
 $pdf->ImprovedTable();

$pdf->Output();
?>