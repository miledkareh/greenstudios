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
<?php
  session_start();
        if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
                                {
                                    header("Location: ../Login");
                                }
                                    if($_SESSION['pencv']!=1){
                                    header("Location: ../Blank");
                                }
  ?>
<body>
     
  
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
                
                    <h1 class="page-header">Pending Visits</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
                        <!-- /.panel-heading -->
                         
<div class="col-lg-12">
<div class="panel panel-default">
    <h3> Pending checkout</h3>  
<div class="panel-body">
    <div class='col-lg-6 nopadding'>
    
  </div>
      <div class='col-lg-6 nopadding' align="right">
   
  </div>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example4">
                                <thead>
 <tr>
                                            
                                        <th>Maintainance</th>
                                       
                                        <th>Date checkout</th>
                                        
                                     <?php if($_SESSION['pence']==1 || $_SESSION['pencd']==1){?>      <th>Action</th> <?php }?>
                                   

                                    </tr>

                                                 
                                            </thead>
                     <tbody>
  <?php     $query = "
select *,maintenances.serial as SERIAL,
(select serial from offers where serial=maintenances.offerId) as OFFERSERIAL,
(select ProjectName from offers where serial=maintenances.offerId) as Pname from  
maintenances,checkin,maintenancedetails 
where maintenancedetails.accepted=0 
 and checkin.checkout=1
 
and checkin.visit=maintenancedetails.Serial
and maintenances.Serial=maintenancedetails.maintenanceid
order by checkoutdate desc


                             ";
//
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($y = mysqli_fetch_array($results)){?>
                                     <tr class="odd gradeX">
                                        
                                     <td><?php echo $y['Pname']; ?></td>
                                      <td><?php echo $y['checkoutdate']; ?></td>
                                      
                                       <?php if($_SESSION['pence']==1 || $_SESSION['pencd']==1){?> 
                <td class="center">
                                                                      <?php if($_SESSION['pence']==1){?>

<a href="../Maintenances/pendingvisits.php?x=<?php echo($y["SERIAL"]);?>&z=<?php echo ($y["OFFERSERIAL"]); ?>&k=<?php echo ($y["Pname"]); ?>"    >View</a>&nbsp;&nbsp;

<?php }  ?>
<?php if($_SESSION['pencd']==1){?>
<a href="#" id="del_<?php echo($y["SERIAL"]);?>" <?php if($_SESSION['pencd']!=1){ echo('disabled'); }?>   ><p class="fa fa-trash-o"></p></a></td>
<?php } 



} ?>










                                      </tr>
                                   
                                    <?php } ?>
                                     
                                        
                                         
                                         
                                                
                                       
                                            
                                        
                                         
                                            
                                            </tbody>
                            </table>
</div>
</div>
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
      $('#dataTables-example4').DataTable({
            
             
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
   dom: 'Blfrtip',
            responsive: true,
              "aaSorting" : [],
                "stateSave": true,
                 fixedHeader: {
            header: true,
            footer: true,

       },
                
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
    <label>Description</label><input class="form-control" type="text"   name="description"  id="description" style="width:100%;" required>
    <label>Icon</label><input class="form-control" type="file"   name="file"  id="file" style="width:100%;" required>
    <span id="uploaded_image"></span>
        </div>
        <div class="modal-footer" >
        
            <label id ="lblalert" style="visibility: hidden; color: red;">Please Fill Empty Fields</label>
        <table align="center"  >
            
        <tr>
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
<!-- <script src="../../js/maintenances.js"></script>
 --><script>

    $(document).ready(function() {
        rec=0;
 function deleterec(idval)
    {
        
        //$("#LoadingImage").show();
          $.ajax({
              type: 'GET',
              url: "../../ws/ws_tdelrec.php",
              data: ({id :idval}),
              
              dataType: 'json',
              timeout: 5000,
              success: function(data, textStatus, xhr) 
              {
                 // $("#LoadingImage").hide();
                
                  if(data==0)
                    alert("Row not deleted!");
                    
         location.reload();
              },
              error: function(xhr, status, errorThrown) 
              {
                 
        
                  alert(status + errorThrown);
              }
          });  //   

    }





  $(document).on('click',"[id^='del_']",function(){ 
            
            strID=$(this).attr('id');           
            rec = strID.substring(4);
        
            var answer = confirm("Are You Sure You Want To Delete This Record!");
    if (answer)
        
           deleterec(rec);
        
            
    });

 
 
});

</script>
</body>

</html>
