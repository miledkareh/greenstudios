<?php
 session_start();
   
    // if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
    //     {
    //      header("Location: ./blank.php");
    //      echo "<script>location='./blank.php'</script>";
    //     }
require_once('../../TCPDF/tcpdf.php');

class MYPDF extends TCPDF {
 

 
 //Page header
function Header()
{

   
  

 $this->SetFont('dejavusans','B',12);


//  $this->StartTransform();

// //$this->Cell(0,0,'G R E E N  S T U D I O S',1,1,'L',0,'');
//  $this->Cell(190,0,"",0,0,'L');
//  $this->Rotate(-90);
//  $this->Cell(60,0,"G R E E N  S T U D I O S",0,0,'L');
// // $this->RotatedText(195,18,'G R E E N  S T U D I O S ',270);
//  $this->SetFont('dejavusans','',5);
//  $this->Cell(40,0,"L A N D S C A P E  T E C H N O L O G Y",0,0,'L');
//  $this->SetFont('dejavusans','',3);
//  $this->Cell(100,0,"---------------------------------------------------------------------------------------------------------------------------------------------------------------
//  ------------------------------------------------------------------------------------------------------------------------------------------------------
//  -------------------------------------------------------------------------------------------------------------------------------------------------",0,0,'L');
//  $this->StopTransform();
 include('../configdb.php');
  $query = "Select * from genpar where serial=1";
  //echo($_GET["to"]);
  $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
    $data = array();
 if($x = mysqli_fetch_array($results)){
$this->SetFont('dejavusans','',14);
	 
$this->Ln(4); // Title
 $this->Cell(100,20,'Bill Of Quantities',0,0,'L');
 $this->SetFont('dejavusans','',9);
 $this->SetTextColor(0,0,0);
 $this->Cell(90,20,$x['company'],0,0,'R');
 $this->Ln(4);
 $this->SetFont('dejavusans','',8);
 $this->Cell(190,20,$x['address'],0,0,'R');
 $this->Ln(3);
 $this->Cell(190,20,$x['street'],0,0,'R');
 $this->Ln(3);
 $this->Cell(190,20,$x['building'],0,0,'R');
 $this->Ln(3);
 $this->Cell(190,20,$x['floor'],0,0,'R');
 $this->Ln(3);
 $this->Cell(190,20,$x['city'],0,0,'R');
 $this->Ln(3);
 $this->Cell(190,20,$x['phone'],0,0,'R');
 $this->Ln(3);
 $this->Cell(190,20,$x['website'],0,0,'R');
 $this->Ln(18);
 }
  
 
}
function Footer()
{

 // Position at 1.5 cm from bottom
 // $this->SetY(-10);
 // $this->SetX(25);
 // // Arial italic 8
 // $this->SetFont('dejavusans','',10);
 // $this->SetTextColor(169,169,169);
 // // Page number
 // $this->Cell(0,10,'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,0,'C');
 // $this->Image('logoreport2.jpg',10,280,190);

}
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 50, 10);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
 require_once(dirname(__FILE__).'/lang/eng.php');
 $pdf->setLanguageArray($l);
}
$pdf->AddPage();
// ---------------------------------------------------------
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

 
// add a page
 

// $pdf->SetFont('dejavusans','',9);

include('../configdb.php');
$query="select *,
(select name from microcontrollers where serial=boq.microtype)as MICRO,
(select description  from items where serial=boq.closetype )as CLOSETYPE, 
(select dimension  from items where serial=boq.closetype )as CLOSETYPEDIM,

(select description  from items where serial=boq.watertype )as WATERTYPE, 
(select dimension  from items where serial=boq.watertype )as WATERTYPEDIM,

(select description  from items where serial=boq.omegatype )as OMEGATYPE, 
(select dimension  from items where serial=boq.omegatype )as OMEGATYPEDIM,

(select description  from items where serial=boq.screwstype)as SCREWTYPE, 
(select dimension  from items where serial=boq.screwstype)as SCREWTYPEDIM,

