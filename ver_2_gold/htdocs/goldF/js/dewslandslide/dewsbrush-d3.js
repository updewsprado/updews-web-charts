	
	function showBrush(frm) {
	
	var startDate = 0, endDate = 0;

<!-- Declaration of Slider Variables -->

		startDate = document.getElementById("formDate").dateinput.value;
		endDate = document.getElementById("formDate").dateinput2.value;
				
		d3.selectAll("#svg-slider").remove();	
		
	var	slider_margin = {top: 10, right: 10, bottom: 20, left: 40};		
		slider_width = parseInt(d3.select('#div_slider').style('width'), 10);
		slider_width = slider_width - slider_margin.left - slider_margin.right;
		slider_height = parseInt(d3.select('#div_slider').style('height'), 10);
		slider_height = slider_height - slider_margin.top - slider_margin.bottom;
	
	var brush = d3.svg.brush()
		.x(slider_x)
		.on("brush", function () {
			onBrushRain;
			onBrushSent;
		});
	
	var slider_parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;
	
	var slider_x = d3.time.scale().range([0, slider_width]),
		slider_y = d3.scale.linear().range([slider_height, 0]);
	
	var slider_area = d3.svg.area()
		.interpolate("basis")
		.x(function(d) { return slider_x(d.date); })
		.y0(slider_height)
		.y1(0);
		
	var slider_xAxis = d3.svg.axis().scale(slider_x).orient("bottom").ticks(2);
		
	var slider_svg = d3.select("#div_slider").append("svg")
		.attr("id", "svg-slider")
		.attr("width", slider_width + slider_margin.left + slider_margin.right)
		.attr("height", slider_height + slider_margin.top + slider_margin.bottom);
		
	var slider_context = slider_svg.append("g")
		.attr("class", "context")
		.attr("transform", "translate(0,0)");
	
	var slider_url = "/test/senttotal/" + frm.sitegeneral.value + "/" + startDate + "/" + endDate + "/" + frm.dbase.value;

<!--Getting the Time Range for Slider -->
	
		d3.json(slider_url, function(error, data) {

			data.forEach(function(d) {
			  d.date = slider_parseDate(d.timestamp);
			  d.nodes = +d.count;
			});
		
			slider_x.domain(d3.extent(data.map(function(d) { return d.date; })));
			slider_y.domain([0, d3.max(data.map(function(d) { return d.nodes; }))]);

			slider_context.append("path")
				.datum(data)
				.attr("fill", "steelblue")
				.attr("d", slider_area);
			
			slider_context.append("g")
			  .attr("class", "x axis")
			  .attr("transform", "translate(0," + slider_height + ")")
			  .call(slider_xAxis)
			  .style("font-size", "11px");

			slider_context.append("g")
			  .attr("class", "x brush")
			  .call(brush)
			  .selectAll("rect")
			  .attr("y", -6)
			  .attr("height", slider_height + 7);
			  
		});
	
}
	

	
	