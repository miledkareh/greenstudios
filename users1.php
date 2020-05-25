<?php session_start(); 
if($_SESSION['ucv']!=1){header("Location: ./blank.php");}
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Souak | Users</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
 <link rel="stylesheet" type="text/css" href="Datatables/datatables.min.css"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="select2/dist/css/select2.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
	
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
<div align="right">
    		<form method="post">
                        		<table>
						<td>
							<button type="button" id="Add" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal" <?php if($_SESSION['uce']!=1){ echo('disabled'); }?> ><span class="fa fa-plus"></span> Add User</button>
						</td>
							   
			</tr>
			</table>
			</form>
    		
    	</div>
        <table width="100%"  id="dataTables-example" class="table table-bordered table-striped">
                       					<thead>
						<tr>
							<th>Name</th>
							<th>Username</th>
							<th>Action</th>
						</tr>
					</thead>
                            </table>
                            </table>
                             </section>
    <!-- /.content -->
  
                            
    	  <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
    
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>
        <div class="modal-body" align="center">
		<label>Name</label><input class="form-control" type="text"   name="name"  id="name" style="width:100%;" required>
		<label>Username</label><input class="form-control" type="text"   name="uusername"  id="username1" style="width:100%;" required>
		<label>Password</label><input class="form-control" type="password"   name="password"  id="password" style="width:100%;" required>
		<label>Profile</label><select class="form-control" id="profile" style="width: 100%; text-align: right;"></select>
    
        <div class="checkbox">
        <label>
        <input type="checkbox" id="admin" value="admin">Admin &nbsp;
        </label>
        </div>
        </div>
        <div class="modal-footer">
        <label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
		<table align="center"  >
		<tr>
		<td>
        <button type="button" id="add1" class="btn btn-block btn-primary" >Save</button>
		</td>
		<td width="10">
		</td>
		<td>
          <button type="button" id="exit1"class="btn btn-block btn-primary" data-dismiss="modal">Exit</button>
          </td>
		</tr>
		</table>
        </div>
      </div>
      
    </div>
  </div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script type="text/javascript" src="Datatables/pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="Datatables/pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="Datatables/datatables.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/dist/sweetalert2.all.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script src="select2/dist/js/select2.js"></script>
<script src="select2/dist/js/i18n/it.js"></script>
<script src="select2/dist/js/i18n/nl.js"></script>
<!-- page script -->
<script>
   $("#profile").select2();
</script>

<script src="js/users1.js"></script>

</body>
</html>
