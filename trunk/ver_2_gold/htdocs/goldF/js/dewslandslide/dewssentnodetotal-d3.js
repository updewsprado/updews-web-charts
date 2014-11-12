	var sentnode_current, blah = 0, blah2 = 0;
	
	var sentnode_margin = {top: 10, right: 10, bottom: 20, left: 40};

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
		blah2 = document.getElementById("formDate").dateinput2.value;
		
		sentnode_current = document.getElementById("sentnode_timestamp");
		sentnode_current.innerHTML = "<b>Data Sent: </b>";
				
		d3.selectAll("#svg-sitehealth").remove();	
		
	var focusGraph;
	var sentnode_target = document.getElementById('div_health');
	var sentnode_spinner = new Spinner(opts).spin();
        sentnode_target.appendChild(sentnode_spinner.el);
			 
		sentnode_width = parseInt(d3.select('#div_health').style('width'), 10);
		sentnode_width = sentnode_width - sentnode_margin.left - sentnode_margin.right;
		sentnode_height = parseInt(d3.select('#div_health').style('height'), 10);
		sentnode_height = sentnode_height - sentnode_margin.top - sentnode_margin.bottom;

	var sentnode_parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;
	var sentnode_formatDate = d3.time.format("%Y-%m-%d %H:%M:%S");
	var sentnode_bisectDate = d3.bisector(function(d) { return d.date; }).left;
	
	var x = d3.time.scale().range([0, sentnode_width]),
		y = d3.scale.linear().range([sentnode_height, 0]);
	
	var sentnode_xAxis = d3.svg.axis().scale(x).orient("bottom"),
		sentnode_yAxis = d3.svg.axis().scale(y).orient("left");
		
	var sentnode_svg = d3.select("#div_health").append("svg")
			.attr("id", "svg-sitehealth")
			.attr("width", sentnode_width + sentnode_margin.left + sentnode_margin.right)
			.attr("height", sentnode_height + sentnode_margin.top + sentnode_margin.bottom);
		
		sentnode_svg.append("defs").append("clipPath")
			.attr("id", "clip")
			.append("rect")
			.attr("width", sentnode_width)
			.attr("height", sentnode_height);
	
	var sentnode_focus = sentnode_svg.append("g")
			.attr("class", "focus")
			.attr("transform", "translate(" + sentnode_margin.left + "," + sentnode_margin.top + ")");
		
	var barsGroup = sentnode_focus.append("g")
			.attr('clip-path', 'url(#clip)');

		d3.selectAll("#svg-sitehealth")
			.attr("viewBox", "0 0 447 430")
			.attr("width", "100%")
			.attr("height", "100%");
			
		d3.selectAll("#div_health")
			.attr("viewBox", "0 0 447 430")
			.attr("width", "100%")
			.attr("height", "100%");
	
	var sentnode_tool = sentnode_svg.append("g")                                
			.style("display", "none");   
		
	var sentnode_url = "/test/senttotal/" + frm.sitegeneral.value + "/" + blah + "/" + blah2 + "/" + frm.dbase.value;
	
		d3.json(sentnode_url, function(error, data) {

			data.forEach(function(d) {
				d.date = sentnode_parseDate(d.timestamp);
				d.nodes = +d.count;
			});
		
			x.domain(d3.extent(data.map(function(d) { return d.date; })));
			y.domain([0, d3.max(data.map(function(d) { return d.nodes; }))]);

			sentnode_tool.append("circle")                                 
				.attr("class", "y")                              
				.style("fill", "red")                          
				.style("stroke", "red")                         
				.attr("r", 3);    
		
			sentnode_focus.append("g")
				.attr("class", "x axis")
				.attr("transform", "translate(0," + sentnode_height + ")")
				.style("font-size", "14px")
				.call(sentnode_xAxis);

			sentnode_focus.append("g")
				.attr("class", "y axis")
				.style("font-size", "14px")
				.call(sentnode_yAxis);
		
			focusGraph = barsGroup.selectAll("rect")
				.data(data)
				.enter().append("rect")
				.attr("fill", "steelblue")
				.attr("x", function(d, i) { return x(d.date); })
				.attr("y", function(d) { return y(d.nodes); })
				.attr("width", 10)
				.attr("height", function(d) { return y(0) - y(d.nodes); });

			sentnode_focus.append("text")
				.attr("transform", "rotate(-90)")
				.attr("y", -40)
				.attr("x",0 - (sentnode_height / 2))
				.attr("dy", "1em")
				.style("text-anchor", "middle")
				.style("font-size", "15px")
				.text("No. of Node Data Sent");											
		
			sentnode_focus.append("rect")
				.attr("width", sentnode_width)                              
				.attr("height", sentnode_height)                           
				.style("fill", "none")                             
				.style("pointer-events", "all") 
				.on("mouseover", function() { sentnode_tool.style("display", null); })
				.on("mouseout", sentnode_mouseout)
				.on("mousemove", sentnode_mousemove); 
			
			function sentnode_mousemove() {                                 
				var x0 = x.invert(d3.mouse(this)[0]);              
					i = sentnode_bisectDate(data, x0, 1),                   
					d0 = data[i - 1],                              
					d1 = data[i],                                  
					d = x0 - d0.date > d1.date - x0 ? d1 : d0;     

					sentnode_tool.select("circle.y")                         
						.attr("transform",                           
							  "translate(" + (x(d.date) + 45)  + "," +         
											 y((d.nodes) - 0.5) + ")");      
										 
					sentnode_current = document.getElementById("sentnode_timestamp");
					sentnode_current.innerHTML = "<b>Data Sent: </b>" + d.nodes + "<b> Timestamp: </b>" + sentnode_formatDate(d.date);
			}

			function sentnode_mouseout() {
					sentnode_tool.style("display", "none");
					sentnode_current = document.getElementById("sentnode_timestamp");
					sentnode_current.innerHTML = "<b>Data Sent: </b>";
			}
	
	});

	sentnode_spinner.stop();
	
	}
	function change(el) {
			if(g != 0)
				g.setVisibility(parseInt(el.id), el.checked);
			
			isVisible[parseInt(el.id)] = el.checked;
		}