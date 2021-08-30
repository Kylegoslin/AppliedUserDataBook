<?php
$startDate = $_GET['date'];
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = ''; 
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch(PDOException $e) {echo $e;}  
function calculateDiffFromDate($baseDate){
    global $DBH;       
    $output = '';
    // Get data for starting record
    $resBase = getDateRecords($baseDate);
    $r = explode(':', $resBase);
    $output .= '
    <tr>
        <th scope="row"> '.$baseDate.'[Start]</th>
        <td>'.$r[0].'</td>
        <td>'.$r[1].'</td>
        <td>0</td>
    </tr>';
    $timestamp = strtotime($baseDate);  
    for($d = 1; $d < 8; $d++){ 
        $nextDate =  date('Y-m-d', strtotime('+'.$d.' day', $timestamp));
        $res2 = getDateRecords($nextDate);
        if($res2 != 0){
            $r1 = explode(':', $resBase);
            $r2 = explode(':', $res2);
            $count1 = $r1[0];
            $sum1 = $r1[1];
            $viewingDate1 = $r1[2];
            $count2 = $r2[0];
            $sum2 = $r2[1];
            $viewingDate2 = $r2[2];
            $v1 = $count1 / $sum1;
            $v2 = $count2 / $sum2;
            $top = $v1 - $v2; 
            $bottom = ($v1 + $v2) / 2; 
            $re = ($top / $bottom) * 100;
            $diff = round($re,2);
        } else {
            $count2 = 0;
            $sum2 = 0;
            $diff = 0;
        }
        $output .= '
        <tr>
            <th scope="row">'.$nextDate.'</th>
            <td>'.$count2.'</td>
            <td>'.$sum2.'</td>
            <td>'.$diff.'%</td>
        </tr>';
    }
    echo $output;
}
function getDateRecords($date){ 
    global $DBH;
    $sql = "SELECT count(score1) as COUNT, sum(score1) AS SUM, datestamp FROM diffcalc WHERE datestamp = ?;";
    $params = array($date);
    $sth = $DBH->prepare($sql);
    $sth->execute($params);
    $res = $sth->fetch();
    $count= $res[0];
    $sum =  $res[1];
    $date = $res[2];
    if($count == '0'){
        return 0;  
    } else {
        return $count . ':' . $sum . ':' . $date;
    }
}
calculateDiffFromDate($startDate);

?>
