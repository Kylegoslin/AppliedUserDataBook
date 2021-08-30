<?php



for($h=0; $h<25; $h++){
    $start = 0;
    $end = 5;
    
    for($i=1; $i<13; $i++){
       
        echo "SELECT COUNT(score) as score  FROM feedbackheat WHERE TIMESTAMP BETWEEN '2019-09-02 $h:$start:00' AND '2019-09-02 $h:$end:00' <br>";
        
        
        
        $start = $start + 5;
        $end = $end + 5;
        
        
        if($end == 60){
          $end = 59;
        }

    }
}