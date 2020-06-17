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
	 $query = "Select * from genpar where serial=".$_GET['c'];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
    $data = array();
	if($x = mysqli_fetch_array($results)){
		
	$this->SetFont('Arial','',8);
	$this->SetTextColor(163,163,163);
	// Title
	$this->Cell(146,20,$x['vat'].' '.$x['commercialNum'],0,0,'L');
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
$flag=0;

    $query = "Select *,(select fname from customers where serial =invoicereport.clientid) as fname,
    					(select lname from customers where serial =invoicereport.clientid) as lname,
    					(select company from customers where serial =invoicereport.clientid) as company,
    					(select telephone from customers where serial =invoicereport.clientid) as phone,
    					(select email from customers where serial =invoicereport.clientid) as email,
    					(select notes from customers where serial =invoicereport.clientid) as notes,
    					(select activity from customers where serial =invoicereport.clientid) as title1,
    					(select country from customers where serial =invoicereport.clientid) as address1,
    					(select city from customers where serial =invoicereport.clientid) as address2,
    					(select ProjectName from offers where serial=invoicereport.project) as projectN,
    					(select GW from offers where serial=invoicereport.project) as GW
    					 from invoicereport where serial=".$_GET['y'];
		//echo($_GET["to"]);
	


	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	 
	while($x = mysqli_fetch_array($results)){
			if($x['GW']==1){$flag=1;}


		$this->SetTextColor(0,0,0);
		
		$this->SetXY(40, 56);
		$this->MultiCell(65,4,$x['company'],0,'L',0);
		$this->SetXY(15, 50);
		
		$this->Cell(25,16,'ATTENTION',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->SetXY(110, 56);
		$this->MultiCell(20,4,'PROJECT TITLE',0,'L',0);
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
		$this->Cell(25,16,'PROPOSAL #',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetXY(136, 66);
		$this->MultiCell(45,4,$x['proposal'],0,'L',0);
		 
		$this->SetTextColor(0,0,0);
		$this->SetXY(15, 78);
		$this->Cell(25,16,'TITLE',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetXY(40, 84);
		$this->MultiCell(65,4,$x['title1'],0,'L',0);
		$this->SetTextColor(0,0,0);
		$this->SetXY(110, 78);
		$this->Cell(25,16,'SUBJECT',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetXY(136, 84);
		$this->MultiCell(45,4,$x['subject'],0,'L',0);
		
		$this->SetTextColor(0,0,0);
		$this->SetXY(15, 95);
		$this->Cell(25,16,'ADDRESS',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetXY(40, 101);
		$this->MultiCell(65,4,$x['notes'],0,'L',0);
		
		
		$this->SetXY(40, 130);
		$this->MultiCell(150,3,$x['body1'],0,'L',0);
		}

  $query = "Select RG,GW,GWINT,GWEXT,GWAREA,RGAREA,
  (select SUM(total) from invoicearea where invoice=".$_GET['y'].") as stotal,
  (select sum(total) from invoicedetail where invoice=".$_GET['y'].")as sinvoicetotal from offers where serial=".$_GET['x'];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	if($x = mysqli_fetch_array($results)){
		$budget=$x['stotal'];
		$total=$x['sinvoicetotal'];
		$this->SetXY(15, 160);
		$this->SetTextColor(0,0,0);
		 $this->SetFillColor(255, 255, 0);
		
		 
		$this->Cell(15,5,'Areas',0,0,'L',1);
		
		$this->SetXY(40, 160);
		$this->SetTextColor(69,68,68);
		
		if($x['GW']==1){
			if($x['GWINT']==1 && $x['GWEXT']==1)
			$this->Cell(45,5,'GW INDOOR/OUTDOOR',0,0,'L',1);
			else if($x['GWINT']==1)
			$this->Cell(25,5,'GW INDOOR',0,0,'L',1);
			else if($x['GWEXT']==1)
		$this->Cell(25,5,'GW OUTDOOR',0,0,'L',1);
else
	$this->Cell(25,5,'GW',0,0,'L',1);
		}
		else if($x['RG']==1){
			$this->Cell(25,5,'RG',0,0,'L');
			
		}
		
		
		$this->SetXY(110, 160);
		$this->SetTextColor(69,68,68);
		$this->Cell(25,5,'TOTAL AREA',0,0,'L');
		
		$this->SetXY(150, 160);
		$this->SetTextColor(69,68,68);
		if($x['GW']==1)
		$this->Cell(25,5,$x['GWAREA']." m2",0,0,'L',1);
		else
			$this->Cell(25,5,$x['RGAREA']." m2",0,0,'L',1);
		
		
		
		 $query = "Select *,
		 (select rarea from invoicereport where serial=invoicearea.invoice) as rarea from invoicearea where invoice=".$_GET['y'];
		
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		$this->SetXY(40, 167);
		$this->SetTextColor(69,68,68);
		$i= mysqli_num_rows($results);
		if($i>1){
			
		$this->Cell(25,5,"broken down as below:",0,0,'L');}
		 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		while($y = mysqli_fetch_array($results)){
				
			
		if($y['description']!= 'GW INDOOR' && $y['description']!='GW' && $y['description']!='RG' && $y['description']!='GW OUTDOOR')
		{
			$this->Ln(4);
		$this->Cell(30,5,'',0,0,'L');
		$this->SetTextColor(69,68,68);
		$this->SetFillColor(255, 255, 255);
			$this->MultiCell(70,5,$y['description'],0,'L',1);
		
		$this->Cell(140,5,'',0,0,'L');
		$this->SetTextColor(69,68,68);
		if($y['rarea']==1)
		$this->Cell(25,-1,$y['total']." m2",0,0,'L');
		else
			$this->Cell(25,-1,$y['total'],0,0,'L');
		}
		$count=174;
			}
		$this->SetFillColor(255, 255, 0);
	}
  $query = "Select *,
(select country from offers where serial =invoicereport.project) as country,
(select symbol from currencies where serial in
 (select currency from offers where serial = invoicereport.project)) as currencyS 
 from invoicereport where serial=".$_GET['y'];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		
		if($y = mysqli_fetch_array($results)){
$this->Ln(20);
			$this->Cell(5,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Requirements by client",0,'L',1);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-8);
		$this->SetTextColor(69,68,68);
		$str=explode(",",$y["requirement"]);
		if (count($str) >=1)
		{
												
		for($i=0;$i<count($str);$i++)
		{
		$query = "Select * from requirements where serial=".$str[$i];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		
		if($z = mysqli_fetch_array($results)){
				$this->MultiCell(130,4,$z['description'],0,'L',0);								
			}
		$this->Ln(3);
		$this->Cell(50,16,'',0,0,'L');
		}	
		}
		
		$this->Ln(7);
			$this->Cell(5,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Including",0,'L',1);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-4);
		$this->SetTextColor(69,68,68);
		
		$str=explode(",",$y["including"]);
		if (count($str) >=1)
		{
												
		for($i=0;$i<count($str);$i++)
		{
		  $query = "Select * from including where serial=".$str[$i];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		
		if($z = mysqli_fetch_array($results)){
				$this->MultiCell(130,4,$z['description'],0,'L',0);								
			}
		$this->Ln(3);
		$this->Cell(50,16,'',0,0,'L');
		}
		}
		
		$TotalBudget=0;
		if($budget>0)
		$TotalBudget=$total/$budget;
	
		
		$this->Ln(7);
			$this->Cell(5,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Excluding",0,'L',1);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-4);
		$this->SetTextColor(0,0,0);
		
		$this->MultiCell(130,4,$y['excluding'],0,'L',0);
		
		$this->Ln(10);
			$this->Cell(5,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		if($y['notes'] <> ''){
		$this->MultiCell(25,4,"Notes",0,'L',1);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-4);
		$this->SetTextColor(0,0,0);
		
		$this->MultiCell(130,4,$y['notes'],0,'L',0);
		}
		$this->Ln(10);
			$this->Cell(5,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Budget",0,'L',1);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-4);
		$this->SetTextColor(0,0,0);
		$country="";
		$totall=0;
$firstfreighttot=0;
$firsttotal=0;
$prices=0;
		$ssl="Select *,(select country from offers where serial in (select project from invoicereport where serial=invoicedetail.invoice)) as country,
	(select description from itemsgroups where serial in (select group1 from items where serial=invoicedetail.item))as group1,
	(select price from items where serial=invoicedetail.item)as dimension,
	(select dimension from items where serial=invoicedetail.item)as dimension,
	(select code from items where serial=invoicedetail.item)as code,
	(select ccode from items where serial= invoicedetail.item)as ccode,
	(select ddescription from items where serial= invoicedetail.item)as ddescription,
	(select description from items where serial=invoicedetail.item) as description,
	(select price from items where serial=invoicedetail.item) as pricee,
	(quantity* (select price from items where serial=invoicedetail.item) )as totall,


	(select unit from items where serial=invoicedetail.item) as unit from invoicedetail where invoice=".$_GET['y']." order by (select group1 from items where serial=invoicedetail.item) asc ,
	(select code from items where serial=invoicedetail.item and CAST(code as UNSIGNED) <> 0) asc,(select description from items where serial=invoicedetail.item) asc";
	 $rrr = mysqli_query($dbhandle,$ssl)  or die(mysqli_error());
		while($rrx = mysqli_fetch_array($rrr)){
			if($rrx['viewprices']==1){$prices+=$rrx['totall'];
			if($rrx['group1']=="Freight"){
				$firstfreighttot+=$rrx['totall'];
			}
}
		}




if($y['ispercentage']==1)
	//$finaltotal=round(round((round($total,2))-((round($total,2)-(round($Freighttot,2)))*$y['discount']/100),2)-$viewprices,2);
$firsttotal=   round(round($prices,2)  -((round($prices,2) -(round($firstfreighttot,2)))*$y['discount']/100),2) ;
 //round($total,2)-($viewprices)      -((round($total,2)-$viewprices-(round($Freighttot,2)))*$y['discount']/100) ;
	else
		$firsttotal= round((round($prices,2))-$y['discount'],2) ;














		
		if($x['GW']==1)
		{
			
			if($y['ispercentage']==1)
		{$totall=$prices-($prices*($y['discount']/100));
			if($y['rarea']==1){
				if($x['GWAREA']==0)
				$TotalBudget=0;
				else
	$TotalBudget=($prices-($prices*($y['discount']/100)))/$x['GWAREA'];
		}
		else {
			$TotalBudget=($prices-($prices*($y['discount']/100)));
			
		}}
	else{
		
		$totall=$prices-$y['discount'];
		if($y['rarea']==1){
		if($x['GWAREA']==0)
		$TotalBudget=0;
		else
		$TotalBudget=($prices-$y['discount'])/$x['GWAREA'];}
		else
		$TotalBudget=($prices-$y['discount']);
	}
		}
		else{
			if($y['ispercentage']==1)
		{$totall=$prices-($prices*($y['discount']/100));
			if($y['rarea']==1){
				if($x['RGAREA']==0)
				$TotalBudget=0;
				else
	$TotalBudget=($prices-($prices*($y['discount']/100)))/$x['RGAREA'];
		}
		else {
			$TotalBudget=($prices-($prices*($y['discount']/100)));
			
		}}
	else{
		
		$totall=$prices-$y['discount'];
		if($y['rarea']==1){
			if($x['RGAREA']==0)
			$TotalBudget=0;
			else
		$TotalBudget=($prices-$y['discount'])/$x['RGAREA'];}
		else
		$TotalBudget=($prices-$y['discount']);
	}
		}
		
		if($y['country']=='Lebanon')
		$country=" + VAT";
		if($y['rarea']==1)
		$this->MultiCell(70,4,$y['currencyS']." ".number_format($TotalBudget, 2 , '.' , ',' )." /sqm ".$country,0,'L',1);
		else
			$this->MultiCell(70,4,$y['currencyS']." ".number_format($TotalBudget, 2 , '.' , ',' )." ".$country,0,'L',1);
		$this->Ln(5);
			$this->Cell(50,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
	
		$this->MultiCell(130,4,"Total ".number_format($firsttotal, 2 , '.' , ',' )." ".$country." (". $this->convert_number_to_words(round($firsttotal,2)) ." ".$y['currencyS'].") ",0,'L',0);
		}
		$this->Ln(8);
		$this->Cell(20,16,'',0,0,'L');
	$this->Cell(150,0,'','T');	
	$this->Ln(0);
	$this->Cell(20,16,'',0,0,'L');
	$this->Cell(40,5,'DESCRIPTION',0,0,'L');
	$this->Cell(35,16,'',0,0,'L');
	$this->Cell(20,5,'UNIT',0,0,'L');
	
	$this->Cell(20,5,'QTY',0,0,'L');
	$this->Cell(20,5,'PRICE',0,0,'L');
	$this->Cell(20,5,$y['currencyS'].' Total',0,0,'L');
	$this->Ln(6);
	
	$this->Cell(20,16,'',0,0,'L');
	$this->Cell(150,0,'','T');
	$this->Ln(1);
	$this->Cell(20,16,'',0,0,'L');
	$Freighttot=0;
	$viewprices=0;
	$this->Ln(8);
      $query = "Select *,(select country from offers where serial in (select project from invoicereport where serial=invoicedetail.invoice)) as country,
	(select description from itemsgroups where serial in (select group1 from items where serial=invoicedetail.item))as group1,
	(select order2 from itemsgroups where serial in (select group1 from items where serial=invoicedetail.item))as group2 ,
	(select price from items where serial=invoicedetail.item)as dimension,
	(select dimension from items where serial=invoicedetail.item)as dimension,
	(select code from items where serial=invoicedetail.item)as code,
	(select ccode from items where serial= invoicedetail.item)as ccode,
	(select ddescription from items where serial= invoicedetail.item)as ddescription,
	(select description from items where serial=invoicedetail.item) as description,
		 price as pricee,
(quantity*price)as totall,

	(select unit from items where serial=invoicedetail.item) as unit from invoicedetail where invoice=".$_GET['y']." order by group2 asc,viewprices DESC  ";

 // (select group1 from items where serial=invoicedetail.item) asc ,
	// (select code from items where serial=invoicedetail.item and CAST(code as UNSIGNED) <> 0) asc,(select description from items where serial=invoicedetail.item) asc

		//echo($_GET["to"]);
		$group="";
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		if($x = mysqli_fetch_array($results)){
			$group=$x['group1'];
		}
		$this->SetTextColor(0,0,0);
			$this->Cell(20,16,'',0,0,'L');
			$this->SetFont('Arial','B',9);
			$this->Cell(30,5,$group,0,0,'L');
			$this->SetFont('Arial','',9);
			$this->Ln(8);
			
			 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		while($x = mysqli_fetch_array($results)){ 
			if($group != $x['group1'])
			{
				  $group=$x['group1'];
				$this->SetFont('Arial','B',9);
				$this->SetTextColor(0,0,0);
			$this->Cell(20,16,'',0,0,'L');
			$this->Cell(30,5,$x['group1'],0,0,'L');
			$this->Ln(8);
			$this->SetFont('Arial','',9);
			}
			$this->Cell(20,16,'',0,0,'L');
			$this->SetTextColor(69,68,68);
			
	$this->MultiCell(66,4,$x['code']." _ ".$x['description'] ,0,'L',0);
	$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+55,$yy-4);
	$this->Cell(40,16,'',0,0,'L');
	$this->SetTextColor(0,0,0);
	$this->Cell(20,5,$x['unit'],0,0,'L');
		$this->Cell(20,5,number_format($x["quantity"], 2 , '.' , ',' ),0,0,'L');
	 


	   if($x["viewprices"]==1){
	$this->Cell(20,5,number_format($x["pricee"], 2 , '.' , ',' ),0,0,'L');
	$this->Cell(20,5,number_format($x["totall"], 2 , '.' , ',' ),0,0,'L');
 if($group=="Freight"){  $Freighttot+=$x["totall"];}
	
	}
	else{
		$this->Cell(20,5,number_format($x["pricee"], 2 , '.' , ',' ),0,0,'L');
	//$this->Cell(20,5,number_format($x["total"], 2 , '.' , ',' ),0,0,'L');
		$viewprices+=$x["totall"];
	}
	$this->Ln(5);
	$this->Cell(20,16,'',0,0,'L');
			$this->SetTextColor(69,68,68);
	$this->MultiCell(30,4,$x['dimension'] ,0,'L',0);
	$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+110,$yy-4);
	$this->Cell(30,4,"Customs commodity code: ".$x['ccode'] ,0,'L',0);
	$this->Ln(5);
	$this->Cell(20,16,'',0,0,'L');
	$this->MultiCell(80,4,$x['ddescription'] ,0,'L',0);
	$this->Ln(8);
		}
		$this->Cell(20,16,'',0,0,'L');
		$this->Cell(150,0,'','T');
		$this->Ln(1);
	$this->Cell(20,16,'',0,0,'L');
	
	$this->MultiCell(66,4,'' ,0,'L',0);
	
	$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-9);

	$this->Cell(77,16,'',0,0,'R');
	$this->SetTextColor(0,0,0);
	$this->Cell(13,13,"Sub Total",0,0,'L');
	$this->Cell(23,13,number_format($total-$viewprices, 2 , '.' , ',' ),0,0,'R');
	
	
	$this->Ln(10);
	$this->Cell(127,4,'' ,0,'L',0);
	$this->MultiCell(20,4,'Discount' ,0,'L',0);
	$discount=round($y['discount'],2);
	if($y['ispercentage']==1)
	$this->MultiCell(163,-5,number_format($discount,2,'.',',')." %",0,'R',0);
	else
		$this->MultiCell(163,-5,number_format($discount,2,'.',','),0,'R',0);
	$this->Ln(6);
	$this->Cell(20,15,'' ,0,'L',0);
	$country="";
	
	if($y['country']=='Lebanon')
	$country=" + VAT";
	if($y['ispercentage']==1)
	//$finaltotal=round(round((round($total,2))-((round($total,2)-(round($Freighttot,2)))*$y['discount']/100),2)-$viewprices,2);
$finaltotal=  round(round($total,2)-round($viewprices,2)   -((round($total,2)-round($viewprices,2)-(round($Freighttot,2)))*$y['discount']/100),2) ;
	else
		$finaltotal=round(round((round($total,2))-$y['discount'],2)-$viewprices,2);
	$this->MultiCell(100,4,'Total('.$this->convert_number_to_words(round($finaltotal,2)).' '.$y['currencyS'].')'.$country ,0,'L',1);
	$this->Cell(136,-4,'Total' ,0,'R',0);
	
	$this->MultiCell(27,-4,number_format($finaltotal, 2 , '.' , ',' ),0,'R',0);
	 $myX=$this->getx();
	 $myY=$this->gety();
	 //  $this->SetXY(1,-100);
	 // $this->MultiCell(27,-4,number_format($finaltotal, 2 , '.' , ',' ),0,'R',0);
	 $this->SetXY($myX,$myY);
	$this->Ln(5);
	$this->Cell(20,16,'',0,0,'L');
		$this->Cell(150,0,'','T');
	$this->Ln(10);
	$query = "Select * from invoicereport where serial=".$_GET['y'];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		
		if($x = mysqli_fetch_array($results)){
		$this->Cell(20,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Time &",0,'L',0);
		$this->Ln(1);
		$this->Cell(20,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Delivery",0,'L',0);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-9);
	$this->Cell(15,16,'',0,0,'L');
	$this->SetTextColor(69,68,68);
	$this->Cell(20,5,$x['delivery'],0,0,'L');
		$this->Ln(15);
		$this->Cell(20,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Warranty",0,'L',0);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-4);
	$this->Cell(15,16,'',0,0,'L');
	$this->SetTextColor(69,68,68);
	$this->MultiCell(100,4,$x['warranty'],0,'L',0);
	$this->Ln(7);
	$this->Cell(20,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->Cell(14,4,"Payment",0,'L',0);
		$this->Ln(1);
		$this->Cell(21,16,'',0,0,'L');
		$this->Cell(14,10,"Schedule",0,'L',0);
			
$this->SetTextColor(69,68,68);
$this->Cell(31,4,'',0,0,'L');
	$this->Cell(41,10,$x['payment'],0,0,'L');
		$this->Ln(7);
		$this->Cell(20,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		
	$this->Ln(7);
	$this->Cell(20,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->Cell(14,4,"",0,'L',0);	
$this->SetTextColor(69,68,68);
$this->Cell(30,4,'',0,0,'L');
	$this->MultiCell(115,5,$x['paymentdetails'],0,'L',0);
		
		$this->SetTextColor(0,0,0);
		$this->Ln(15);
		
		$this->Cell(20,16,'',0,0,'L');
		$this->SetTextColor(0,0,0);
		$this->MultiCell(25,4,"Offer validity",0,'L',0);
		$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx+50,$yy-4);
	$this->Cell(15,16,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['validity'],0,'L',0);
	$this->Ln(8);
	$this->Cell(20,16,'',0,0,'L');
$this->MultiCell(160,4,$x['body2'],0,'L',0);

if($flag==1){$this->Ln(8);
	$this->Cell(20,16,'',0,0,'L');
$this->MultiCell(160,4,$x['body3'],0,'L',0);}

		}
$this->Ln(8);
$this->Cell(5,16,'',0,0,'L');
$this->SetTextColor(69,68,68);
$this->Cell(90,20,"Yours truly,",0,0,'L');
$this->Cell(80,20,"Read and Approved",0,0,'L');
$this->Ln(10);
$this->Cell(5,16,'',0,0,'L');
$this->Cell(90,20,"Jamil Corbani",0,0,'L');
$this->Cell(80,20,"Client Name",0,0,'L');
$this->Ln(11);
$this->Cell(119,16,'',0,0,'L');
$this->Cell(50,0,'','T');
$this->Ln(1);
$this->Cell(5,16,'',0,0,'L');
$this->Cell(90,20,"CEO",0,0,'L');
$this->Cell(80,20,"Date",0,0,'L');
$this->Ln(11);
$this->Cell(119,16,'',0,0,'L');
$this->Cell(50,0,'','T');
$this->Ln(4);
$this->Cell(95,16,'',0,0,'L');
$this->Cell(80,20,"Signature",0,0,'L');
$this->Ln(11);
$this->Cell(119,16,'',0,0,'L');
$this->Cell(50,0,'','T');
$this->Ln(11);
$query = "Select * from genpar where serial=".$_GET['c'];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		
		if($x = mysqli_fetch_array($results)){
$this->SetFont('Arial','',10);
$this->Cell(5,16,'',0,0,'L');
$this->SetTextColor(0,0,0);
$this->Cell(90,20,"BANK NAME",0,0,'L');
$this->SetFont('Arial','',9);
$this->SetTextColor(69,68,68);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx-62,$yy+8);
	$this->Cell(15,16,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['bank'],0,'L',0);
	
	$this->SetFont('Arial','',10);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy-5);
$this->Cell(5,10,'',0,0,'L');
$this->SetTextColor(0,0,0);
$this->Cell(90,20,"BANK",0,0,'L');
$this->SetFont('Arial','',9);
$this->SetTextColor(69,68,68);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx-62,$yy+8);
	$this->Cell(15,16,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['bankname'],0,'L',0);
	
	$this->SetFont('Arial','',10);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy-5);
$this->Cell(5,10,'',0,0,'L');
$this->SetTextColor(0,0,0);
$this->Cell(90,20,"ADDRESS",0,0,'L');
$this->SetFont('Arial','',9);
$this->SetTextColor(69,68,68);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx-62,$yy+8);
	$this->Cell(15,16,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['bankaddress'],0,'L',0);

$this->SetFont('Arial','',10);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy-5);
$this->Cell(5,10,'',0,0,'L');
$this->SetTextColor(0,0,0);
$this->Cell(90,20,"ACCOUNT NAME",0,0,'L');
$this->SetFont('Arial','',9);
$this->SetTextColor(69,68,68);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx-62,$yy+8);
	$this->Cell(15,16,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['accountname'],0,'L',0);

	
	$this->SetFont('Arial','',10);
$this->Cell(5,16,'',0,0,'L');
$this->SetTextColor(0,0,0);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy-6);

$this->Cell(90,20,"ACCOUNT #",0,0,'L');
$this->SetFont('Arial','',9);
$this->SetTextColor(69,68,68);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx-62,$yy+8);
	$this->Cell(15,3,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['accountnumber'],0,'L',0);

	
	$this->SetFont('Arial','',10);
$this->Cell(5,16,'',0,0,'L');
$this->SetTextColor(0,0,0);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy-6);


$this->Cell(90,20,"IBAN",0,0,'L');
$this->SetFont('Arial','',9);
$this->SetTextColor(69,68,68);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx-62,$yy+8);
	$this->Cell(15,16,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['ibanusd'],0,'L',0);
	

	
	$this->SetFont('Arial','',10);
$this->Cell(5,16,'',0,0,'L');
$this->SetTextColor(0,0,0);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy-6);
$this->Cell(90,20,"SWIFT CODE",0,0,'L');
$this->SetFont('Arial','',9);
$this->SetTextColor(69,68,68);
$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx-62,$yy+8);
	$this->Cell(15,16,'',0,0,'L');
	
	$this->MultiCell(100,4,$x['swift'],0,'L',0);

		}

