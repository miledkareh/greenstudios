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
									if($_SESSION['atcv']!=1){
									header("Location: ../Blank");
				}

include('../configdb.php');
$query = "Update audit set seen=1";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
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
                
                    <h1 class="page-header">Audit Trail</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="right">
					
							 <form method="post">
                        	<div class="row">
                        	
                        		<div class="col-lg-2 nopadding">
                        			Activity
                        			 <select  class="form-control" id="activity" name="activity" style="width: 100%;" >
											<option  value="All" <?php if(isset($_POST['activity'])){ if($_POST['activity']=='All') echo "selected";} ?>>All</option>
											<?php	$query = "Select distinct(description)  From audit order by description asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());

											while($x = mysqli_fetch_array($results)){?>
		<option  style="background-color: <?php if($x['description']=='New followup added') echo "lightblue";else if($x['description']=='New maintenance followup added') echo "salmon";else if($x['description']=='New Plant has been Added') echo "lightgrey";else if($x['description']=='Plant has been Updated') echo "lightgrey"; else if ($x['description']=='Client Updated') echo "yellow"; else if ($x['description']=='Followup updated') echo "#9FB5D1"; else if ($x['description']=='New Client added') echo "#F9F9B4"; else if ($x['description']=='New Offer added') echo "#98FD32"; else if ($x['description']=='Offer Updated') echo "#C4FD8B";?>" value="<?php echo($x['description']); ?>" <?php if(isset($_POST['activity'])){ if($_POST['activity']==$x['description']) echo "selected";} ?>><?php echo($x['description']);?></option>
 <?php 
}?></select>
                        		</div>
                        		<div class="col-lg-2 nopadding">
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
                        	<div class="col-lg-1">
                                    	&nbsp;&nbsp;
                                     <div class="checkbox">
                                     <label>
                                      <input type="checkbox" name="fhp" id="fhp" value=""  value=""<?php if(isset($_POST['fhp'])) {if($_POST['fhp']=='checked'){echo("checked='TRUE'");} else{ echo("checked='FALSE'");}}?>>HP
                                    </label>
                               </div>
                            </div>
                        	<div class="col-lg-1 nopadding">
										 <br>
											<button type="button" id="search" class="btn btn-outline btn-primary" onclick="this.form.submit()">Search</button>
										</div>
										
                        	</div>
                        	</form>
			
						
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    	<th></th>
                                    	<th>Date</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Project</th>
                                          <th>Country</th>
                                        <th>User</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

								<?php
$activity='';
if(isset($_POST['activity']) && $_POST['activity'] !='All')
$activity=" and description='".$_POST['activity']."'";
else {
	$activity='';
}
if(isset($_POST['fcountry']) && $_POST['fcountry'] != 'All') {$country=$_POST['fcountry'];}
	else {
		$country='';
	}
	if(isset($_POST['fuser']) && $_POST['fuser'] != 'All') {$user=" and userid=".$_POST['fuser'];}
	else {
		$user='';
	}
	$hp="";
	if(isset($_POST['fhp'])) 
{$hp=1;}
$query = "Select *,(select fullname from users where serial=audit.userid) as userN from audit where serial <> 0 $activity $user order by dat desc,seen desc";

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>

                                      
                                    	<?php 
                                    	
										 if($x['tablename']=='customers'){
												$query = "Select concat(company,'/',fname,' ', lname) as description1,'' as projectname,country,0 as hp from customers where serial=".$x['tableserial'];
											if($country!='')
											$query.=" and country='$country'";
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if($x['tablename']=='offerfollowup'){
												$query = "Select description as description1,(select projectname from offers where serial=offerfollowup.offerid) as projectname,(select country from offers where serial=offerfollowup.offerid) as country,(select hp from offers where serial=offerfollowup.offerid) as hp from offerfollowup where serial=".$x['tableserial'];
											if($country!='')
											$query.=" and offerid in (select serial from offers where country='$country')";
											if($hp==1)
											$query.=" and offerid in (select serial from offers where hp=1)";
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if($x['tablename']=='mfollowup'){
												$query = "Select description as description1,(select projectname from offers where serial =maintenances.offerid) as projectname,(select country from offers where serial =maintenances.offerid) as country,(select hp from offers where serial =maintenances.offerid) as hp from maintenances where serial=".$x['tableserial'];
											if($country!='')
											$query.=" and offerid in (select serial from offers where country='$country')";
											if($hp==1)
											$query.=" and offerid in (select serial from offers where hp=1)";
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
											else if ($x['tablename']=='offers'){
                                    		$query = "Select projectname as description1,projectname,country,hp from offers where serial=".$x['tableserial'];
												if($country!='')
											$query.=" and country='$country'";
												if($hp==1)
											$query.=" and  hp=1";
											$resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
											if($z = mysqli_fetch_array($resultss)){}}
                                                else if($x['tablename']=='Plants'){
                                                        $query = "Select scientic as description1,country  from Plants where serial=".$x['tableserial'];
                                              
                                            $resultss = mysqli_query($dbhandle,$query)  or die(mysqli_error());
                                            if($z = mysqli_fetch_array($resultss)){}

                                                }
											
											?>
                                    <tr class="odd gradeX" style="background-color: <?php if($x['description']=='New followup added') echo "lightblue";else if($x['description']=='New maintenance followup added') echo "salmon"; else if ($x['description']=='Client Updated') echo "yellow"; else if ($x['description']=='Followup updated') echo "#9FB5D1"; else if ($x['description']=='New Client added') echo "#F9F9B4"; else if ($x['description']=='New Offer added') echo "#98FD32"; else if ($x['description']=='Offer Updated') echo "#C4FD8B";
                                    else if ($x['description']=='New Plant has been Added'||$x['description']=='Plant has been Updated') echo "lightgrey";?>">

                                           <?php if($x['description']=='New Plant has been Added'||$x['description']=='Plant has been Updated'){ ?>
                                            <td></td><?php }else{ ?>
                                     <td><?php if($z['hp']==1){?><span class="fa fa-star" ></span><?php }?></td>
                                     <?php } ?>






                                    		
                                    	 <td ><?php echo($x["dat"]);?></td>                                	
                                        <td><?php echo($x["description"]);?></td>
                                       

                                       <?php if($x['description']=='New Plant has been Added'||$x['description']=='Plant has been Updated'){ ?>
                                            <td><?php echo($z["description1"]);?></td>
                                        <?php }else{ ?>
                                         <td><?php echo($z["description1"]);?></td>
                                     <?php } ?>

                                          <?php if($x['description']=='New Plant has been Added'||$x['description']=='Plant has been Updated'){ ?>
                                            <td></td><?php }else{ ?>
                                         <td><?php echo($z["projectname"]);?></td>
                                     <?php } ?>

                                        


                                         <?php if($x['description']=='New Plant has been Added'||$x['description']=='Plant has been Updated'){ ?>
                                             <td><?php echo($z["country"]);?></td><?php }else{ ?>
                                         <td><?php echo($z["country"]);?></td>
                                     <?php } ?>
                                          <td><?php echo($x["userN"]);?></td>
          

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

	 

 </div> 

</body>

</html>
