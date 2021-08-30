<?php
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = '';
    $rawtext = 'did not like';
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $params = array("%$rawtext%");
    $sql = " SELECT * from feedback_tree WHERE comments LIKE ?";
    $sth = $DBH->prepare($sql);
    $sth->execute($params);
    $res = $sth->fetchAll();
    $header = '      
        {
       "name": "did not like",
       "children": ['; 
   $footer = '   
         ]
      }';
    $body = '';
    foreach ($res as $row){
        $record = $row[2];
        $start = strpos($record, $rawtext);

        $body .= '
        {
        "name":"'. substr($record, $start+strlen($rawtext)).'"
        },'; 
    }
    echo $header;
    echo substr_replace($body ,"", -1); // strip the last comma.
    echo $footer;
} catch(PDOException $e) {echo $e;} 