(select description  from items where serial=boq.anchorstype)as ANCHORTYPE, 
(select dimension  from items where serial=boq.anchorstype)as ANCHORTYPEDIM,

(select description  from items where serial=boq.watersealanttype)as WATERSEALANTTYPE, 
 

(select description  from items where serial=boq.watersealant2type)as WATERSEALANT2TYPE, 

(select description  from items where serial=boq.jambstype)as JAMBSTYPE, 
(select dimension  from items where serial=boq.jambstype)as JAMBSTYPEDIM,

(select description  from items where serial=boq.staplestype)as STAPLESTYPE,
(select dimension  from items where serial=boq.staplestype)as STAPLESTYPEDIM, 


(select description from microcontrollers where serial=boq.microtype)as Description

 from boq where serial='".$_GET['serial']."' ";



 $results = mysqli_query($dbhandle,$query)  or die(mysqli_error());

 if($x = mysqli_fetch_array($results)){}
//Table with 20 rows and 4 columns

  $query1="select *,
(select company from customers where serial= offers.CustomerID)as CUST
 from offers where serial in (select offer_id from boq where serial='".$_GET['serial']."')";



 $results1 = mysqli_query($dbhandle,$query1)  or die(mysqli_error());

 if($y = mysqli_fetch_array($results1)){}

  $html ='<table   cellpadding="1" style="width:100%" >
<tr>
<th align="left" width="130px">Client : </th>
<th align="left">'.$y['CUST'].'</th>

 
</tr>
<tr>
<th align="left">Project Name : </th>
 <th align="left">'.$y['ProjectName'].'</th>
</tr>
<tr>
<th align="left">Date : </th>
 <th align="left">'.date("Y-m-d").'</th>
</tr>
</table><br><br>';
$html .='
<table   cellpadding="1" style="width:100%" >
 ';


$html.='
<tr nobr="true" >
 
<td style="border-top: 1px solid black;border-bottom: 1px solid black;" width="50px" align="center"><b>Item</b></td>
<td  style="border-top: 1px solid black;border-bottom: 1px solid black;" width="510px" align="center"><b>Description</b></td>
<td  style="border-top: 1px solid black;border-bottom: 1px solid black;" width="50px" align="center"><b>Unit</b></td>
<td  style="border-top: 1px solid black;border-bottom: 1px solid black;" width="65px" align="center"><b>';

if($y['GWINT']==1)
$html.='Indoor</b></td></tr>';
else
$html.='Outdoor</b></td></tr>';

 


$html.='<tr nobr="true" >
 
<td align="center"><b></b></td>
<td align="center"><u>Supply & Installation of  Green wall</u></td>
<td align="center">m²</td>
<td align="center">'.$x['gw_area'].'</td>
 
</tr>


<tr nobr="true" >
 
<td colspan="4" align="center"></td>

 
</tr>



<tr nobr="true" >
 
<td align="center"><b>1.0</b></td>
<td align="left"><b>L Shaped Jambs</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>

<tr nobr="true" >
 
<td align="center"></td>
<td align="left">'.$x['JAMBSTYPE'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['jambsqty'].'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"></td>
<td align="left"><b>Dimensions:</b>'.$x['JAMBSTYPEDIM'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['corners'].'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"></td>
<td align="left"></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>1.1</b></td>
<td align="left"><b>Corners</b><br><b>Dimension:</b> 40 x 40 cm</td>
<td align="center"></td>
<td align="center"></td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>1.2</b></td>
<td align="left">'.$x['SCREWTYPE'].'<br><b>Dimension:</b>'.$x['SCREWTYPEDIM'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['jambsanchors'].'</td>
 
</tr>



<tr nobr="true" >
 
<td align="center"><b>1.3</b></td>
<td align="left">'.$x['ANCHORTYPE'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['jambsanchors'].'</td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>1.4</b></td>
<td align="left">'.$x['WATERSEALANTTYPE'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['jambswater'].'</td>
 
</tr>

 



 


<tr nobr="true" >
 
<td colspan="4" align="center"></td>
 
 
</tr>





<tr nobr="true" >
 
