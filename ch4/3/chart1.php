<!doctype html>
<html>
<head>
    <title>Bar Chart</title>
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
<div id="container" style="width: 50%;">
    <canvas id="canvas"></canvas>
</div>
<script>
var color = Chart.helpers.color;
var barChartData = {
    labels: ["Score 1", "Score 2", "Score 3", "Score 4", "Score 5", 
    "Score 6", "Score 7", "Score 8", "Score 9", "Score 10"],
    datasets: [{
        label: 'Customer Satisfaction',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [
          <?php getSatisfactionScores(1); ?>
        ]
    }]
};
window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Customer Satisfaction'
            }
        }
    });

};
</script>
</body>
</html>

<?php
function getSatisfactionScores($formID){
   try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "SELECT score, count(score) FROM feedbackformrecords  
                                           WHERE FeedbackFormId = ? GROUP BY score";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $formID, PDO::PARAM_INT);
        $sth->execute();
        $res = $sth->fetchAll();
        
        foreach ($res as $row){
            echo $row[1] . ', ';
        }
    } catch(PDOException $e) {echo $e;}  
}
?>
