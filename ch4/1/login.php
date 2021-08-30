<?php
$type = $_POST['type'];
if($type == 'login'){
    login();
}
function login(){
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
        $host = 'localhost';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "SELECT * FROM dashboard_accounts WHERE username = ? LIMIT 1";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $username, PDO::PARAM_STR);
        $sth->execute();
        $res = $sth->fetch();
        $result = password_verify ($password,$res[2]);
        if($result){
            echo 'success';
            session_start();
            $_SESSION['id'] = $res[0];
            $_SESSION['username'] = $res[1];
            $_SESSION['valid'] = True;
        } else {
            echo 'Password is not valid';
        }
    } catch(PDOException $e) {echo $e;}  
}
?>