$query = "Select *,(select country from offers where serial in (select project from invoicereport where serial=offermaintenance.invoiceid)) as country,(select name from currencies where serial=offermaintenance.currency) as currencyN,(select symbol from currencies where serial=offermaintenance.currency) as currencyS,(select proposal from invoicereport where serial=offermaintenance.invoiceid) as proposal from offermaintenance where invoiceid=".$_GET['y'];
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
		$i= mysqli_num_rows($results);
		
		if($i>0)
		{
			$this->Ln(20);
$this->AddPage();
		}
		while($x = mysqli_fetch_array($results)){
			$this->SetTextColor(0,0,0);
			$this->SetFont('Arial','B',10);
			$this->Cell(10,16,'',0,0,'L');
			$this->MultiCell(150,4,"MAINTENANCE OFFER _".$x['proposal'],0,'C',0);
			//$this->MultiCell(200,16,"MAINTENANCE OFFER _".$x['proposal'],0,0,'L');
			$this->Ln(10);
			$this->SetFont('Arial','U',10);
			$this->SetTextColor(69,68,68);
			$this->Cell(30,16,"Scope :",0,0,'L');
			$this->Ln(5);
			$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy+8);
			$this->SetFont('Arial','',10);
			$this->MultiCell(180,4,"GS  team  of  experts  will  send  the  CLIENT  a  fixed  yearly  maintenance  schedule  that  will  include  ".$x['visits']." visits.  GS  will  do  all  necessary  works  and  apply  all  necessary  products  to  keep  the  green  wall  healthy  all  year  round.  Any  plant  mortality  resulting  directly  from  a  technical  error  in  maintenance  will  be  replaced  Free  of  Charge.  All  other  cases  of  possible  mortality  and  replacements  will  be  charged  separately.  GS  is  not  liable  for  any  defect  in  any  part  installed  by  a  third  party.",0,'L',0);
		
