<?php
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = '';
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch(PDOException $e) {echo $e;}  

function getNumberOfPositive($date){
    global $DBH;
    $date = explode(' ', $date);
    $justYear = $date[0];
    $sql = "SELECT COUNT(score) as score FROM pastime WHERE TIMESTAMP LIKE '$justYear%' AND score > 5 LIMIT 7;";
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll();
    return $res[0][0];     
}
function getNumberOfNegative($date){
    global $DBH;
    $date = explode(' ', $date);
    $justYear = $date[0];
    $sql = "SELECT COUNT(score) as score FROM pastime WHERE TIMESTAMP LIKE '$justYear%' AND score <= 5 LIMIT 7;";
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll();
    return $res[0][0];    
}      
        
// Get a list of unique dates from the 
// database
$sql = 'SELECT DISTINCT timestamp FROM pastime';
$sth = $DBH->prepare($sql);
$sth->execute();
$res = $sth->fetchAll();   
$labels = '';
$positive = '';
$negative = '';
foreach ($res as $row){
    $labels = $labels . "'" .$row[0]. "',";
    $positive = $positive . getNumberOfPositive($row[0]) . ',';
    $negative = $negative . getNumberOfNegative($row[0]) . ',';
} 
$labels = substr($labels, 0, -1); // remove the final colon from the end of the string
$positive = substr($positive, 0, -1);
$negative = substr($negative, 0, -1);
 
?>
<!doctype html>
<html>
<head>
<title>Positive and Negative Feedback</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<style>
canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
</style>
</head>
<body>
    <div style="width:75%;">
        <canvas id="canvas"></canvas>
    </div>
<br>
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

var color = Chart.helpers.color;
var config = {
    type: 'line',
    data: {
        labels: [ // Date Objects
            //'2019-08-06 21:04:11',
            <?php echo $labels; ?>
        ],
        datasets: [{
            label: 'Positive Feedback',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            fill: false,
            data: [
                 <?php echo $positive; ?>
            ],
        }, {
            label: 'Negative Feedback',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            fill: false,
            data: [
                <?php echo $negative; ?>
            ],
        
        }]
    },
    options: {
        title: {
            text: 'Time Feedback Analysis'
        },
        scales: {
            xAxes: [{
                type: 'time',
                
                scaleLabel: {
                    display: true,
                    labelString: 'Date'
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Feedback Count'
                }
            }]
        },
    }
};
window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = new Chart(ctx, config);
};
</script>

