<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"> </script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
*{
    font-family: arial;
}
.colorRow {
 height:13px;
 width:50px;
 margin-left: 35px;
 background-color:red;
}
</style>
</head>
<script>
var step = 0;
</script>
<span style="font-size:16pt">Feedback Heat Map </span>
<p>Date: <input type="text" id="datepicker">
<button id="viewChart">View Chart</button></p> 
<script>
 $( function() {
    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
  } );
</script>
<div id="chart">
</div>
</html>
<script>
$("#viewChart").click(function() {    
    var date = $('#datepicker').val();
    $.get( "getData.php", { selectedDate: date } )
    .done(function( data ) {
    $("#chart").html(data);
    // ------- add color style
    var start = 0;
    var end = 0;
    var op = 0.1;
    $(".colorRow").filter(function() {
        console.log("processing new record.......");
        start = 0;
        end = step;   
        op = 0.1;
        var score = $(this).attr("score");
        for(var i=0; i < 10; i++){ 
            console.log("checking if "+score+" is between" + start + " and " + (end) + " op is..." + op);
            if(score >= start && score <= end  ){
                console.log("found");
                $(this).css('background-color', 'red') ;
                $(this).css( "opacity", op );
                break;    
            }
            start = end;
            end = end + step;   
            op = op + 0.1;
        }
    })
  }); // end .done()
}); // end .click()
$( function() {
    $( document ).tooltip({
    track: true
    });
} );
</script>