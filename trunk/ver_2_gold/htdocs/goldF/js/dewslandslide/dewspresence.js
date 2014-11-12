/**
 * @author PradoArturo
 */

var presenceJSON = 0;
var allSitesJSON = 0;

var presencePlot = new function() {
	// Set the dimensions of the canvas / graph
	this.cWidth = 0;
	this.cHeight = 0;
	
	this.margin = 0;
	this.width = 0;
	this.height = 0;
	
	this.graphDim = 0;
	this.labelHeight = 16;
	this.graphCount = 0;
		
	// Parse the xval / time
	this.parseDate = d3.time.format("%b %Y").parse;
	
	this.x, this.y, this.yOrd;
	
	this.yvalline;
	this.svg;	
	
	//initialize dimensions
	this.init_dims = function() {
		this.cWidth = document.getElementById('presence-map-canvas').offsetWidth;
		this.cHeight = document.getElementById('presence-map-canvas').offsetHeight;
		
		this.margin = {top: 0, right: 0, bottom: 0, left: this.cWidth * 0.05};
		this.width = this.cWidth - this.margin.left - this.margin.right;
		this.height = this.cHeight - this.margin.top - this.margin.bottom;
		
		this.graphDim = {gWidth: this.width, gHeight: this.height};	
		
		// Set the ranges
		this.x = d3.scale.linear().range([0, this.graphDim.gWidth]);
		this.y = d3.scale.linear().range([this.graphDim.gHeight, 0]);
		this.yOrd = d3.scale.ordinal()
						.rangeRoundBands([this.graphDim.gHeight, 0], .1);
						
		// Define the line
		this.yvalline = d3.svg.line()	
			//.interpolate("monotone")
		    .x(function(d) { return this.x(d.xval); })
		    .y(function(d) { return this.y(d.yval); });
		    
		// Adds the svg canvas
		this.svg = d3.select("#presence-map-canvas")
            .attr('id', 'svg-presence')
		    .append("svg")
		        .attr("width", this.width + this.margin.left + this.margin.right)
		        .attr("height", this.height + this.margin.top + this.margin.bottom)
		    .append("g")
		        .attr("transform", 
		              "translate(" + this.margin.left + "," + this.margin.top + ")");
		
		this.svg.call(this.tip);	
	};
	
    d3.selectAll("#svg-presence")
			.attr("viewBox", "0 0 1073 430")
			.attr("width", "100%")
			.attr("height", "100%");
            
    d3.selectAll("#alert_canvas")
			.attr("viewBox", "0 0 1073 430")
			.attr("width", "100%")
			.attr("height", "100%");
            
	// Define the axes
	this.make_x_axis = function () {          
	    return d3.svg.axis()
	        .scale(this.x)
	        .orient("bottom")
	        .ticks(40);
	};
	
	this.make_y_axis = function () {          
	    return d3.svg.axis()
	        .scale(this.y)
	        .orient("left")
	        .ticks(5);
	};
	
	this.make_yOrd_axis = function () {           
	    return d3.svg.axis()
	        .scale(this.yOrd)
	        .orient("left")
	        .ticks(1);
	};	
	
	// Tip that displays node info
	this.tip = d3.tip()
	  .attr('class', 'd3-tip')
	  .offset([-10, 0])
	  .html(function(d) {
		var alert,status,id_ts,comment;
		
	    return "<strong>Site:</strong> <span style='color:red'>" + d.site + "</span><Br/>"
			 + "<strong>Timestamp:</strong> <span style='color:red'>" + d.timestamp + "</span><Br/>";
	  });
	  
	this.clearData = function () {
		this.graphCount = 0;
		this.svg.selectAll(".dot").remove();
		this.svg.selectAll(".dot1").remove();
		this.svg.selectAll(".dot2").remove();
		this.svg.selectAll(".line").remove();
		this.svg.selectAll(".legend").remove();
		this.svg.selectAll(".tick").remove();
		this.svg.selectAll(".axislabel").remove();
	};  
};

var siteMaxNodes = [];
var maxNode;
var maxNodesJSON = 0;

function getDataPresence(xOffset) {
	var delay = 500;
	var data = presenceJSON;
	
	siteMaxNodes = data;
	
	//add node links to nodes with normal status
	var urlBase = "http://www.dewslandslide.com/";
	var urlNodeExt = "gold/node/";	
	
	var parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;
	//maxNode = d3.max(siteMaxNodes, function(d) { return parseDate(d.timestamp); });
	maxNode = 48;
	
	// Scale the range of the data
	presencePlot.x.domain(d3.extent(siteMaxNodes, function(d) { return parseDate(d.timestamp); }));
	//yOrd.domain(siteMaxNodes.map(function(d) { return d.site; }));
	presencePlot.yOrd.domain(allSitesJSON.map(function(d) { return d.site; }));
	
	var cellw = (presencePlot.graphDim.gWidth / maxNode) * 0.9;
	var cellh = presencePlot.yOrd.rangeBand(); //9;

	presencePlot.svg.selectAll(".cell")
		.data(siteMaxNodes)
	.enter().append("rect")
		.attr("class", "cell")
		.attr('x', function(d){
			return presencePlot.x(parseDate(d.timestamp)) + xOffset;
		})
		.attr('y', function(d){
			return presencePlot.yOrd(d.site);
		})
		.attr('width', cellw)
		.attr('height', cellh)
		.on('mouseover', presencePlot.tip.show)
		.on('mouseout', presencePlot.tip.hide)
		//.style("cursor", "pointer")
		.on("click", function(d){
	        //document.location.href = urlBase + urlNodeExt + d.site + '/' + d.node;
	        //document.location.href = "www.google.com";
	    });	
}

var nodeStatuses = [];
var nodeStatusJSON = 0;

var alertdata = [];
function generatePresencePlot(url, title, xOffset, isLegends, graphNum) {
	// Get the data
	var jsondata = [];

	//var data = url;
	d3.json(url, function(error, data) {
		presenceJSON = data;
		jsondata = data;
		
		getDataPresence(xOffset);
		
		var horOff = xOffset + ((presencePlot.graphDim.gWidth / maxNode) * 0.9)/2;
		
		/*
		// Graph Label
		presencePlot.svg.append("text")      // text label for the x axis
			.attr("class", "axislabel")
			.attr("x", xOffset + (presencePlot.graphDim.gWidth / 2))
			.attr("y", 0 - (presencePlot.margin.top/2))
			.text(title);	
		*/		
			
		// Add the Y Axis
		presencePlot.svg.append("g")
			.attr("class", "y axis")
			.attr("transform", "translate(" + xOffset + ",0)")
			.call(presencePlot.make_yOrd_axis());
	
		/*
		// Y axis Label
		presencePlot.svg.append("text")		// text label for the y axis
			.attr("class", "axislabel")
			.attr("transform", "rotate(-90)")
			.attr("y", xOffset -5 - (presencePlot.margin.left / 2))
			.attr("x", 0 - (presencePlot.height / 2))
			.text("Column/Site");			
		*/	
	});			
}

var nodeAlertJSON = 0;
function showDataPres() {
	//presenceJSON = <?php echo $dataPresence; ?>;
	//allSitesJSON = <?php echo $allSites; ?>;
	allSitesJSON = maxNodesJSON;
	var url = "/test/allpres";
	
	generatePresencePlot(url, "Data Presence Map", 0, true, 1);
}

function dataPresencePlot() {
	presencePlot.init_dims();
	showDataPres();	
}

window.onload = function() {
	//dataPresencePlot();
};















