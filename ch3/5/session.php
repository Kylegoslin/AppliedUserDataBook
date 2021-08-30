<?php
session_start();
$_SESSION['samplevariable'] = 'Sample Value';
$id = session_id();
echo $id;
?>