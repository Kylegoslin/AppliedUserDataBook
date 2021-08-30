<?php
$type = $_POST['type'];
if($type == 'register'){
    registerNewUser();
}
function registerNewUser(){
    $email =         $_POST['email'];
    $fullName =      $_POST['fullName'];
    $serviceRating = $_POST['serviceRating'];
    $foodRating =    $_POST['foodRating'];
    $atmosRating =   $_POST['atmosRating'];
    $comments =      $_POST['comments'];
    try {
        $host = 'localhost';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        
        $sql = "INSERT INTO `servicerating` (`email`, `fullName`, 
                                             `serviceRating`, `foodRating`, 
                                             `atmosRating`, `comments`) 
                                              VALUES (?,?,?,?,?,?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $email, PDO::PARAM_STR);
        $sth->bindParam(2, $fullName, PDO::PARAM_STR);
        $sth->bindParam(3, $serviceRating, PDO::PARAM_INT);
        $sth->bindParam(4, $foodRating, PDO::PARAM_INT);
        $sth->bindParam(5, $atmosRating, PDO::PARAM_INT);
        $sth->bindParam(6, $comments, PDO::PARAM_STR);
        $sth->execute();
    } catch(PDOException $e) {echo $e;}  
} 
