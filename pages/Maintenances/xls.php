
<?php  
 
 include('../configdb.php');
  require_once '../../../PHPExcel/Classes/PHPExcel.php';
 


$tot=0;




$objPHPExcel = new PHPExcel();
$last=0;

// Set properties
$objPHPExcel->getProperties()->setCreator("----- Web Server");
$objPHPExcel->getProperties()->setLastModifiedBy("-----Web Server");
$objPHPExcel->getProperties()->setTitle("report");
$objPHPExcel->getProperties()->setSubject("report");
 

// Create a first sheet, representing sales data
//$objPHPExcel->setActiveSheetIndex(0);  
const UNDERLINE_SINGLE = 'single';
$styleArray = array(
  'font' => array(
    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);

   $objPHPExcel->setActiveSheetIndex(0);
   $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');
  
$cell_name = "A1";
$objPHPExcel->getActiveSheet()->getStyle( $cell_name )->getFont()->setBold( true );
$cell_name = "B1";
$objPHPExcel->getActiveSheet()->getStyle( $cell_name )->getFont()->setBold( true );

 $objPHPExcel->getActiveSheet()->SetCellValue('A5', "Date"); 
 $objPHPExcel->getActiveSheet()->SetCellValue('B5', "Cost($)"); 
        
    $sql="Select *, 
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN from maintenancedetails where accepted=1 and maintenanceid=".$_GET['x']; 
 

foreach(range('A','C') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}

$res = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
 $x = mysqli_fetch_array($res);

 $objPHPExcel->getActiveSheet()->SetCellValue('B1',$x[9]); 
 $objPHPExcel->getActiveSheet()->SetCellValue('A1',"Project Expenses"); 
 $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getFont()->setSize(16);


$objPHPExcel->getActiveSheet()->SetCellValue('A3', " Accumulated cost");
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($styleArray);  
 $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
  $objPHPExcel->getActiveSheet()->getStyle( 'A3')->getFont()->setBold( true );


 

  $objPHPExcel->getActiveSheet()->SetCellValue('A5', "Date");               





            $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
$i=6;
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $y['SUMCOST']);  
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }
 $i=$i+1;

 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Cost/m2"); 
  $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray); 

 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true );
 $i=$i+2;
 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Date");  
   $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Cost($)"); 
$i++;










    $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,
   (select GWAREA  from offers    where serial in (select offerid from maintenances where serial =".$_GET['x']."))as GWAREA ,
    (select RGAREA  from offers    where serial in (select offerid from maintenances where serial =".$_GET['x']."))as RGAREA ,

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  
if($y['RGAREA']==0)
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, round($y['SUMCOST']/$y['GWAREA'],2));  
else{
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, round($y['SUMCOST']/$y['RGAREA'],2));    
}



$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }
 $i=$i+1;

 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "1. Labor");  
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray); 
 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true );


 $i=$i+2;
 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Date");  
  $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, "Cost($)"); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Number of employees/time spent(hr)"); 
$i++;





         $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,
   
    (select cost  from visitcost where   visitid=maintenancedetails.serial and serviceid=2 )as COST,
   

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  

  

$arr=explode(",",$y['Employees']);
if($y['time']!=null){
 $time=explode(":", $y['time']);
 $tottime=$time[0]+($time[1]/60);
if($tottime==0)
  $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, '0');  
else
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, round(sizeof($arr)/$tottime,2));  

$objPHPExcel->getActiveSheet()->SetCellValue('c'.$i, $y['COST']);  
$tot+=$y['COST'];

}
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }

  $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Total");  
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $tot);  
$tot=0;

$i++;
 $i=$i+1;



 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "2. Plants"); 
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14); 
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray); 
 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true );
 $i=$i+2;
 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Date");  
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Number of Plants");  
  $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, "Cost($)");  
$i++;






          $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,
  (select nbplants from readingm where maintenancedetail_id=maintenancedetails.serial limit 1) as PLANTS ,
   (select cost  from visitcost where   visitid=maintenancedetails.serial and serviceid=3  or serviceid=4 limit 1)as COST,

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $y['PLANTS']);    
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $y['COST']);    
 $tot+=$y['COST'];
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }
   $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Total");  
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $tot);  
$tot=0;

$i++;
 $i=$i+1;


 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "3. Fertilizer ");  
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray); 
  
 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true );
 $i=$i+2;
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Cost($)"); 
 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Date");  
