<?php
$type = $_POST['type'];
if($type == 'timelog'){
    timeRecordLog();
}
function timeRecordLog(){
    $pageID = $_POST['pageTitle'];
    $att1name = $_POST['att1name'];
    $att1time = $_POST['att1'];
    $att2name = $_POST['att2name'];
    $att2time = $_POST['att2'];

try {

    $host = 'localhost:3306';
    $dbname = 'bookexamples';
    $user = 'root';
    $pass = '';
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $sql = "INSERT INTO `timinglog` (`pageID`, `att1`, `timing1`, `att2`, `timing2`) 
            VALUES (?,?,?,?,?);";
    $sth = $DBH->prepare($sql);
    $sth->bindParam(1, $pageID, PDO::PARAM_STR);
    $sth->bindParam(2, $att1name, PDO::PARAM_STR);
    $sth->bindParam(3, $att1time, PDO::PARAM_STR);
    $sth->bindParam(4, $att2name, PDO::PARAM_STR);
    $sth->bindParam(5, $att2time, PDO::PARAM_STR);
    $sth->execute();

} catch(PDOException $e) {echo $e;}
}