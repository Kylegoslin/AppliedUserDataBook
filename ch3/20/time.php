<script>
window.addEventListener('beforeunload', function (e) {  
    timingDataStore();
    return undefined
});

// Customer logging function
function timingDataStore(){
    console.log("goodbye...")
}
</script>