<td align="center"><b>2</b></td>
<td align="left"><b>Secondary structure</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>



<tr nobr="true" >
 
<td align="center"><b></b></td>
<td align="left">'.$x['OMEGATYPE'].'<br><b>Dimension:</b>'.$x['OMEGATYPEDIM'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['omegaqty'].'</td>
 
</tr>



<tr nobr="true" >
 
<td align="center"><b>2.1</b></td>
<td align="left">'.$x['SCREWTYPE'].'<br><b>Dimension:</b>'.$x['SCREWTYPEDIM'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['omegaanchors'].'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"><b>2.2</b></td>
<td align="left">'.$x['ANCHORTYPE'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['omegaanchors'].'</td>
 
</tr>



<tr nobr="true" >
 
<td align="center"><b>2.3</b></td>
<td align="left">'.$x['WATERSEALANT2TYPE'].'</td>
<td align="center">nr.</td>
<td align="center">'.$x['omegawater'].'</td>
 
</tr>



<tr nobr="true" >
 
<td colspan="4" align="center"></td>
 
 
</tr>

<tr nobr="true" >
 
<td align="center"><b>3</b></td>
<td align="left"><b>Waterproofing boards</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>







<tr nobr="true" >
<td align="center"></td>
<td align="left">PVC panels,  screwed to secondary structure (providing a 2.5cm air layer circulation), with joints and screws protected with waterproofing bitumen tape of 5cm width and chemical resistant water sealant.<br><b>Dimension:</b> Width: 244 cm, Length: 122 cm, Thickness: 12 mm</td>
<td align="center">nr.</td>
<td align="center">'.($x['pvcqty']).'</td>
</tr>

<tr nobr="true" >
 
<td align="center"><b>3.1</b></td>
<td align="left">'.$x['CLOSETYPE'].'
<br><b>Dimension:</b>'.$x['CLOSETYPEDIM'].' </td>
<td align="center">nr.</td>
<td align="center">'.($x['pvcclose']).'</td>
 
</tr>



<tr nobr="true" >
 
<td align="center"><b>3.2</b></td>
<td align="left">'.$x['WATERTYPE'].'<br>
<b>Dimension:</b>'.$x['WATERTYPEDIM'].'</td>
<td align="center">nr.</td>
<td align="center">'.($x['pvcwater']).'</td>
 
</tr>


<tr nobr="true" >
 
<td colspan="4" align="center"></td>
 
 
</tr>
<tr nobr="true" >
 
<td colspan="4" align="center"></td>
 
 
</tr>



<tr nobr="true" >
 
<td align="center"></td>
<td align="left"></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>

<tr nobr="true" >
 
<td align="center"><b>4</b></td>
<td align="left"><b>Irrigation system</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>



<tr nobr="true" >
 
<td align="center"><b>4.1</b></td>
<td align="left">Irrigation Pipes PE '.($x['pipesize']).' mm </td>
<td align="center">Lm</td>
<td align="center">'.($x['pipe']).'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"><b>4.2</b></td>
<td align="left">GS watering mat</td>
<td align="center">m2</td>
<td align="center">'.($x['gs']).'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"><b>4.3</b></td>
<td align="left">Velcro Irrigation Sleeve to cover irrigation pipe, length: 10m, width: 0.3 m</td>
<td align="center">nr.</td>
<td align="center">'.($x['lockk']).'</td>
 
</tr>




<tr nobr="true" >
 
<td align="center"><b>4.4</b></td>
<td align="left">Skin to cover flushing pipe, length: 2m, width: 0.3 m</td>
<td align="center">nr.</td>
<td align="center">'.($x['skin']).'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"></td>
<td align="left"></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>4.5</b></td>
<td align="left"><b>Irrigation fittings</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>4.5.1</b></td>
<td align="left">Pressure Compensating Emmitters PC '.($x['pcemitters']).'</td>
<td align="center">nr.</td>
<td align="center">'.($x['emitters']).'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"><b>4.5.2</b></td>
<td align="left">PE Elbow '.$x['elbow'].' mm</td>
<td align="center">nr.</td>
<td align="center">'.($x['elbowqty']).'</td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>4.5.3</b></td>
<td align="left">PE Ball Valve '.$x['ball'].' mm</td>
<td align="center">nr.</td>
<td align="center">'.($x['ballqty']).'</td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>4.5.4</b></td>
<td align="left">PE Adaptor '.($x['adapter']).' mm</td>
<td align="center">nr.</td>
<td align="center">'.($x['adapterqty']).'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"></td>
<td align="left"></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>








