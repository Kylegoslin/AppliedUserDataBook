<?php
$type = $_GET['type'];
if($type == 'getrating'){
    getRating();
}
function getRating(){
    $articleid = $_GET['articleid'];
    try {
        $host = 'localhost';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "SELECT AVG(result) FROM starratinglog WHERE articleid=?";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->execute();
        $res = $sth->fetch();
        echo round($res[0]);
    } catch(PDOException $e) {echo $e;}  
}   
?>