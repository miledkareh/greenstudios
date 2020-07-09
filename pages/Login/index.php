<?php 


ini_set('session.gc_maxlifetime', 86400);

 
session_set_cookie_params(86400);



session_start(['cookie_lifetime' => 86400]);
include('../configdb.php');
if(isset($_SESSION['UserSerial'])){
	 header("Location: ../Blank");
}
if(isset($_POST['username'])&& $_POST['username']!=NULL )	
{ 
$username=$_POST['username'];
 $password =$_POST['password'];
    $query = "SELECT serial,isadmin,username,userprofile,hidevalues,Complaint,(select hide from userprofile where serial=users.userprofile) as hide,ViewQuantity FROM users WHERE username='".$username."' AND password ='".$password."'";
    $result = mysqli_query($dbhandle,$query)or die(mysqli_error());
    $num_row = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    if($num_row ==1)
    {
		$_SESSION['Login']= true;
		$_SESSION['UserSerial']= $row[0];
        $_SESSION['IsAdmin']="".$row[1];
		$_SESSION['hidevalues']="".$row[4];
		$_SESSION['userprofile']="".$row[3];
		$_SESSION['Hide']="".$row[6];
		$_SESSION['User']="".$row[2];
		$_SESSION['ViewQuantity']=$row[7];
		$_SESSION['flag']=0;
		$_SESSION['ocv']=0;
		$_SESSION['ocd']=0;
		$_SESSION['oce']=0;
		$_SESSION['ccv']=0;
		$_SESSION['ccd']=0;
		$_SESSION['cce']=0;
		$_SESSION['ucv']=0;
		$_SESSION['ucd']=0;
		$_SESSION['uce']=0;
		$_SESSION['dcv']=0;
		$_SESSION['dcd']=0;
		$_SESSION['dce']=0;
		$_SESSION['upcv']=0;
		$_SESSION['upcd']=0;
		$_SESSION['upce']=0;
		$_SESSION['cccv']=0;
		$_SESSION['cccd']=0;
		$_SESSION['ccce']=0;
		
		$_SESSION['pcv']=0;
		$_SESSION['pcd']=0;
		$_SESSION['pce']=0;
		$_SESSION['mcv']=0;
		$_SESSION['mcd']=0;
		$_SESSION['mce']=0;
		
		$_SESSION['ncv']=0;
		$_SESSION['ncd']=0;
		$_SESSION['nce']=0;
		
		$_SESSION['rncv']=0;
		$_SESSION['rncd']=0;
		$_SESSION['rnce']=0;
		$_SESSION['ircv']=0;
		$_SESSION['ircd']=0;
		$_SESSION['irce']=0;
		
		$_SESSION['cocv']=0;
		$_SESSION['cocd']=0;
		$_SESSION['coce']=0;
		
		$_SESSION['tscv']=0;
		$_SESSION['tscd']=0;
		$_SESSION['tsce']=0;
		$_SESSION['icv']=0;
		$_SESSION['icd']=0;
		$_SESSION['ice']=0;
		
			$_SESSION['fucv']=0;
		$_SESSION['fucd']=0;
		$_SESSION['fuce']=0;
		
		$_SESSION['curcv']=0;
		$_SESSION['curcd']=0;
		$_SESSION['curce']=0;
		
		$_SESSION['atcv']=0;
		$_SESSION['atcd']=0;
		$_SESSION['atce']=0;
		
		$_SESSION['tcv']=0;
		$_SESSION['tcd']=0;
		$_SESSION['tce']=0;
		
		$_SESSION['plcv']=0;
		$_SESSION['plcd']=0;
		$_SESSION['plce']=0;
		
		$_SESSION['vacv']=0;
		$_SESSION['vacd']=0;
		$_SESSION['vace']=0;
		
		$_SESSION['igcv']=0;
		$_SESSION['igcd']=0;
		$_SESSION['igce']=0;
		
		$_SESSION['acv']=0;
		$_SESSION['acd']=0;
		$_SESSION['ace']=0;

		$_SESSION['pencv']=0;
		$_SESSION['pencd']=0;
		$_SESSION['pence']=0;

		$_SESSION['pallcv']=0;
		$_SESSION['pallcd']=0;
		$_SESSION['pallce']=0;

		$_SESSION['vrepcv']=0;
		$_SESSION['vrepcd']=0;
		$_SESSION['vrepce']=0;

		$_SESSION['scv']=0;
		$_SESSION['scd']=0;
		$_SESSION['sce']=0;



		$_SESSION['pestcv']=0;
		$_SESSION['pestcd']=0;
		$_SESSION['pestce']=0;


		$_SESSION['iccv']=0;
		$_SESSION['iccd']=0;
		$_SESSION['icce']=0;


		$_SESSION['comcv']=0;
		if($row['Complaint']==1)
		{$_SESSION['comcv']=1;}
		 $query = "SELECT Serial,Description,Filter,DataFilter,(select canedit from userprofiledetail where profileid=userprofile.serial and form=2),";
		 $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=2),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=2),";
		  
		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=3),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=3),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=3),";
		  
		  		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=1),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=1),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=1),";
		  
		  	   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=4),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=4),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=4),";
		  
		  	   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=5),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=5),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=5),";
		  
		  	   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=6),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=6),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=6),";
		  
		  		  	   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=7),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=7),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=7),";
		  
		  		  	   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=8),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=8),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=8),";
		  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=9),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=9),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=9),";
		  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=10),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=10),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=10),";
		  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=11),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=11),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=11),";	
		  			  
		    $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=13),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=13),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=13),";	
		  	  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=14),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=14),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=14),";
		  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=15),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=15),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=15),";
		  
		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=16),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=16),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=16),";
		  
		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=17),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=17),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=17),";
		  
		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=18),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=18),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=18),";
		  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=19),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=19),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=19),";
		  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=20),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=20),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=20),";
		  
		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=21),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=21),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=21),";
		  
		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=22),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=22),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=22),";
		  
		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=23),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=23),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=23),";
		    
  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=24),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=24),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=24),";

		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=25),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=25),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=25),";

		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=26),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=26),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=26),";

		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=27),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=27),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=27), ";


		  $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=28),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=28),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=28), ";

		   $query = $query."(select canedit from userprofiledetail where profileid=userprofile.serial and form=29),";
		   $query = $query."(select candelete from userprofiledetail where profileid=userprofile.serial and form=29),";
		  $query = $query."(select canview from userprofiledetail where profileid=userprofile.serial and form=29) ";


		     $query = $query." from userprofile where serial=".$row[3];
			$result = mysqli_query($dbhandle,$query)or die(mysqli_error());
   if( $x=mysqli_fetch_array($result)){
	   if($x[4]==1){
		  $_SESSION['oce']=1; 
	   }
	    if($x[5]==1){
		  $_SESSION['ocd']=1; 
	   }
	    if($x[6]==1){
		  $_SESSION['ocv']=1; 
	   }
	      if($x[7]==1){
		  $_SESSION['cce']=1; 
	   }
	    if($x[8]==1){
		  $_SESSION['ccd']=1; 
	   }
	    if($x[9]==1){
		  $_SESSION['ccv']=1; 
	   }
	   	if($x[10]==1){
		  $_SESSION['uce']=1; 
	   }
	    if($x[11]==1){
		  $_SESSION['ucd']=1; 
	   }
	    if($x[12]==1){
		  $_SESSION['ucv']=1; 
	   }
	   	if($x[13]==1){
		  $_SESSION['dce']=1; 
	   }
	    if($x[14]==1){
		  $_SESSION['dcd']=1; 
	   }
	    if($x[15]==1){
		  $_SESSION['dcv']=1; 
	   }
	   	if($x[16]==1){
		  $_SESSION['upce']=1; 
	   }
	    if($x[17]==1){
		  $_SESSION['upcd']=1; 
	   }
	    if($x[18]==1){
		  $_SESSION['upcv']=1; 
	   }
	   	if($x[19]==1){
		  $_SESSION['ccce']=1; 
	   }
	    if($x[20]==1){
		  $_SESSION['cccd']=1; 
	   }
	    if($x[21]==1){
		  $_SESSION['cccv']=1; 
	   }
	   	  if($x[22]==1){
		  $_SESSION['pce']=1; 
	   }
	    if($x[23]==1){
		  $_SESSION['pcd']=1; 
	   }
	    if($x[24]==1){
		  $_SESSION['pcv']=1; 
	   }
	   	   	  if($x[25]==1){
		  $_SESSION['mce']=1; 
	   }
	    if($x[26]==1){
		  $_SESSION['mcd']=1; 
	   }
	    if($x[27]==1){
		  $_SESSION['mcv']=1; 
	   }
		 if($x[28]==1){
		  $_SESSION['nce']=1; 
	   }
		  if($x[29]==1){
		  $_SESSION['ncd']=1; 
	   }
		    if($x[30]==1){
		  $_SESSION['ncv']=1; 
	   }
			
			 if($x[31]==1){
		  $_SESSION['rnce']=1; 
	   }
		  if($x[32]==1){
		  $_SESSION['rncd']=1; 
	   }
		    if($x[33]==1){
		  $_SESSION['rncv']=1; 
	   }

	 if($x[34]==1){
		  $_SESSION['irce']=1; 
	   }
		  if($x[35]==1){
		  $_SESSION['ircd']=1; 
	   }
		    if($x[36]==1){
		  $_SESSION['ircv']=1; 
	   }

 

 if($x[37]==1){
		  $_SESSION['coce']=1; 
	   }
		  if($x[38]==1){
		  $_SESSION['cocd']=1; 
	   }
		    if($x[39]==1){
		  $_SESSION['cocv']=1; 
	   }
if($x[40]==1){
		  $_SESSION['tsce']=1; 
	   }
		  if($x[41]==1){
		  $_SESSION['tscd']=1; 
	   }
		    if($x[42]==1){
		  $_SESSION['tscv']=1; 
	   }
			if($x[43]==1){
		  $_SESSION['ice']=1; 
	   }
		  if($x[44]==1){
		  $_SESSION['icd']=1; 
	   }
		    if($x[45]==1){
		  $_SESSION['icv']=1; 
	   }
			if($x[46]==1){
		  $_SESSION['fuce']=1; 
	   }
		  if($x[47]==1){
		  $_SESSION['fucd']=1; 
	   }
		    if($x[48]==1){
		  $_SESSION['fucv']=1; 
	   }
			
				if($x[49]==1){
		  $_SESSION['curce']=1; 
	   }
		  if($x[50]==1){
		  $_SESSION['curcd']=1; 
	   }
		    if($x[51]==1){
		  $_SESSION['curcv']=1; 
	   }
			
					if($x[52]==1){
		  $_SESSION['atce']=1; 
	   }
		  if($x[53]==1){
		  $_SESSION['atcd']=1; 
	   }
		    if($x[54]==1){
		  $_SESSION['atcv']=1; 
	   }

			if($x[55]==1){
		  $_SESSION['tce']=1; 
	   }
		  if($x[56]==1){
		  $_SESSION['tcd']=1; 
	   }
		    if($x[57]==1){
		  $_SESSION['tcv']=1; 
	   }
			
			if($x[58]==1){
		  $_SESSION['plce']=1; 
	   }
		  if($x[59]==1){
		  $_SESSION['plcd']=1; 
	   }
		    if($x[60]==1){
		  $_SESSION['plcv']=1; 
	   }
			
			if($x[61]==1){
		  $_SESSION['vace']=1; 
	   }
		  if($x[62]==1){
		  $_SESSION['vacd']=1; 
	   }
		    if($x[63]==1){
		  $_SESSION['vacv']=1; 
	   }
			
			if($x[64]==1){
		  $_SESSION['igce']=1; 
	   }
		  if($x[65]==1){
		  $_SESSION['igcd']=1; 
	   }
		    if($x[66]==1){
		  $_SESSION['igcv']=1; 
	   }
			
			if($x[67]==1){
		  $_SESSION['ace']=1; 
	   }
		  if($x[68]==1){
		  $_SESSION['acd']=1; 
	   }
		    if($x[69]==1){
		  $_SESSION['acv']=1; 
	   }



	   	if($x[70]==1){
		  $_SESSION['pence']=1; 
	   }
		  if($x[71]==1){
		  $_SESSION['pencd']=1; 
	   }
		    if($x[72]==1){
		  $_SESSION['pencv']=1; 
	   }

	     	if($x[73]==1){
		  $_SESSION['pallce']=1; 
	   }
		  if($x[74]==1){
		  $_SESSION['pallcd']=1; 
	   }
		    if($x[75]==1){
		  $_SESSION['pallcv']=1; 
	   }



	     	if($x[76]==1){
		  $_SESSION['vrepce']=1; 
	   }
		  if($x[77]==1){
		  $_SESSION['vrepcd']=1; 
	   }
		    if($x[78]==1){
		  $_SESSION['vrepcv']=1; 
	   }

	   if($x[79]==1){
		$_SESSION['sce']=1; 
	 }
		if($x[80]==1){
		$_SESSION['scd']=1; 
	 }
		  if($x[81]==1){
		$_SESSION['scv']=1; 
	 }








  if($x[82]==1){
		$_SESSION['pestce']=1; 
	 }
		if($x[83]==1){
		$_SESSION['pestcd']=1; 
	 }
		  if($x[84]==1){
		$_SESSION['pestcv']=1; 
	 }



if($x[85]==1){
		$_SESSION['icce']=1; 
	 }
		if($x[86]==1){
		$_SESSION['iccd']=1; 
	 }
		  if($x[87]==1){
		$_SESSION['iccv']=1; 
	 }





	    $_SESSION['filter']=$x['Filter']; 
		 $_SESSION['datafilter']=$x['DataFilter']; 
   }
	
	
       header("Location: ../Blank");
        exit;
    }
	else{$_SESSION['Error']= true;}
}
else{$_SESSION['Error']= false;}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

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


    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
					<div Style="color:red;" align="center"><?php 
if($_SESSION['Error']== true){echo('Wrong Username Or Password <br><br>');$_SESSION['Error']= false;} ?></div>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="UserName" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								 <button class="btn btn-lg btn-success btn-block">login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

</body>

</html>
