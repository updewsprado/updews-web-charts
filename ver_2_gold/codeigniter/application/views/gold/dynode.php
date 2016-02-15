<!--
<!doctype html>
<html lang="en">
<head>

	<STYLE TYPE="text/css">
	BODY	{
   		font-family:sans-serif;
   	}
	</STYLE>
	<meta charset="utf-8">
	<title>View Senslope Data</title>
-->	
	
	<link href="/js/development-bundle/themes/south-street/jquery-ui.css" rel="stylesheet">

	<script type="text/javascript" src="/js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="/js/development-bundle/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="/js/development-bundle/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="/js/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dygraph/1.1.0/dygraph-combined.js"></script>
	<script type="text/javascript" src="http://fgnass.github.io/spin.js/spin.min.js"></script>
	
	<script type="text/javascript" src="/goldF/js/dewslandslide/dewsaccel-dy.js"></script>
	<script type="text/javascript" src="/goldF/js/dewslandslide/dewslsbchange.js"></script>
	<script type="text/javascript" src="/goldF/js/dewslandslide/dewsalertmini.js"></script>

	
	<style type="text/css">
		#demodiv {
			margin-left: auto;
			margin-right: auto;
			min-width: 90%;
			height: auto;
		}
		
		#myFlashContent {
			margin-left: auto;
			margin-right: auto;
			min-width: 50%;
			min-height: 70%;		
		}
		
		#flashIE {
			margin-left: auto;
			margin-right: auto;
			min-width: 50%;
			min-height: 70%;		
		}
    </style>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" id="header-site">Node Overview</h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- New Features!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Bug Fixed!</strong> "No Chart Display for some 
                            	new site columns" occurred from sudden change in msgid values. (Update: Jan 25, 2015)
                        </div>
                    </div>  
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>New Feature!</strong> Battery Level Plots for 
                            	version 2+ sensors are available (Update: Dec 17, 2015)
                        </div>
                    </div>  
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>New Feature!</strong> You can now view 
                            	Filtered/Purged Data using the left Navigation Bar (Update: Dec 3, 2015)
                        </div>
                    </div> 
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>New Feature!</strong> You can now view the 2nd 
                            	Accelerometer Data for version 2 sensors (Update: Nov 12, 2015)
                        </div>
                    </div>                                                            
                </div>
                <!-- /.row -->                                             
                
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Monitoring
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->  

                <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> <b>Mini Alert Map</b></h3>
                            </div>
                            <div class="panel-body">
                                <div id="mini-alert-canvas" ></div>
                            </div>
                        </div>
                    </div>                                       
                </div>
                <!-- /.row -->   

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> <b>LSB Change Plot</b></h3>
                            </div>
                            <div class="panel-body">
                                <div id="lsb-change-canvas" ></div>
                            </div>
                        </div>
                    </div>                                   
                </div>
                <!-- /.row -->                             

                <!-- Heading for Date Dependent Charts -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">Date Dependent Charts</li>
                        </ol>
                    </div>
                </div>

				<div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                	<i class="fa fa-bar-chart-o fa-fw"></i> <b>Accelerometer: X Value</b>
									<div class="btn-group switch-graph-view" data-toggle="buttons">
										<label class="btn btn-info btn-ds-1 active" onclick="toggleGraphView(1)">
											<input type="radio" name="options" id="option1" autocomplete="off" checked> Dataset 1
										</label>
										<label class="btn btn-info btn-ds-2" onclick="toggleGraphView(0)">
											<input type="radio" name="options" id="option2" autocomplete="off"> Dataset 2
										</label>
									</div>
	                            </h3>
                            </div>
                            <div class="panel-body">
								<div id="accel-1" class="first-dataset"></div>         
								<div id="accel-21" class="second-dataset"></div>                     	
                            </div>
                        </div>
                    </div>                                     
                </div>	
                <!-- /.row -->	   
                
                <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                	<i class="fa fa-bar-chart-o fa-fw"></i> <b>Accelerometer: Y Value</b>
									<div class="btn-group switch-graph-view" data-toggle="buttons">
										<label class="btn btn-info btn-ds-1 active" onclick="toggleGraphView(1)">
											<input type="radio" name="options" id="option1" autocomplete="off" checked> Dataset 1
										</label>
										<label class="btn btn-info btn-ds-2" onclick="toggleGraphView(0)">
											<input type="radio" name="options" id="option2" autocomplete="off"> Dataset 2
										</label>
									</div>
                                </h3>
                            </div>
                            <div class="panel-body">
								<div id="accel-2" class="first-dataset"></div>      
								<div id="accel-22" class="second-dataset"></div>                        	
                            </div>
                        </div>
                    </div>                                     
                </div>	
                <!-- /.row -->	
                
                <div class="row">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                	<i class="fa fa-bar-chart-o fa-fw"></i> <b>Accelerometer: Z Value</b>
									<div class="btn-group switch-graph-view" data-toggle="buttons">
										<label class="btn btn-info btn-ds-1 active" onclick="toggleGraphView(1)">
											<input type="radio" name="options" id="option1" autocomplete="off" checked> Dataset 1
										</label>
										<label class="btn btn-info btn-ds-2" onclick="toggleGraphView(0)">
											<input type="radio" name="options" id="option2" autocomplete="off"> Dataset 2
										</label>
									</div>
                                </h3>
                            </div>
                            <div class="panel-body">
								<div id="accel-3" class="first-dataset"></div>    
								<div id="accel-23" class="second-dataset"></div>     	
                            </div>
                        </div>
                    </div>                                     
                </div>	
                <!-- /.row -->	 
                
                <div class="row" id="moisture-panel">
                     <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                	<i class="fa fa-bar-chart-o fa-fw"></i> <b>Soil Moisture: M Value</b>
									<div class="btn-group switch-graph-view" data-toggle="buttons">
										<label class="btn btn-info btn-ds-1 active" onclick="toggleGraphView(1)">
											<input type="radio" name="options" id="option1" autocomplete="off" checked> Dataset 1
										</label>
										<label class="btn btn-info btn-ds-2" onclick="toggleGraphView(0)">
											<input type="radio" name="options" id="option2" autocomplete="off"> Dataset 2
										</label>
									</div>
                                </h3>
                            </div>
                            <div class="panel-body">
								<div id="accel-4" class="first-dataset"></div>      
								<div id="accel-24" class="second-dataset"></div>    	
                            </div>
                        </div>
                    </div>                                     
                </div>	
                <!-- /.row -->	
                		
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<script>
	var toDate = "<?php echo $dateto; ?>";
	var fromDate = "<?php echo $datefrom; ?>";

	var curSite = "<?php echo $site; ?>";
	var curNode = "<?php echo $node; ?>";
	var dataBase = "";
	
	nodeAlertJSON = <?php echo $nodeAlerts; ?>;
	nodeStatusJSON = <?php echo $nodeStatus; ?>;
	maxNodesJSON = <?php echo $siteMaxNodes; ?>;	
	
	var options;
	var isSecondSetLoaded = false;

	function getAllSites() {	
		var baseURL = "<?php echo $_SERVER['SERVER_NAME']; ?>";
		var URL;
		if (baseURL == "localhost") {
			URL = "http://localhost/temp/getSenslopeData.php?sitenames&db=senslopedb";
		}
		else {
			URL = "http://www.dewslandslide.com/ajax/getSenslopeData.php?sitenames&db=senslopedb";
		}
		
		$.getJSON(URL, function(data, status) {
			options = data;
			popDropDownGeneral();
		});
	}

	//getAllSites();	
	
	function popDropDownGeneral() {
		var select = document.getElementById('sitegeneral');
		var i;
		for (i = 0; i < options.length; i++) {
			var opt = options[i];
			var el = document.createElement("option");
			el.textContent = opt.toUpperCase();
			
			if(opt == "select") {
				el.value = "none";
			}
			else {
				el.value = opt;
			}
			
			select.appendChild(el);
		}
	}
	
	function initNode() {
		if (curSite != "") {
			$('#sitegeneral').val(curSite);
			document.getElementById("node").value = curNode;
			
			var element = document.getElementById("header-site");
			var targetForm = document.getElementById("formGeneral");
			element.innerHTML = targetForm.sitegeneral.value.toUpperCase() + " Node " + curNode + " Overview";			
		}
	}
	
	function getMainForm() {
		var targetForm = document.getElementById("formGeneral");
		
		return targetForm;
	}
	
	window.onload = function() {					
		//popDropDownGeneral();
		getAllSites();
		setDate(fromDate, toDate);
		initAlertPlot();
		
		var targetForm = getMainForm();
		
		setTimeout(function(){
			initNode();

			if ((document.getElementById("sitegeneral").value).length == 5) {
				//$("#moisture-panel").hide();
				$("#moisture-panel").find("b").text("Voltage Level: V Value");
				resetSecondSetLoaded();
			}
			else {
				$("#moisture-panel").find("b").text("Soil Moisture: M Value");
				$(".switch-graph-view").hide();
			}

			if (document.getElementById("dbase").value == "filtered") {
				$("#moisture-panel").hide();
			} 
			else{
				$("#moisture-panel").show();
			};

			$(".first-dataset").show();
			$(".second-dataset").hide();
			showAccel(getMainForm());
		}, 1000); 
		
		setTimeout(function(){
			showLSBChange(targetForm);
		}, 2500); 
	}
	
	function redirectNodePlots (frm) {
		//if(frm.sitegeneral.value == "none") {
		if(document.getElementById("sitegeneral").value == "none") {
			//do nothing
		}
		else if ((curSite == document.getElementById("sitegeneral").value) && (curNode == document.getElementById("node").value)) {
			if ((document.getElementById("sitegeneral").value).length == 5) {
				//$("#moisture-panel").hide();
				$("#moisture-panel").find("b").text("Battery Level: V Value");
				resetSecondSetLoaded();
			}
			else {
				$("#moisture-panel").find("b").text("Soil Moisture: M Value");
			}

			if (document.getElementById("dbase").value == "filtered") {
				$("#moisture-panel").hide();
			} 
			else{
				$("#moisture-panel").show();
			};

			$(".first-dataset").show();
			$(".second-dataset").hide();
			showAccel(getMainForm());
			showLSBChange(getMainForm());
		}
		else {
			curSite = document.getElementById("sitegeneral").value;
			curNode = document.getElementById("node").value;
			fromDate = document.getElementById("formDate").dateinput.value;
			toDate = document.getElementById("formDate").dateinput2.value;
			var urlExt = "gold/node/" + curSite + "/" + curNode + "/" + fromDate + "/" + toDate;
			var urlBase = "<?php echo base_url(); ?>";
			
			window.location.href = urlBase + urlExt;
		}
	}	

	function checkIfSecondSet(elemid) {
		var JSON = ["#accel-21","#accel-22","#accel-23","#accel-24"];	
		var hasMatch = false;

		for (var index = 0; index < JSON.length; ++index) {
			var graphName = JSON[index];

			if(graphName == elemid){
				hasMatch = true;
				return hasMatch;
			}
		}	

		return hasMatch;
	}

	function checkSecondSetLoaded() {
		return isSecondSetLoaded;	
	}

	function setSecondSetLoaded(val) {
		isSecondSetLoaded = val;	
	}

	function resetSecondSetLoaded() {
		isSecondSetLoaded = false;
	}

	function switchGraphView (toshow, tohide) {
		if(checkIfSecondSet(toshow)) {
			if (checkSecondSetLoaded() == false) {
				showAccelSecond(getMainForm());
				setSecondSetLoaded(true);
			}
		}

		$(toshow).show();
		$(tohide).hide();
	}

	function toggleGraphView (setNum) {
		if (setNum == 1) {
			//Show the first data set
			$(".btn-ds-1").addClass("active");
			$(".btn-ds-2").removeClass("active");
			$(".first-dataset").show();
			$(".second-dataset").hide();
		} else{
			//Show the second data set
			$(".btn-ds-1").removeClass("active");
			$(".btn-ds-2").addClass("active");
			$(".first-dataset").hide();
			$(".second-dataset").show();

			if (checkSecondSetLoaded() == false) {
				showAccelSecond(getMainForm());
				setSecondSetLoaded(true);
			}			
		};
	}
</script>