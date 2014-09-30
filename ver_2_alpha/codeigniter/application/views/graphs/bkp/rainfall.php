
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View NOAH Rainfall Data</title>
	<link rel="stylesheet" href="js/development-bundle/themes/base/jquery.ui.all.css">
	<script src="js/development-bundle/jquery-1.10.2.js"></script>
	<script src="js/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="js/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="js/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="http://fgnass.github.io/spin.js/spin.min.js"></script>
	<script type="text/javascript" src="http://dygraphs.com/dygraph-combined.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
	});

        $(function() {
		$( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd" });
	});

	// Create the XHR object.
	function createCORSRequest(method, url) {
		var xhr = new XMLHttpRequest();
		if ("withCredentials" in xhr) {
			// XHR for Chrome/Firefox/Opera/Safari.
			xhr.open(method, url, true);
		} else if (typeof XDomainRequest != "undefined") {
			// XDomainRequest for IE.
			xhr = new XDomainRequest();
			xhr.open(method, url);
		} else {
			// CORS not supported.
			xhr = null;
		}
		return xhr;
	}

	// Helper method to parse the title tag from the response.
	function getTitle(text) {
		return text.match('<title>(.*)?</title>')[1];
	}

	// Make the actual CORS request.
	function makeCorsRequest() {
		// All HTML5 Rocks properties support CORS.
		//var url = 'http://updates.html5rocks.com';
		//var url = 'http://noah.dost.gov.ph/';
		//var url = 'http://senslopetest.comlu.com/';
		var url = 'http://dewslandslide.com/';

		var xhr = createCORSRequest('GET', url);
		if (!xhr) {
			alert('CORS not supported');
			return;
		}

		// Response handlers.
		xhr.onload = function() {
			var text = xhr.responseText;
			var title = getTitle(text);
			alert('Response from CORS request to ' + url + ': ' + title);
		};

		xhr.onerror = function() {
			alert('Woops, there was an error making the request.');
		};

		xhr.send();
	}
	
	var g = 0;
	var isVisible = [true, true, true, true];
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
	var target = document.getElementById('raindiv');
    
    var xmlhttp;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
	
	function showDataCors(frm) {
	
		if (frm.dateinput.value == "") {
			document.getElementById("txtHint").innerHTML="";
			return;
		} 
		//else
		//	alert("The field contains the date: " + frm.dateinput.value + " and site: " + frm.sites.value);

        /*
		var url = "http://weather.asti.dost.gov.ph/home/index.php/api/data/" + frm.sites.value + "/from/" + frm.dateinput.value + "/to/" + frm.dateinput2.value;
		var xmlhttp = createCORSRequest('GET', url);
		if (!xmlhttp) {
			alert('CORS not supported');
			return;
		}
		*/
		var target = document.getElementById('raindiv');
		var spinner = new Spinner().spin();
		target.appendChild(spinner.el);

		// Response handlers.
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				
                //var rdatajson = JSON.parse(xmlhttp.responseText);
				var rdatacsv = JSON2CSV(xmlhttp.responseText);	
				//document.getElementById("txtHint").innerHTML = rdatacsv;
				//document.getElementById("txtHint").innerHTML = rdatacsv;
                spinner.stop();
                
                var threshold = 0.0;
                switch(frm.sites.value){
                    case "blcb": threshold = 130.00; break;
                    case "blct": threshold = 130.00; break;
                    case "bolb": threshold = 128.53; break;
                    case "gamt": threshold = 183.85; break;
                    case "gamb": threshold = 183.85; break;
                    case "humb": threshold = 79.33; break;
                    case "humt": threshold = 79.33; break;
                    case "labb": threshold = 195.21; break;
                    case "labt": threshold = 195.21; break;
                    case "lipb": threshold = 129.65; break;
                    case "lipt": threshold = 129.65; break;
                    case "mamb": threshold = 208.54; break;
                    case "mamt": threshold = 208.54; break;
                    case "oslb": threshold = 179.41; break;
                    case "oslt": threshold = 179.41; break;
                    case "plat": threshold = 78.32; break;
                    case "plab": threshold = 78.32; break;
                    case "pugb": threshold = 191.95; break;
                    case "pugt": threshold = 191.95; break;
                    case "sinb": threshold = 235.03; break;
                    case "sint": threshold = 235.03; break;
                    case "sinu": threshold = 235.03; break;
                }
                
				g2 = new Dygraph(
					document.getElementById("raindiv"),
					rdatacsv,
					{
						ylabel: "Rain Intensity (mm)",
                        labels: ["Timestamp","24h Rain","15m Rain"],
                        ylabel: "Rain Intensity",
                        fillGraph: true,
                        
                        underlayCallback: function(canvas, area, g2) {
                            
                            var c1 = g2.toDomCoords(g2.getValue(0,0), threshold);
                            canvas.fillStyle = '#FF0000';
                            canvas.fillRect(area.x, c1[1], area.w, 1);
                                                        
                        },
                        
						//visibility: [true, false]
					}// options
				);
				//var json = JSON.parse(xmlhttp.responseText);
				//document.getElementById("txtHint").innerHTML = json.data[0].dateTimeRead;
                
			}
		};
        
        //var url = "getRainfall.php?rsite=" + frm.sites.value + "&fdate=" + frm.datepicker.value + "&tdate=" + frm.datepicker2.value;
        var url = "ajax/getRainfall.php?rsite=" + frm.sites.value + "&fdate=" + frm.datepicker.value + "&tdate=" + frm.datepicker2.value;
        //var url = "http://dewslandslide.com/ajax/dlRain_json.php?site=" + frm.sites.value;
        document.getElementById("txtHint").innerHTML = url;
		//xmlhttp.open("GET","http://weather.asti.dost.gov.ph/home/index.php/api/data/" + frm.sites.value + "/from/" + frm.dateinput.value + "/to/" + frm.dateinput2.value,true);
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	
	function downloadDataCors(frm) {
	
		if (frm.dateinput.value == "") {
			document.getElementById("txtHint").innerHTML="";
			return;
		} 
		else
			alert("The field contains the date from: " + frm.dateinput.value + ", date to: " + frm.dateinput2.value + " and site: " + frm.sites.value);

		var url = "http://weather.asti.dost.gov.ph/home/index.php/api/data/" + frm.sites.value + "/from/" + frm.dateinput.value + "/to/" + frm.dateinput2.value;
		var xmlhttp = createCORSRequest('GET', url);
		if (!xmlhttp) {
			alert('CORS not supported');
			return;
		}
	  
		// Response handlers
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var siteData = JSON.parse(xmlhttp.responseText);
				//var csv = JSON2CSV(siteData);
				var csv = JSON2CSV(siteData.data);
				var uri = 'data:text/csv;charset=utf-8,' + escape(csv);

				var link = document.createElement("a");    
				link.href = uri;

				link.style = "visibility:hidden";
				link.download = frm.sites.value + ".csv";

				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			}
		}

		xmlhttp.send();
	}	
	
	function JSON2CSV(objArray) {
		var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;

		var str = '';
		var line = '';

		if ($("#labels").is(':checked')) {
			var head = array[0];
			if ($("#quote").is(':checked')) {
				for (var index in array[0]) {
					var value = index + "";
					line += '"' + value.replace(/"/g, '""') + '",';
				}
			} else {
				for (var index in array[0]) {
					line += index + ',';
				}
			}

			line = line.slice(0, -1);
			str += line + '\r\n';
		}

		for (var i = 0; i < array.length; i++) {
			var line = '';

			if ($("#quote").is(':checked')) {
				for (var index in array[i]) {
					var value = array[i][index] + "";
					line += '"' + value.replace(/"/g, '""') + '",';
				}
			} else {
				for (var index in array[i]) {
					line += array[i][index] + ',';
				}
			}

			line = line.slice(0, -1);
			str += line + '\r\n';
		}
		return str;
	}

	function downloadData(frm) {
	
		if (frm.dateinput.value == "") {
			document.getElementById("txtHint").innerHTML="";
			return;
		} 
		else
			alert("The field contains the date from: " + frm.dateinput.value + ", date to: " + frm.dateinput2.value + " and site: " + frm.sites.value);

		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else { // code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	  
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var siteData = JSON.parse(xmlhttp.responseText);
				var csv = JSON2CSV(siteData);
				var uri = 'data:text/csv;charset=utf-8,' + escape(csv);

				var link = document.createElement("a");    
				link.href = uri;

				link.style = "visibility:hidden";
				link.download = frm.sites.value + ".csv";

				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			}
		}
		xmlhttp.open("GET","http://weather.asti.dost.gov.ph/home/index.php/api/data/" + frm.sites.value + "/from/" + frm.dateinput.value + "/to/" + frm.dateinput2.value,true);
		xmlhttp.send();
	}

	function showData(frm) {
	
		if (frm.dateinput.value == "") {
			document.getElementById("txtHint").innerHTML="";
			return;
		} 
		else
			alert("The field contains the date: " + frm.dateinput.value + " and site: " + frm.sites.value);

		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else { // code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	  
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
			}
		}
        
        //var url = "getRainfall.php?rsite=" + frm.sites.value + "&fdate=" + frm.datepicker.value + "&tdate=" + frm.datepicker2.value;
		xmlhttp.open("GET","http://weather.asti.dost.gov.ph/home/index.php/api/data/" + frm.sites.value + "/from/" + frm.dateinput.value + "/to/" + frm.dateinput2.value,true);
		//xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	
	function showAndClearField(frm){
		if (frm.dateinput.value == "")
			alert("Hey! You didn't enter anything!")
		else
			alert("The field contains the text: " + frm.dateinput.value)
		frm.dateinput.value = ""
	}
	</script>
</head>
<body>

<FORM NAME="test">
	<p>
	<b>Available NOAH Weather stations per site:</b><br>
	Puguis: DOST Regional Office, La Trinidad, Benguet <br>
	Mamuyod, Labey: Bokod, Benguet <br> 
	Boloc: Aliodian, Iloilo <br>
	Humay-humay, Planas: Canlaon City, Negros Oriental <br>
	Lipanto, Bolod-bolod: San Juan, Poblacion, Southern Leyte <br>
	Oslao: San Francisco Municipal Hall Compound, San Francisco, Surigao Del Norte <br>
	Gamut: Awasian, Tandag City, Surigao Del Sur<br>
	Sinipsip: Buguias, Benguet (not yet available)<br>
	</p>
	<p>
		<b>Select NOAH Weather Station: </b><br>
		Site: <select name="sites">
		<option value="204">BLCB</option>
		<option value="204">BLCT</option>
		<option value="1236">BOLB</option>
		<option value="782">GAMT</option>
		<option value="782">GAMB</option>
		<option value="789">HUMB</option>
		<option value="789">HUMT</option>
		<option value="389">LABB</option>
		<option value="389">LABT</option>
		<option value="1236">LIPB</option>
		<option value="1236">LIPT</option>
		<option value="389">MAMB</option>
		<option value="389">MAMT</option>
		<option value="152">OSLB</option>
		<option value="152">OSLT</option>
		<option value="789">PLAB</option>
		<option value="789">PLAT</option>
		<option value="65">PUGB</option>
		<option value="65">PUGT</option>
		<option value="454">SINB</option>
		<option value="454">SINT</option>
		<option value="454">SINU</option>
		</select>
		<Br/>
		From: <input type="text" id="datepicker" name="dateinput" size="30"/><Br/>
		To: <input type="text" id="datepicker2" name="dateinput2" size="30"/><Br/>
		<input type="button" value="go" onclick="showDataCors(this.form)">
		<input type="button" value="Download CSV" onclick="downloadDataCors(this.form)">
	</p>
</FORM>

<div id="raindiv" style="width:100%; height:200px;">+++</div>

<div class="demo-description">
	<p>Pick a date for viewing rainfall data</p>
</div>

<div id="txtHint"><b>...</b></div>

</body>
</html>