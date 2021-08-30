<?php
$type = $_POST['type'];
if($type == 'yesno'){ 
    yesNoLog();
}
function yesNoLog(){
    $articleid = $_POST['articleid'];
    $result = $_POST['result'];
    $ip = $_POST['ip'];
    try {
        $host = 'localhost';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);     
        $sql = "INSERT INTO `yesnolog` (`articleid`, `result`, `ipadd`) VALUES (?, ?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->bindParam(3, $ip, PDO::PARAM_STR);
        $sth->execute();
    } catch(PDOException $e) {echo $e;}
}
?>