$i++;






        $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,
  (select nbplants from readingm where maintenancedetail_id=maintenancedetails.serial limit 1) as PLANTS ,
   (select cost  from visitcost where   visitid=maintenancedetails.serial and serviceid=6  or serviceid=7 limit 1 )as COST,

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  
 
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $y['COST']);    
 $tot+=$y['COST'];
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }

 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Total");  
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $tot);  
 $tot=0;

$i++;



 $i=$i+1;

 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "4. Pesticide spray"); 
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray); 
   $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Cost($)"); 
 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true ); 
 $i=$i+2;
 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Date");  
$i++;




        $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,
  (select nbplants from readingm where maintenancedetail_id=maintenancedetails.serial limit 1) as PLANTS ,
   (select cost  from visitcost where   visitid=maintenancedetails.serial and serviceid=4 )as COST,

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  
 
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $y['COST']);    
 $tot+=$y['COST'];
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }


  $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Total");  
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $tot);  

$tot=0;
$i++;
 $i=$i+1;

 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "5. Transportation"); 
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray); 
 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true ); 
 $i=$i+2;
 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Date");  
   $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Cost($)"); 
$i++;





          $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,
  (select nbplants from readingm where maintenancedetail_id=maintenancedetails.serial limit 1) as PLANTS ,
   (select cost  from visitcost where   visitid=maintenancedetails.serial and serviceid=1 )as COST,

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  
 
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $y['COST']);    
 $tot+=$y['COST'];
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }

  $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Total");  
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $tot);  
$tot=0;

$i++;
 $i=$i+1;

 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "6. Administration and supervision");  
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray); 
 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true );
 $i=$i+2;
 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Date");  
   $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Cost($)"); 
$i++;


   $sql2=  "Select *,
(select fullname from users where serial  = maintenancedetails.userid) as user,
employees as Employees,
 (select fname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as fname,
  (select lname from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as lname,
  (select nbplants from readingm where maintenancedetail_id=maintenancedetails.serial limit 1) as PLANTS ,
   (select cost  from visitcost where   visitid=maintenancedetails.serial and serviceid=8 )as COST,

 (select activity from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as title1,  
(select country from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address1,
(select city from customers where serial in (select customerid from offers where serial in (select offerid from maintenances where serial =".$_GET['x']."))) as address2,
(select projectname from offers where serial in (select offerid from maintenances where serial =".$_GET['x'].")) as projectN,
(select TIMEDIFF(checkoutdate, checkindate) from checkin where visit=maintenancedetails.serial) as time,
(select checkoutdate from checkin where visit=maintenancedetails.serial) as checkoutdate,
(select checkindate from checkin where visit=maintenancedetails.serial) as checkindate,
(select checkout from checkin where visit=maintenancedetails.serial) as checkout,
(select SUM(cost) from visitcost  where visitid=maintenancedetails.serial) as SUMCOST,
work as Work
 from maintenancedetails 
where accepted=1 and maintenanceid=".$_GET['x'];
 

// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['dat']);  
 
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $y['COST']);    
 $tot+=$y['COST'];
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }

  $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Total");  
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $tot);  
$tot=0;

$i++;
 $i=$i+1;

  
 $i=$i+2;
  
$i++;

 $sql2=  "select * from servicescost";

 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Legend");  
 $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(14);

 $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true );
 $i++;
  $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, "Services"); 
  $objPHPExcel->getActiveSheet()->getStyle( 'A'.$i)->getFont()->setBold( true ); 
  $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "Cost($)");  
  $objPHPExcel->getActiveSheet()->getStyle( 'B'.$i)->getFont()->setBold( true );
$i++;
// foreach(range('A','P') as $columnID) {
//     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
//         ->setAutoSize(true);
// }
 
$res2 = mysqli_query($dbhandle,$sql2)  or die(mysqli_error());
 while($y = mysqli_fetch_array($res2)){

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $y['description']);  
 
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $y['cost']);    
 