$this->Ln(2);
$this->SetFont('Arial','U',10);
$this->Cell(30,16,"Maintenance Guarantee:",0,0,'L');
$this->Ln(5);
			$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy+8);
			$this->SetFont('Arial','',10);
			$this->MultiCell(180,4,"The  maintenance  guarantee  does  not  apply  in  case  of  the  following:
			
- Water  shortage/cut  for  a  duration  of  24  hours  or  more
- Water  salinity  exceeding  700  microsiemens/cm  for  a  duration  of  one  week
- Electricity  shortage/cut  for  a  duration  of  24  hours  or  more
- Acts  of  vandalism  caused  by  a  third  party  on  site
- Fire  accident,  natural  disasters,  acts  of  war",0,'L',0);
	
	$this->Ln(2);
$this->SetFont('Arial','U',10);
$this->Cell(30,16,"CLIENT:",0,0,'L');
$this->Ln(5);
			$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy+8);
			$this->SetFont('Arial','',10);
			$this->MultiCell(180,4,"The  CLIENT  is  the  sole  counterpart  of  GS  regarding  the  execution  of  this  contract.
			
CLIENT  will  arrange  for  GS  team  clearance  to  access  the  technical  room  and  access  the  green  wall  according  to  a  pre-agreed  schedule  of  works.

CLIENT's  personnel  will  make  sure  to  inspect  the  site,  every  time  a  maintenance  is  done  by  GS,  and  advise  back  GS  management,  by  phone  ".$x['phone']."  or  mail  ".$x['email']."  before  GS  team  leaves  the  premises,  of  any  special  on  site  request  related  to  the  green  wall  in  general.

CLIENT's  personnel  will  make  sure  to  clean  the  premises  after  GS  team  leaves  the  site;  GS  team  will  do  the  necessary  'dry'  cleaning  before  CLIENT's  personnel  takes  over  for  final  cleaning  (soap/detergents/wax & water applications)
",0,'L',0);
		
$this->Ln(2);
$this->SetFont('Arial','U',10);
$this->Cell(30,16,"SPOT visits and special requests:",0,0,'L');
$this->Ln(5);
			$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy+8);
			$this->SetFont('Arial','',10);
			$this->MultiCell(180,4,"GS  can  perform  spot  visits  to  listen  to  the  CLIENT's  comments  or  additional  requests.  Those  visits  are  done  against  a  nominal  fee  of  ".$x['currencyS']." ".$x['spotfees']."  and  do  not  include  any  labor/technical  team  services.  Any  technical  service  coming  for  these  special  request  will  be  quoted  separately  and  sent  for  CLIENT's  approval.  These  special  requests  require  a  mobilization  period  from  GS  of  minimum  72hrs.",0,'L',0);		
	
	$this->Ln(2);
