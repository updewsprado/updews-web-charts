<?php
/*
 * Combines the data from "xy_cs_0" and "xy_cs" to form data for plotting
 */
 
header('Content-type: application/json');
 
// Set your CSV feed
$feed = 'blcb';
$feedX = $feed . ' xy_cs_0.csv';
$feedY = $feed . ' xy_cs.csv';
 
// Arrays we'll use later
$keys = array();
$arrayX = array();
$arrayY = array();
$arrayPlot = array();
 
// Function to convert CSV into associative array
function csvToArray($file, $delimiter) { 
  if (($handle = fopen($file, 'r')) !== FALSE) { 
    $i = 0; 
    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
      for ($j = 0; $j < count($lineArray); $j++) { 
        $arr[$i][$j] = $lineArray[$j]; 
      } 
      $i++; 
    } 
    fclose($handle); 
  } 
  return $arr; 
}
 
// Do it
$dataX = csvToArray($feedX, ',');
$dataY = csvToArray($feedY, ',');
 
// Set number of elements (minus 1 because we shift off the first row)
$count = count($dataX) - 1;

//Use first row for names  
$labels = array_shift($dataX);  
$labels = array_shift($dataY); 
 
foreach ($labels as $label) {
  $keys[] = $label;
}

echo "# of elements per column: " . count($keys) . "\n\n";

// Bring it all together
for ($j = 0; $j < $count; $j++) {
  $dX = array_combine($keys, $dataX[$j]);
  $arrayX[$j] = $dX;
  
  $dY = array_combine($keys, $dataY[$j]);
  $arrayY[$j] = $dY;
}

$count_xy = 0;
echo "XY Plot Values:\n";
for ($l = 0; $l < $count; $l++) {
	$date = $arrayX[$l]["ts"];
	$data_cnt = count($keys);
	
	for ($k = 1; $k < $data_cnt; $k++) {
		$arrayPlot[$count_xy]["date"] = $date;
		$arrayPlot[$count_xy]["xval"] = $arrayX[$l]["$k"];
		$arrayPlot[$count_xy]["yval"] = $arrayY[$l]["$k"];
		$count_xy++;
		
		echo $date . ",";
		echo $arrayX[$l]["$k"] . ",";
		echo $arrayY[$l]["$k"] . "\n";
	}
	echo "\n";
}
echo "\n";

// Print it out as JSON
echo json_encode($arrayPlot);
echo "\n\n";

?>