<?php
$type = $_GET['type'];
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = '';
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
 } catch(PDOException $e) {echo $e;}  
if($type=='positive'){
    getPositiveRecords();
}
else if($type=='negative'){
    getNegativeRecords();
}
function getPositiveRecords(){
    global $DBH;
    $sql = "SELECT  DATE(TIMESTAMP) AS date,COUNT(score) AS score FROM calendar WHERE score > 5 GROUP BY date(TIMESTAMP)";
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll();
    $output = '';
    foreach ($res as $row){
        $output .= $row[0] . '-' . $row[1] . ',';  
    } 
    echo substr($output, 0, -1);      
}
function getNegativeRecords(){
    global $DBH;
    $sql = "SELECT  DATE(TIMESTAMP) AS date,COUNT(score) AS score FROM calendar WHERE score <= 5 GROUP BY date(TIMESTAMP)";
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll();
    $output = '';
    foreach ($res as $row){
        $output .= $row[0] . '-' . $row[1] . ',';
    } 
    echo substr($output, 0, -1);
}




