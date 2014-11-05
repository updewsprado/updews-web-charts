<?php
	require_once('connectDB.php'); 

	//$homepage = file_get_contents('http://localhost/test/datapres/blcb/196');
	$homepage = file_get_contents('http://weather.asti.dost.gov.ph/home/index.php/api/data/204/from/2014-10-01/to/2014-11-05');
	//echo $homepage;
	
	$arr = json_decode($homepage);
	$rain = $arr->data;
	
	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$i = 0;
	foreach ($rain as $value) {
		//echo $value->dateTimeRead;
		
		$query = "INSERT INTO rain_noah(id, site, timestamp, rval) VALUES ('','blcb', '$value->dateTimeRead', '$value->rain_value')";

		if (!mysqli_query($con,$query)) {
			die('Error: ' . mysqli_error($con));
		}
		echo "#$i th record added";	

		$i++;
	}
?>