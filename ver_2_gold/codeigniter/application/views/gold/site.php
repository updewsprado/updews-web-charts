
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" id="header-site">Site Overview</h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- New Features!!! -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>New Feature!</strong> Mini Alert Map for a more convenient way of mapping alerts on the site level analysis page
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>New Feature!</strong> All nodes from Alert Map are now clickable!
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
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Mini Alert Map</h3>
                            </div>
                            <div class="panel-body">
								<div id="mini-alert-canvas">
									<svg id="minialertcanvas" viewBox="0 0 1024 30" preserveAspectRatio = "xMinYMin meet">
									</svg>
								</div>
                            </div>
                        </div>
                    </div>                                       
                </div>
                <!-- /.row -->  

                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Sites Map</h3>
                            </div>
                            <div class="panel-body">
                                <div id="map-canvas" >MAP CANVASS</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-8">
                    	<div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Position Plot <input type="button" id="posLegend" onclick="posLegends(this.form)" value="Show Legends" /></h3>
							</div>
							<div id="position-legends" style="width:130px; height:85px; visibility:hidden; display:none;"></div>  
							<div class="panel-body">		
								<div id="position-canvas">
									<FORM id="formPosition">
									<p>
										Day Intervals: <select name="interval" onchange="showPositionPlotGeneral(document.getElementById('formGeneral'))">
										<option value="6">6</option>
										<option value="5">5</option>
										<option value="4">4</option>
										<option value="3">3</option>
										<option value="2">2</option>
										<option value="1">1</option>
										</select>
									</p>
									</FORM>
									<svg id="positioncanvas" viewBox="0 0 587 380" preserveAspectRatio = "xMinYMin meet">
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Communication Health <input type='button' id='show' onclick='showLegends(this.form)' value='Show Legends' /></h3>
									<div width="250px" id="legends" style="visibility:hidden; display:none;">
											<strong>Past 7 Days</strong><input type='button' onclick="barTransition('red')" style='background-color:red; padding-right:5px;' /><br/>
											<strong>Past 30 Days</strong><input type='button' onclick="barTransition('blue')" style='background-color:blue; padding-right:5px;' /><br/>
											<strong>Overall</strong><input type='button' onclick="barTransition('green')" style='background-color:green; padding-right:5px;' />
									</div>
							</div>
                            <div class="panel-body">
                                <div id="healthbars-canvas" >
										<svg id="barchart" viewbox="0 0 448 433" preserveAspectRatio = "xMinYMin meet">
										</svg>
                                </div>
                            </div>
                        </div>
                    </div>                                    
                </div>
                <!-- /.row -->

				<div class="row">
                     <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> XZ Linear Displacement (Zeroed and Offsetted)</h3>
                            </div>
                            <div class="panel-body">
                                <div class="analysis-dyna-canvas" >
									<div id="xz-lin-zero-analysis-dyna-canvas"></div>                              	
                                </div>
                            </div>
                        </div>
                    </div>     
                    
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> XY Linear Displacement (Zeroed and Offsetted)</h3>
                            </div>
                            <div class="panel-body">
                                <div class="analysis-dyna-canvas" >
									<div id="xy-lin-zero-analysis-dyna-canvas"></div>                               	
                                </div>
                            </div>
                        </div>
                    </div>                                  
                </div>	
                <!-- /.row -->		
                
				<div class="row">
                     <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> XZ Linear Displacement</h3>
                            </div>
                            <div class="panel-body">
                                <div class="analysis-dyna-canvas" >
									<div id="xz-lin-analysis-dyna-canvas"></div>                               	
                                </div>
                            </div>
                        </div>
                    </div>     
                    
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> XY Linear Displacement</h3>
                            </div>
                            <div class="panel-body">
                                <div class="analysis-dyna-canvas" >
									<div id="xy-lin-analysis-dyna-canvas"></div>                              	
                                </div>
                            </div>
                        </div>
                    </div>                                  
                </div>	
                <!-- /.row -->	
                
				<div class="row">
                     <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> XZ Linear Velocity</h3>
                            </div>
                            <div class="panel-body">
                                <div class="analysis-dyna-canvas" >
									<div id="xz-vel-analysis-dyna-canvas"></div>                               	
                                </div>
                            </div>
                        </div>
                    </div>     
                    
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> XY Linear Velocity</h3>
                            </div>
                            <div class="panel-body">
                                <div class="analysis-dyna-canvas" >
									<div id="xy-vel-analysis-dyna-canvas"></div>                             	
                                </div>
                            </div>
                        </div>
                    </div>                                  
                </div>	
                <!-- /.row -->	                                

                <!-- Heading for Date Dependent Charts -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Date Dependent Charts                                
                            </li>
                        </ol>
                    </div>
                </div>

				<div class="row">
                     <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Sent Node Data</h3>
                            </div>
                            <div class="panel-body">
								<div id="sent-node-canvas">
									<div id="sentnode_timestamp"><b>Data Sent: </b></div>
									<svg id="div_health" viewbox="0 0 448 400" preserveAspectRatio = "xMinYMin meet">
									</svg>                          	     	
								</div>
							</div>
						</div>     
                    </div>
				</div>
				<!-- /.row -->
				<div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Rainfall Data (24 Hour Cummulative)</h3>
                            </div>
                            <div class="panel-body">
								<div id="rainfall-canvas">
									<div id="rainfall_24hr_timestamp"><b>Timestamp: </b></div>
									<svg id="rainfall_24hr" viewbox="0 0 447 430" preserveAspectRatio = "xMinYMin meet">
									</svg>
								</div>                            	
                            </div>
                        </div>
					</div>
					<div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Rainfall Data (15 Min Cummulative)</h3>
                            </div>
                            <div class="panel-body">
								<div id="rainfall-canvas">
									<div id="rainfall_15min_timestamp"><b>Timestamp: </b></div>
									<svg id="rainfall_15min" viewbox="0 0 447 430" preserveAspectRatio = "xMinYMin meet">
									</svg>
								</div>                            	
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
var curSite = "<?php echo $site; ?>";

