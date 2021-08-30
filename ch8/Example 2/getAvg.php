<?php
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = '';
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
 } catch(PDOException $e) {echo $e;}  
function getAverageScore($columnName){
    global $DBH;
    $sql = "SELECT AVG($columnName) AS average FROM statistics";
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetch();
    $avg= $res[0];
    return $avg;
}
echo 'The averages for score1 is ' . getAverageScore('score1');