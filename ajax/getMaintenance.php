<?php
	require_once('connectDB.php'); 

	//$q = intval($_GET['q']);
	$q = $_GET['q'];
	//$site = $_GET['site'];
	$maintenance = "health_node";
	
	//echo "Site: " . $site . "<Br/>Date: " . $q . "<Br/><Br/>";

	// Create connection
	$con=mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	//mysqli_select_db($con,"ajax_demo");
	$sql="SELECT * FROM $maintenance";
	$result = mysqli_query($con, $sql);

	/*
	echo "<table border='1'>
	<tr>
	<th>nh_id</th>
	<th>n_id</th>
	<th>tstamp</th>
	<th>total_up_time</th>
	<th>status</th>
	</tr>";
	*/
	
	echo "<h4>Sensor Maintenance</h4>";
	
	while($row = mysqli_fetch_array($result)) {
	/*
	  echo "<tr>";
	  echo "<td>" . $row['nh_id'] . "</td>";
	  echo "<td>" . $row['n_id'] . "</td>";
	  echo "<td>" . $row['tstamp'] . "</td>";
	  echo "<td>" . $row['total_up_time'] . "</td>";
	  echo "<td>" . $row['status'] . "</td>";
	  echo "</tr>";
	*/  
	  echo "<p>Timestamp: " . $row['tstamp'] . "</p>";
	  echo "<p>Node ID: " . $row['tstamp'] . "</p>";
	  echo "<p>Total Up Time: " . $row['total_up_time'] . "</p>";
	  echo "Status: " . $row['status'] . "</p><Br/>";
	}
	//echo "</table>";

   mysqli_close($con);
?>	