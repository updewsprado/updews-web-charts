<?php   
    $site = $_GET['site'];
    $node = $_GET['node'];
    exec('/home/ubuntu/anaconda/bin/python getLsbChangeFromPurged.py ' . $site . ' ' . $node, $output, $return);  
    echo($output[0]);
?>