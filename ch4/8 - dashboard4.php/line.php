<?php
include('data_processor.php');
$id = $_GET['id'];
$title = $_GET['title'];
$sourceType = $_GET['source'];
?>
<!doctype html>
<html>
<head>
    <title>Line Chart</title>
    <script src="Chart.bundle.js"></script>
    <script src="utils.js"></script>
    <style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>
<body>
<div id="container" style="width:50%"; class="ui-widget-content">
<canvas id="canvas"></canvas>
</div>
<script>
var uniqueID = Math.floor((Math.random() * 1000) + 1);
document.getElementById("container").setAttribute("id", "container"+uniqueID);
document.getElementById("canvas").setAttribute("id", "canvas"+uniqueID);
var lab =  new Array();
var data1 = new Array();
<?php
// Get the data for the graph
getData($id,$sourceType);
?>
var config = {
    type: 'line',
    data: {
        labels: lab,
        datasets: [{
            label: "",
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: data1,
            fill: false,
        }]
    },
    
        
    options: {
        responsive: true,
        title:{
            display:true,
            text: unescape('<?php echo $title;?>')
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
};
var ctx = document.getElementById("canvas"+uniqueID).getContext("2d");
window.myLine = new Chart(ctx, config);
$("#container"+uniqueID).resizable();
$("#container"+uniqueID).draggable();
</script>
</body>
</html>
