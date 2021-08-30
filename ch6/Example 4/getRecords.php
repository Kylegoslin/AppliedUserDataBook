<?php
$date = $_GET['date'];
$terms = $_GET['terms'];
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = '';
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $words = explode(',',$terms);
    $whereClause = '';
    foreach( $words as $word) {
        $whereClause .= ' feedback LIKE "%' . $word . '%" OR';
    }
    $whereClause = substr($whereClause, 0, -2);
    $params = array($date);
    $sql = "SELECT * FROM nodetree WHERE timestamp > ? AND " . $whereClause;
    $sth = $DBH->prepare($sql);
    $sth->execute($params);
    $res = $sth->fetchAll();
    foreach ($res as $row){
        $record = $row[2];
        echo $record . '<br>';
    } 
} catch(PDOException $e) {echo $e;}  