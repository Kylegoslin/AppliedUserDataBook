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
    getRecords('positive');
}
else if($type=='negative'){
    getRecords('negative');
}
function getRecords($sort){
    global $DBH;
    $dateStart = $_GET['dstart'];
    $timeStart = $_GET['tstart'];
    $minutes = $_GET['minutes'];
    $start = $dateStart . ' ' . $timeStart;
    $dt = new DateTime($start);
    $offSet = $minutes;
    $dt->modify("+{$offSet} minutes");
    $end= $dt->format('Y-m-d H:m');
    $params = array($start, $end);
    $scoreSort = '';
    if($sort == 'positive'){
        $scoreSort = 'score >= 5';
    }
    else if($sort == 'negative'){
        $scoreSort = 'score < 5';            
    }
    $sql = "SELECT timestamp, score FROM timeanalysis  where TIMESTAMP >= ? AND TIMESTAMP <= ? AND $scoreSort ORDER BY timestamp";
    $sth = $DBH->prepare($sql);
    $sth->execute($params);
    $res = $sth->fetchAll();
    $output = '';
    foreach ($res as $row){
        $output .= $row[0] . ' ' . $row[1] . ',';
    } 
    echo substr($output, 0, -1);    
}

