<?php
include('data_processor.php');
$id = $_GET['id'];
$title = $_GET['title'];
$sourceType = $_GET['source'];
?>
<!doctype html>
<html>
<head>
<script src="Chart.bundle.js"></script>
<script src="utils.js"></script>
<style>
canvas {
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
var color = Chart.helpers.color;
var lab =  new Array();
var data1 = new Array();
<?php
// Get the data for the graph
getData($id, $sourceType);
?>
var barChartData = {
    labels: lab,
    datasets: [{
        label: '',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: data1
    }]

};
var ctx = document.getElementById("canvas"+uniqueID).getContext("2d");
window.myBar = new Chart(ctx, {
    type: 'bar',
    data: barChartData,
       options: {
        responsive: true,
      scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
    },
    legend: {
        display:false,
    },
    title: {
        display: true,
        text: unescape('<?php echo $title;?>')
    }
}
});
$("#container"+uniqueID).resizable();
$("#container"+uniqueID).draggable();
</script>
</body>
</html>