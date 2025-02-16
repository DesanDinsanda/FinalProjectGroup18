<?php
require_once('../tcpdf/tcpdf.php'); // Include TCPDF library

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 16);
$pdf->Cell(0, 10, 'Hello, TCPDF is working!', 0, 1, 'C');

// Output the PDF file
$pdf->Output('test.pdf', 'I'); // 'I' = View in browser, 'D' = Download
?>
