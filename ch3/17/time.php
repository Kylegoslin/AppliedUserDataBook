<script src="timeme.js"></script>
<script type="text/javascript">
    TimeMe.initialize({
        currentPageName: "my-home-page", // current page
        idleTimeoutInSeconds: 3 // seconds
    });	
    TimeMe.callAfterTimeElapsedInSeconds(4, function(){
        console.log("The user has been using the page for 4 seconds!");
    });	
</script>