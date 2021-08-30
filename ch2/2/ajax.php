<?php
$type = $_POST['type'];
if($type == 'yesno'){
    yesNoLog();
}
else if($type == 'whyanswer'){
    whyAnswer();
}
function yesNoLog(){
    $articleid = $_POST['articleid']; 
    $result = $_POST['result'];
    try {
        $host = 'localhost';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "INSERT INTO `yesnolog` (`articleid`, `result`) VALUES (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();
    } catch(PDOException $e) {echo $e;}  
}   
function whyAnswer(){
    $articleid = $_POST['articleid']; 
    $result = $_POST['result'];
    try {
        $host = 'localhost';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "INSERT INTO `whyanswerlog` (`articleid`, `result`) VALUES (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();
    } catch(PDOException $e) {echo $e;}  
} 
?>
