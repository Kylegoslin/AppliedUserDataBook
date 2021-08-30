<?php
$type = $_POST['type'];
if($type == 'starrating'){
    starRatingLog();
}
function starRatingLog(){
    $articleid = $_POST['articleid']; 
    $result = $_POST['userrating'];
    try {
        $host = 'localhost';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "INSERT INTO `starratinglog` (`articleid`, `result`) VALUES (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_INT);
        $sth->execute();
    } catch(PDOException $e) {echo $e;}  
}
?>   