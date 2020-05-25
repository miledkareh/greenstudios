<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
	function Header()
{
	$this->SetFont('Arial','B',15);
	
	// Title
	
	$this->SetFont('Arial','B',15);
	$this->Cell(150,20,'Visits Report',0,0,'R');
	$this->SetFont('Arial','B',10);
		$this->ln(1);
	$this->Cell(10,50,'',0,0,'R');
	$this->Cell(10,50,'From date:',0,0,'R');
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
$count=0;
$totalmns=0;
$totalhrs=0;
$totalcost=0;
$totalcost1=0;
if(isset($_GET['p']))
	{
		$query = "Select *,(select description from checkin where visit=maintenancedetails.serial) as description,
		(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
		(select serial from checkin where visit=maintenancedetails.serial) as checkinid,
		(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
		(select rate from checkin where visit=maintenancedetails.serial) as rate,
		(select notes from checkin where visit=maintenancedetails.serial) as feedback,(select projectname from offers where serial in (select offerid from maintenances where serial=maintenancedetails.maintenanceid)) projectname  from maintenancedetails where maintenanceid=".$_GET['p'];
	}
else
	$query = "Select *,(select fullname from users where serial=maintenancedetails.userid) as user,(select description from checkin where visit=maintenancedetails.serial) as description,
		(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
		(select serial from checkin where visit=maintenancedetails.serial) as checkinid,
		(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
		(select rate from checkin where visit=maintenancedetails.serial) as rate,
		(select notes from checkin where visit=maintenancedetails.serial) as feedback,(select projectname from offers where serial in (select offerid from maintenances where serial=maintenancedetails.maintenanceid)) projectname  from maintenancedetails where serial <> 0";
	 if(isset($_GET['u']))
$query=$query." and (userid=".$_GET['u']." || ".$_GET['u']." in (employees))";
if(isset($_GET['f']))
$query=$query." and serial in (select visit from checkin where checkindate >='".$_GET['f']."') ";
if(isset($_GET['t']))
$query=$query." and serial in (select visit from checkin where checkindate <='".$_GET['t']."') ";

	 $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	 while($x = mysqli_fetch_array($result)){
	 	$count++;
	 	$totalcost1=0;
	 	 $w = array(60,35,35,56,56,30);
	 	 $this->SetFont('Arial','B',10);
   $this->Cell(0,0,"Project - Visit:".$x['projectname']." - ".$x['description'],0,0,'L');
   $this->Ln(3);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
		   
    $this->Ln();
$this->SetFont('Arial','',8);
		$countt=$countt+1;
		$employee1=$x['user'];
		 $dataa = array();
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
		 $dataa[0]=$employee1;
		 $dataa[1]=$x['feedback'];
		 $dataa[2]=date('d-m-Y H:i',strtotime($x["checkindate"]));
		 if($x["checkoutdate"]==0)
		 $dataa[3]="";
		 else
		  $dataa[3]=date('d-m-Y H:i',strtotime($x["checkoutdate"]));
		$dataa[4]=$x["rate"];
		 $dataa[5]=$x['Notes'];
   	//	$dteDiff  = $dteStart->diff($dteEnd); 
		// $dataa[5]=$dteDiff->format("%H:%I:%S");
			
	$data[] = $dataa;
		$this->SetFont('Arial','',10);
      
      $this->MultiCell($w[0],6,$dataa[0],'');
	   $xx=$this->GetX();
	  $yy=$this->GetY();
	  $this->SetXY($xx+$w[0],$yy-6);
	  $this->MultiCell($w[1],6,$dataa[2],'');
	  
	$xx=$this->GetX();
	  $yy=$this->GetY();
	  $this->SetXY($xx+$w[1]+$w[0],$yy-6);
        $this->MultiCell($w[2],6,$dataa[3],'');
		
		$xx=$this->GetX();
	  $yy=$this->GetY();
	  $this->SetXY($xx+$w[1]+$w[0]+$w[2],$yy-6);
        $this->MultiCell($w[3],6,$dataa[5],'');
		
			$xx=$this->GetX();
	  $yy=$this->GetY();
	 
	  $this->SetXY($xx+$w[1]+$w[0]+$w[2]+$w[3],$yy-6);
		    $this->MultiCell($w[4],6,$dataa[1],'','C');
		    $xx=$this->GetX();
	  $yy=$this->GetY();
	 
	  $this->SetXY($xx+$w[1]+$w[0]+$w[2]+$w[3]+$w[4],$yy-6);
	  $this->SetFont('zapfdingbats','',10);
	  if($dataa[4]==0)
		    $this->MultiCell($w[5],6,'I I I I I','','C');
	  else if($dataa[4]==1)	    
			$this->MultiCell($w[5],6,'H I I I I','','C');
	  else if($dataa[4]==2)	    
			$this->MultiCell($w[5],6,'H H I I I','','C');
			else if($dataa[4]==3)	    
			$this->MultiCell($w[5],6,'H H H I I','','C');
			else if($dataa[4]==4)	    
			$this->MultiCell($w[5],6,'H H H H I','','C');
			else if($dataa[4]==5)	    
			$this->MultiCell($w[5],6,'H H H H H','','C');
     $this->SetFont('Arial','B',10);
	 
	 
	 
	 
	 $query = "select * from visitattachment where visitid =".$x['checkinid'];
	 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	 $t=0;
	 while($y = mysqli_fetch_array($results)){
	 	 
		  $xx=$this->GetX();
	  $yy=$this->GetY();
	 
	 	$this->Image('../../att/visits/'.$x['checkinid'].'/'.$y['description'],$xx+$t,$yy+1,30);
	 $t+=35;
	 }
	 
	 
		$this->Cell(array_sum($w),0,'','T');
		$this->Ln(10);
		if($countt>28){
			$this->Ln(50);
			$countt=0;
		}
		
		
	 }
	 

	
	$this->Ln(5);
	$this->Cell(180,7,"Number Of Visits : ".$count,0,0,'R');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
// Column headings
$header = array('Employee','Checkin Date','Checkout Date','Description','Feedback','Rating');
// Data loading
$pdf->SetFont('Arial','',9);
$pdf->AddPage('L');
$pdf->ImprovedTable($header);
$pdf->Output();
?>