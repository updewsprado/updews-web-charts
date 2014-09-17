<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom DEWS Landslide CSS -->
    <link href="css/dewslandslide/dewsalert.css" rel="stylesheet" type="text/css">
    <link href="css/dewslandslide/dewsposition.css" rel="stylesheet" type="text/css">

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

	<!-- Spinner -->
	<script type="text/javascript" src="http://fgnass.github.io/spin.js/spin.min.js"></script>

	<!-- load the d3.js library -->    
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

	<!-- Custom Google Map Location -->	
	<script type="text/javascript"
	  src="https://maps.googleapis.com/maps/api/js?client385290333225-1olmpades21is0bupii1fk76fgt3bf4k.apps.googleusercontent.com?key=AIzaSyBRAeI5UwPHcYmmjGUMmAhF-motKkQWcms">
	</script>

    <!-- Custom DEWS Landslide JS 
    <script src="js/dewslandslide/dewsalert.js"></script>
    -->	
    <?php echo $jsfile; ?>
    <?php echo $gmap; ?>
    
	<!-- Load the Map -->
	<script>
	google.maps.event.addDomListener(window, 'load', initialize_map);
	</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	
    <div id="wrapper">