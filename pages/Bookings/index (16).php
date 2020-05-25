<?php
ini_set('memory_limit', '-1');
require_once('../calendar/bdd.php');


$sql = "SELECT serial as id,subject as title,dat as start,duedate as end, color,(select company from customers where serial=tickets.clientid) as clietname,(select Name from players where serial=events.player4) as player4name,resource,turn FROM events where deleted='0000-00-00'";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
$sql = "SELECT * from courts";
$req = $bdd->prepare($sql);
$req->execute();

$eventss = $req->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href='fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='scheduler.min.css' rel='stylesheet' />
<script src='moment.min.js'></script>
<script src='jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script src='scheduler.min.js'></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Courts Management</title>

    <!-- Bootstrap Core CSS -->
 
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    body {
        padding-top: 0px;
        padding-right:0px; 
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
	#calendar {
		max-width: 100%;
		
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
.navbar-default {
background-color:white;
}

.fc-time-grid .fc-slats td {
    height: 4em;
}

    </style>
</head>

<body >
 <?php
  session_start();
				
  ?>
    <div id="wrapper" style="background-color:white;">

        <!-- Navigation -->
                         <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" >
            <div class="navbar-header" style="background-color:white;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<table width="100%" height="100%" align="center" style="background-color:white;"><tr>
				<td >
                   
                                <img src="../logo.png"  />
                       
							</td>
							<td>
							<h3> &nbsp;&nbsp;PRIVATE CLUB COURTS </h3>
							</td>
							<td >
							&nbsp;
							</td>
							</tr>
							</table>
            </div>
            <!-- /.navbar-header -->
                          <ul class="nav navbar-top-links navbar-right" style="background-color:white;">
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

            <div class="navbar-default sidebar" role="navigation" style="background-color:white;">
  <ul class="nav" id="side-menu">

					 <li>
                          <div id="datepicker"></div>
                        </li>
						<?php if($_SESSION['dcv']==1){ ?>
								 <li>
                            <a href="../Dashboard/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>	
							<?php } ?>	
						<?php if($_SESSION['pcv']==1){ ?>
					 <li>
                            <a href="../Players/"><i class="fa fa-group fa-fw"></i> Players</a>
                        </li>
							<?php } ?>
						<?php if($_SESSION['rcv']==1){ ?>
					 <li>
                             <a href="../Report/"><i class="fa fa-file fa-fw"></i>Report</a>
                        </li>
							<?php } ?>
							 <?php if($_SESSION['ucv']==1 ||  $_SESSION['ccv']==1){ ?>
						 <li>
						    <a href="#"><i class="fa fa-wrench fa-fw"></i> Configure<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <?php if( $_SESSION['ucv']==1){ ?>
                                <li >
                                    <a href="../Courts/" ><i class="fa fa-sitemap fa-fw"></i>Courts</a>
                                </li>
								<?php } ?>
							 <?php if( $_SESSION['ucv']==1){ ?>
                                <li >
                                    <a href="../Users/" ><i class="fa fa-user fa-fw"></i>Users</a>
                                </li>
								   <li>
                                    <a href="../UserProfile/" ><i class="fa fa-shield fa-fw"></i>User Profile</a>
                                </li>
								<?php } ?>
								<?php } ?>
								</ul>
                        </li>
						
				
                            </ul>
							<ul class="nav" id="side-menu1">
         </ul>
            </div>
            <!-- /.navbar-static-side -->
        </nav>

          <div id="page-wrapper"  align=" left" >
		  <br>
        <div class="row" >
        	 <div class="col-lg-12" >
         <div style="width: 100%;" id="calendar" class="col-centered" style="background-color:white;">
         </div>
               </div>
            </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Event</h4>
			  </div>
			  <div class="modal-body">
				<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 1</label>
					<div class="col-sm-4">
<select name="player1" class="form-control" id="player1">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						</select>
						
					  	</div>
							<div class="col-sm-1">
						 <button type="button" id="a1" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="member1" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="invitation1" class="form-control" id="invitation1" placeholder="Invitation #">
						</div>
				  </div>
				  				<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 2</label>
					<div class="col-sm-4">
<select name="player2" class="form-control" id="player2">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						</select>
					  	</div>
							<div class="col-sm-1">
						 <button type="button" id="a2" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="member2" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="invitation2" class="form-control" id="invitation2" placeholder="Invitation #">
						</div>
				  </div>
				  		<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 3</label>
					<div class="col-sm-4">
<select name="player3" class="form-control" id="player3">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						  	    <option value="0" selected></option>
						</select>
					  	</div>
							<div class="col-sm-1">
						 <button type="button" id="a3" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="member3" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="invitation3" class="form-control" id="invitation3" placeholder="Invitation #">
						</div>
				  </div>
				  		<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 4</label>
					<div class="col-sm-4">
<select name="player4" class="form-control" id="player4">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						   <option value="0" selected></option>
						</select>
					  	</div>
							<div class="col-sm-1">
						 <button type="button" id="a4" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="member4" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="invitation4" class="form-control" id="invitation4" placeholder="Invitation #">
						</div>
				  </div>
				  			<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Court</label>
					<div class="col-sm-10">
					  <select name="resource" class="form-control" id="resource" >
									<?php
							
$query = "Select * From courts";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
							  <option value="0">Canceled</option>
						</select>
					</div>
				  </div>
				  		<div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2 control-label">Notes</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title">
					</div>
				  </div>
				 
				  
					<div class="col-sm-12 " style="margin-top: 5px;" >
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-5">
						<input type="date" name="start" class="form-control" id="start" >
						</div>
						<div class="col-sm-5">
							<input type="time" name="starttime" class="form-control" id="starttime" >
					</div>
	
				  </div>
				 
				 <div class="col-sm-12 " >
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-5">
					 <input type="date" name="end" class="form-control" id="end" >
					 </div>
						<div class="col-sm-5">
					 <input type="time" name="endtime" class="form-control" id="endtime" >
					</div>
				  </div>
				    <div class="col-sm-12 "  >
					<label for="title" class="col-sm-2">Repeat Till</label>
					<div class="col-sm-10">
					  <input type="date" name="repeat" class="form-control" id="repeat">
					</div>
				  </div>
				  <div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2">Turn ON/OFF</label>
					<div class="col-sm-10">
					 <select name="turn" class="form-control" id="turn" >
						
						<option value="2" style="background-color:red;">OFF</option>
						<option value="3" style="background-color:white;" selected>AUTO</option>
						</select>
					</div>
				  </div>
					<div>&nbsp;</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="Save" class="btn btn-primary">Save changes</button>
			  </div>
			
			</div>
		  </div>
		</div>
		

		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
			  </div>
			  <div class="modal-body">
			<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 1</label>
					<div class="col-sm-4">
<select name="eplayer1" class="form-control" id="eplayer1">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						</select>
					  	</div>
						<div class="col-sm-1">
						 <button type="button" id="a5" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="emember1" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="einvitation1" class="form-control" id="einvitation1" placeholder="Invitation #">
						</div>
				  </div>
				  				<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 2</label>
					<div class="col-sm-4">
<select name="eplayer2" class="form-control" id="eplayer2">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						</select>
					  	</div>
						<div class="col-sm-1">
						 <button type="button" id="a6" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="emember2" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="einvitation2" class="form-control" id="einvitation2" placeholder="Invitation #">
						</div>
				  </div>
				  		<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 3</label>
					<div class="col-sm-4">
<select name="eplayer3" class="form-control" id="eplayer3">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						  	    <option value="0" selected></option>
						</select>
					  	</div>
						<div class="col-sm-1">
						 <button type="button" id="a7" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="emember3" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="einvitation3" class="form-control" id="einvitation3" placeholder="Invitation #">
						</div>
				  </div>
				  		<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Player 4</label>
					<div class="col-sm-4">
<select name="eplayer4" class="form-control" id="eplayer4">
							<?php
								
include('../configdb.php');
$query = "Select * From players order by name asc";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
						   <option value="0" selected></option>
						</select>
					  	</div>
						<div class="col-sm-1">
						 <button type="button" id="a8" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
                            </button>
							</div>
						<div class="col-sm-2">
						 <div class="checkbox">
        <label>
        <input type="checkbox" id="emember4" >Member 
        </label>
        </div>
						</div>
						<div class="col-sm-3">
						<input type="text" name="einvitation4" class="form-control" id="einvitation4" placeholder="Invitation #">
						</div>
				  </div>
				  			<div class="col-sm-12 " >
					<label for="color" class="col-sm-2 control-label">Court</label>
					<div class="col-sm-10">
					  <select name="eresource" class="form-control" id="eresource" >
									<?php
							
$query = "Select * From courts";
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){?>
						  <option value="<?php echo($x['SERIAL']); ?>"><?php echo ($x['Name']);?></option>
						  <?php } ?>
							  <option value="0">Canceled</option>
						</select>
					</div>
				  </div>
				  		<div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2 control-label">Notes</label>
					<div class="col-sm-10">
					  <input type="text" name="etitle" class="form-control" id="etitle">
					</div>
				  </div>
				 
				  
					<div class="col-sm-12 " style="margin-top: 5px;" >
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-5">
						<input type="date" name="estart" class="form-control" id="estart" >
						</div>
						<div class="col-sm-5">
							<input type="time" name="estarttime" class="form-control" id="estarttime" >
					</div>
	
				  </div>
				 
				 <div class="col-sm-12 " >
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-5">
					 <input type="date" name="eend" class="form-control" id="eend" >
					 </div>
						<div class="col-sm-5">
					 <input type="time" name="eendtime" class="form-control" id="eendtime" >
					</div>
				  </div>
				      <div class="col-sm-12 " style="margin-top: 5px;">
					<label for="title" class="col-sm-2">Turn ON/OFF</label>
					<div class="col-sm-10">
					 <select name="eturn" class="form-control" id="eturn" >
						

						<option value="2" style="background-color:red;">OFF</option>
						<option value="3" style="background-color:white;" selected>AUTO</option>
						</select>
					</div>
				  </div>
	
				    <div class="col-sm-12"> 
						<div class="col-sm-offset-2 col-sm-5">
						  <div class="checkbox" >
							<label class="text-danger" disabled><input type="checkbox" id="deletee" name="delete"   > Delete event</label>
						  </div>
						</div>
						<div class="col-sm-5">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox" id="all" name="all">Update All</label>
						  </div>
					</div>
				  	</div>
