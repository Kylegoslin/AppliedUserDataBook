<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous">
</script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js">
</script>
<link rel="stylesheet" href="jquery.rateyo.css"/>
<div id="rateYo"></div>
<script>
$.get( "ajax.php", { type: "getrating", articleid: 1221})
    .done(function( data ) {
    $("#rateYo").rateYo({
        rating:data,
        onSet: function (rating, rateYoInstance) {
    }
    });
});
</script>