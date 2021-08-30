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
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var color = Chart.helpers.color;
        var lab =  new Array();
        var data1 = [];
        var data2= [];
        <?php getData('married'); ?>
        var barChartData = {
             labels: lab,
        datasets: [{
            label: 'No',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: data1,
        }, {
        label: 'Yes',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: data2,
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
                        text: 'Chart.js Bar Chart'
                    }
                }
       }); };
</script>
</body>
</html>

<?php
function getData($column){
   try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "SELECT $column, count($column) FROM survey WHERE FeedbackFormId = 1
                                                           GROUP BY $column";
        $sth = $DBH->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();
        // add the label
        echo 'lab.push("'.$column.'");';
        foreach ($res as $row){
            // its is 0 add to first column
            if($row[0] == 0){
                echo " data1.push('".$row[1]."');";
            } //if it is 1 add to the second column
            else if($row[0] == 1){
             echo "data2.push('".$row[1]."');";
            }
        } 
    } catch(PDOException $e) {echo $e;} 
}
?>