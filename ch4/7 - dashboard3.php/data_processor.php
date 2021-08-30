<?php
function getData($id, $sourceType){
    if($sourceType =='mysql'){
        try {
            $host = 'localhost:3306';
            $dbname = 'aa';
            $user = 'root';
            $pass = '';
            $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $sql = getDataSourceOptions($id);
            $sth = $DBH->prepare($sql);
            $sth->execute();
            $res = $sth->fetchAll();
            foreach ($res as $row){
                echo " lab.push('".$row[0]."');";
                echo " data1.push('".$row[1]."');";
            }
           
        } catch(PDOException $e) {echo $e;}  

    }
    else if($sourceType =='csv'){
        $dataSourceOptions = getDataSourceOptions($id);
        $op = explode(',',$dataSourceOptions);
        if (($file = fopen('../samplefiles/'.$op[0], "r")) !== FALSE) {
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                $col1 = $op[1];
                $col2 = $op[2];
                echo " lab.push('".$data[$col1]."');";
                echo " data1.push('".$data[$col2]."');";
          }
          fclose($file);
        }
    }    
   
   
}
function getDataSourceOptions($id){
    try {
        $host = 'localhost:3306';
            $dbname = 'aa';
            $user = 'root';
            $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "SELECT options FROM dashboard_camp_elements WHERE id = ?";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $id, PDO::PARAM_INT);
        $sth->execute();
        $res = $sth->fetch();
        return $res[0];
    } catch(PDOException $e) {echo $e;}  
}