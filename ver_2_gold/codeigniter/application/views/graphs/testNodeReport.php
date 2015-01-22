<!DOCTYPE html>
<meta charset="utf-8">
<title>Alert Color Map</title>

<head>
<style> /* set the CSS */

body { font: 12px Arial;}

#alert-canvas { font: 12px Arial;}

path { 
    stroke: steelblue;
    stroke-width: 2;
    fill: none;
}

.axis path,
.axis line {
    fill: none;
    stroke: grey;
    stroke-width: 1;
    shape-rendering: crispEdges;
}

.legend {
    font-size: 16px;
    font-weight: bold;
    text-anchor: left;
}

.axislabel {
    font-size: 16px;
    font-weight: bold;
    text-anchor: middle;
}

.cell_default {
  fill: #03899C;
}

.cell {
  /*fill: #FFAE00;*/
}

.cell:hover {
  fill: #FF1300 ;
}

.dot {
  fill: orangered;
}

.dot:hover {
  fill: black ;
}

.dot1 {
  fill: gainsboro;
}

.dot1:hover {
  fill: black ;
}

.dot2 {
  fill: gainsboro;
}

.dot2:hover {
  fill: black ;
}

.grid .tick {
    stroke: lightgrey;
    opacity: 0.7;
}

.grid path {
      stroke-width: 0;
}

.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}

#alert-canvas svg {
    display: block;
    margin: 0 auto;
}
</style>

<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css'>
<style class="cp-pen-styles">/* Fix for Bootstrap 3 with Angular UI Bootstrap */

.modal { 
	display: block;
}

/* Custom dialog/modal headers */

.dialog-header-error { background-color: #d2322d; }
.dialog-header-wait { background-color: #428bca; }
.dialog-header-notify { background-color: #eeeeee; }
.dialog-header-confirm { background-color: #333333; }
.dialog-header-error span, .dialog-header-error h4,
.dialog-header-wait span, .dialog-header-wait h4,
.dialog-header-confirm span, .dialog-header-confirm h4 { color: #ffffff; }

/* Ease Display */

.pad { padding: 25px; }
</style>

<body>

<!-- load the d3.js library -->    
<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

<!-- Custom DEWS Landslide CSS -->
<link href="/goldF/css/dewslandslide/dewsalert.css" rel="stylesheet" type="text/css">
<!-- Custom DEWS Landslide JS 
<script src="../js/dewslandslide/dewslandslide.js"></script>
-->	
<script src="/goldF/js/dewslandslide/dewsalert.js"></script>
<!-- jQuery Version 1.11.0 -->
<script src="/js/jquery-1.11.0.js"></script>

</head>

<html ng-app="modalTest" ng-init="alias='holy cow'">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js"></script>
    <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
    <script src="http://m-e-conroy.github.io/angular-dialog-service/javascripts/dialogs.min.js" type="text/javascript"></script>
    <script src="/goldF/js/dewslandslide/dewsnodereport.js"></script>
  </head>
  <body ng-controller="dialogServiceTest" class="pad">
    <div class="row">
      <div class="col-md-12">
        <button class="btn btn-warning" ng-click="launch('create')">Custom Dialog</button>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-12">
        <p>
          <span class="text-info">Your Name</span>: {{name}}
        </p>
        <p>
          <span class="text-info">Your Alternate Name</span>: {{alias}}
        </p>         
      </div>
    </div>
    <br />
    
    <div id="alert-canvas"></div>
    
  </body>
  
    <script type="text/ng-template" id="/dialogs/whatsyourname.html">
		<div class="modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">
							<span class="glyphicon glyphicon-star"></span> User's Name
						</h4>
					</div>
					<div class="modal-body">
						<ng-form name="nameDialog" novalidate role="form">
						<div class="form-group input-group-lg" ng-class="nameDialog.username.$dirty && nameDialog.username.$invalid">
							<label class="control-label" for="username">Name:</label>
							<input type="text" class="form-control" name="username" id="username" ng-model="user.name" ng-keyup="hitEnter($event)" required>
							<!--
							<input type="text" class="form-control" name="username" id="username" ng-model="user.name" ng-keyup="hitEnter($event)" required>
							-->
							<p>Alias: <span ng-bind="alias"></span></p>
							<span class="help-block">Enter your full name, first &amp; last.</span>
						</div>
						</ng-form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
						<button type="button" class="btn btn-primary" ng-click="save()" ng-disabled="(nameDialog.$dirty && nameDialog.$invalid) || nameDialog.$pristine">Save</button>
					</div>
				</div>
			</div>
		</div>
    </script>  
</html>

<script>
window.onload = function() {
	nodeAlertJSON = <?php echo $nodeAlerts; ?>;
	maxNodesJSON = <?php echo $siteMaxNodes; ?>;
	nodeStatusJSON = <?php echo $nodeStatus; ?>;
	
	initAlertPlot();
}	
</script>
<script src='http://codepen.io/assets/editor/live/css_live_reload_init.js'></script>

</body>
</html>
































