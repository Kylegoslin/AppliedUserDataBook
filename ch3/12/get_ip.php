<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(function() {
    $.getJSON("https://api.ipify.org?format=json",
        function(json) {
            var ip = json.ip;
            console.log(ip);
    }
    );
});
</script>