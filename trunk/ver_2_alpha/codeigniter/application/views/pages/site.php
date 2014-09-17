
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Site Overview <small>Site Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Monitoring
                            </li>
                        </ol>
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
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Position Plot</h3>
                            </div>
                            <div class="panel-body">
                                <div id="position-canvas">
                                	<FORM NAME="test">
									<p>
										Site: <select name="sites" id="selectSite">
										</select>
										<input type="button" value="go" onclick="showData(this.form)"><br />
										Day Intervals: <select name="interval">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										</select>
									</p>
									</FORM>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
<script>
window.onload = function() {
	initPosPlot();
}	
</script>