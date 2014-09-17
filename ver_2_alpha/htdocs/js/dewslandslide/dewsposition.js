/**
 * @author PradoArturo
 */

// Set the dimensions of the canvas / graph
var cWidth = 0;
var cHeight = 0;

var margin = 0,
    width = 0,
    height = 0;

var graphDim = 0;

/*
// Set the dimensions of the canvas / graph
var cWidth = 1300,
	cHeight = 600;

var margin = {top: 70, right: 20, bottom: 70, left: 50},
    width = cWidth - margin.left - margin.right,
    height = cHeight - margin.top - margin.bottom;

var graphDim = {gWidth: width * 0.4, gHeight: height};
*/
	
var labelHeight = 16;
	
var graphCount = 0;
	
// Parse the xval / time
var parseDate = d3.time.format("%b %Y").parse;

var x, y;

var yvalline;
var svg;

/*
// Set the ranges
var x = d3.scale.linear().range([0, graphDim.gWidth]);
var y = d3.scale.linear().range([graphDim.gHeight, 0]);
*/

//initialize dimensions
function init_dims() {
	// Set the dimensions of the canvas / graph
	cWidth = document.getElementById('position-canvas').offsetWidth;
	cHeight = document.getElementById('position-canvas').offsetHeight;
	
	margin = {top: 70, right: 20, bottom: 70, left: 50},
	width = cWidth - margin.left - margin.right,
	height = cHeight - margin.top - margin.bottom;
	
	graphDim = {gWidth: width * 0.4, gHeight: height};	
	
	// Set the ranges
	x = d3.scale.linear().range([0, graphDim.gWidth]);
	y = d3.scale.linear().range([graphDim.gHeight, 0]);
	
	// Define the line
	yvalline = d3.svg.line()	
		//.interpolate("monotone")
	    .x(function(d) { return x(d.xval); })
	    .y(function(d) { return y(d.yval); });
	    
	// Adds the svg canvas
	svg = d3.select("#position-canvas")
	    .append("svg")
	        .attr("width", width + margin.left + margin.right)
	        .attr("height", height + margin.top + margin.bottom)
	    .append("g")
	        .attr("transform", 
	              "translate(" + margin.left + "," + margin.top + ")");
	
	svg.call(tip);		
};

// Define the axes
function make_x_axis() {        
    return d3.svg.axis()
        .scale(x)
        .orient("bottom")
        .ticks(5);
};

function make_y_axis() {        
    return d3.svg.axis()
        .scale(y)
        .orient("left")
        .ticks(5);
};

// Tip that displays node info
var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    return "<strong>Date:</strong> <span style='color:red'>" + d.date + "</span><Br/>"
		+ "<strong>Node ID:</strong> <span style='color:red'>" + d.node + "</span><Br/>"
		+ "<strong>X:</strong> <span style='color:red'>" + d.xval + " m</span>"
		+ "<strong>Y:</strong> <span style='color:red'>" + d.yval + " m</span>";
  });		  
			
function clearData() {
	graphCount = 0;
	svg.selectAll(".dot").remove();
	svg.selectAll(".dot1").remove();
	svg.selectAll(".dot2").remove();
	svg.selectAll(".line").remove();
	svg.selectAll(".legend").remove();
	svg.selectAll(".tick").remove();
	svg.selectAll(".axislabel").remove();
}

