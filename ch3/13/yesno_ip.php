<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<input type="radio" name="answer" value="Yes"> Yes  <br>
<input type="radio" name="answer" value="No">  No   <br>
<script>
$( "input:radio[name=answer]" ).click(function() {
    var val = $(this).val(); 
    saveAnswer(val);
});
var ip = '';
$(function() {
    $.getJSON("https://api.ipify.org?format=json",
    function(json) {
        ip = json.ip;
    }
    );

});
var ip = 0;
function saveAnswer(answer){
    $.post( "ajax.php", { type: "yesno", articleid: "1221", result: answer, ip:ip })
      .done(function( data ) {
        alert('Thank you!');
      });
}
</script>