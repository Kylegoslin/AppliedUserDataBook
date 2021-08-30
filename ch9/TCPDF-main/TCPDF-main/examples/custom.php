<?php
try {
    $host = '127.0.0.1:3306';
    $dbname = 'test';
    $user = 'root';
    $pass = '';
    
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch(PDOException $e) {echo $e;}  
function getMode(){
    global $DBH;
    $sql = 'SELECT score1, count(score1) AS COUNT FROM statistics GROUP BY score1 ORDER BY count DESC LIMIT 1';
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetch();
    $mode=$res[0];
    $count = $res[1];    
    return $mode . ' with count ' . $count;
}

function getAverageScore($columnName){
    global $DBH;
    $sql = "SELECT AVG($columnName) AS average FROM statistics";
    $sth = $DBH->prepare($sql);
    $params = array($columnName);
    $sth->execute($params);
    $res = $sth->fetch();
    $avg= $res[0];
    return $avg;
}
function calculateStdDev(){
    global $DBH;
    $sql = 'SELECT std(score) as sd FROM smallset;';
    $sth = $DBH->prepare($sql);
    $sth->execute();
    $res = $sth->fetch();
    $stdev=$res[0];
    return $stdev;
}
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kyle Goslin');
$pdf->SetTitle('Sample PDF');
$pdf->SetSubject('How to use TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Custom Sample Statistics', '', array(000,000,000), array(000,000,000));
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set default font subsetting mode
$pdf->setFontSubsetting(true);
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);
// Add a page
$pdf->AddPage();
// Gather the data
$mode = 'The mode is: ' . getMode();
$average = 'The averages for score1 is: ' . getAverageScore('score1');
$stdev = 'The standard deviation of the database table is: ' . calculateStdDev();


// Set some content to print
$html = <<<EOD
                Welcome to the statistics page!
                <p>
                $mode <br>
                $average <br>
                $stdev<br>
EOD;
$pdf->Image('stats/graph1.png', 10, 80, 170, 80, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Close and output PDF document
$pdf->Output(__DIR__ . '/stats/report.pdf', 'I');

