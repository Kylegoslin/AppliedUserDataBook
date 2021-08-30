<?php

$numberOfRecords = 1000;
for($i=0; $i<numberOfRecords; $i++){
    
    $h = rand(1, 23);
    $m = rand(1, 59);
    $s = rand(1, 59);

    
    $score = rand(0, 10);
    
    
echo "INSERT INTO `test`.`feedbackheat` (`score`,`timestamp`) VALUES ($score, '2019-09-02 $h:$m:$s'); <br>";


}