<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Green Studios</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	  <?php
  session_start();
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
								if($_SESSION['ocv']!=1){
									header("Location: ../Blank");
								}

  ?>
  
 

        <!-- Navigation -->
            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
						<table><tr>
						<form method="post">
						<td>
						From Date
						</td>
							<td> &nbsp;</td>
						<td><input class="form-control" type="date"   name="fromdate"  id="fromdate" onchange="this.form.submit()" value="<?php if(isset($_POST['fromdate'])) {echo($_POST['fromdate']);}?>" ></td>
							<td> &nbsp;</td>
						<td>To Date </td><td><input class="form-control" type="date"   name="todate"  id="todate"  onchange="this.form.submit()" value="<?php if(isset($_POST['todate'])) {echo($_POST['todate']);}?>"> </td>
						</form>
						<td> &nbsp;</td>
		
						<td> <button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['oce']!=1){ echo('disabled'); }?> >Add Offer</button></td>
						</tr>
						</table>
					 
							  
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div width="100%" align="right">	 <a  id="btnExport">Export</a> </div>
                           <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size: 80%;">
                                <thead>
                                    <tr>
									<th>PE</th>
                                      <th>Project Name </th>
                                      <th>Country</th>
									  <th>City</th>
									  <th>Client</th>
									  <th>GW</th>
									  <th>GW Area</th>
									   <th>RG</th>
									  <th>RG Area</th>
									  <th>Offer Ref#</th>
									  <th>Refferal</th>
									  <th>INT</th>
									  <th>EXT</th>									  									 
									  <th>Offer</th>
									  <th>HP</th>
									  
									  <th>Offer value</th>
									  <th>Remaining</th>
									  <th>Signed</th>
									  <th>Signed Date</th>
									   <th>Canceled</th>
									  <th>Status</th>
									  <th>Status Date</th>
									  <th>Kick Off Date</th>
									  <th>Due Date</th>
									  <th>Attach</th>
									  <th>Build-UP</th>
									  <th>Technical Room</th>
									  <th>Completed</th>
									  <th>Notes</th>
									  
									   <?php if($_SESSION['ocd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

								<?php
										include('../configdb.php');
												
if(isset($_POST['fromdate']))
$fromdate=$_POST['fromdate'];
else {
	$fromdate='';
}
if(isset($_POST['todate']))
$todate=$_POST['todate'];
else {
	$todate='';
}
$confidential="";
if($_SESSION['IsAdmin']!=1){
	$confidential=" and confidential =0";
}
$query ="select *,(select company from customers where serial = offers.customerid) as Client,(select company from customers where serial = offers.referral) as Referral,(select username from users where serial=offers.lastuser) as LastUser,lastupdated,(select count(*) from offerattachment where offerid=offers.serial ".$confidential.") as cnt,(select count(*) from refferalnotes where offerid=offers.serial) as Refcnt,(select count(description) from offerattachment where offerid=offers.serial and main=1) as Imagee from offers where manuel=0 ";
 if($fromdate!=''){ $query =$query." and dat>='$fromdate'"; }
  if($todate!=''){ $query =$query." and dat<='$todate'"; }
  if($_SESSION['filter']==3){$query =$query." and serial in (".$_SESSION['datafilter'].")";}
    if($_SESSION['filter']==2){
		$countries=$_SESSION['datafilter'];
		$countries= str_replace(",", "','", $countries);
		$query =$query." and country in ('".$countries."')";}
	if($_SESSION['IsAdmin']!=1){$query =$query." and userid=".$_SESSION['UserSerial']." ";}
	
 $query =$query." Order by order1,order2 desc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());

while($x = mysqli_fetch_array($results)){
?>
                                    <tr class="odd gradeX"  style="background-color:<?php
                                    
									if ($x["status"]=='Canceled'){echo("Red");}
									elseif( $x["status"]=='Completed'){echo("Violet");}
									elseif ($x["status"]=='Potential'){echo("Green");}
									elseif ($x["status"]=='Offer'){echo("");}
									elseif ( $x["status"]=='In Hand'){echo("LightBlue");}
									elseif ($x["status"]!='Offer'){echo("#F75A53");}
									
												
?>">
<td><?php if($x["hp"]==1){ ?> <span class="fa fa-star fa-2x" style="color:yellow;"></span> <?php }?><?php if ($x["bd"]==1){?> <span class="fa fa-user"></span> <?php }?><?php if ($x["dealer"]==1){?> <span class="fa fa-flag"></span> <?php }?><?php echo($x["pe"]);?></td>   
       <?php if($_SESSION['oce']==1){?>
<td class="center"><span  data-toggle="tooltip" data-placement="top" title="<?php echo("LastUser : ".$x["LastUser"]);?><?php echo("  LastUpdated : ".$x["LastUpdated"]);?>">
<a  id="Edit_<?php echo($x["Serial"]);?>"  data-toggle="modal" data-target="#myModal" style="color:black;" > <?php echo($x["ProjectName"]);?></a></span>
</td>
<?php } else{ ?>                         	
<td><?php echo($x["ProjectName"]);?></td>
<?php } ?>
<td><a  id="Img_<?php echo($x["Serial"]."/".$x["Imagee"]);?>"  data-toggle="modal" data-target="#ImageModal" style="color:black;" > <?php echo($x["Country"]);?></a></td>
<td><?php echo($x["city"]);?></td>
<td><?php echo($x["Client"]);?></td>
<td><?php if ($x["GW"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php echo($x["GWAREA"]);?></td>
<td><?php if ($x["RG"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php echo($x["RGAREA"]);?></td>
<td><?php echo($x["OfferRef"]);?></td>
<td> 
	<?php echo($x["Referral"]);?>
	<!--<a  href ="refferalnotes.php?x=<?php echo($x["Serial"]);?>" target="_blank"  ><?php echo($x["Refcnt"]);?> </a> -->
	</td>

<td><?php if ($x["GWINT"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php if ($x["GWEXT"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>



<td><?php if ($x["status"]!='Offer') {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?> </td>
<td><?php if ($x["hp"]!=1) {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>

<td><?php echo(number_format(round($x["OfferValue"],2)));?></td>
<td><?php echo($x["remaining"]);?></td>
<td><?php if ($x["status"]!='Signed') {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php if ($x["status"]=='Signed'){ if($x["OfferSignedDate"]!="0000-00-00"){echo($x["OfferSignedDate"]);}}?></td>
<td><?php if ($x["status"]!='Canceled') {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php echo($x["status"]);
?></td>
<td><?php echo($x["statusdate"]);?></td>
<td><?php if($x["kickoff"]!="0000-00-00"){ echo($x["kickoff"]);}?></td>
<td><?php if($x["duedate"]!="0000-00-00"){echo($x["duedate"]);} ?></td>
<td> <a  href ="attachments.php?x=<?php echo($x["Serial"]);?>" target="_blank"  ><?php echo($x["cnt"]);?> </a></td>
<td><?php echo($x["buildup"]);?></td>
<td><?php echo($x["troom"]);?></td>
<td ><?php if ($x["status"]!='Completed') {echo('<p class="fa fa-times"></p>');} else {echo('<p class="fa fa-check"></p>');} ?></td>
<td><?php echo($x["notes"]);?></td>
<?php if($_SESSION['ocd']==1){?>
<td class="center"><a href="" id="del_<?php echo($x["Serial"]);?>"   <?php if($_SESSION['ocd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
<?php }  ?>
                                    </tr>
									<?php 
}?>
                                </tbody>
                            </table>
                           
                 
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>	
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
 
    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
 
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
			"aaSorting": []
        });
    });
    </script>
  
	  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" >
   
      <!-- Modal content-->
      <div class="modal-content"  >
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="center">		
<fieldset  width="100%" height="100%">
		   <legend  style="font-size: 15px;" >Project Info</legend>
		<table>
	
	<tr>	
		<td>Date<input class="form-control" type="date"   name="date"  id="date"  ></td>
		<td>Due Date<input class="form-control" type="date"   name="duedate"  id="duedate"  ></td>

		</tr>
		<tr>
		<td colspan="2">Project Name<input class="form-control" type="text"   name="pname"  id="pname"  required></td>
		</tr>
		<tr>	
		<td>Country<input class="form-control" type="text" id="country" name="country" list="countryy" />
<datalist id="countryy">
  <?php
								
include('../configdb.php');
$query = "Select distinct(country) as country From offers";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option ><?php echo ($x['country']); ?></option>
						  <?php } ?>
</datalist></td>
		<td>PE<input class="form-control" type="text"   name="pe"  id="pe"  ></td>

		</tr>
		<tr>
		<td colspan="2">City<input class="form-control" type="text"   name="city"  id="city"  ></td>
		</tr>
	<?php	$query = "Select * From customers order by fname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
		<tr>
		<td colspan="2">Client/owner<select class="form-control" id="client" style="width: 100%; ">
	 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['fname']." ".$x['lname']."/".$x['company']); ?></option>
 <?php 
}?>
		</select></td>
		</tr>
		<tr>
		<td colspan="2">Clien Rep<select class="form-control" id="clien" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['fname']." ".$x['lname']."/".$x['company']); ?></option>
 <?php 
}?>
		</select></td>
		</tr>
		<tr>
		<td colspan="2">Consultant<select class="form-control" id="consultant" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['fname']." ".$x['lname']."/".$x['company']); ?></option>
 <?php 
}?>
		</select></td>
		</tr>
		<tr>
		<td colspan="2">Architect<select class="form-control" id="architect" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['fname']." ".$x['lname']."/".$x['company']); ?></option>
 <?php 
}?>
		</select></td>
		</tr>
		<tr>
		<td colspan="2">Landscape Architect<select class="form-control" id="larchitect" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['fname']." ".$x['lname']."/".$x['company']); ?></option>
 <?php 
}?>
		</select></td>
		</tr>
		<tr>
		<td colspan="2">Contractor<select class="form-control" id="contractor" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['fname']." ".$x['lname']."/".$x['company']); ?></option>
 <?php 
}?>
		</select></td>
		</tr>
		<tr>
		<td colspan="2">Refferal<select class="form-control" id="refferal" style="width: 100%; ">
		 <option value="0" selected></option>
		<?php