<tr nobr="true" >
 
<td align="center"><b>5</b></td>
<td align="left"><b>GS patented skin</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>






<tr nobr="true" >
 
<td align="center"><b>5.1</b></td>
<td align="left">Multi-layered hydroponic patented ‘skin’ type '.$x['skintype'].', engineered for different climates particularly for dry and hot weather, fixed onto waterproofing boards using air pressured stapling, ‘skin’ water retention capacity vary between 15 & 21 liters / sqm<br><b>Dimension: Height: 1.7 m, Width: 0.6m</b></td>
<td align="center">nr.</td>
<td align="center">'.$x['skinqty'].'</td>
 
</tr>



<tr nobr="true" >
 
<td align="center"><b>5.2</b></td>
<td align="left"><b>Dimension: Height: 1.7 m, Width: 0.3m</b></td>
<td align="center">nr.</td>
<td align="center">'.$x['skinadd'].'</td>
 
</tr>


<tr nobr="true" >
 
<td align="center"><b>5.3</b></td>
<td align="left">'.$x['STAPLESTYPE'].'<br><b>Dimension:</b>'.$x['STAPLESTYPEDIM'].'</td>
<td align="center">nr.</td>
<td align="center">'.($x['staples']+$x['staplesqty']).'</td>
 
</tr>





<tr nobr="true" >
 
<td colspan="4" align="center"></td>
 
 
</tr>

';

if($x['plumbsys']!='None' || $x['MICRO']!='None'){
$html.='<tr nobr="true" >
 
<td align="center"><b>6</b></td>
<td align="left"><b>Technical Room components</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>

 ';


if($x['plumbsys']!='None'){
$html.='<tr nobr="true" >
 
<td align="center"><b>6.1</b></td>
<td align="left">Plumbing System</td>
<td align="center">nr.</td>
<td align="center">'.$x['plumbsysqty'].'</td>
 
</tr>

<tr nobr="true" >
 
<td align="center"></td>
<td align="left">'.$x['plumbsys'].'</td>
<td align="center"></td>
<td align="center"></td>
 
</tr>
';
}

if($x['MICRO']!='None'){
 $html.='<tr nobr="true" >
 
<td align="center"><b>6.2</b></td>
<td align="left"><b>Irrigation Controller Board</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>

<tr nobr="true" >
 
<td align="center"></td>
<td align="left">'.$x['MICRO'].' : '.$x['Description'].'
</td>
<td align="center">nr.</td>
<td align="center">'.$x['microqty'].'</td>
 
</tr>

 

';
 }









if($x['sensorssm150t']!='0'){
$html.='<tr nobr="true" >
 
<td align="center"><b>6.3</b></td>
<td align="left"><b>Moisture Sensor</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>
<tr nobr="true" >

<td align="center"></td>
<td align="left">Soil moisture sensor - SM150T</td>
<td align="center">nr.</td>
<td align="center">'.$x['sensorssm150t'].'</td>
 
</tr>

 
';
}


if($x['sensorsflow']!='0'){
$html.='<tr nobr="true" >
 
<td align="center"><b>6.4</b></td>
<td align="left"><b>Flow Sensors</b></td>
<td align="center"></td>
<td align="center"></td>
 
</tr>
<tr nobr="true" >

<td align="center"></td>
<td align="left">Smart capacitive proximity sensor</td>
<td align="center">nr.</td>
<td align="center">'.$x['sensorssm150t'].'</td>
 
</tr>
 
';
}








 }
 
 
 $html.='</table>';


 
   // output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page

 $pdf->lastPage();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('Boq_report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
