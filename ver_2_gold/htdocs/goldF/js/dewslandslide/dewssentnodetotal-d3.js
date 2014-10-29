	var current, blah = 0;
	
	var margin = {top: 10, right: 10, bottom: 100, left: 40},
		margin2 = {top: 430, right: 10, bottom: 20, left: 40};

	var end_date = new Date();
	//var start_date = new Date(end_date.getMonth() + '-' + end_date.getDate() + '-' + end_date.getFullYear());
	var start_date = new Date(end_date.getFullYear(), end_date.getMonth(), end_date.getDate()-10);

	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
		$( "#datepicker" ).datepicker("setDate", start_date); 
	});

	$(function() {
		$( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd" });
		$( "#datepicker2" ).datepicker("setDate", end_date);
	});

	var opts = {
		lines: 11, // The number of lines to draw
		length: 6, // The length of each line
		width: 3, // The line thickness
		radius: 8, // The radius of the inner circle
		corners: 1, // Corner roundness (0..1)
		rotate: 0, // The rotation offset
		direction: 1, // 1: clockwise, -1: counterclockwise
		color: '#000', // #rgb or #rrggbb or array of colors
		speed: 1.1, // Rounds per second
		trail: 58, // Afterglow percentage
		shadow: false, // Whether to render a shadow
		hwaccel: false, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex: 2e9, // The z-index (defaults to 2000000000)
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent
	};
		
	function showSentNodeTotalGeneral(frm) {

	blah = document.getElementById("formDate").dateinput.value;
	
	current = document.getElementById("current");
	current.innerHTML = "<b>Data Sent: </b>";
				
		d3.selectAll("#svg-sitehealth").remove();	
		
	var focusGraph;
	var target = document.getElementById('div_health');
	var spinner = new Spinner(opts).spin();
        target.appendChild(spinner.el);
			 
		width = parseInt(d3.select('#div_health').style('width'), 10);
		width2 = 600;
		width = width - margin.left - margin.right;
		height = parseInt(d3.select('#div_health').style('height'), 10);
		height2 = 400;
		height = height - margin.top - margin.bottom;

	var parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;
	var formatDate = d3.time.format("%Y-%m-%d %H:%M:%S");
	var bisectDate = d3.bisector(function(d) { return d.date; }).left;
	
	var x = d3.time.scale().range([0, width]),
		x2 = d3.time.scale().range([0, width2]),
		y = d3.scale.linear().range([height, 0]),
		y2 = d3.scale.linear().range([height2, 0]);
	
	var xAxis = d3.svg.axis().scale(x).orient("bottom"),
		xAxis2 = d3.svg.axis().scale(x2).orient("bottom"),
		yAxis = d3.svg.axis().scale(y).orient("left");
	
	var sliderarea = d3.svg.area()
		.interpolate("basis")
		.x(function(d) { return x2(d.date); })
		.y0(height2)
		.y1(0);
	
	var brush = d3.svg.brush()
		.x(x2)
		.on("brush", brushed);
		
	var svg = d3.select("#div_health").append("svg")
		.attr("id", "svg-sitehealth")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom);
	
	var slider = d3.select("#slider").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height2)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		
	svg.append("defs").append("clipPath")
		.attr("id", "clip")
		.append("rect")
		.attr("width", width)
		.attr("height", height);
	
	var focus = svg.append("g")
		.attr("class", "focus")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		
	var barsGroup = focus.append("g")
		.attr('clip-path', 'url(#clip)');

	d3.selectAll("#svg-sitehealth")
		.attr("viewBox", "0 0 447 430")
		.attr("width", "100%")
		.attr("height", "100%")
		.attr("preserveAspectRatio", "xMinYMin meet");	
	
	var tool = svg.append("g")                                
		.style("display", "none");   
	
	var data = sentNodeJSON;

		data.forEach(function(d) {
		  d.date = parseDate(d.timestamp);
		  d.nodes = +d.count;
		});
		
	  x.domain(d3.extent(data.map(function(d) { return d.date; })));
	  y.domain([0, d3.max(data.map(function(d) { return d.nodes; }))]);
	  x2.domain(x.domain());
	  y2.domain(y.domain());

		tool.append("circle")                                 
			.attr("class", "y")                              
			.style("fill", "red")                          
			.style("stroke", "red")                         
			.attr("r", 3);    
		
		focus.append("g")
		    .attr("class", "x axis")
		    .attr("transform", "translate(0," + height + ")")
			.style("font-size", "14px")
		    .call(xAxis);

		focus.append("g")
			.attr("class", "y axis")
			.style("font-size", "14px")
			.call(yAxis);
		
		focusGraph = barsGroup.selectAll("rect")
			.data(data)
			.enter().append("rect")
			.attr("fill", "steelblue")
			.attr("x", function(d, i) { return x(d.date); })
			.attr("y", function(d) { return y(d.nodes); })
			.attr("width", 10)
			.attr("height", function(d) { return y(0) - y(d.nodes); });

		focus.append("text")
			.attr("transform", "rotate(-90)")
			.attr("y", 0)
			.attr("x",0 - (height / 2))
			.attr("dy", "1em")
			.style("text-anchor", "middle")
			.style("font-size", "15px")
			.text("No. of Node Data Sent");											
		
		focus.append("rect")
			.attr("width", width)                              
			.attr("height", height)                           
			.style("fill", "none")                             
			.style("pointer-events", "all") 
			.on("mouseover", function() { tool.style("display", null); })
			.on("mouseout", mouseout)
			.on("mousemove", mousemove); 
		
		slider.append("path")
			.datum(data)
			.attr("fill", "blue")
			.attr("d", sliderarea);	
			
		slider.append("g")
			.attr("class", "x axis top")
			.attr("transform", "translate(0," + height2 + ")")
			.style("font-size", "11px")
			.call(xAxis2);
			
		slider.append("g")
			.attr("class", "x brush")
			.call(brush)
			.selectAll("rect")
			.attr("y", 0)
			.attr("height", height2);	
			
	function mousemove() {                                 
        var x0 = x.invert(d3.mouse(this)[0]);              
            i = bisectDate(data, x0, 1),                   
            d0 = data[i - 1],                              
            d1 = data[i],                                  
            d = x0 - d0.date > d1.date - x0 ? d1 : d0;     

			tool.select("circle.y")                         
            .attr("transform",                           
                  "translate(" + (x(d.date) + 45)  + "," +         
                                 y((d.nodes) - 0.5) + ")");      
								 
			current = document.getElementById("current");
			current.innerHTML = "<b>Data Sent: </b>" + d.nodes + "<b> Timestamp: </b>" + formatDate(d.date);
    }

	function mouseout() {
			tool.style("display", "none");
			current = document.getElementById("current");
			current.innerHTML = "<b>Data Sent: </b>";
	}

	function brushed() {
	  x.domain(brush.empty() ? x2.domain() : brush.extent());
	  focusGraph.attr("x", function(d, i) { return x(d.date); });
	  focusGraph.attr("width", 10);

	  focus.select(".x.axis").call(xAxis);
	}
	
	spinner.stop();
	
	}
	function change(el) {
			if(g != 0)
				g.setVisibility(parseInt(el.id), el.checked);
			
			isVisible[parseInt(el.id)] = el.checked;
		}