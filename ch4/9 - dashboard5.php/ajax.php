<?php
$type = $_POST['type'];
if($type == 'getcamp'){
    getCamp();
}
else if($type == 'getformfields'){
    getFormFields();
}
if($type == 'addnewcamp'){
    addNewCamp();
}
if($type =='addElementToCamp'){
    addElementToCamp();
}
function addElementToCamp(){   
    $cid = $_POST['cid'];
    $customName = $_POST['customName'];
    $dataType = $_POST['dataType'];
    $dataSourceType = $_POST['dataSourceType'];
    $options = $_POST['options'];
    $chart = $_POST['chart'];

    try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';

        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        
        $sql = "INSERT INTO `dashboard_camp_elements` (`campID`, `desc`, 
                                                       `datatype`, `datasource`, 
                                                       `options`, `chart`) 
                                                       VALUES (?,?,?,?,?,?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $cid, PDO::PARAM_STR);
        $sth->bindParam(2, $customName, PDO::PARAM_STR);
        $sth->bindParam(3, $dataType, PDO::PARAM_STR);
        $sth->bindParam(4, $dataSourceType, PDO::PARAM_STR);
        $sth->bindParam(5, $options, PDO::PARAM_STR);
        $sth->bindParam(6, $chart, PDO::PARAM_STR);
        $sth->execute();
        echo 'New Element Added';
    } catch(PDOException $e) {echo 'failed' . $e;}  
}

function addNewCamp(){ 
    $newcid = $_POST['newcid'];
    $newdesc = $_POST['newdesc'];
    try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "INSERT INTO `dashboard_camps` (`campname`, `campid`) VALUES (?,?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $newdesc, PDO::PARAM_STR);
        $sth->bindParam(2, $newcid, PDO::PARAM_INT);
        $sth->execute();
        echo 'Added';
    } catch(PDOException $e) {echo 'failed' . $e;}  
}
function getCamp(){
    try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "select campid, campname from dashboard_camps;";
        $sth = $DBH->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();

        foreach($res as $row){
            $id = $row['campid'];
            echo '<a class="list-group-item list-group-item-action" cid="'.$id.'" 
            id="list-camp-'.$id.'" data-toggle="list" href="#list-camp-'.$id.'" 
            role="tab" aria-controls="camp-'.$id.'">CID:' . $row['campid'] . '-
            '.$row['campname'].'</a>';
        }
       
    } catch(PDOException $e) {echo $e;}  
}



// return a list of form fields
// for a given cid
function getFormFields(){
    $cid = $_POST['cid'];
    try {
        $host = 'localhost:3306';
        $dbname = 'aa';
        $user = 'root';
        $pass = '';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "select * from dashboard_camp_elements where campID=?;";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $cid, PDO::PARAM_STR);
        $sth->execute();
        $res = $sth->fetchAll();
        
        foreach($res as $row){
            $elementID = $row['id'];
            $desc = $row['desc'];
            $dataType = $row['datatype'];
            $src = $row['datasource'];
            $chart = $row['chart'];
            // print out each individual attribute as a new button 
            // inside of the tab panel.
            echo'<a chart="'.$chart.'" datasource="'.$src.'" elementid="'.$elementID.'" 
            elementtitle="'.$desc.'" cid="'.$cid.'" 
            class="list-group-item list-group-item-action" 
            id="list-camp-e" data-toggle="list" href="#" role="tab" 
            aria-controls="camp">'.$desc.' - ('.$dataType.') - '.$src.'</a>';
        }    
    } catch(PDOException $e) {echo $e;} 
}
?>