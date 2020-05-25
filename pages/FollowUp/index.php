<?php  session_start(); ?>
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
 
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
								if($_SESSION['fucv']!=1){
									header("Location: ../Blank");
								}

  ?>
    <div id="wrapper">

        <!-- Navigation -->
                        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Green Studios</a>
            </div>
            <!-- /.navbar-header -->

                          <ul class="nav navbar-top-links navbar-right">

        <li class="dropdown">
   Logged In By <?php echo($_SESSION['User']);?>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                   
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

               
  <?php include("../menu.php"); ?>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                	
                    <h1 class="page-header">Follow Up</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
                        	<div class="row" align="left">
					<form method="post">
						
						<div class="col-lg-2">
						From Date<input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "fromdate" name="fromdate"  value="<?php if (isset($_POST['fromdate'])) {echo($_POST['fromdate']);} ?>"/>
					</div>
					<div class="col-lg-2">
						To Date<input class="form-control" style="width: 100%;text-align: right;" type ="date" id= "todate" name="todate"  value="<?php if (isset($_POST['todate'])) {echo($_POST['todate']);} ?>"/>
					</div>
					<div class="col-lg-2">
						Projects
						<?php	$query = "Select *  From offers order by projectname asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>


	<select class="form-control" id="fproject" name="fproject" style="width: 100%; ">
		<option value="All" <?php if(isset($_POST['fproject'])){ if($_POST['fproject']=='All') echo "selected";} ?>>All</option>
		<?php
		while($x = mysqli_fetch_array($results)){?>
		<option value="<?php echo($x['Serial']); ?>" <?php if(isset($_POST['fproject'])){ if($_POST['fproject']==$x['Serial']) echo "selected";} ?>><?php echo($x['ProjectName']);?></option>
 <?php 
}?>
		</select>
					</div>
					<div class="col-lg-2">
						Country
						<select  class="form-control" id="fcountry" name="fcountry" style="width: 100%;" >
											<option selected value="All">All</option>
											<?php 
											include('../configdb.php');
										$query="select distinct(Country) as country from offers where country <> '' order by country asc";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["country"]); ?>" <?php
												if (isset($_POST['fcountry'])) {
													if ($_POST['fcountry'] == $x['country'])
														echo("selected");
												}
 ?>><?php echo($x["country"]); ?></option>
											<?php } ?>
											</select>
					</div>
					<div class="col-lg-2 nopadding">
                        			User
                        	 <select  class="form-control" id="fuser" name="fuser" style="width: 100%;" >
											<option selected value="All">All</option>
											<?php 
											include('../configdb.php');
										$query="select *  from users";
										$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											while($x = mysqli_fetch_array($results)){?>
											<option value="<?php echo($x["Serial"]); ?>" <?php if (isset($_POST['fuser'])) { if ($_POST['fuser'] == $x['Serial'])
														echo("selected");
												}
 ?>><?php echo($x["Fullname"]); ?></option>
											<?php } ?>
											</select>
                        	</div>
                        	 <div class="col-lg-1 nopadding">
                            	&nbsp;&nbsp;
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="frg" id="frg" value=""  value=""<?php if(isset($_POST['frg'])) {if($_POST['frg']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>RG 
                                    </label>
                               </div>
                              </div>
                             <div class="col-lg-1">
                             	&nbsp;&nbsp;
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="fgw" id="fgw" value=""  value=""<?php if(isset($_POST['fgw'])) {if($_POST['fgw']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>GW 
                                    </label>
                               </div>
                             </div>
                            </div>
                            <div class="row">
                            	<div class="col-lg-9"></div>
					<div class="col-lg-1">
						<br>
						<button type="button" id="seatch" class="btn btn-outline btn-primary" onclick="this.form.submit();"> Search</button>
					</div>
					<div class="col-lg-1">
						<br>
						<button type="button" id="Add" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['fuce']!=1){ echo('disabled'); }?> >Add Follow up</button>
					</div>
					</form>
							   
			</div>
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th>Date</th>
                                    	<th>Project</th>
                                        <th>Description</th>
                                        <th>Done By</th>
										
                                       <?php if($_SESSION['fuce']==1){?>      <th>Edit</th> <?php }?>
									   <?php if($_SESSION['fucd']==1){?>      <th>Delete</th> <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
if(isset($_POST['fuser']) && $_POST['fuser'] != 'All') {$user=" and userid=".$_POST['fuser'];}
	else {
		$user='';
	}								
include('../configdb.php');
if(isset($_POST['fcountry']) && $_POST['fcountry'] != 'All') {$country=" and offerid in (select serial from offers where country ='".$_POST['fcountry']."')";}
	else {
		$country='';
	}
if(isset($_POST['fromdate']) && $_POST['fromdate']!='')
$fromdate=" and dat >= '".$_POST['fromdate']."'";
else {
	$fromdate='';
}
if(isset($_POST['todate']) && $_POST['todate']!='')
$todate=" and dat <='".$_POST['todate']."'";
else {
	$todate='';
}
if(isset($_POST['fproject']) && $_POST['fproject']!='All')
$project=" and offerid =".$_POST['fproject'];
else {
	$project='';
}
$rg="";
$gw="";
if(isset($_POST['frg'])) 
{$rg=" and offerid in( select serial from offers where RG= 1) ";}
if(isset($_POST['fgw'])) 
{$gw=" and offerid in( select serial from offers where GW= 1) ";}
$query = "Select *,(select projectname from offers where serial =offerfollowup.offerid) as projectname,(select fullname from users where serial=offerfollowup.userid) as userN From offerfollowup where serial<> 0 $project $fromdate $todate $country $user $rg $gw order by dat desc,(select projectname from offers where serial =offerfollowup.offerid) asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
                                    <tr class="odd gradeX">
                                        <td><?php echo date("d-m-Y", strtotime($x["dat"]));?></td>
										 <td><?php echo($x["projectname"]);?></td>
										 <td><?php echo($x["description"]);?></td>
										  <td><?php echo($x["userN"]);?></td>
                                       
                              
                                                                      <?php if($_SESSION['fuce']==1){?>
<td class="center">
<a  id="Edit_<?php echo($x["serial"]);?>"  data-toggle="modal" data-target="#myModal" ><p class="fa fa-edit"></p> Edit</a>
</td>
<?php }  ?>
<?php if($_SESSION['fucd']==1){?>
<td class="center"><a  id="del_<?php echo($x["serial"]);?>"   <?php if($_SESSION['fucd']!=1){ echo('disabled'); }?> ><p class="fa fa-trash-o"></p> Delete</a></td>
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
				"aaSorting" : []
        });
    });
    </script>

	  <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
    
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>
        <div class="modal-body" align="center">
		<?php	$query = "Select *  From offers";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
?>
<label>Project</label>	

	<select class="form-control" id="project" style="width: 100%; ">
		<?php
		while($x = mysqli_fetch_array($results)){?>
		<option value="<?php echo($x['Serial']); ?>" ><?php echo($x['ProjectName']);?></option>
 <?php 
}?>
		</select>
			
	<label>Date</label><input class="form-control" type="date"   name="dat"  id="dat" style="width:100%;" >
	<label>Description</label><textarea class="form-control" type="text"   name="description1"  id="description1" style="width:100%;" rows="2"></textarea>
		
        </div>
        <div class="modal-footer">
        <label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
		<tr>
		<td>
        <button type="button" id="add1" class="btn btn-outline btn-primary" >Save</button>
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

  
<script src="../../js/followup.js"></script>
</body>

</html>