mysqli_data_seek($results, 0);
		while($x = mysqli_fetch_array($results)){?>
 <option value="<?php echo($x['Serial']); ?>" ><?php echo($x['fname']." ".$x['lname']."/".$x['company']); ?></option>
 <?php 
}?></select></td>
		</tr><tr style="display: none;">
		<td colspan="2" >Refferal Notes<textarea class="form-control" id="refferaln" size="3" style="width: 100%; "></textarea></td>
		</tr><tr>
			<td colspan="2">Expected Date of Project Kick-Off<input class="form-control" type="date"   name="kdate"  id="kdate"  ></td>
			</tr><tr>
		<td colspan="2">Notes<input class="form-control" type="text"   name="notes"  id="notes" style="width: 100%; " ></td>
		</tr>
	
		</table>
		</fieldset>
<br>
<br>
			<fieldset width="100%" height="100%">
			 <legend  style="font-size: 15px;" >Project type</legend>
			 <table style=" border: 1px solid #DDD;" width="100%">
			  <caption >GW</caption>
			 <tr>
			<td>  <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="gw" value="gw">GW &nbsp;
                                    </label>
                               </div>
							   </td>
							   <td>
							   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="int" value="int">INT &nbsp;
                                    </label>
                               </div>
							     </td>
							   <td>
							   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="ext" value="ext">EXT &nbsp;
                                    </label>
                               </div>
							     </td>
								<td>Area<input class="form-control" type="text"   name="area"  id="area"  ></td>
			
			</tr>
			 </table>
			
			 <table style=" border: 1px solid #DDD;" width="100%">
			  <caption>RG</caption>
			 <tr>
			 <td >
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="rg" value="rg">RG &nbsp;
                                    </label>
                               </div>
							  </td><td>&nbsp;&nbsp;</td>
							  <td>
								Area<input class="form-control" type="text"   name="rgarea"  id="rgarea"  >
								
								</td></tr></table>
		<table style=" border: 1px solid #DDD;display:none;" >
			  <caption>Design</caption><tr>
			 <td >
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="ls" value="ls">Design &nbsp;
                                    </label>
                               </div>
							  </td>
							  <td>
								Area<input class="form-control" type="text"   name="lsarea"  id="lsarea"  style="width: 100%; ">
								
								</td></tr></table>
						
				
				<table width="100%"  >
			
				<tr>
				<td>
					Build-UP<textarea class="form-control" id="buildup" size="3" style="width: 100%; "></textarea>
				</td>
				</tr>
				<tr>
				<td>
					Technical-Room<textarea class="form-control" id="troom" size="3" style="width: 100%; "></textarea>
				</td>
				</tr>
				</table>
				</fieldset>
						<br>
				<br>
 <table width="100%">
			 <tr>
			 <td>
			Offer Status<select class="form-control" id="status" style="width: 100%; ">
	 <option value="Inquiry">Inquiry</option>
	 <option value="Offer">Offer</option>
	 <option value="In Hand">In Hand</option>
	 <option value="Offer">Offer</option>
	 <option value="Potential">Potential</option>
	 <option value="Completed">Completed</option>
	 <option value="Canceled">Canceled</option>
	 <option value="WIP">WIP</option>
	 <option value="Signed">Signed</option>
		</select></td>
		          <td> Offer Status
							     <input class="form-control" type="date"   name="statusdate"  id="statusdate"  >
			 </td>
			 </tr>
			 </table>
			 <br>
			 <table width="100%">

			  	 <tr>

			  <td colspan="2" >
			  Cancel Reason
			<input class="form-control" type="text"   name="cancelreason"  id="cancelreason"  >
			 </td>
			 </tr>
			 <tr>
			 <td colspan="2">
			    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="tsupport" value="tsupport">Tech Support &nbsp;
                                    </label>
                               </div>
							
								   
			 </td>
			 </tr>
			 <tr>
			 <td>
			      <input class="form-control" type="date"   name="tstartdate"  id="tstartdate" >
			 </td>
			  <td>
		
			    <input class="form-control" type="date"   name="tenddate"  id="tenddate"  >
			  
			 </td>
			 </tr>
	
			 <tr style="display:none;">
			 <td colspan="2">
			    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="design" value="design">Design &nbsp;
                                    </label>
                               </div>
							
			 </td>
			 </tr>
			 <tr style="display:none;">
			  <td>
			       <input class="form-control" type="date"   name="dstartdate"  id="dstartdate"  >
			  </td>
			  <td>
							       <input class="form-control" type="date"   name="denddate"  id="denddate"  >
			 </td>
			 </tr>
			
			 	 <tr>

		

			  <td colspan="2">
			  	 Ref #
			<input class="form-control" type="text"   name="offerref"  id="offerref"  >
			 </td>
			 </tr>
			 	 <tr>

		

			  <td >
			  <?php if($_SESSION['hidevalues']!=1){?>
			  	 Value
			  <?php } ?>
			<input class="form-control" type="text"   name="offervalue"  id="offervalue"  <?php if($_SESSION['hidevalues']==1){?> style=" display:none; visibility:hidden;"    <?php } ?> >
			 </td>
			   <td >
			  	 Remaining
			<input class="form-control" type="text"   name="offerremaining"  id="offerremaining"  >
			 </td>
			 </tr>
			  <tr>

			  <td >
			  <table><tr><td>
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dealer" value="dealer">Agent &nbsp;
                                    </label>
                               </div>
							   </td>
							      <td>
			   <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="bd" value="bd">Business development &nbsp;
                                    </label>
                               </div>
							   </td>
							 <td>
			   <div class="checkbox">
                                     <label>
                                      <input type="checkbox" id="hprobability" value="hprobability">High Probability &nbsp;
                                    </label>
                               </div>
                             </td>
							
							   </tr>
							  </table>
							  	<form id="formattachment" target="blank" action="upload.php?x=<?php if (isset($_GET['x']))echo $_GET['x']; ?>" method="post" enctype="multipart/form-data">
							  <table>
							  <tr> 
							  	<td width="25%"><input type="file" name="fileToUpload[]" id="fileToUpload" style="display:none;" multiple>
						
					<input type="button" id="btnsearch" style="width: 100%;" class="btn btn-primary" onclick = "document.getElementById('fileToUpload').click();" value="Select Attachment"> 
					<td>&nbsp;</td>
					<td width="75%" >
						<input class="form-control" type="text"   name="attachment12"  id="attachment12" style="width:100%;" required>
						</td>
						
						
					
					</td>
					<td>&nbsp;</td>
					<td> <button type="button" id="save" class="btn btn-primary" >Save</button></td>
					</tr>
							   </table>
							   </form>
<!-- /container -->
			 </td>
			
			 </tr>
			 </table>
			 <div align="left">
			<table border="1" id="tableattachment" style="width: 80%">
				
			</table>
			</div>
        </div>
        <div class="modal-footer" >
			<label id ="lblalert1" style="visibility: hidden; color: red;">Please Choose Attachment !</label>
        	<label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Project Name !</label>
		<table align="center"  >
			
		<tr>
			<td>
	
        <button type="button" id="ref"class="btn btn-outline btn-primary" >Refferal notes</button>
		</td>
			<td width="10">
		</td>
		<td>
	
        <button type="button" id="att1"class="btn btn-outline btn-primary" >Attach</button>
		</td>
			<td width="10">
		</td>
		<td>
	
        <button type="button" id="add1"class="btn btn-outline btn-primary" >Save</button>
		</td>
		<td width="10">
		</td>
		<td>
          <button type="button" id="exit1"class="btn btn-outline btn-primary" data-dismiss="modal">Exit</button>
          </td>
		</tr>
		</table>
		
        </div>
	
      </div>
    
    </div>
  </div>


 </div> 
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script src="../../js/offers.js"></script>
</body>

</html>
