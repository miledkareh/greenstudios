<!DOCTYPE html>
<html lang="en">



<body>
  <?php
  session_start();
								if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ../Login");
								}
								include('../configdb.php');
	$query ="select * from offers";
$offer1='';
$offer2='';

$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
while($x = mysqli_fetch_array($results)){
	    if($x['status']=="INQUIRIES"){$offer1='a';}
    elseif($x['status']=="IN HAND"){$offer1='b';}
elseif( $x['status']=="OFFER"){$offer1='c';}
    elseif($x['status']=="POTENTIAL"){$offer1='d';}
	elseif($x['status']=="COMPLETED"){$offer1='e';}
	elseif($x['status']=="CANCELED"){$offer1='f';}
	elseif($x['status']=="ARCHIVED"){$offer1='g';}
	if($x['hp']==1){$offer2=1;}
	else{$offer2=0;}
	$r = mysqli_query($dbhandle,"Update offers set order1='$offer1',order2='$offer2.' where serial=".$x['Serial'])  or die(mysqli_error());
	echo("abc".$r);
}

  ?>
  

</body>

</html>
