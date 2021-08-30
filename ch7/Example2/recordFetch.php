<?php
$id = $_GET['currentRecord'];
$date = '2019-8-18 20:36:18'; // only used for static example
try {
        $host = '127.0.0.1:3306';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch(PDOException $e) {echo $e;}  
$params = array($id, $date);
$sql = "SELECT * FROM realtime  WHERE id > ? ORDER BY DATETIME >= ?, id asc LIMIT 1";
$sth = $DBH->prepare($sql);
$sth->execute($params);
$res = $sth->fetch();
echo $res[0] . '-' . $res[2];
           
        
