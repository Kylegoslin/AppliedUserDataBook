<?php
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = '';
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
 } catch(PDOException $e) {echo $e;}
function calculateStdDev(){
    global $DBH;
    $sql = 'SELECT std(score) as sd FROM smallset;';
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetch();
    $stdev=$res[0];
    return $stdev;
} 
echo 'The standard deviation is ' . calculateStdDev();