<div>&nbsp;</div>					
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="savee" class="btn btn-primary">Save changes</button>
			  </div>
			
			</div>
		  </div>
		</div>
		  <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
    
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="ctitle"></h4>
        </div>
        <div class="modal-body" align="center">
		<label>Name</label><input class="form-control" type="text"   name="name"  id="name" style="width:100%;" required>
		<label>Phone</label><input class="form-control" type="text"   name="phone"  id="phone" style="width:100%;" >
		<label  style="display: none;">Address</label><input  style="display: none;" class="form-control" type="text"   name="address"  id="address" style="width:100%;" > </div>
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
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
   

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    <!-- Bootstrap Core JavaScript -->
	
	<!-- FullCalendar -->
	
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
 
<script>
$("#ModalAdd").on('hidden.bs.modal', function (e) {

  $(this)
    .find("input,textarea")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
$("#ModalEdit").on('hidden.bs.modal', function (e) {

  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
	$(document).ready(function() {
		var error=false;
		var status=0;
$('#turn').on('change', function() {
	if(this.value==1){$("#turn").css("background-color", "lightgreen");}
	else if (this.value==2){$("#turn").css("background-color", "red");}
	else{$("#turn").css("background-color", "white");}
});
$('#eturn').on('change', function() {
	if(this.value==1){$("#eturn").css("background-color", "lightgreen");}
	else if (this.value==2){$("#eturn").css("background-color", "red");}
	else{$("#eturn").css("background-color", "white");}
});
$(document).on('click',"[id^='savee']",function(){
	//alert("hi");
	var answer =true;
			if(document.getElementById('deletee').checked==true)
				{	del=1;
				
    				if (answer)
					{$('#calendar').fullCalendar('removeEvents',$('#ModalEdit #id').val());}
				}
				else
				{del=0;}
				if(answer){
			ID=	$('#ModalEdit #id').val();
			start1=$('#ModalEdit #estart').val();
			end1=$('#ModalEdit #eend').val();
			title1=$('#ModalEdit #etitle').val();
			color1=$('#ModalEdit #ecolor').val();
			starttime1=$('#ModalEdit #estarttime').val();
			endtime1=$('#ModalEdit #eendtime').val();
			player1=$('#ModalEdit #eplayer1').val();
			player2=$('#ModalEdit #eplayer2').val();
			player3=$('#ModalEdit #eplayer3').val();
			player4=$('#ModalEdit #eplayer4').val();
			turn=$('#ModalEdit #eturn').val();
			if(document.getElementById('emember1').checked==true)
				{member1=1;
				}else{member1=0;}
		if(document.getElementById('emember2').checked==true)
				{member2=1;
				}else{member2=0;}
			if(document.getElementById('emember3').checked==true)
				{member3=1;
				}else{member3=0;}
				if(document.getElementById('emember4').checked==true)
				{member4=1;
				}else{member4=0;}
			invitation1=$('#ModalEdit #einvitation1').val();
			invitation2=$('#ModalEdit #einvitation2').val();
			invitation3=$('#ModalEdit #einvitation3').val();
			invitation4=$('#ModalEdit #einvitation4').val();
			resource1=$('#ModalEdit #eresource').val();
			if(document.getElementById('all').checked==true)
				{	all=1;
			}
			else{all=0;}
			if((start1==end1 && starttime1.substring(0,5)>=endtime1.substring(0,5)) || start1>end1 )
			{
				alert("Start and End date must be different");
			}
			else{
				//alert("del "+del+"ID "+ID+"start "+start+"end "+end+"title "+title+"color "+color+"starttime "+starttime+"endtime "+endtime+"client "+client);
				 $.ajax({
			  type: 'GET',
			  url: "../ws/ws_tappointment.php",
			  data: ({action:3,serial :ID,del:del,start:start1,end:end1,title:title1,color:color1,starttime:starttime1,endtime:endtime1,resource:resource1,player1:player1,player2:player2,player3:player3,player4:player4,member1:member1,member2:member2,member3:member3,member4:member4,invitation1:invitation1,invitation2:invitation2,invitation3:invitation3,invitation4:invitation4,all:all,turn:turn}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				  if(data==0)
				  	alert("There is a Booking at the same time");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	if(del==0){
  				  	$('#calendar').fullCalendar('removeEvents',$('#ModalEdit #id').val());
  				  	start1=$('#ModalEdit #estart').val()+" "+$('#ModalEdit #estarttime').val();
  				  	end1=$('#ModalEdit #eend').val()+" "+$('#ModalEdit #eendtime').val();
						ttl="";
					ttl+=$("#ModalEdit #eplayer1 option:selected").text() ;
					if(invitation1!=""){ttl+="/"+invitation1;}
					ttl+=" ";
					ttl+=$("#ModalEdit #eplayer2 option:selected").text() ;
					if(invitation2!=""){ttl+="/"+invitation2;}
					ttl+=" ";
					ttl+=$("#ModalEdit #eplayer3 option:selected").text() ;
					if(invitation3!=""){ttl+="/"+invitation3;}
					ttl+=" ";
					ttl+=$("#ModalEdit #eplayer4 option:selected").text() ;
					if(invitation4!=""){ttl+="/"+invitation4;}
		var events={id:ID ,title:ttl,titlee:title1,start:start1,color:color1,end:end1,resourceId:resource1,player1:player1,player2:player2,player3:player3,player4:player4,member1:member1,member2:member2,member3:member3,member4:member4,invitation1:invitation1,invitation2:invitation2,invitation3:invitation3,invitation4:invitation4,turn:turn};
  				  	$('#calendar').fullCalendar('renderEvent',events,true);
}filltotals();
  				  	$('#ModalEdit').modal('hide');
  				  	if(all==1){location.reload();}
  				  //	alert("Update");	
				  }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {

			  }
			  
		  }); }}
			
		});
//=================================================================================================
$(document).on('click',"[id^='Save']",function(){
			start1=$('#ModalAdd #start').val();
			end1=$('#ModalAdd #end').val();
			title1=$('#title').val();
			color1=$('#color').val();
			starttime1=$('#ModalAdd #starttime').val();
			endtime1=$('#ModalAdd #endtime').val();
			player1=$('#ModalAdd #player1').val();
			player2=$('#ModalAdd #player2').val();
			player3=$('#ModalAdd #player3').val();
			player4=$('#ModalAdd #player4').val();
			turn=$('#ModalAdd #turn').val();
			if(document.getElementById('member1').checked==true)
				{member1=1;
				}else{member1=0;}
		if(document.getElementById('member2').checked==true)
				{member2=1;
				}else{member2=0;}
			if(document.getElementById('member3').checked==true)
				{member3=1;
				}else{member3=0;}
				if(document.getElementById('member4').checked==true)
				{member4=1;
				}else{member4=0;}
			invitation1=$('#ModalAdd #invitation1').val();
			invitation2=$('#ModalAdd #invitation2').val();
			invitation3=$('#ModalAdd #invitation3').val();
			invitation4=$('#ModalAdd #invitation4').val();
			resource1=$('#resource').val();
			repeat=$('#ModalAdd #repeat').val();
			if((start1==end1 && starttime1.substring(0,5)>=endtime1.substring(0,5)) || start1>end1)
			{
				alert("Start and End date must be different");
			}
				else{
					//alert("start "+start1+"end "+end1+"title "+title1+"color "+color1+"starttime "+starttime1+"endtime "+endtime1+"player "+player1+"player "+player2+"player "+player3+"player "+player4+"member "+member1+"member "+member2+"member "+member3+"member "+member4 +"inv" +invitation1+"inv" +invitation2+"inv" +invitation3+"inv" +invitation4);
				 $.ajax({
			  type: 'GET',
			  url: "../ws/ws_tappointment.php",
			  data: ({action:1,start:start1,end:end1,title:title1,color:color1,starttime:starttime1,endtime:endtime1,resource:resource1,player1:player1,player2:player2,player3:player3,player4:player4,member1:member1,member2:member2,member3:member3,member4:member4,invitation1:invitation1,invitation2:invitation2,invitation3:invitation3,invitation4:invitation4,repeat:repeat,turn:turn}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				  if(data==0)
				  		alert("There is a Booking at the same time");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	start1=$('#ModalAdd #start').val()+" "+$('#ModalAdd #starttime').val();
  				  	end1=$('#ModalAdd #end').val()+" "+$('#ModalAdd #endtime').val();
					ttl="";
					ttl+=$("#ModalAdd #player1 option:selected").text() ;
					if(invitation1!=""){ttl+="/"+invitation1;}
					ttl+=" ";
					ttl+=$("#ModalAdd #player2 option:selected").text() ;
					if(invitation2!=""){ttl+="/"+invitation2;}
					ttl+=" ";
					ttl+=$("#ModalAdd #player3 option:selected").text() ;
					if(invitation3!=""){ttl+="/"+invitation3;}
					ttl+=" ";
					ttl+=$("#ModalAdd #player4 option:selected").text() ;
					if(invitation4!=""){ttl+="/"+invitation4;}
		
  				  	var events={id:data ,title:ttl,titlee: title1,start:start1,end:end1,resourceId:resource1,player1:player1,player2:player2,player3:player3,player4:player4,member1:member1,member2:member2,member3:member3,member4:member4,invitation1:invitation1,invitation2:invitation2,invitation3:invitation3,invitation4:invitation4,turn:turn};
  				  	$('#calendar').fullCalendar('renderEvent',events,true);
filltotals();
  				  	$('#ModalAdd').modal('hide');
  				  	if(repeat!=''){location.reload();}
  				  //	alert("Update");	
				  }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {

			  }
			  
		  }); }
			
		});



////////////////////////////////////////////////////////////
var start;
		$('#calendar').fullCalendar({
			defaultView: 'agendaDay',
			defaultDate: Date.now(),
			editable: true,
			selectable: true,
			eventLimit: true,
            allDaySlot: false,	
minTime: "07:00:00",
maxTime: "24:00:00",
slotDuration: '01:00:00',			// allow "more" link when too many events
			schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaDay,agendaTwoDay,agendaWeek,month,listWeek'
			},
			views: {
				agendaTwoDay: {
					type: 'agenda',
					duration: { days: 2},

					// views that are more than a day will NOT do this behavior by default
					// so, we need to explicitly enable it
					groupByResource: true

					//// uncomment this line to group by day FIRST with resources underneath
					//groupByDateAndResource: true
				},
				day: { // name of view
            titleFormat: 'dddd,MMMM D,YYYY'
            // other view-specific options here
        }
			},

			//// uncomment this line to hide the all-day slot
			//allDaySlot: false,

			resources: [
			
			<?php foreach($eventss as $event): 
			?>
				{ id: '<?php echo $event['SERIAL']; ?>', title: '<?php echo $event['Name']; ?>', eventColor: '<?php echo $event['Color']; ?>'},
			
				<?php endforeach; ?>
					{ id: '0', title: 'Canceled', eventColor: 'red' }
			],
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
				$title="";
				$title=$title.$event['player1name'];
				if(($event['invitation1'])!=''){
					$title=$title."/".$event['invitation1'];
				}
				$title=$title." ";
				$title=$title.$event['player2name'];
				if(($event['invitation2'])!=''){
					$title=$title."/".$event['invitation2'];
				}
				$title=$title." ";
				$title=$title.$event['player3name'];
				if(($event['invitation3'])!=''){
					$title=$title."/".$event['invitation3'];
				}
				$title=$title." ";
				$title=$title.$event['player4name'];
				if(($event['invitation4'])!=''){
					$title=$title."/".$event['invitation4'];
				}
			?>
				{
					id: <?php echo $event['id']; ?>,
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					title: '<?php echo $title;?>',
					titlee: '<?php echo $event['title'];?>',
					player1: '<?php echo $event['player1'];?>',
					player2: '<?php echo $event['player2'];?>',
					player3: '<?php echo $event['player3'];?>',
					player4: '<?php echo $event['player4'];?>',
					member1: '<?php echo $event['member1'];?>',
					member2: '<?php echo $event['member2'];?>',
					member3: '<?php echo $event['member3'];?>',
					member4: '<?php echo $event['member4'];?>',
					invitation1: '<?php echo $event['invitation1'];?>',
					invitation2: '<?php echo $event['invitation2'];?>',
					invitation3: '<?php echo $event['invitation3'];?>',
					invitation4: '<?php echo $event['invitation4'];?>',
					turn: '<?php echo $event['turn'];?>',
					allDay: false,
                    resourceId: '<?php echo $event['resource']; ?>'
					
					
				},
			<?php endforeach; ?>
			],	

			select: function(start, end, jsEvent, view, resource) {
					$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
				$('#ModalAdd #endtime').val(moment(end).format('HH:mm:ss'));
				$('#ModalAdd #starttime').val(moment(start).format('HH:mm:ss'));
				$('#ModalAdd #resource').val(resource.id);
				$('#ModalAdd #turn').val("2");
				$("#turn").css("background-color", "red");
				ace=<?php echo($_SESSION['ace']); ?>;
				if (ace==1){
				$('#ModalAdd').modal('show');}
			},
			dayClick: function(date, jsEvent, view, resource) {
			$('#ModalAdd #start').val(moment(date).format('YYYY-MM-DD'));
				$('#ModalAdd #end').val(moment(date).format('YYYY-MM-DD'));
				$('#ModalAdd #endtime').val(moment(date).format('HH:mm:ss'));
				$('#ModalAdd #starttime').val(moment(date).format('HH:mm:ss'));
				//$('#ModalAdd #resource').val(resource.id);
					$('#ModalAdd #turn').val("2");
				$("#turn").css("background-color", "red");
				ace=<?php echo($_SESSION['ace']); ?>;
				if (ace==1){
				$('#ModalAdd').modal('show');}
				
			},
			 eventDragStart: function(event) {
     	start=new Date(event.start.format('YYYY-MM-DD HH:mm:ss'));
   },
			eventDrop: function(event, delta, revertFunc) {
			isadmin=<?php echo($_SESSION['IsAdmin']); ?>;
					ace=<?php echo($_SESSION['ace']); ?>;
				var today = new Date();
				if(isadmin==1 || (today.getTime()<=start.getTime() && ace==1)){
						start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			Event[3] = event.resourceId;
			$.ajax({
			 url: '../calendar/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						filltotals()
						
					}else if(rep == 'Double'){
							revertFunc();	
					}else{
						
					alert('error'); 
				
					}
				}
			});
			}
				else{
				revertFunc();}
},
			eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) { // si changement de longueur
	            isadmin=<?php echo($_SESSION['IsAdmin']); ?>;
		        ace=<?php echo($_SESSION['ace']); ?>;
				var today = new Date();
				var startt=new Date(event.start.format('YYYY-MM-DD HH:mm:ss'));
				if(isadmin==1 || (today.getTime()<=startt.getTime() && ace==1)){
							start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			Event[3] = event.resourceId;
			$.ajax({
			 url: '../calendar/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						filltotals()
						
					}else if(rep == 'Double'){
							revertFunc();	
					}else{
						
					alert('error'); 
				
					}
				}
			});
				}
				else{
				revertFunc();
				}
			},
			viewRender: function(view, element){
        var currentdate = view.intervalStart;
        $('#datepicker').datepicker().datepicker('setDate', new Date(currentdate));
		filltotals();
		
    },
			eventRender: function(event, element) {
				
				element.bind('click', function() {
				
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #etitle').val(event.titlee);
					$('#ModalEdit #estart').val(event.start.format('YYYY-MM-DD'));
					$('#ModalEdit #estarttime').val(event.start.format('HH:mm:ss'));
				$('#ModalEdit #eend').val(event.end.format('YYYY-MM-DD'));
				$('#ModalEdit #eendtime').val(event.end.format('HH:mm:ss'));
				$('#ModalEdit #eplayer1').val(event.player1);
				$('#ModalEdit #eplayer2').val(event.player2);
				$('#ModalEdit #eplayer3').val(event.player3);
				$('#ModalEdit #eplayer4').val(event.player4);
				$('#ModalEdit #eturn').val(event.turn);
					if(event.turn==1){$("#eturn").css("background-color", "lightgreen");}
	else if (event.turn==2){$("#eturn").css("background-color", "red");}
	else{$("#eturn").css("background-color", "white");}
				if(event.member1==1){
				document.getElementById('emember1').checked=true;
				}else{document.getElementById('emember1').checked=false;}
							if(event.member2==1){
				document.getElementById('emember2').checked=true;
				}else{document.getElementById('emember2').checked=false;}
							if(event.member3==1){
				document.getElementById('emember3').checked=true;
				}else{document.getElementById('emember3').checked=false;}
							if(event.member4==1){
				document.getElementById('emember4').checked=true;
				}else{document.getElementById('emember4').checked=false;}
				$('#ModalEdit #einvitation1').val(event.invitation1);
				$('#ModalEdit #einvitation2').val(event.invitation2);
				$('#ModalEdit #einvitation3').val(event.invitation3);
					$('#ModalEdit #einvitation4').val(event.invitation4);
				$('#ModalEdit #eresource').val(event.resourceId);
					isadmin=<?php echo($_SESSION['IsAdmin']); ?>;
					ace=<?php echo($_SESSION['ace']); ?>;
					acd=<?php echo($_SESSION['acd']); ?>;
				var today = new Date();
				var start=new Date(event.start.format('YYYY-MM-DD HH:mm:ss'));
				if(isadmin==1 || (today.getTime()<=start.getTime() && ace==1)){
					 $("#savee").prop("disabled",false);
					  $("#enew").prop("disabled",false);
				}
				else{ $("#savee").prop("disabled",true);
				 $("#enew").prop("disabled",true);}
				 
				 if(isadmin==1 || (today.getTime()<=start.getTime() && acd==1)){
					 $("#deletee").prop("disabled",false);
					
				}
				else{
				 $("#deletee").prop("disabled",true);}
					$('#ModalEdit').modal('show');
				});
			}
		});
				function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			Event[3] = event.resourceId;
			$.ajax({
			 url: '../calendar/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						filltotals()
						
					}else if(rep == 'Double'){
								
					}else{
						
					alert('error'); 
				
					}
				}
			});
			
		}
