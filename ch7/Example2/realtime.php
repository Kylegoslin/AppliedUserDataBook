<!DOCTYPE html>
<html>
<head>
    <title>Negative Feedback Real-time view</title>
    <script type="text/javascript" src="smoothie.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body>
    <h1>Negative Feedback Real-time view</h1>
    <canvas id="mycanvas" width="500" height="400"></canvas>
</body>
</html>
<script type="text/javascript">
// get the current date and time
var now = new Date();
var date = now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate();
var time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
var currentTime = date+' '+time;
var line1 = new TimeSeries();
var currentIdProcessed = '';
// start the updating loop
setInterval(function() {  
    $.get( "recordFetch.php", { time: currentTime, currentRecord: currentIdProcessed} )
        .done(function( data ) {
          if(!(data.length == 1)){
              var result = data.split('-');
              line1.append(new Date().getTime(), result[1]);
              console.log("adding new record" + result[0] + " " + result[1]);
              currentIdProcessed = result[0];
          }
    });
}, 2000);
var smoothie = new SmoothieChart({ grid: { strokeStyle: 'rgb(125, 0, 0)', fillStyle: 'rgb(60, 0, 0)', lineWidth: 1, millisPerLine: 250, verticalSections: 6 }, labels:{fontSize:16}  });
smoothie.addTimeSeries(line1, { strokeStyle: 'rgb(255, 0, 0)', fillStyle: '', lineWidth: 3 });
smoothie.streamTo(document.getElementById("mycanvas"), 2000);
</script>