$i++;
// echo $query = "Select *,(select description from servicescost where serial=visitcost.serviceid) as description   from visitcost where visitid =".$y['Serial'];
//   $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
//     while($z = mysqli_fetch_array($result)){}

 }
 

  header('location:maintenance.xls');


 // if ($x["status"] == 'CANCELED') {

 //     $objPHPExcel->getActiveSheet()
 //    ->getStyle('A'.$i.':P'.$i)->getFill()
 //    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 //    ->getStartColor()
 //    ->setARGB('FFFF0000');
 //    } 
 //    elseif ($x["status"] == 'COMPLETED') {  $objPHPExcel->getActiveSheet()
 //    ->getStyle('A'.$i.':P'.$i)
 //    ->getFill()
 //    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 //    ->getStartColor()
 //    ->setRGB('990099');
 //    } elseif ($x["status"] == 'POTENTIAL') {
 //       $objPHPExcel->getActiveSheet()
 //    ->getStyle('A'.$i.':P'.$i)
 //    ->getFill()
 //    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 //    ->getStartColor()
 //    ->setARGB('FF00FF00');
 //    } elseif ($x["status"] == 'OFFER') { 
 //    } elseif ($x["status"] == 'IN HAND') {  
 //      $objPHPExcel->getActiveSheet()
 //    ->getStyle('A'.$i.':P'.$i)
 //    ->getFill()
 //    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 //    ->getStartColor()
 //    ->setARGB('FFafeeee');
 //    } elseif ($x["status"] == 'INQUIRIES') { 
 //    $objPHPExcel->getActiveSheet()
 //    ->getStyle('A'.$i.':P'.$i)
 //    ->getFill()
 //    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 //    ->getStartColor()
 //    ->setRGB('F75A53');
 //    }elseif ($x["status"] == 'ARCHIVED') {
 //        $objPHPExcel->getActiveSheet()
 //    ->getStyle('A'.$i.':P'.$i)
 //    ->getFill()
 //    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 //    ->getStartColor()
 //    ->setARGB('FFFFFF00');
 //    }
                 








//  $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $x['ProjectName']);  
//     $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $x['Country']); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$x['city'] ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,$x['Client']); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $x['status']);   

//        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, date("Y-m-d", strtotime($x['statusdate'])));   
//        if($x['GW']==0)
//        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, "No" ); 
//      else
//       $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, "Yes" );
  
//        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i,   $x['GWAREA']  ); 
       
//  if($x['RG']==0)
//        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,  "No" ); 
//        else
//           $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,  "Yes" ); 
     
//         $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i,    $x['RGAREA']  ); 
      

//         $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $x['OfferRef']);  
//     $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $x['Referral']); 


//     if ($x["status"] != 'OFFER')
//      $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i,"No"); 
//    else
//        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i,"Yes" ); 

//    if ($x["hp"] != 1)
//       $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, "No"); 
//     else
//        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i,"Yes"); 

//   $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, round($x["OfferValue"], 2) );   
//       // $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i,round($x["cost"], 2) );   
//       // $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i,round($x["gross"], 2));   
//        //$objPHPExcel->getActiveSheet()->SetCellValue('R'.$i,  round($x["remaining"], 2) ); 

//      //   if ($x["status"] != 'Canceled')
//      //   $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i,  "Yes" );  
//      // else
//      //   $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i,  "No" ); 


//        //$objPHPExcel->getActiveSheet()->SetCellValue('T'.$i,   $x['kickoff']  );  
//       //  $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i,  $x['duedate'] ); 

//         $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $x['buildup']);  
//    // $objPHPExcel->getActiveSheet()->SetCellValue('W'.$i, $x['cnttask']); 
//      //$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$i,$x['cprintout'] ); 

// // if ($x["status"] != 'Completed')
// //        $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$i,  "Yes" );  
// //      else
// //        $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$i,  "No" ); 


     
//        //$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$i,   $x['notes']  ); 
       
 
 


//        $i++;
//        $last=$i;
//   }
// $last+=2;
//   // $objPHPExcel->createSheet();
 

//   //  $objPHPExcel->setActiveSheetIndex(1);
//   //  $objPHPExcel->getActiveSheet()->setTitle('Sheet 2');
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$last, "");  
//     $objPHPExcel->getActiveSheet()->SetCellValue('B'.$last, "Total"); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.$last, "RG"); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.$last, "GW"); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$last, "Remaining");   
       

//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+1), "Budget");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+2), "INQUIRY");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+3), "In HAND");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+4), "Offer not HP");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+5), "Potential");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+6), "Complete");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+7), "Cancelled");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+8), "High Prob");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+9), "Business Development");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+10), " Agent");  
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.($last+11), " Archived");  
// $sql=$query2xls;
// $j=3;
// $res2 = mysqli_query($dbhandle,$sql)  or die(mysqli_error());
//  $x = mysqli_fetch_array($res2);


// //      $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray(
// //     array(
// //         'fill' => array(
// //             'type' => PHPExcel_Style_Fill::FILL_SOLID,
// //             'color' => array('rgb' => 'FF0000')
// //         )
// //     )
// // );

//     $objPHPExcel->getActiveSheet()
//     ->getStyle('A'.($last+1).':E'.($last+1))
//     ->getFill()
//     ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//     ->getStartColor()
//     ->setRGB('A9A9A9');

