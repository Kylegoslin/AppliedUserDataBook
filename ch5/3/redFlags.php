<?php
$start = $_GET['start'];
$end =   $_GET['end'];
$cid =   $_GET['cid'];
echo '<div id="redflags">';
echo '<b>Start:</b> ' . $start . ' - <b>End date:</b> ' . $end.' - <b>CID:</b> '.$cid.'<br>';
echo '<hr>';
getData();
echo' </div>';

function getData(){
   global $start,$end, $cid;
   try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "SELECT * FROM redflag_comments WHERE mytime BETWEEN ? AND ? AND cid = ?";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $start, PDO::PARAM_STR);
        $sth->bindParam(2, $end, PDO::PARAM_STR);       
        $sth->bindParam(3, $cid, PDO::PARAM_INT);       
        $sth->execute();
        $res = $sth->fetchAll();
        // Get the list of red flags from the database
        $redFlags = getRedFlags($cid);
        foreach ($res as $row){
            $comment = $row[2];
            $inputArray = explode(' ', strtolower($comment));
            $output = '';
            foreach ($inputArray as $inputWord) {
               $isFlag = in_array($inputWord, $redFlags);
               if($isFlag){
                   $output .= '<span style="color:red"> ' . $inputWord . '</span> ';
               } else {
                   $output .= ' ' . $inputWord;
               }
            }      
            echo $output . '<br>';
        }
    } catch(PDOException $e) {echo $e;}  
} 
function getRedFlags($cid){
    $flags = array();
    try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "SELECT term FROM redflagterms WHERE cid = ?";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $cid, PDO::PARAM_STR);
        $sth->execute();
        $res = $sth->fetchAll();
        foreach ($res as $row){
            array_push($flags, $row[0]);   
        }
    } catch(PDOException $e) {echo $e;}  

    return $flags;
}
