<?php

//$feed = 'stocks.csv';
$feed = 'blcb xy_cs.csv';

$csv = file_get_contents( $feed );
 $csv = explode(",", trim($csv) );
 
 foreach ( $csv as &$line )
 {
     $line = trim( $line );
 }
 
 print json_encode($csv);

?>