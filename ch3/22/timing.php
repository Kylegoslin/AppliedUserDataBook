<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="timeme.js"></script>
<script type="text/javascript">
// Initialize library and start tracking time
TimeMe.initialize({
currentPageName: "my-home-page", // current page
idleTimeoutInSeconds: 3 // seconds
});
window.addEventListener('beforeunload', function (e) {  
    timingDataStore();
    return undefined;
});
// Custome logging function
function timingDataStore(){
    var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
    
    console.log('Time on Page:' + timeSpentOnPage);

    // Send data to the server here
    $.post( "ajax.php", { type: "timelog", pageTitle: TimeMe.currentPageName,
                            att1name: 'totaltime', att1: timeSpentOnPage,
                            att2name: 'interest', att2: '0' })
    .done(function( data ) {
    alert("Bye!");
    });
}
</script>