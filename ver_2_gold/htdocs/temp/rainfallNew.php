<!DOCTYPE html>
<html lang="en">
<head>
  <title>*NEW* Rainfall Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="http://dygraphs.com/dygraph-combined.js"></script>
  <style type="text/css">
    .rainPlot {
      margin-left: auto;
      margin-right: auto;
      min-width: 100%;
      height: auto;
    }
  </style>
</head>
<body>

<?php
// Database login information
$servername = "localhost";
$username = "updews";
$password = "october50sites";
$dbname = "senslopedb";

//Weather Stations
$weatherStationsFull;
$weatherStations;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT 
          site_column.s_id, 
          site_column.name, 
          site_rain_props.rain_noah, 
          site_rain_props.rain_senslope,
          site_rain_props.max_rain_2year
        FROM 
          site_column
        INNER JOIN 
          site_rain_props
        ON 
          site_column.s_id=site_rain_props.s_id";
$result = mysqli_query($conn, $sql);

$numSites = 0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["s_id"]. " - Name: " . $row["name"]. ", " . $row["rain_noah"]. ", " . $row["rain_senslope"] . "<br>";
        $weatherStationsFull[$numSites]["s_id"] = $row["s_id"];
        $weatherStationsFull[$numSites]["name"] = $row["name"];
        $weatherStationsFull[$numSites]["rain_noah"] = $row["rain_noah"];
        $weatherStationsFull[$numSites]["rain_senslope"] = $row["rain_senslope"];
        $weatherStationsFull[$numSites++]["max_rain_2year"] = $row["max_rain_2year"];
    }
} else {
    echo "0 results";
}

//echo json_encode($weatherStationsFull);
mysqli_close($conn);
?>

<div class="container">
  <div class="jumbotron">
    <h1>Rainfall Data Display</h1>      
    <p>Display Rain volume data on graphs</p>
  </div>

  <div class="row">
    <div class="col-sm-2">
      <form>
        <select id="mySelect" class="form-control" onchange="myFunction()">
          <option value="default">select site...</option>
          <?php
            $ctr = 0;
            foreach ($weatherStationsFull as $singleSite) {
              $curSite = $singleSite["name"];
              echo "<option value=\"$ctr\">$curSite</option>";
              $ctr++;
            }
          ?>
        </select>       
      </form>
    </div>    
  </div><Br>

  <div id="rainGraphSenslope" class="row rainPlot"></div><br>
  <div id="rainGraphNoah" class="row rainPlot"></div>
  <div id="container" class="row rainPlot"></div>
</div>

<script>
var allWS = <?php echo json_encode($weatherStationsFull); ?>;
var prevWS = null;
var prevWSnoah = null;
var rainData = [];
var rainDataNoah = [];

var isVisible = [true, true, true, true];

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

function myFunction() {
    var x = document.getElementById("mySelect").value;

    if (x != "default") {
        var rainSenslope = allWS[x]["rain_senslope"];
        var rainNOAH = allWS[x]["rain_noah"];
        alert("senslope: " + rainSenslope + ", noah: " + rainNOAH);

        if(rainSenslope) {
            if (rainSenslope != prevWS) {
                getRainfallData(rainSenslope);
                prevWS = rainSenslope;
            }            
        }
        else {
            document.getElementById("rainGraphSenslope").innerHTML = null;
        }
        
        if(rainNOAH) {
            if (rainNOAH != prevWSnoah) {
                getRainfallDataNOAH(rainNOAH);
                prevWSnoah = rainNOAH;
            }            
        }
        else {
            document.getElementById("rainGraphNoah").innerHTML = null;
        }
    };
}

function getRainfallData(str) {
    if (str.length == 0) { 
        document.getElementById("rainGraphSenslope").innerHTML = "";
        return;
    } else { 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("rainGraphSenslope").innerHTML = xmlhttp.responseText;
                var testData = xmlhttp.responseText;

                if(testData) {
                  var data = JSON2CSV(testData);
                  var isStacked = false;
                  
                  //spinner.stop();
                  
                  g = new Dygraph(
                      document.getElementById("rainGraphSenslope"), 
                      data, 
                      {
                          title: 'Rainfall Data from ' + str,
                          stackedGraph: isStacked,
                          labels: ['timestamp', 'rain'],
                          visibility: isVisible,
                          rollPeriod: 1,
                          showRoller: true,
                          //errorBars: true,

                          highlightCircleSize: 2,
                          strokeWidth: 1,
                          strokeBorderWidth: isStacked ? null : 1,
                          connectSeparatedPoints: true,
                                    
                          highlightSeriesOpts: {
                              strokeWidth: 1,
                              strokeBorderWidth: 1,
                              highlightCircleSize: 5
                          }
                      }
                  );  
                }
                else {
                    document.getElementById("rainGraphSenslope").innerHTML = "";
                    return;
                }
            }
        }
        xmlhttp.open("GET", "rainfallNewGetData.php?site=" + str, true);
        xmlhttp.send();
    }
}

function getRainfallDataNOAH(str) {
    if (str.length == 0) { 
        document.getElementById("rainGraphNoah").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("rainGraphSenslope").innerHTML = xmlhttp.responseText;
                var testData = xmlhttp.responseText;

                if(testData) {
                  var data = JSON2CSV(testData);
                  var isStacked = false;
                  
                  //spinner.stop();
                  
                  g = new Dygraph(
                      document.getElementById("rainGraphNoah"), 
                      data, 
                      {
                          title: 'Rainfall Data from NOAH WS ' + str,
                          stackedGraph: isStacked,
                          labels: ['timestamp', 'rain'],
                          visibility: isVisible,
                          rollPeriod: 1,
                          showRoller: true,
                          //errorBars: true,

                          highlightCircleSize: 2,
                          strokeWidth: 1,
                          strokeBorderWidth: isStacked ? null : 1,
                          connectSeparatedPoints: true,
                                    
                          highlightSeriesOpts: {
                              strokeWidth: 1,
                              strokeBorderWidth: 1,
                              highlightCircleSize: 5
                          }
                      }
                  );  
                }
                else {
                    document.getElementById("rainGraphNoah").innerHTML = "";
                    return;
                }
            }
        }
        xmlhttp.open("GET", "rainfallNewGetDataNoah.php?site=" + str, true);
        xmlhttp.send();
    }
}
</script>

</body>
</html>