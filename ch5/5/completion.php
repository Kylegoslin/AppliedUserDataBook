<?php
 try {
        $host = '127.0.0.1:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $rootWords = 'staff';
        $likeString = '%' . $rootWords . '%';
        $stmt = $DBH->prepare("SELECT * FROM feedback_wild WHERE feedback LIKE ?");
        $stmt->execute([$likeString]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $record = $row['feedback'];
            $start = strpos($record, "staff");
            echo substr($record ,$start, strlen($record)) . '<br>';
        }
    } catch(PDOException $e) {echo $e;}  