<?php
/*
 * Converts CSV to JSON
 * Example uses Google Spreadsheet CSV feed
 * csvToArray function I think I found on php.net
 */
 
header('Content-type: application/json');
 
// Set your CSV feed
//$feed = 'https://docs.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0Akse3y5kCOR8dEh6cWRYWDVlWmN0TEdfRkZ3dkkzdGc&single=true&gid=0&output=csv';
//$feed = 'blcb xy_cs.csv';
//$feed = 'stocks.csv';
//$feed = 'test.csv';
//$feed = 'blcb xy_cs.csv';

$feed = 'blcb';
$feedX = $feed . ' xy_cs_0.csv';
$feedY = $feed . ' xy_cs.csv';
 
// Arrays we'll use later
$keys = array();
$arrayX = array();
$arrayY = array();
 
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

echo "X-axis Values:\n";
for ($l = 0; $l < $count; $l++) {
	$data_cnt = count($keys);
	for ($k = 1; $k <= $data_cnt; $k++) {
		$elem = "'" . $k . "'";
		echo $arrayX[$l]["$k"];
		
		if($k < $data_cnt - 1) {
			echo ",";
		}
	}
	echo "\n";
}
echo "\n";

// Print it out as JSON
echo json_encode($arrayX);
echo "\n\n";

echo "Y-axis Values:\n";
for ($l = 0; $l < $count; $l++) {
	$data_cnt = count($keys);
	for ($k = 1; $k <= $data_cnt; $k++) {
		$elem = "'" . $k . "'";
		echo $arrayY[$l]["$k"];
		
		if($k < $data_cnt - 1) {
			echo ",";
		}
	}
	echo "\n";
}
echo "\n";

// Print it out as JSON
echo json_encode($arrayY);

?>