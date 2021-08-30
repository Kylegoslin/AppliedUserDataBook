<!doctype html>
<html>
<head>
<title>Time Segment Analysis</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
</head>
<body>
Date: <input type="text" id="datepicker">
Time From: <input type="text" id="timepicker">
Time Window 
<select id="minutes">
    <option value="15">15 Minutes</option>
    <option value="30">30 Minutes</option>
    <option value="45">45 Minutes</option>
    <option value="1h">1 Hour</option>
    <option value="2h">2 Hour</option>
    <option value="3h">3 Hour</option>
    <option value="4h">4 Hour</option>
    <option value="5h">5 Hour</option>
    <option value="6h">6 Hour</option>
    <option value="7h">7 Hour</option>
    <option value="8h">8 Hour</option>
    <option value="9h">9 Hour</option>
    <option value="10h">10 Hour</option>
    <option value="11h">11 Hour</option>
    <option value="12h">12 Hour</option>
    <option value="13h">13 Hour</option>
    <option value="14h">14 Hour</option>
    <option value="15h">15 Hour</option>
    <option value="16h">16 Hour</option>
    <option value="17h">17 Hour</option>
    <option value="18h">18 Hour</option>
    <option value="19h">19 Hour</option>
    <option value="20h">20 Hour</option>
    <option value="21h">21 Day</option>
    <option value="22h">22 Day</option>
    <option value="23h">23 Day</option>
    <option value="24h">All Day</option>
</select>
<button id="loadData"> Load Data </button>
<div style="width:75%;">
    <canvas id="canvas"></canvas>
</div>
</body>
</html>
<script>
    
window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};
$( function() {
    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
    $('#timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 15,
    defaultTime: '1:00am',
    startTime: '1:00am',
    dropdown: true,
    scrollbar: true
    });
});
$( "#loadData" ).click(function() {
       generateNewChart(); 
}); 
function generateNewChart(){
    var color = Chart.helpers.color;
    var config = {
        type: 'line',
        data: {
            datasets: [{
                label: 'Negative Feedback Score',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                fill: false,
                data: []
            }, 
            {
                label: 'Positive Feedback Score',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
                fill: false,
                data: []
            }
            
            ]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Time Segment Analysis'
            },
            scales: {
                xAxes: [{
                    type: 'time',
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Timestamp'
                    },
                    ticks: {
                        major: {
                            
                            fontColor: '#000000'
                        }
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Feedback Score'
                    }
                }]
            }
        }
    };

		
var ctx = document.getElementById('canvas').getContext('2d');
window.myLine = new Chart(ctx, config);

// get values entered by the user
var date = $('#datepicker').val();
console.log($('#timepicker').val())
var time = moment($('#timepicker').val(), ["h:mm A"]).format("HH:mm");
console.log("time new" + time);

var minutes = $('#minutes').val();

if(minutes.indexOf('h') > -1){
    minutes = minutes.replace('h', '');
    minutes = minutes * 60;
}
// get negative records
$.get( "getTimeRecords.php", { type: "negative", dstart: date, tstart: time, minutes:minutes} )
  .done(function( data ) {
    var result = data.split(',');
    result.forEach((record) => {
        var single = record.split(' ');
        config.data.datasets[0].data.push({
                x: newDate(single[0]+single[1]),
                y: single[2],
            });
    });
    window.myLine.update();             
}); // end of get
                          
     
// get positive records
$.get( "getTimeRecords.php", { type: "positive", dstart: date, tstart: time, minutes:minutes} )
  .done(function( data ) {
    var result = data.split(',');
    result.forEach((record) => {
        var single = record.split(' ');
        config.data.datasets[1].data.push({
                x: newDate(single[0]+single[1]),
                y: single[2],
        });
   });
    window.myLine.update();
  }); // end of GET
}    
function newDate(stamp) {
    return moment(stamp, "YYYY-MM-DD HH:mm:ss");
}
</script>


 


