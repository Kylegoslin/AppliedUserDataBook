<?php
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = ''; 
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
 } catch(PDOException $e) {echo $e;}
function getMode(){
    global $DBH;
    $sql = 'SELECT score1, count(score1) AS scoreCount FROM statistics GROUP BY score1 ORDER BY scoreCount DESC LIMIT 1';
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetch();
    $mode = $res[0];
    $count = $res[1];
    return $mode . ' with count ' . $count;
}
echo 'The mode is: ' . getMode();