$('#datepicker').datepicker()
    .on("input change", function (e) {
		$('#calendar').fullCalendar( 'gotoDate',new Date(e.target.value) )
});
function filltotals() {
	$("#side-menu1").html("");
        var calendar = $('#calendar').fullCalendar('getCalendar');
        var view = calendar.view;
        var start = view.start._d;
        var end = view.end._d;
		start = start.getFullYear()+'-'+(start.getMonth() + 1) + '-' + start.getDate() ;
		end = end.getFullYear()+'-'+(end.getMonth() + 1) + '-' + end.getDate() ;
       		  $.ajax({
			  type: 'GET',
			  url: "../ws/ws_totals1.php",
			  data: ({start:start,end:end}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  h=0;
				  h1=0;
				  $.each(data, function(i, item) {
					  h+=Number(item.hours);
					   h1+=Number(item.hourss);
					   style='';
					   if (item.onn==1){style="style='background-color:lightgreen;'";}
					 var quotient = Math.floor( Number(item.hours)/60);
var remainder =  Number(item.hours)%60;
	 var quotientt = Math.floor( Number(item.hourss)/60);
var remainderr =  Number(item.hourss)%60;
					  $("#side-menu1").append("<li "+style+"><a >"+item.Name + "  </br> " +  Number(quotient) +" hrs "+remainder+" mins / " +Number(quotientt) +" hrs "+remainderr+" mins</a></li>");	
				  });
				   var quotient = Math.floor( Number(h)/60);
var remainder =  Number(h)%60;
	 var quotientt = Math.floor( Number(h1)/60);
var remainderr =  Number(h1)%60;
				   $("#side-menu1").append("<li><a >Total </br>" +  Number(quotient) +" hrs "+remainder+" mins / " +Number(quotientt) +" hrs "+remainderr+" mins</a></li>");	
				      var quotient = Math.floor( Number(data[0]["can"])/60);
var remainder =  Number(data[0]["can"])%60;
				   $("#side-menu1").append("<li><a >Cancelled : " +  Number(quotient) +" hrs "+remainder+" mins </a></li>");	
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
    }
	});

</script>
</div>	 
    <script src="../js/appointments.js"></script>
</body>

</html>