// Get the data
var jsondata = [];
function generatePlotData(url, title, xOffset, isLegends, graphNum) {
	d3.json(url, function(error, data) {
		jsondata = data;

		data.forEach(function(d) {
			d.xval = parseFloat(d.xval);
			d.yval = parseFloat(d.yval);
		});
		
		// Scale the range of the data
		x.domain(d3.extent(data, function(d) { return parseFloat(d.xval); }));
		y.domain(d3.extent(data, function(d) { return parseFloat(d.yval); }));

		// Nest the entries by date
		var dataNest = d3.nest()
			.key(function(d) {return d.date;})
			.entries(data);

		var color = d3.scale.category10();   // set the colour scale

		legendSpace = width/dataNest.length; // spacing for the legend

		// Add the X Axis
		svg.append("g")
			.attr("class", "x axis")
			//.attr("transform", "translate(0," + height + ")")
			.attr("transform", "translate(" + xOffset + "," + height + ")")
			.call(make_x_axis());

		// Graph Label
		svg.append("text")      // text label for the x axis
			.attr("class", "axislabel")
			.attr("x", xOffset + (graphDim.gWidth / 2))
			.attr("y", 0 -(margin.top/2))
			.text(title);
			
		// X axis Label
		svg.append("text")      // text label for the x axis
			.attr("class", "axislabel")
			.attr("x", xOffset + (graphDim.gWidth / 2))
			.attr("y", height + (margin.bottom/2) + 5)
			.text("Horizontal Displacement (meters)");
			
		// Add the Y Axis
		svg.append("g")
			.attr("class", "y axis")
			.attr("transform", "translate(" + xOffset + ",0)")
			.call(make_y_axis());
		
		// Y axis Label
		svg.append("text")		// text label for the y axis
			.attr("class", "axislabel")
			.attr("transform", "rotate(-90)")
			.attr("y", xOffset -5 - (margin.left / 2))
			.attr("x", 0 - (height / 2))
			.text("Vertical Displacement (meters)");
		
		// Add the Grids
		svg.append("g")
			.attr("class", "grid")
			.attr("transform", "translate(" + xOffset + "," + height + ")")
			.call(make_x_axis()
				.tickSize(-height, 0, 0)
				.tickFormat("")
			);

		svg.append("g")
			.attr("class", "grid")
			.attr("transform", "translate(" + xOffset + ",0)")
			.call(make_y_axis()
				.tickSize(-graphDim.gWidth, 0, 0)
				.tickFormat("")
			);		
		
		// Loop through each date / key
		dataNest.forEach(function(d,i) { 

			svg.selectAll(".dot" + graphNum + "")
					.data(jsondata)
				.enter().append("circle")
					.attr("class", "dot" + graphNum + "")
					//.attr("transform", "translate(" + xOffset + ",0)")
					.attr("r", 5)
					.attr("cx", function(d) { return x(d.xval) + xOffset; })
					.attr("cy", function(d) { return y(d.yval); })
					.on('mouseover', tip.show)
					.on('mouseout', tip.hide);
		
			svg.append("path")
				.attr("class", "line")
				.attr("transform", "translate(" + xOffset + ",0)")
				.style("stroke", function() { // Add the colours dynamically
					return d.color = color(d.key); })
				.attr("id", 'tag'+d.key.replace(/\s+/g, '')) // assign ID
				.attr("d", yvalline(d.values));
				
			// Add the Legend
			if(isLegends){
				svg.append("text")
					.attr("x", graphDim.gWidth + margin.right)  // space legend
					.attr("y", i*(labelHeight + 5))
					.attr("transform", "translate(" + xOffset + ",0)")
					.attr("class", "legend")    // style the legend
					.style("fill", function() { // Add the colours dynamically
						return d.color = color(d.key); })
					.on("click", function(){
						// Determine if current line is visible 
						var active   = d.active ? false : true,
						newOpacity = active ? 0 : 1; 
						// Hide or show the elements based on the ID
						d3.select("#tag"+d.key.replace(/\s+/g, ''))
							.transition().duration(100) 
							.style("opacity", newOpacity); 
						// Upxval whether or not the elements are active
						d.active = active;
						})  
					.text(d.key); 
			}
		});
	});
}
		
function showData(frm) {
	// Clear the canvas area first
	clearData();

	// Generate the XY Graph
	urlXY = "temp/getPosPlot.php?site=" + frm.sites.value + "&interval=" + frm.interval.value;
	titleXY = frm.sites.value + " XY Column Position";
	generatePlotData(urlXY, titleXY, 0, true, 1);
	
	// Generate the XZ Graph
	urlXZ = "temp/getPosPlot.php?xz&site=" + frm.sites.value + "&interval=" + frm.interval.value;
	titleXZ = frm.sites.value + " XZ Column Position";
	generatePlotData(urlXZ, titleXZ, width * 0.6, false, 2);
}

var options = ["blcb", "blct", "bolb", "gamb", "gamt",
				"humb", "humt", "labb", "labt", "lipb",
				"lipt", "mamb", "mamt", "oslb", "oslt",
				"plab", "plat", "pugb", "pugt", "sinb",
				"sinu"];

function popDropDown() {
	var select = document.getElementById('selectSite');
	var i;
	for (i = 0; i < options.length; i++) {
		var opt = options[i];
		var el = document.createElement("option");
		el.textContent = opt;
		el.value = opt;
		select.appendChild(el);
	}
}

function initPosPlot() {
	init_dims();
	popDropDown();	
}

//window.onload = initPosPlot();








