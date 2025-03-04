<?php
include 'conf.php';
require_once('../tcpdf/tcpdf.php'); 
class Report {
    private $reportType;
    

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getReportType() { return $this->reportType; }
    public function setReportType($reportType) { $this->reportType = $reportType; }


    public function viewReport($reportType) {
        $this->reportType = $reportType;

         // Fetch data based on selected report type
    $query = "";
    switch ($this->reportType) {
        case "customer": //Identifies high-value customers.
            $query = "SELECT 
    u.ID AS customerID,
    CONCAT(u.firstName, ' ', u.lastName) AS customerName,
    u.email AS customerEmail,
    COUNT(o.orderID) AS totalOrders,
    SUM(p.price) AS totalSpending
            FROM orders o
            INNER JOIN user u ON o.customerID = u.ID
            LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
            GROUP BY u.ID, customerName
            ORDER BY totalSpending DESC;
            ";

            break;

        case "supplier": //Identifies the most active suppliers
            $query = "SELECT 
    s.supplierID, 
    CONCAT(s.firstName, ' ', s.lastName) AS supplierName, 
    s.city, 
    COUNT(its.itemID) AS totalItemsSupplied,
    (SELECT COUNT(*) FROM favorite_suppliers WHERE supplierID = s.supplierID) AS favoriteCount
            FROM supplier s
            LEFT JOIN item_supplier its ON s.supplierID = its.supplierID
            GROUP BY s.supplierID, supplierName, s.city
            ORDER BY totalItemsSupplied DESC;
            ";

            break;

        case "item": //Helps determine which items are frequently included in event packages.
            $query = "SELECT i.itemID, i.itemName, i.itemPrice,i.itemSource,COUNT(cpi.itemID) AS timesUsed
            FROM item i
            LEFT JOIN custom_package_item cpi ON i.itemID = cpi.itemID WHERE itemSource IN ('Supplied', 'Company')
            GROUP BY i.itemID, i.itemName, i.itemPrice 
            ORDER BY timesUsed DESC ";
            
            break;

        case "order": //Shows the total number of orders for each package and event type
            $query = "SELECT p.packageName, p.eventType,
    COUNT(o.orderID) AS totalOrders,
    SUM(p.price) AS totalRevenue,
    AVG(p.price) AS avgOrderValue,
    MIN(o.orderDate) AS firstOrderDate,
    MAX(o.orderDate) AS lastOrderDate
        FROM orders o
        LEFT JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
        GROUP BY p.packageName, p.eventType
        ORDER BY totalOrders DESC;
        ";
            break;
    }

    $result = $this->conn->query($query);
    $columns = $result->fetch_fields();
    $numColumns = count($columns);
    
    
    $pageWidth = 270; 
    $columnWidth = $pageWidth / $numColumns;

    // Initialize TCPDF
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle("Generated Report");
    
    
    $pdf->AddPage('L');
    
    
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->SetTextColor(0, 0, 128); 
    
    // Report Title
    $pdf->Cell(0, 12, strtoupper($this->reportType) . " REPORT", 0, 1, 'C');
    $pdf->Ln(5);

    //test Description
    $description = "";
    $pdf->SetTextColor(255, 0, 0); 

    if ($this->reportType == "item") {
        $description = "Helps determine which items are frequently included in event packages Useful for managing stock and procurement.";
    } elseif ($this->reportType == "customer") {
        $description = "This report identifies high-value customers and helps to create loyalty programs or special offers.";
    } elseif ($this->reportType == "order") {
        $description = "This report Shows the total number of orders for each package and event type. Helps identify the most popular package and revenue generated.Provides insights into the first and most recent orders for each package.";
    } elseif ($this->reportType == "Financial") {
        $description = "This report includes financial statements, revenue details, and expense tracking.";
    } else {
        $description = "This report provides relevant insights based on the selected data category.";
    }
    
    // Print the description
    $pdf->MultiCell(0, 8, $description, 0, 'C');

    // Table Header Styling
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetFillColor(0, 102, 204); 
    $pdf->SetTextColor(255, 255, 255); 

    // Table Headers
    foreach ($columns as $column) {
        $pdf->Cell($columnWidth, 10, ucfirst($column->name), 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Table Data
    $pdf->SetFont('helvetica', '', 11);
    $pdf->SetTextColor(0, 0, 0); 
    $fill = false; 

    while ($row = $result->fetch_assoc()) {
        foreach ($row as $column) {
            $pdf->SetFillColor(240, 240, 240); 
            $pdf->MultiCell($columnWidth, 10, $column, 1, 'L', $fill, 0);
        }
        $pdf->Ln();
        $fill = !$fill; 
    }

    // Save and Output PDF
    $pdf->Output('report.pdf', 'I'); 
    }

    
}
?>
