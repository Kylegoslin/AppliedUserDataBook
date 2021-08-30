<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load("current", {packages:["calendar"]});
google.charts.setOnLoadCallback(drawPositiveChart);
google.charts.setOnLoadCallback(drawNegativeChart);
function drawPositiveChart() {
    var dataTable = new google.visualization.DataTable();
    dataTable.addColumn({ type: 'date', id: 'Date' });
    dataTable.addColumn({ type: 'number', id: 'Feedback Count' });
    dataTable.addRows([
      // Sample records that can be added to the chart.
      //[ new Date(2019, 3, 13), 2 ],
    ]);
    var chart = new google.visualization.Calendar(document.getElementById('calendar_positive'));
    var options = {
        title: "Positive Feedback Analysis",
        height: 350,
    };
    $.get( "calendarGetRecords.php", { type: "positive"} )
        .done(function( data ) {
            console.log(data); 
            var singleDates = data.split(',');
            for(var i=0; i< singleDates.length; i++){
                var oneDate = singleDates[i].split('-');
                console.log(oneDate[0], oneDate[1], oneDate[2], oneDate[3]);
                dataTable.addRow( [ new Date(oneDate[0], oneDate[1], oneDate[2]), Number(oneDate[3]) ]  );
            }
        chart.draw(dataTable, options);
   });
}
function drawNegativeChart() {
    var dataTable = new google.visualization.DataTable();
    dataTable.addColumn({ type: 'date', id: 'Date' });
    dataTable.addColumn({ type: 'number', id: 'Feedback Count' });
    dataTable.addRows([
      // first sample records that can be hardcoded.
      //[ new Date(2019, 3, 13), 2 ],
    ]);

    var chart = new google.visualization.Calendar(document.getElementById('calendar_negative'));
    var options = {
        title: "Negative Feedback Analysis",
        height: 350,
    };
    $.get( "calendarGetRecords.php", { type: "negative"} )
        .done(function( data ) {
            console.log(data); 
            var singleDates = data.split(',');
            for(var i=0; i< singleDates.length; i++){
                var oneDate = singleDates[i].split('-');
                console.log(oneDate[0], oneDate[1], oneDate[2], oneDate[3]);
                dataTable.addRow( [ new Date(oneDate[0], oneDate[1], oneDate[2]), Number(oneDate[3]) ]  );
            }
    chart.draw(dataTable, options);
});
}
</script>
</head>
<body>
    <div id="calendar_positive" style="width: 700px; height: 200px;"></div>
    <hr>
    <div id="calendar_negative" style="width: 700px; height: 200px;"></div>
</body>
  
</html>