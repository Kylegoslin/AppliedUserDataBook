<script src="timeme.js"></script>
<script type="text/javascript">
    TimeMe.initialize({
        currentPageName: "my-home-page", // current page
        idleTimeoutInSeconds: 5, // stop recording time due to inactivity
    });
    window.onload = function(){
        TimeMe.trackTimeOnElement('area-of-interest-1');
        setInterval(function(){
        var timeSpentOnElement = TimeMe.getTimeOnElementInSeconds('area-of-interest-1');
        document.getElementById('area-of-interest-time-1').textContent = timeSpentOnElement.toFixed(5);
    }, 100);
}
</script>
<div class="area-of-interest" id="area-of-interest-1">
    Interact with this element<br/><br/>
    Interaction: <span id="area-of-interest-time-1"></span> seconds.
</div>