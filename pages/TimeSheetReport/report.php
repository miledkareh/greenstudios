<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
	function Header()
{
	$this->SetFont('Arial','B',15);
	
	// Title
	$this->Cell(115,20,'Time Sheet',0,0,'R');
	$this->SetFont('Arial','B',10);
	$this->Cell(0,50,'',0,0,'R');
	$this->Cell(-170,50,'From date:',0,0,'R');
	if(isset($_GET['f']))
	$this->Cell(30,50,$_GET['f'],0,0,'R');
	$this->Cell(0,70,'',0,0,'R');
	$this->ln(0);
	$this->Cell(15,70,'To date:',0,0,'R');
	if(isset($_GET['t']))
	$this->Cell(35,70,$_GET['t'],0,0,'R');

	
	
	$this->Ln(50);
}
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-30);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
}

function ImprovedTable($header)
{
	session_start();
  include('../configdb.php');
  $totalm=0;
$totalh=0;
$countt=0;
$totalmns=0;
$totalhrs=0;
$totalcost=0;
$totalcost1=0;
if(isset($_GET['p']))
	{
		$query = "Select distinct(project)as project,(select cost from users where Serial=timesheet.employee) as cost,(select ProjectName from offers where serial = timesheet.project)as projectname  from timesheet where project=".$_GET['p'];
	}
else
	$query = "Select distinct(project)as project,(select cost from users where Serial=timesheet.employee) as cost,(select ProjectName from offers where serial = timesheet.project)as projectname  from timesheet";
	 $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	 while($y = mysqli_fetch_array($result)){
	 
    $query = "Select *,(select Fullname from users where serial=timesheet.employee) as Employee,(select cost from users where Serial=timesheet.employee) as cost,
    (select ProjectName from offers where serial=timesheet.project) as ProjectName from timesheet where project =".$y['project']." ";
if(isset($_GET['u']))
$query=$query." and employee=".$_GET['u'];
if(isset($_GET['f']))
$query=$query." and fromdate >='".$_GET['f']."' ";
if(isset($_GET['t']))
$query=$query." and todate <='".$_GET['t']."' ";		
		//echo($_GET["to"]);
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
    $data = array();
    $i=mysqli_num_rows($results);
    $w = array(40,60,30,30,15,15);
   
	if ($i>0){		$this->SetFont('Arial','B',10);
	 	$totalcost1=0;
	 	 
   $this->Cell(0,0,"Project :".$y['projectname'],0,0,'L');
   $this->Ln(3);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');

    $this->Ln();
	}
$countt=0;
$totalmns=0;
$totalhrs=0;

while($x = mysqli_fetch_array($results)){
	
		 $t1 = StrToTime ( $x["fromdate"] );
$t2 = StrToTime ( $x["todate"] );
$diff = $t2 - $t1;
$mns = $diff / ( 60);
$mns= ( $mns % 60);
$hours = $diff / ( 60 *60);


$hours=round($hours, 0, PHP_ROUND_HALF_DOWN);;
$cost= ($mns/60+$hours)*$x['cost'];
$totalcost1=$totalcost1+$cost;
$totalmns=$totalmns+$mns;
$totalhrs=$totalhrs+$hours;
$totalcost=$totalcost +$cost;
   // $diff = (strtotime($stoptime) - strtotime($starttime));
    //$total = $diff/60;
		 
		 
}

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if($i>0){
	while($x = mysqli_fetch_array($results)){
		
		$countt=$countt+1;
		 $dataa = array();
		
		 $dataa[0]=$x['Employee'];
		 $dataa[1]=$x['description'];
		 $dataa[2]=date('d-m-Y H:i',strtotime($x["fromdate"]));
		  $dataa[3]=date('d-m-Y H:i',strtotime($x["todate"]));
		  $dteStart = StrToTime ( $dataa[2] ); 
   		$dteEnd   =  StrToTime($dataa[3]);
		$diff = $dteEnd - $dteStart;
		$mns = $diff / ( 60);
		$mns= ( $mns % 60);
		$hours = $diff / ( 60 *60);
		
$hours=round($hours, 0, PHP_ROUND_HALF_DOWN);;
$cost= ($mns/60+$hours)*$x['cost'];
   	//	$dteDiff  = $dteStart->diff($dteEnd); 
		// $dataa[5]=$dteDiff->format("%H:%I:%S");
			
	$data[] = $dataa;
		$this->SetFont('Arial','',10);
      
      $this->MultiCell($w[0],6,$dataa[0],'');
	   $xx=$this->GetX();
	  $yy=$this->GetY();
	  $this->SetXY($xx+$w[0],$yy-6);
	  $this->MultiCell($w[1],6,$dataa[1],'');
	$xx=$this->GetX();
	  $yy=$this->GetY();
	  $this->SetXY($xx+$w[1]+$w[0],$yy-6);
        $this->MultiCell($w[2],6,$dataa[2],'');
			$xx=$this->GetX();
	  $yy=$this->GetY();
	 
	  $this->SetXY($xx+$w[1]+$w[0]+$w[2],$yy-6);
		    $this->MultiCell($w[3],6,$dataa[3],'');
			$xx=$this->GetX();
	  $yy=$this->GetY();
	  $this->SetXY($xx+$w[1]+$w[0]+$w[2]+$w[3],$yy-6);
       // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		$this->MultiCell($w[4],6,$hours.":".$mns,'');
        
		 $yy=$this->GetY();
	  $this->SetXY($xx+$w[1]+$w[0]+$w[2]+$w[3]+$w[4],$yy-6);
       // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		$this->MultiCell($w[5],6,$cost,'');
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln();
		if($countt>28){
			$this->Ln(50);
			$countt=0;
		}
		}
		
		$mns=floor($totalmns/60);
		  $modmns=$totalmns%60;
		  $totalhrs=$totalhrs+$mns;
		  $totalh=$totalh+ $totalhrs;
		  $totalm=$modmns+$totalm;
		  $this->Cell(array_sum($w),0,'','T');
		  $this->Ln();
		  
		$this->Cell(170,10,"Total Hours",0,0,'R'); 
		 $this->Cell(20,10,"Total Cost",0,0,'R');
		$this->Cell(-20,20,(string)$totalhrs."hrs ,".(string)$modmns." mns",0,0,'R');
		$this->Cell(15,20,(string)$totalcost1,0,0,'R');
		$this->Cell(-195,6,'',0,0,'R');
		$this->Ln(15);}
	 }
	 

	if(!isset($_GET['p'])){
		$totalm1=floor($totalm/60);
		  $totalm=$totalm%60;
		  $totalh=$totalh+$totalm1;	  
		  $this->SetFont('Arial','BU',12);
		$this->Cell(100,40,"Total Hours: ",0,0,'R');
		 $this->SetFont('Arial','B',9);
		$this->Cell(10,40,(string)$totalh."hrs ,".(string)$totalm." mns",0,0,'L');
		$this->SetFont('Arial','BU',12);
		
		  $this->Cell(60,40,"Total Cost : ",0,0,'R');
		   $this->SetFont('Arial','B',9);
		  $this->Cell(30,40,(string)$totalcost,0,0,'L');
		 
		  
		  
		
		
    // Closing lined
	}
	$this->Ln(5);
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
// Column headings
$header = array('Employee','Description','From Date','To Date','Hours','Cost');
// Data loading
$pdf->SetFont('Arial','',9);
$pdf->AddPage();
$pdf->ImprovedTable($header);
$pdf->Output();
?>