$this->SetFont('Arial','U',10);
$this->Cell(30,16,"Contract's Duration:",0,0,'L');
$this->Ln(5);
			$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy+8);
			$this->SetFont('Arial','',10);
			$this->MultiCell(180,4,"The  duration  of  subject  agreement  is  ".$x['agreement']."  and  will  be  reviewed  and  agreed  upon  mutually  three  months  prior  to  renewal,  unless  either  party  informs  in  writing  of  its  wish  to  interrupt  or  change  the  agreement  three  months  prior  to  its  expiry.",0,'L',0);		
	
	$this->Ln(2);
$this->SetFont('Arial','U',10);
$this->Cell(30,16,"Price offer:",0,0,'L');
$this->Ln(5);
			$xx=$this->GetX();
$yy=$this->GetY();
$this->SetXY($xx,$yy+8);
			$this->SetFont('Arial','',10);
			if($x['country']!='Kuwait')
			$vat="(".$x['currencyN']." ".$this->convert_number_to_words(round($x['total'],2)).") + VAT";
			else
			$vat="";
			$this->MultiCell(180,4,"The  yearly  maintenance  fee  will  be:  ".$x['currencyS']." ".$x['total']."  $vat,  and  will  be  normally  invoiced  every  six  months.  Invoices  are  issued  in  April  and  October  (April  invoice  covering  Jan  to  June  and  October  covering  July  to  December.",0,'L',0);		
	
	$this->Ln(8);
$this->Cell(5,16,'',0,0,'L');
$this->SetTextColor(69,68,68);
$this->Cell(90,20,"Yours truly,",0,0,'L');
$this->Cell(80,20,"Read and Approved",0,0,'L');
$this->Ln(10);
$this->Cell(5,16,'',0,0,'L');
$this->Cell(90,20,"Jamil Corbani",0,0,'L');
$this->Cell(80,20,"Client Name",0,0,'L');
$this->Ln(11);
$this->Cell(119,16,'',0,0,'L');
$this->Cell(50,0,'','T');
$this->Ln(1);
$this->Cell(5,16,'',0,0,'L');
$this->Cell(90,20,"CEO",0,0,'L');
$this->Cell(80,20,"Date",0,0,'L');
$this->Ln(11);
$this->Cell(119,16,'',0,0,'L');
$this->Cell(50,0,'','T');
$this->Ln(4);
$this->Cell(95,16,'',0,0,'L');
$this->Cell(80,20,"Signature",0,0,'L');
$this->Ln(11);
$this->Cell(119,16,'',0,0,'L');
$this->Cell(50,0,'','T');				
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