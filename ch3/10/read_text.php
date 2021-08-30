<?php
if (($file = fopen("textfile.txt", "r")) !== FALSE) {
    while (!feof($file)) {
        $line = fgets($file);
        echo $line . '<br>';
    }
fclose($file);
}