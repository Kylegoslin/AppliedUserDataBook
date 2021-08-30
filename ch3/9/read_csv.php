<?php
if (($file = fopen("data.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        echo $data[0] . " --- " . $data[1] . " --- " . $data[2] . '<br>'; 
    }
fclose($file);
}