<?php

	require_once('connectDB.php'); 

   // Create connection
   $con = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

   // Check connection
   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   
	// get path of dbcsv folder
	//chdir('dbcsv');   
	$fullpath = getcwd();
	echo $fullpath . "<Br/>";

   $directory = 'dbcsv/';
   $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
   
   // Open All CSV Files
   while($it->valid()) {

		if (!$it->isDot()) {
			if (strpos($it->key(),".csv") !== false) { 
				echo 'Open CSV File:         ' . $it->key() . "<br/><br/>\n";
				
				$row = 1;
				if (($handle = fopen($it->key(), "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
						$num = count($data);
						echo "<p> $num fields in line $row: <br /></p>\n";
						$row++;

						for ($c=0; $c < $num; $c++) {
							echo $data[$c] . ", ";
						}
						echo "<br />\n"; 
/*
						// Put csv data into the query
						$query = "INSERT INTO users(post_id, post_timestamp, date_of_identification, flagger, site, node, status, comment) VALUES ('$data[0]','$data[1]', '$data[2]', '$data[3]', '$data[4]','$data[5]', '$data[6]', '$data[7]')";

						if (!mysqli_query($con,$query)) {
							die('Error: ' . mysqli_error($con));
						}
*/
						echo "1 record added";
					}
					fclose($handle);
					unlink($it->key());
				}			
			}
		}

		$it->next();
   }

   mysqli_close($con);

?>