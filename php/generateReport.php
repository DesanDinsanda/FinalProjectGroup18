<?php
require_once('../tcpdf/tcpdf.php'); 
include 'conf.php';
include 'classReport.php';

if (isset($_POST['generate'])) {
    $reportType = $_POST['reportType']; 

    $report = new Report($conn);
    $report->viewReport($reportType);
    
}
?>
