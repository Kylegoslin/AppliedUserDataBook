<?php
$type = $_POST['type'];
if($type == 'register'){
    registerNewUser();
}
function registerNewUser(){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "INSERT INTO `dashboard_accounts` (`username`, `password`, `email`) 
                                                  VALUES (?,?,?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $username, PDO::PARAM_STR);
        $sth->bindParam(2, $hashed_password, PDO::PARAM_STR);
        $sth->bindParam(3, $email, PDO::PARAM_STR);
        $sth->execute();
        echo 'registered';
    } catch(PDOException $e) {echo 'failed' . $e;}  
}
?>