var options = ["select", "blcb", "blct", "bolb", "gamb", "gamt",
				"humb", "humt", "labb", "labt", "lipb",
				"lipt", "mamb", "mamt", "oslb", "oslt",
				"plab", "plat", "pugb", "pugt", "sinb",
				"sinu"];

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

function initSite() {
	if (curSite != "") {
		$('#sitegeneral').val(curSite);
		
		var element = document.getElementById("header-site");
		var targetForm = document.getElementById("formGeneral");
		element.innerHTML = targetForm.sitegeneral.value.toUpperCase() + " Site Overview";
		
		showSitePlots(targetForm);
	}
}

window.onload = function() {
	
	nodeAlertJSON = <?php echo $nodeAlerts; ?>;
	nodeStatusJSON = <?php echo $nodeStatus; ?>;
	maxNodesJSON = <?php echo $siteMaxNodes; ?>;
	
	$('#nodeGeneral').hide();
	positionPlot.init_dims();
	//initAnalysisDyna();
	popDropDownGeneral();
	
	setTimeout(function(){
		initSite();
		initAlertPlot();
	}, 1500); 
}	

function redirectSitePlots (frm) {
	if(frm.sitegeneral.value == "none") {
		//do nothing
	}
	else {
		curSite = frm.sitegeneral.value;
		
		var urlExt = "gold/site/" + curSite;
		var urlBase = "<?php echo base_url(); ?>";
		
		window.location.href = urlBase + urlExt;
	}
}

function showSitePlots (frm) {
	if(frm.sitegeneral.value == "none") {
		//do nothing
	}
	else {
		curSite = frm.sitegeneral.value;
		
		var element = document.getElementById("header-site");
		element.innerHTML = frm.sitegeneral.value.toUpperCase() + " Site Overview";
		
		showPositionPlotGeneral(frm);
		showAnalysisDynaGeneral(frm);
		showSentNodeTotalGeneral(frm);
		showBrush(frm);
        showRainGeneral(frm);
		showCommHealthPlotGeneral(frm);

		
	}
}

function showDateSitePlots (frm) {
	if(frm.sitegeneral.value == "none") {
		//do nothing
	}
	else {
		showSentNodeTotalGeneral(frm);
		showRainGeneral(frm);
	}
}

</script>