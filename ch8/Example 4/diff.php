<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
thead tr {
    background-color: #000000;
    color: #FFFFFF;
}
</style>
</head>
<body>
<div class="container sm">
<p>View Week starting from: <input type="text" id="datepicker">
<button id="viewData">View Data</button></p> 
<table class="table table-striped">
    <thead style="">
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Number of records</th>
            <th scope="col">Sum of scores</th>
            <th scope="col">% difference</th>
        </tr>
    </thead>
    <tbody id="content">
    </tbody>
</table>
</div>
</body>
<script>
$( "#viewData" ).click(function() {
    var dateSelected = $( "#datepicker" ).val();
    $.get( "getDiff.php", { date: dateSelected} )
        .done(function( data ) {
             $( "#content" ).html('');
             $( "#content" ).append(data);
        });
})
$( function() {
    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
} );
</script>