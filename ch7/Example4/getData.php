<?php
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = ''; 
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch(PDOException $e) {echo $e;}  
$totalRecords = 0;
echo '<div style="overflow: hidden; width:900px">';
for($h=0; $h<24; $h++){
    echo getBlockForhour($h);
}
echo '</div>'; 
// update the step variable before chart generation
echo '<script> step = ' . ($max / 10) .'; </script>';
function getBlockForhour($hour){
    $output = '';
    $minutes = '00';
    $output .='<div class="oneRow" style="float:left; width:100px">';
    $output .= '<span style="font-size:11pt;">' . $hour . ':00</span>';
    
    $hourStamp = '';
    if($hour < 10){
        $hourStamp = '0' . $hour ;
    } else{
        $hourStamp = $hour;
    }
    
    for($i=1; $i<13; $i++){
        $score = getScore($hourStamp, $minutes);
        $output .= '<div style="width:300px; overflow: hidden;">
                <div style="width:40px; float: left">
                <span style="font-size:10pt">  '. $hourStamp.':' . $minutes . ' </span>
                </div>
                <div class="colorRow" id="colorRow" title="'.$score.' Feeback records" score="'.$score.'">
                </div>
                </div>';     
        $minutes += 5;
        if($minutes < 10){
            $minutes = '0' . $minutes;
        }
    }
    $output .= '</div>';
    return $output;
}
function getScore($hourStamp, $minuteStamp){
    global $DBH, $max, $min;
    $endTime = $minuteStamp+4;
    $date = $_GET['selectedDate'];
    $sql = "SELECT COUNT(score) as score  FROM feedbackheat WHERE TIMESTAMP BETWEEN ? AND ?";
    $stDate = $date . " ". "$hourStamp:$minuteStamp:00";
    $finish = "$date $hourStamp:$endTime".":59";
    $params = array($stDate, $finish);
    $sth = $DBH->prepare($sql);
    $sth->execute($params);
    $res = $sth->fetch();
    global $totalRecords;
    $totalRecords = $totalRecords + $res[0];
    $result = $res[0];
    global $max, $min;
    if($result > $max){
        $max = $result;
    }
    if($result < $min){
        $min = $result;
    }
    return $result;
}
?>