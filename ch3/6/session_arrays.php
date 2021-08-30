<?php
session_start();
$myArray = array("John Smith", 18, "8222555");
$_SESSION['contactinfo'] = $myArray;
echo $_SESSION['contactinfo'][0];
?>