// $objPHPExcel->getActiveSheet()
//     ->getStyle('A'.($last+2).':E'.($last+2))
//     ->getFill()
//     ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//     ->getStartColor()
//     ->setRGB('F75A53');
 

// $objPHPExcel->getActiveSheet()
//     ->getStyle('A'.($last+3).':E'.($last+3))
//     ->getFill()
//     ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//     ->getStartColor()
//     ->setARGB('FF0000FF');
 

  

 

 
 

//       $objPHPExcel->getActiveSheet()
//     ->getStyle('A'.($last+5).':E'.($last+5))
//     ->getFill()
//     ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//     ->getStartColor()
//     ->setARGB('FF00FF00');
  

//     $objPHPExcel->getActiveSheet()
//     ->getStyle('A'.($last+6).':E'.($last+6))
//     ->applyFromArray(
//         array(
//             'fill' => array(
//                 'type' => PHPExcel_Style_Fill::FILL_SOLID,
//                 'color' => array('rgb' => 'EE82EE')
//             )
//         )
//     );

//      $objPHPExcel->getActiveSheet()
//     ->getStyle('A'.($last+7).':E'.($last+7))
//     ->getFill()
//     ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//     ->getStartColor()
//     ->setARGB('FFFF0000');

//  $objPHPExcel->getActiveSheet()
//     ->getStyle('A'.($last+11).':E'.($last+11))
//     ->getFill()
//     ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//     ->getStartColor()
//     ->setARGB('FFFFFF00');

//      $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+1),round((float)$x["sOFFERINQBudget"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+1),round((float)$x["sRGAREA"], 2)  ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+1), round((float)$x["sGWAREA"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+1),"");   
        

// $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+2), round((float)$x["sINQ"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+2),round((float)$x["sRGINQ"], 2)  ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+2), round((float)$x["sGWINQ"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+2),"");  

 
// $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+3), round($x["sInHandBudget"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+3),round($x["sINHANDRGBudget"], 2)  ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+3), round($x["sINHANDGWBudget"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+3),round($x["sINHANDRemaining"], 2));  


 

// $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+4), round($x["sOFFERBudget"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+4),round($x["sRGOFFERBudget"], 2)  ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+4), round($x["sGWOFFERBudget"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+4),"");  

   
//    $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+5), round($x["sPOT"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+5),round((float)$x["sRGPOT"], 2)  ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+5), round((float)$x["sGWPOT"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+5),"");  
 
                          

//        $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+6), round($x["sCompletedBudget"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+6),round($x["sRGCompletedBudget"], 2)  ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+6), round($x["sGWCompletedBudget"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+6),round($x["sRemainingCompletedBudget"], 2));             
                                     

//       $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+7), round($x["sCancelledBudget"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+7),round($x["sRGCancelledBudget"], 2) ); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+7), round($x["sGWCancelledBudget"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+7),"");    
                                    
                                  

//       $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+8), round($x["sHPBudget"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+8),round($x["sRGHPBudget"], 2)); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+8),round($x["sGWHPBudget"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+8),"");    
                                        
                                    
//       $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+9), round($x["sBusinessD"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+9),round($x["sRGBusinessD"], 2)); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+9),round($x["sGWBusinessD"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+9),"");    


//        $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+10),round($x["sAgent"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+10),round($x["sRGAgent"], 2)); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+10),round($x["sGWAgent"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+10),"");    
           

//                $objPHPExcel->getActiveSheet()->SetCellValue('B'.($last+11),round($x["sARCHIVED"], 2)); 
//      $objPHPExcel->getActiveSheet()->SetCellValue('C'.($last+11),round($x["sRGARCHIVED"], 2)); 
//       $objPHPExcel->getActiveSheet()->SetCellValue('D'.($last+11),round($x["sGWARCHIVED"], 2)); 
//        $objPHPExcel->getActiveSheet()->SetCellValue('E'.($last+11),round($x["sRemainingARCHIVED"], 2));                         
                                       


                                     

//}
 

    include '../../../PHPExcel/Classes/PHPExcel/IOFactory.php';
    $file_name ='Maintenance';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save($file_name.'.xls');

//header('location:"Offer.xls"');
 //header("Location: http://www.awebsite.com");
     

// $flag=0;
// echo '<script>window.close();window.open("http:Offer.xls");window.open("http://http://192.168.10.7:8181//greenstudios/pages/Offers/","_blank");</script>';

//echo $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];

 
  // header("Location:".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);


   ?>
 
